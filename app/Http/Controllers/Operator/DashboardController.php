<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function toDashboard()
    {
        $userId = Auth::user()->id;

        // Menghitung jumlah berdasarkan status dan user
        $agendaDraft = Agenda::where('created_by', $userId)->where('status', 'DRAFT')->count();
        $agendaPending = Agenda::where('created_by', $userId)->where('status', 'PENDING')->count();
        $agendaApproved = Agenda::where('created_by', $userId)->where('status', 'APPROVED')->count();
        $agendaRejected = Agenda::where('created_by', $userId)->where('status', 'REJECTED')->count();

        // Mengambil data terbaru berdasarkan user
        $dataAgendaDraft = Agenda::where('created_by', $userId)->where('status', 'DRAFT')->latest()->take(5)->get();

        $dataAgendaRejected = Agenda::where('created_by', $userId)->where('status', 'REJECTED')->latest()->take(5)->get();

        return view('operator.dashboard', [
            'agendaDraft' => $agendaDraft,
            'agendaPending' => $agendaPending,
            'agendaApproved' => $agendaApproved,
            'agendaRejected' => $agendaRejected,
            'dataAgendaDraft' => $dataAgendaDraft,
            'dataAgendaRejected' => $dataAgendaRejected ,
        ]);
    }
}