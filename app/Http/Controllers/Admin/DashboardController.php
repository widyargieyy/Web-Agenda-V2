<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{   
    public function toDashboard(){
        $dataAgenda = Agenda::with('creator')->orderBy('created_at', 'desc')->take(5)->get();

        // Dynamic counts
        $totalUser = User::count(); // Total Data User
        $totalAgenda = Agenda::count(); // Total Agenda
        $totalPending = Agenda::where('status', 'pending')->count(); // Agenda Pending
        $totalApproved = Agenda::where('status', 'approved')->count(); // Agenda Disetujui

        // User count per role (dynamic)
        $totalAdmin = User::whereHas('role', function($q){ $q->where('name', 'Admin'); })->count();
        $totalKabid = User::whereHas('role', function($q){ $q->where('name', 'Kabid'); })->count();
        $totalOperator = User::whereHas('role', function($q){ $q->where('name', 'Operator'); })->count();
        $totalStaff = User::whereHas('role', function($q){ $q->where('name', 'Staff'); })->count();

        return view('admin.dashboard', [
            'dataAgenda' => $dataAgenda,
            'totalUser' => $totalUser,
            'totalAgenda' => $totalAgenda,
            'totalPending' => $totalPending,
            'totalApproved' => $totalApproved,

            'totalAdmin' => $totalAdmin,
            'totalKabid' => $totalKabid,
            'totalOperator' => $totalOperator,
            'totalStaff' => $totalStaff,
        ]);
    }
}   