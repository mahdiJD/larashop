<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Blog;
use App\Models\Categorie;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //seed user and rol
        User::factory(10)->create();
        User::find([5,6])->each(function($user){
            $user->role = Role::admin;
            $user->save();
        });
        User::find([7])->each(function($user){
            $user->role = Role::root;
            $user->save();
        });

        //seed blog
        $images = Storage::allFiles('images');
        foreach($images as $image){
            Blog::factory()->create([
                'file' => $image,
            ]);
        }

        //seed comment
        Blog::find([1,2])->each(function($image){
            User::find([1,2,3,4,])->each(function($user) use($image){
                $image->comments()->save(Comment::factory()->make([
                    'user_id' => $user->id ,
                    'approved' => rand(0,1) ,
                ]));
            });
        });

        // seed tag adn match with blog
        $tags = Tag::factory(10)->create();
        Blog::all()->each(function ($blog) use($tags){
            $blog->tags()->attach(
                $tags->pluck('id')->random(rand(2,5)),
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        });
        //seed products
        $images = Storage::allFiles('products');
        foreach($images as $image){
            Product::factory()->create([
                'file' => $image,
            ]);
        }
        //seed categori
        $categories = Categorie::factory(10)->create();
        Product::all()->each(function ($product) use($categories){
            $product->categories()->attach(
                $categories->pluck('id')->random(rand(2,5)),
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        });


        $users = User::all();
        Blog::all()->each(function($image) use($users){
            $image->likes()->attach(
                $users->pluck('id')->random($num_likes = rand(2,7)),
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
            $image->increment('likes_count', $num_likes);
        });

    }
}
