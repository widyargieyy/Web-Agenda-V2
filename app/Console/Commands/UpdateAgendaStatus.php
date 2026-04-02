<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Agenda;
use Illuminate\Console\Command;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Attributes\Description;

#[Signature('app:update-agenda-status')]
#[Description('Command description')]
class UpdateAgendaStatus extends Command
{
    /**
     * Execute the console command. 
     */
    public function handle()
    {
        $now = Carbon::now();
        
        Agenda::where('status', 'APPROVED')
            ->where(function ($q) use ($now) {
                $q->whereDate('date', '<', $now->toDateString())->orWhere(function ($q2) use ($now) {
                    $q2->whereDate('date', $now->toDateString())->whereTime('end_time', '<', $now->toTimeString());
                });
            })
            ->update([
                'status' => 'COMPLETED',
            ]);
        
        return 0;
    }
}