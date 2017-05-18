<?php

use Illuminate\Database\Seeder;

use App\Models\Author;
use App\Models\Card;

class CardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $author_ids = Author::pluck('id')->toArray();
        $cards = factory(Card::class, 80)->make()
        ->each(function($card) use($faker, $author_ids){
          $card->author_id = $faker->randomElement($author_ids);
        });
        return Card::insert($cards->toArray());
    }
}
