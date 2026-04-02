<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Unit::truncate();
        $datas = [
            [
                'name' => 'Infrastruktur dan Kewilayahan',
                'code' => 'INFRAKWIL',
            ],
        ];

        foreach($datas as $data){
            Unit::create($data);
        }

        
    }
}