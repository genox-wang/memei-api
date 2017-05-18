<?php

use Illuminate\Database\Seeder;

use App\Models\Catagory;

class CatagoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catagories = factory(Catagory::class, 4)->make();
        Catagory::insert($catagories->toArray());
    }
}
