<?php

namespace Database\Seeders;

use App\Models\Instansi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Instansi::truncate();
        $datas = [
            [
                'name' => 'Dinas PUPR',
                'contact' => 'pupr@pemda.go.id',
            ],
            [
                'name' => 'Dinas Perhubungan',
                'contact' => 'dishub@pemda.go.id',
            ],
        ];

        foreach($datas as $data){
            Instansi::create($data);
        }
    }
}