<?php

namespace App\Http\Controllers\Kabid;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dataPending = Agenda::where('status', 'PENDING')->get();
        // Semua
        $totalDataPending = Agenda::where('status', 'PENDING')->count();
        $totalDataApproved = Agenda::where('status', 'APPROVED')->count();
        $totalDataCompleted = Agenda::where('status', 'COMPLETED')->count();
        $totalDataCancelled = Agenda::where('status', 'CANCELLED')->count();

        // Total Agenda Bulanan
        $totalDataAgendaPendingBulanan = Agenda::where('status', 'PENDING')
            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();

        $totalDataAgendaApprovedBulanan = Agenda::where('status', 'APPROVED')
            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();

        $totalDataAgendaCompletedBulanan = Agenda::where('status', 'COMPLETED')
            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();

        $totalDataAgendaRejectedBulanan = Agenda::where('status', 'REJECTED')
            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();

        $totalDataAgendaCancelledBulanan = Agenda::where('status', 'CANCELLED')
            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();
        
        // return $totalDataAgendaPendingBulanan;
        return view('kabid.dashboard', [
            // Data List
            'dataPending' => $dataPending,

            // Total Keseluruhan (All Time)
            'totalPending' => $totalDataPending,
            'totalApproved' => $totalDataApproved,
            'totalCompleted' => $totalDataCompleted,
            'totalCancelled' => $totalDataCancelled,

            // Total Agenda Bulanan (Current Month)
            'pendingBulanan' => $totalDataAgendaPendingBulanan,
            'approvedBulanan' => $totalDataAgendaApprovedBulanan,
            'completedBulanan' => $totalDataAgendaCompletedBulanan,
            'rejectedBulanan' => $totalDataAgendaRejectedBulanan,
            'cancelledBulanan' => $totalDataAgendaCancelledBulanan,
        ]);
    }
}