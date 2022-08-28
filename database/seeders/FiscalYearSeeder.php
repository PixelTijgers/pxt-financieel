<?php

// Namespacing.
namespace Database\Seeders;

// Facades.
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models.
use App\Models\FiscalYear;

class FiscalYearSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $fiscal_years = [
            [
                'year' => 2022,
                'name' => 'Boekjaar 2022',
            ],
        ];

        foreach($fiscal_years as $fiscal_year)
            FiscalYear::create($fiscal_year);
    }
}
