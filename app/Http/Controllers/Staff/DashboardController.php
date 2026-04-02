<?php

namespace App\Http\Controllers\Staff;

use Carbon\Carbon;
use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AgendaAttachments;

class DashboardController extends Controller
{
    public function toDashboard()
    {
        $upcomingAgendas = Agenda::where('status', 'APPROVED')
            ->with(['category', 'location'])
            ->whereDate('date', '>=', now())
            ->orderBy('date', 'asc')
            ->get();

        $today = Carbon::today();
        $totalAgenda = Agenda::where('status', 'APPROVED')->orWhere('status', 'COMPLETED')->count();
        $agendaBulanIni = Agenda::whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->where('status', 'APPROVED')
            ->orWhere('status', 'COMPLETED')
            ->count();

        // return [$totalAgenda, $agendaBulanIni];
        $totalDokumen = AgendaAttachments::whereHas('agenda', function ($query) {
            $query->where('status', 'APPROVED')->orWhere('status', 'COMPLETED');
        })->count();
        
        return view('staff.dashboard', [
            'agendaMendatang' => $upcomingAgendas,
            'totalAgenda' => $totalAgenda,
            'agendaBulanIni' => $agendaBulanIni,
            'totalDokumen' => $totalDokumen,
        ]);
    }
}