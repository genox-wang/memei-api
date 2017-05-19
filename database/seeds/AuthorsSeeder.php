<?php

use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Author;

class AuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create();
      $category_ids = Category::pluck('id')->toArray();
      $authors = factory(Author::class, 30)->make()
      ->each(function($author) use ($faker, $category_ids){
        $author->category_id = $faker->randomElement($category_ids);
      });
      Author::insert($authors->toArray());
    }
}
