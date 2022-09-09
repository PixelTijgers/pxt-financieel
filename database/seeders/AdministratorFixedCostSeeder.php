<?php

// Namespacing.
namespace Database\Seeders;

// Facades.
use Illuminate\Database\Seeder;

// Models.
use App\Models\AdministratorFixedCost;

class AdministratorFixedCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $AdministratorFixedCosts = [
            [
                'admin_id' => 1,
                'fixed_cost_id' => 1
            ],
            [
                'admin_id' => 2,
                'fixed_cost_id' => 1
            ],
            [
                'admin_id' => 1,
                'fixed_cost_id' => 2
            ],
        ];

        foreach($AdministratorFixedCosts as $AdministratorFixedCost)
            AdministratorFixedCost::create($AdministratorFixedCost);
    }
}
