<?php

// Namespacing.
namespace Database\Seeders;

// Facades.
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Import models.
use App\Models\BankaccountType;

class BankaccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bankaccountTypes = [
            [
                'name' => 'Zichtrekening',
            ],
            [
                'name' => 'Spaarrekening',
            ],
        ];

        foreach($bankaccountTypes as $bankaccountType)
            BankaccountType::create($bankaccountType);
    }
}
