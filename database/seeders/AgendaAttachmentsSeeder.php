<?php

namespace Database\Seeders;

use App\Models\AgendaAttachments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgendaAttachmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // AgendaAttachments::truncate();   
        $datas = [
            [
                'agenda_id' => 1,
                'filename' => 'undangan_rapat.pdf',
                'filepath' => 'agendas/undangan_rapat.pdf',
                'mime_type' => 'application/pdf',
                'file_size' => 245000,
                'uploaded_by' => 2,
                'is_primary' => true,
                'uploaded_at' => now(),
            ],
        ];

        foreach ($datas as $data) {
            AgendaAttachments::create($data);
        }
    }
}