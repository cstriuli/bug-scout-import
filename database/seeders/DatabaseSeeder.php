<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Company;
use \App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::factory(20)->create();
        $companies = Company::factory(2)->create();

        $companies->each(function (Company $company) use ($products) {
            $company->products()->attach(
                $products->random(rand(5, 10))->pluck('id')->toArray(),
                ['published' =>  (bool) random_int(0, 1)]
            );
        });
    }
}
