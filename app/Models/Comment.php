<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable =['user_id','image_id','body'];

    public function image() {
        return $this->belongsTo(Blog::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeApproved($query) {
        return $query->where('approved',true);
    }
    public function scopeForUser($query, User $user) {
        return $query->whereIn('image_id',Blog::whereBelongsTo($user)->pluck('id'));
    }
}
