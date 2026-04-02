<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgendasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Agenda::truncate();
        $datas = [
            [
                'title' => 'Rapat Koordinasi Infrastruktur',
                'description' => 'Pembahasan rencana pembangunan infrastruktur',
                'date' => '2026-02-15',
                'start_time' => '09:00',
                'end_time' => '11:00',
                'category_id' => 1,
                'location_id' => 1,
                'instansi_id' => 1,
                'unit_id' => 1,
                'status' => 'DRAFT',
                'created_by' => 2,
            ],

            [
                'title' => 'Survei Drainase Desa Aeng Tong-tong',
                'description' => 'Survei kondisi drainase untuk perencanaan perbaikan',
                'date' => '2026-02-18',
                'start_time' => '08:00',
                'end_time' => '12:00',
                'category_id' => 3,
                'location_id' => 2,
                'instansi_id' => 1,
                'unit_id' => 1,
                'status' => 'PENDING',
                'created_by' => 2,
            ],

            [
                'title' => 'Monitoring Proyek Jalan Lingkar Utara',
                'description' => 'Monitoring progres pembangunan jalan lingkar utara',
                'date' => '2026-02-20',
                'start_time' => '10:00',
                'end_time' => '13:00',
                'category_id' => 4,
                'location_id' => 2,
                'instansi_id' => 1,
                'unit_id' => 1,
                'status' => 'APPROVED',
                'created_by' => 2,
                'approved_by' => 3,
                'approved_at' => now(),
            ],

            [
                'title' => 'Kunjungan Lapangan Pembangunan Jembatan',
                'description' => 'Kunjungan ke lokasi pembangunan jembatan penghubung desa',
                'date' => '2026-02-22',
                'start_time' => '09:30',
                'end_time' => '14:00',
                'category_id' => 2,
                'location_id' => 2,
                'instansi_id' => 2,
                'unit_id' => 1,
                'status' => 'COMPLETED',
                'created_by' => 2,
                'approved_by' => 3,
                'approved_at' => now(),
            ],

            [
                'title' => 'Rapat Evaluasi Triwulan I',
                'description' => 'Evaluasi pelaksanaan program infrastruktur triwulan I',
                'date' => '2026-03-01',
                'start_time' => '13:00',
                'end_time' => '15:00',
                'category_id' => 1,
                'location_id' => 1,
                'instansi_id' => 1,
                'unit_id' => 1,
                'status' => 'REJECTED',
                'created_by' => 2,
                'rejected_reason' => 'Jadwal bentrok dengan agenda pimpinan',
            ],

            [
                'title' => 'Koordinasi Penanganan Banjir',
                'description' => 'Koordinasi lintas OPD terkait penanganan banjir musiman',
                'date' => '2026-03-05',
                'start_time' => '09:00',
                'end_time' => '11:30',
                'category_id' => 5,
                'location_id' => 1,
                'instansi_id' => 2,
                'unit_id' => 1,
                'status' => 'CANCELLED',
                'created_by' => 2,
            ],
        ];

        foreach ($datas as $data) {
            Agenda::create($data);
        }
    }
}