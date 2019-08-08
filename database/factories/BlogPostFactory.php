<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\BlogPost;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(BlogPost::class, function (Faker $faker) {
    $title = $faker->sentence(mt_rand(3, 8), true);
    $txt = $faker->realText(mt_rand(1000, 4000));
    $isPublished = mt_rand(1, 5) > 1;
    $createdAt = $faker->dateTimeBetween('-3 months', '-2 months');

    return [
        'category_id'   => mt_rand(1, 11),
        'user_id'       => (mt_rand(1, 5) == 5) ? 1 : 2,
        'title'         => $title,
        'slug'          => Str::slug($title),
        'excerpt'       => $faker->text(mt_rand(40, 100)),
        'content_raw'   => $txt,
        'content_html'  => $txt,
        'is_published'  => $isPublished,
        'published_at'  => $isPublished ? $faker->dateTimeBetween('-2 months', '-1 days') : null,
        'created_at'    => $createdAt,
        'updated_at'    => $createdAt,
    ];
});
