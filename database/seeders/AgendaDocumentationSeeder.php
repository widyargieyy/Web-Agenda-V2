<?php

namespace Database\Seeders;

use App\Models\AgendaDocumentation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgendaDocumentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // AgendaDocumentation::truncate();
        $datas = [
            [
                'agenda_id' => 1,
                'caption' => 'Foto kegiatan rapat',
                'filename' => 'foto_rapat.jpg',
                'filepath' => 'documentations/foto_rapat.jpg',
                'file_type' => 'foto',
                'uploaded_by' => 4,
                'uploaded_at' => now(),
            ],
        ];
        foreach($datas as $data){
            AgendaDocumentation::create($data);
        }
    }
}