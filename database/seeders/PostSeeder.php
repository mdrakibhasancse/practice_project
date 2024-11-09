<?php

namespace Database\Seeders;

use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i <= 1000; $i++) {
            $faker = Factory::create();
            $post = new Post();
            $post->title = $faker->sentence;
            $post->slug = Str::slug($post->title);
            $post->excerpt = $faker->paragraph;
            $post->description = $faker->paragraph(3);
            $post->image = $faker->imageUrl(640, 480, 'posts', true);
            $post->save();

        }

    }
}
