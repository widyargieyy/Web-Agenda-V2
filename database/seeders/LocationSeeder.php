<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Location::truncate();
        $datas = [
            [
                'name' => 'Ruang Rapat Bappeda',
                'address' => 'Kantor Bappeda Lt. 2',
            ],
            [
                'name' => 'Aula Pemda',
                'address' => 'Kantor Bupati',
            ],
        ];

        foreach($datas as $data){
            Location::create($data);
        }


    }
}