<?php

// Namespacing.
namespace Database\Seeders;

// Facades.
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models.
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            [
                'name' => 'Hello Fresh',
            ],
            [
                'name' => 'Bol.com',
            ],
            [
                'name' => 'ALDI',
            ],
            [
                'name' => 'LIDL',
            ],
            [
                'name' => 'Albert Heijn',
            ],
            [
                'name' => 'JUMBO',
            ],
            [
                'name' => 'Delhaize',
            ],
            [
                'name' => 'Telenet',
            ],
            [
                'name' => 'Kindertrein Evanshave',
            ],
            [
                'name' => 'Bond Moyson',
            ],
            [
                'name' => 'Engie',
            ],
        ];

        foreach($companies as $company)
            Company::create($company);
    }
}
