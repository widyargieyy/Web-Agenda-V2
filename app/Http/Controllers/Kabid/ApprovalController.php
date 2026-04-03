<?php

namespace App\Http\Controllers\Kabid;

use App\Models\User;
use App\Models\Agenda;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ApprovalController extends Controller
{
    public function index()
    {
        $dataKategori = Category::all();
        $dataAgenda = Agenda::with(['category'])
            ->where('status', 'pending')
            ->get();
        $dataUserOperator = User::where('role_id', 2)->get();
        return view('kabid.approvals.index', [
            'dataKategori' => $dataKategori,
            'dataAgenda' => $dataAgenda,
            'dataUserOperator' => $dataUserOperator,
        ]);
    }

    public function show(Agenda $data)
    {
        return view('kabid.approvals.show', [
            'data' => $data,
        ]);
    }

    public function approve(Agenda $data)
    {
        $data->update([
            'status' => 'APPROVED',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        Alert::success('Berhasil!', 'Agenda Telah Disetujui');
        return redirect()->route('kabid.approval.index');
    }

    public function reject(Agenda $data, Request $request)
    {
        $data->update([
            'status' => 'REJECTED',
            'rejected_reason' => $request->rejected_reason,
        ]);

        Alert::success('Berhasil', 'Agenda Telah Ditolak');
        return redirect()->route('kabid.approval.index');
    }
}