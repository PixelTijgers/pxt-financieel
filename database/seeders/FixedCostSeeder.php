<?php

// Namespacing.
namespace Database\Seeders;

// Facades.
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models.
use App\Models\FixedCost;

class FixedCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fixedCosts = [
            [
                'fiscal_year_id' => 1,
                'bankaccount_id' => 3,
                'category_id' => 7,
                'company_id' => 8,
                'cost' => 45,
                'is_shared' => 1,
            ],
            [
                'fiscal_year_id' => 1,
                'bankaccount_id' => 1,
                'category_id' => 6,
                'company_id' => 12,
                'cost' => 11
            ],
        ];

        foreach($fixedCosts as $fixedCost)
            FixedCost::create($fixedCost);
    }
}
