<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::truncate();
        $datas = [
            [
                'name' => 'Admin',
                'email' => 'admin@demo.go.id',
                'password' => bcrypt('password'),
                'role_id' => 1,
                'unit_id' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Operator TU',
                'email' => 'operator@demo.go.id',
                'password' => bcrypt('password'),
                'role_id' => 2,
                'unit_id' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Kabid Infra',
                'email' => 'kabid@demo.go.id',
                'password' => bcrypt('password'),
                'role_id' => 3,
                'unit_id' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Staff Infra',
                'email' => 'staff@demo.go.id',
                'password' => bcrypt('password'),
                'role_id' => 4,
                'unit_id' => 1,
                'is_active' => true,
            ],
        ];

        foreach($datas as $data){
            User::create($data);
        }

    }
}