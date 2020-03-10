<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AddCategoriesBrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<2;$i++){
            $categoryId = $this->seedCategory();
            $this->seedBrand($categoryId);
        }
    }

    protected function seedCategory()
    {
        return DB::table(\App\Category::TABLE_NAME)->insertGetId([
            'name' => Str::random(10),
        ]);
    }

    private function seedBrand($categoryId)
    {
        return DB::table(\App\Brand::TABLE_NAME)->insertGetId([
            'name' => Str::random(10),
            'category_id'=>$categoryId,
            'website'=>'http:://'.Str::random(20).'.local',
        ]);
    }
}
