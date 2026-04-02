<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Role::truncate();
        $datas = [
            [
                'name' => 'Admin',
                'description' => 'Pengelola sistem dan master data',
            ],
            [
                'name' => 'Operator',
                'description' => 'Petugas input dan pengelolaan agenda',
            ],
            [
                'name' => 'Kabid',
                'description' => 'Kepala bidang yang melakukan persetujuan agenda',
            ],
            [
                'name' => 'Staff',
                'description' => 'Pegawai yang melihat agenda dan mengunggah dokumentasi',
            ],
        ];

        foreach($datas as $data){
            Role::create($data);
        }

        
    }
}