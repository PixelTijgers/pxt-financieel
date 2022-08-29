<?php

// Namespacing.
namespace Database\Seeders;

// Facades.
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models.
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Hypotheek',
            ],
            [
                'name' => 'Water',
            ],
            [
                'name' => 'Gas en elektra',
            ],
            [
                'name' => 'Boodschappen',
            ],
            [
                'name' => 'Verzekeringen',
            ],
            [
                'name' => 'Telefonie',
            ],
            [
                'name' => 'Internet',
            ],
            [
                'name' => 'Belastingen',
            ],
            [
                'name' => 'Kinderopvang',
            ],
            [
                'name' => 'Marktplaats',
            ],
            [
                'name' => 'Bol.com',
            ],
            [
                'name' => 'Online aankoop',
            ],
            [
                'name' => 'Overboeking tussen rekeningen',
            ],
            [
                'name' => 'Hello Fresh',
            ],
            [
                'name' => 'Benzine',
            ],
            [
                'name' => 'Kleding',
            ],
            [
                'name' => 'Horeca',
            ],
            [
                'name' => 'Efteling',
            ],
            [
                'name' => 'Abonnementen',
            ],
            [
                'name' => 'Overige betalingen',
            ],
            [
                'name' => 'Kinderen',
            ],
        ];

        foreach($categories as $category)
            Category::create($category);
    }
}
