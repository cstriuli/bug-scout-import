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
        \App\Models\CompanyProductPivot::disableSearchSyncing();

        $products = Product::factory(100)->create();
        $companies = Company::factory(10)->create();
        $faker = \Faker\Factory::create();

        $companies->each(function (Company $company) use ($products, $faker) {
            $company->products()->attach(
                $products->random(10)->pluck('id')->toArray(),
                ['published' =>  $faker->boolean]
            );
        });

        \App\Models\CompanyProductPivot::enableSearchSyncing();
    }
}
