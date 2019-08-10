<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        $categoryName = 'Без категории';
        $categories[] = [
            'title'     => $categoryName,
            'slug'      => Str::slug($categoryName),
            'parent_id' => 0,
        ];

        for ($i = 1; $i <= 10; $i++) {
            $categoryName = 'Категория #' . $i;
            $parentId = ($i > 4) ? mt_rand(1, 4) : 1;

            $categories[] = [
                'title'     => $categoryName,
                'slug'      => Str::slug($categoryName),
                'parent_id' => $parentId,
            ];
        }
        DB::table('blog_categories')->insert($categories);
    }
}
