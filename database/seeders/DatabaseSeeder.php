<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Instansi;
use App\Models\Location;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            UnitSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            LocationSeeder::class,
            InstansiSeeder::class,
            AgendasSeeder::class,
            AgendaParticipantSeeder::class,
            AgendaAttachmentsSeeder::class,
            AgendaDocumentationSeeder::class,
            NotificationSeeder::class,
        ]);
    }
}