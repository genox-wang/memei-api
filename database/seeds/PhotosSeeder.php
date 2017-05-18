<?php

use Illuminate\Database\Seeder;

use App\Models\Card;
use App\Models\Photo;

class PhotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $card_ids = Card::pluck('id')->toArray();
        $photos = factory(Photo::class, 160)->make()
        ->each(function($photo) use($faker, $card_ids) {
          $photo->card_id = $faker->randomElement($card_ids);
        });
        return Photo::insert($photos->toArray());
    }
}
