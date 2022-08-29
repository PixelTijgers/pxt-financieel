<?php

// Namespacing.
namespace Database\Seeders;

// Facades.
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Import models.
use App\Models\Bankaccount;

class BankaccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bankaccounts = [
            [
                'bankaccount_type_id' => 1,
                'accountnumber' => 'NL94 ASNB 0785 8406 05',
                'name' => 'Zichtrekening Michiel ASN'
            ],
            [
                'bankaccount_type_id' => 2,
                'accountnumber' => 'NL70 ASNB 8824 4061 22',
                'name' => 'Spaarrekening Michiel ASN'
            ],
            [
                'bankaccount_type_id' => 1,
                'accountnumber' => 'BE92 3771 3398 4723',
                'name' => 'Gedeelde Zichtrekening ING'
            ],
            [
                'bankaccount_type_id' => 1,
                'accountnumber' => 'BE72 3771 3398 4016',
                'name' => 'Zichtrekening Michiel ING'
            ],
            [
                'bankaccount_type_id' => 2,
                'accountnumber' => 'BE21 3636 2707 2203',
                'name' => 'Spaarrekening Michiel ING'
            ],
            [
                'bankaccount_type_id' => 2,
                'accountnumber' => 'BE21 3536 8938 9117',
                'name' => 'Gedeelde Spaarrekening ING'
            ],
            [
                'bankaccount_type_id' => 2,
                'accountnumber' => 'BE21 3804 2116 6593',
                'name' => 'Spaarrekening Flo ING'
            ],
            [
                'bankaccount_type_id' => 1,
                'accountnumber' => 'BE31 3630 2682 2055',
                'name' => 'Zichtrekening Naomi ING'
            ],
            [
                'bankaccount_type_id' => 2,
                'accountnumber' => 'BE23 3636 2229 8991',
                'name' => 'Spaarrekening Bas ING'
            ],
            [
                'bankaccount_type_id' => 2,
                'accountnumber' => 'BE40 3634 2691 8763',
                'name' => 'Spaarrekening Naomi ING'
            ],
        ];

        foreach($bankaccounts as $bankaccount)
            Bankaccount::create($bankaccount);
    }
}
