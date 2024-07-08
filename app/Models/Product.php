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

class Product extends Model
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

    /*
     * TO DO
     * tag => category
     * */
    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /*
     * TO DO
     * comments => commentsForProduct
     * */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function cart() : BelongsToMany{
        return $this->belongsToMany(User::class,'cart','product_id','user_id')->withTimestamps();
    }

    /*
     * TO DO
     * tag => category
     * */
    public function tagLinks() : HtmlString {
        $items = $this
            ->tags()
            ->pluck('name','slug')
            ->map(function($name, $slug){
                return "<li><a href=".route('product.tag',$slug) .">{$name}</a></li>";
            })->join("");
        return new HtmlString("<ul>{$items}</ul>");
    }

    /*
     * TO DO
     * tag => category
     * */
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

    /*
     * TO DO
     * tag => category
     * */
    public function tagString() : string {
        return $this->tags()->pluck('name')->join(',');
    }

    public function relatedProducts($limit = 3) : mixed
    {
        $tagsId = $this->load('tags')->tags->pluck('id');
        return Product::where('id','!=',$this->id)
            ->whereHas('tags', function($query) use($tagsId){
                $query->whereIn('tag_id', $tagsId);
            })
            ->inRandomOrder()
            ->take($limit)
            ->get();
    }
    public function hasBeenFavorites()
    {
        $userId = auth()->id();
        $productId = $this->id;
        return Product::whereHas('favorites',function($query) use($userId , $productId){
            $query->where('user_id', $userId)->where('product_id', $productId);
        })->count();
    }

    public static function makeDirectory(){
        $subFolder = 'products/' . date('y/m/d');
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
        return $this->slug ? route('products.show' , $this->slug) : "#" ;
    }

    public function route($method,$key ='id'){
        return route("products.{$method}",$this->$key);
    }

    public function getSlug(){
        $slug = str($this->title)->slug();
        $numSlugsFound =Product::where('slug','regexp',"^".$slug."(-[0-9])?")->count();
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
        static::creating(function ($product){
            if ($product->title){
                $product->slug = $product->getSlug();
                $product->is_published = true;
            }
        });
        static::updating(function ($product){
            if ($product->title && !$product->slug){
                $product->slug = $product->getSlug();
                $product->is_published = true;
            }
        });
        static::deleted(function($product){
            Storage::delete($product->file);
        });
        static::deleting(function($product){
            $product->tags->each(function($tag){
                $productCount = $tag->products()->wherePivot('product_id','!=',
                    $tag->pivot->product_id)->count();
                if (!$productCount) {
                    $tag->delete();
                }
            });
        });
    }
}