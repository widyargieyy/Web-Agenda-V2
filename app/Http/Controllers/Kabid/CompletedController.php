<?php

namespace App\Http\Controllers\Kabid;

use App\Models\Agenda;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CompletedController extends Controller
{
    public function index(){
        $dataAgenda = Agenda::with('category')->where('status', 'APPROVED')->latest()->get();
        $dataKategori = Category::all();
        $dataUserOperator = User::where('role_id', 2)->get();
        return view('kabid.completed.index', [
            'dataAgenda' => $dataAgenda,
            'dataKategori' => $dataKategori,
            'dataUserOperator' => $dataUserOperator,
        ]);
    }

    public function show(Agenda $data){
        return view('kabid.completed.show', [
            'data' => $data,
        ]);
    }

    public function complete(Agenda $data){
        $data->update([
            'status' => 'COMPLETED',
        ]);

        Alert::success('Berhasil,', 'Agenda Telah Diselesaikan!');
        return redirect()->route('kabid.completed.index');
    }

    public function cancelled(Agenda $data){
        $data->update([
            'status' => 'CANCELLED',
        ]);

        Alert::success('Berhasil,', 'Agenda Telah Dibatalkan!');
        return redirect()->route('kabid.completed.index');
    }



    
}