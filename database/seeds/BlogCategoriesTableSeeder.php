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
        $created = Carbon::now();
        $category = [
            ['title' => 'PHP-фреймворки', 'parent_id' => 0],
            ['title' => 'Javascript-фреймворки', 'parent_id' => 0],
            ['title' => 'CSS-фреймворки', 'parent_id' => 0],
        ];
        $child = [
            ['title' => 'Laravel', 'parent_id' => 1],
            ['title' => 'Symfony', 'parent_id' => 1],
            ['title' => 'CodeIgniter', 'parent_id' => 1],
            ['title' => 'Yii 2', 'parent_id' => 1],
            ['title' => 'React', 'parent_id' => 2],
            ['title' => 'Vue', 'parent_id' => 2],
            ['title' => 'Angular', 'parent_id' => 2],
            ['title' => 'Redux', 'parent_id' => 2],
            ['title' => 'Bootstrap', 'parent_id' => 3],
            ['title' => 'Skeleton', 'parent_id' => 3],
            ['title' => 'Kube', 'parent_id' => 3],
            ['title' => 'Foundation', 'parent_id' => 3],
        ];
        $data = array_merge($category, $child);
        foreach ($data as $key => $value) {
            $data[$key]['slug'] = Str::slug($value['title']);
            $data[$key]['created_at'] = $created;
            $data[$key]['updated_at'] = $created;
        }
        DB::table('blog_categories')->insert($data);
    }
}
