<?php

use Illuminate\Database\Seeder;

use App\Models\Catagory;
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
      $catagory_ids = Catagory::pluck('id')->toArray();
      $authors = factory(Author::class, 30)->make()
      ->each(function($author) use ($faker, $catagory_ids){
        $author->catagory_id = $faker->randomElement($catagory_ids);
      });
      Author::insert($authors->toArray());
    }
}
