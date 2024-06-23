<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Laravel para principiantes'],
            ['name' => 'Laravel para avanzandos'],
            ['name' => 'Angular para principiantes'],
            ['name' => 'Angular para avanzados'],
            ['name' => 'React para principiantes'],
            ['name' => 'React para avanzados'],
            ['name' => 'Ionic para principiantes'],
            ['name' => 'Ionic para avanzados']
        ];

        foreach($categories as $value) {
            Category::create($value);
        }
    }
}
