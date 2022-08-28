<?php

// Namespacing.
namespace Database\Seeders;

// Facades.
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models.
use App\Models\Administrator;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrators = [
            [
                'name' => 'Michiel Elshout',
                'email' => 'melshout2@gmail.com',
                'phone' => '+31 (0)6 23 38 47 06',
                'password' => \Hash::make('(Michiel0912!)'),
            ],
            [
                'name' => 'Naomi Ongenae',
                'email' => 'naomiongenae2@gmail.com',
                'phone' => '+32 (0)4 76 76 73 98',
                'password' => \Hash::make('(Naomi0912!)'),
            ],
        ];

        foreach($administrators as $administrator) {
            $crAdministrator = Administrator::create($administrator);

            // Add avatar to database.
            $crAdministrator->addMediaFromBase64(\Avatar::create($crAdministrator['name'])->toBase64())
                ->toMediaCollection('avatar');
        }
    }
}
