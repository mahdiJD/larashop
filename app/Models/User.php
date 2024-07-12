<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function blogs(){
        return $this->hasMany(Blog::class);
    }

    public function comments(): HasMany{
        return $this->hasMany(Comment::class);
    }

    public function carts() : HasMany{
        return $this->hasMany(Cart::class);
    }

    protected static function booted() : void
    {
        static::created(function($user){
//            $user->setting()->create([
//                'email_notification' => [
//                    'new_comment' => 1,
//                    'new_image'   => 1,
//                ]
//            ]);
        });
    }

    public static function makeDirectory(): string
    {
        $directory = 'users';
        Storage::makeDirectory($directory);
        return $directory;
    }

    // public function url()
    // {
    //     return route('author.show',$this->username);
    // }

    public function profileBlogUrl(){
        return Storage::url($this->profile_image ? $this->profile_image :
            'users/user-default.png');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'role' => Role::class ,
            'password' => 'hashed',
        ];
    }
}
