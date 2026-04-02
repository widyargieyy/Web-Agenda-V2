<?php

namespace Database\Seeders;

use App\Models\AgendaParticipant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgendaParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // AgendaParticipant::truncate();
        $datas = [
            [
                'agenda_id' => 1,
                'user_id' => 4,
                'invited' => true,
            ],
            [
                'agenda_id' => 1,
                'name' => 'Kepala Dinas PUPR',
                'instansi_name' => 'Dinas PUPR',
                'role' => 'Kadis',
                'invited' => true,
            ],
        ];

        foreach($datas as $data){
            AgendaParticipant::create($data);
        }
    }
}