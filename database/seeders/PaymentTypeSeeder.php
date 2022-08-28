<?php

// Namespacing.
namespace Database\Seeders;

// Facades.
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models.
use App\Models\PaymentType;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentTypes = [
            [
                'name' => 'Vaste kost',
            ],
            [
                'name' => 'Variabele kosten',
            ],
            [
                'name' => 'Onvoorziene kost',
            ],
        ];

        foreach($paymentTypes as $paymentType)
            PaymentType::create($paymentType);
    }
}
