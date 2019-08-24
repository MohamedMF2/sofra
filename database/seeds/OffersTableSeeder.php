<?php

use Illuminate\Database\Seeder;
use App\Offer;
class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(Offer::class,5)->create();
    }
}
