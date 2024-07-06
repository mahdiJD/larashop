<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
class Blog extends Model
{
    use HasFactory;

    protected $fillable =[
        'title' ,
        'file',
        'body',
        'user_id',
        'slug',
        'short',
        'is_published'
    ];


    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function likes() : BelongsToMany{
        return $this->belongsToMany(User::class,'likes','blog_id','user_id')->withTimestamps();
    }
    public function favorites() : BelongsToMany{
        return $this->belongsToMany(User::class,'favorites','blog_id','user_id')->withTimestamps();
    }
    public function tagLinks() : HtmlString {
        $items = $this
            ->tags()
            ->pluck('name','slug')
            ->map(function($name, $slug){
                return "<li><a href=".route('blog.tag',$slug) .">{$name}</a></li>";
            })->join("");
        return new HtmlString("<ul>{$items}</ul>");
    }

    public function syncTags($tagString)
    {
        if(!$tagString) return ;
        $tagsId = collect(explode("," , $tagString))
            ->filter()
            ->map(function($tag){
                $tagsObj = Tag::firstOrCreate([
                    'name' => trim($tag),
                    'slug' => str($tag)->slug(),
                ]);
                return $tagsObj->id;
            });
        $this->tags()->sync($tagsId);
    }

    public function tagString() : string {
        return $this->tags()->pluck('name')->join(',');
    }

    public function relatedBlogs($limit = 3) : mixed
    {
        $tagsId = $this->load('tags')->tags->pluck('id');
        return Blog::where('id','!=',$this->id)
            ->whereHas('tags', function($query) use($tagsId){
                $query->whereIn('tag_id', $tagsId);
            })
            ->inRandomOrder()
            ->take($limit)
            ->get();
    }

    public function hasBeenLiked()
    {
        $userId = auth()->id();
        $blogId = $this->id;
        return Blog::whereHas('likes',function($query) use($userId , $blogId){
            $query->where('user_id', $userId)->where('blog_id', $blogId);
        })->count();
    }
    public function hasBeenFavorites()
    {
        $userId = auth()->id();
        $blogId = $this->id;
        return Blog::whereHas('favorites',function($query) use($userId , $blogId){
            $query->where('user_id', $userId)->where('blog_id', $blogId);
        })->count();
    }

    public static function makeDirectory(){
        $subFolder = 'blogs/' . date('y/m/d');
        Storage::makeDirectory($subFolder);
        return $subFolder;
    }

    public function scopePublished($query){
        return $query->where('is_published',true);
    }

    public function scopeVisibleFor($query , User $user){
        if($user->role === Role::root || $user->role === Role::admin)
            return ;
        $query->where('user_id',$user->id);
    }

    public function fileURL(){
        return Storage::url($this->file);
    }

    public function thePermalink(){
        return $this->slug ? route('blogs.show' , $this->slug) : "#" ;
    }

    public function route($method,$key ='id'){
        return route("blogs.{$method}",$this->$key);
    }

    public function getSlug(){
        $slug = str($this->title)->slug();
        $numSlugsFound =Blog::where('slug','regexp',"^".$slug."(-[0-9])?")->count();
        if ($numSlugsFound > 0){
            return $slug . "-" . $numSlugsFound + 1;
        }
        return $slug;
    }

    public function uploadDate(){
        return $this->created_at->diffForHumans();
    }
    protected static function booted()
    {
        static::creating(function ($blog){
            if ($blog->title){
                $blog->slug = $blog->getSlug();
                $blog->is_published = true;
            }
        });
        static::updating(function ($blog){
            if ($blog->title && !$blog->slug){
                $blog->slug = $blog->getSlug();
                $blog->is_published = true;
            }
        });
        static::deleted(function($blog){
            Storage::delete($blog->file);
        });
        static::deleting(function($blog){
            $blog->tags->each(function($tag){
                $blogCount = $tag->blogs()->wherePivot('blog_id','!=',
                    $tag->pivot->blog_id)->count();
                if (!$blogCount) {
                    $tag->delete();
                }
            });
        });
    }
}
