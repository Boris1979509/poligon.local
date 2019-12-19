<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [];
        $cName = "Без категории";
        $category[] = [
            'title' => $cName,
            'slug' => Str::slug($cName, '_'),
            'parent_id' => 0
        ];
        for($i = 0; $i <= 10; $i++){
            $cName = "Категория №{$i}";
            $perentId = ($i > 4) ? rand(1, 4) : 1;
            $category[] = [
                'title' => $cName,
                'slug' => Str::slug($cName, '_'),
                'parent_id' => $perentId
            ];
        }
        DB::table('blog_categories')->insert($category);
    }
}
