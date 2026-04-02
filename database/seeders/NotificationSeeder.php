<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Notification::truncate();
        $datas = [
            [
                'user_id' => 3,
                'title' => 'Agenda Baru',
                'message' => 'Ada agenda baru menunggu persetujuan',
                'link' => '/kabid/agenda/pending',
                'is_read' => false,
            ],
        ];

        foreach($datas as $data){
            Notification::create($data);
        }
    }
}