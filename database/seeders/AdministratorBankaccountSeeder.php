<?php

// Namespacing.
namespace Database\Seeders;

// Facades.
use Illuminate\Database\Seeder;

// Models.
use App\Models\AdministratorBankaccount;

class AdministratorBankaccountSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $administratorBankaccounts = [
            [
                'admin_id' => 1,
                'bankaccount_id' => 1
            ],
            [
                'admin_id' => 1,
                'bankaccount_id' => 2
            ],
            [
                'admin_id' => 1,
                'bankaccount_id' => 3
            ],
            [
                'admin_id' => 2,
                'bankaccount_id' => 3
            ],
            [
                'admin_id' => 1,
                'bankaccount_id' => 4
            ],
            [
                'admin_id' => 1,
                'bankaccount_id' => 5
            ],
            [
                'admin_id' => 1,
                'bankaccount_id' => 6
            ],
            [
                'admin_id' => 2,
                'bankaccount_id' => 6
            ],
            [
                'admin_id' => 1,
                'bankaccount_id' => 7
            ],
            [
                'admin_id' => 2,
                'bankaccount_id' => 7
            ],
            [
                'admin_id' => 2,
                'bankaccount_id' => 8
            ],
            [
                'admin_id' => 1,
                'bankaccount_id' => 9
            ],
            [
                'admin_id' => 2,
                'bankaccount_id' => 9
            ],
            [
                'admin_id' => 2,
                'bankaccount_id' => 10
            ],
        ];

        foreach($administratorBankaccounts as $administratorBankaccount)
            AdministratorBankaccount::create($administratorBankaccount);
    }
}
