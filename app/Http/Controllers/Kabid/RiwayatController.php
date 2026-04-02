<?php

namespace App\Http\Controllers\Kabid;

use App\Models\Agenda;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index(){
        $dataKategori = Category::all();
        $dataAgendas = Agenda::with('category')->latest()->get();

        return view('kabid.riwayat.index', [
            'dataKategori' => $dataKategori,
            'dataAgenda' => $dataAgendas,
        ]);
    }

    public function show(Agenda $data){
        return view('kabid.riwayat.show', [
            'data' => $data,
        ]);
    }
}