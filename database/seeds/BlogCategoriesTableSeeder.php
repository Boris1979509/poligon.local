<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        $category = [];
        $cName = 'Без категории';
        $dateNow = Carbon::now();

        $category[] = [
            'title'      => $cName,
            'slug'       => Str::slug($cName, '_'),
            'parent_id'  => 0,
            'created_at' => $dateNow,
            'updated_at' => $dateNow,
        ];
        for ($i = 0; $i <= 10; $i++) {
            $cName = 'Категория_' . $i;
            $parentId = ($i > 4) ? random_int(1, 4) : 1;
            $category[] = [
                'title'      => $cName,
                'slug'       => Str::slug($cName, '_'),
                'parent_id'  => $parentId,
                'created_at' => $dateNow,
                'updated_at' => $dateNow,
            ];
        }
        DB::table('blog_categories')->insert($category);
    }
}
