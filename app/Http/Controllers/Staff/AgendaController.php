<?php

namespace App\Http\Controllers\Staff;

use App\Models\Agenda;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\AgendaDocumentation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AgendaController extends Controller
{
    public function index()
    {
        $upcomingAgendas = Agenda::where('status', 'APPROVED')
            ->orWhere('status', 'COMPLETED')
            ->with(['category', 'location'])
            ->orderBy('id', 'desc')
            ->get();
        $dataKategori = Category::all();
        return view('staff.agendas.index', [
            'agendas' => $upcomingAgendas,
            'dataKategori' => $dataKategori,
        ]);
    }

    public function show(Agenda $data)
    {
        return view('staff.agendas.show', [
            'data' => $data,
        ]);
    }

    public function uploadDocumentation(Agenda $data, Request $request)
    {
        // 🔒 Validasi
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,gif|max:3072',
            'caption' => 'nullable|string|max:255',
        ]);

        // ❌ Cegah upload kalau belum completed (double safety)
        if ($data->status !== 'COMPLETED') {
            return back()->with('error', 'Agenda belum selesai');
        }
    
        // 📂 Upload file
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();

        $path = $file->storeAs('documentations', $filename, 'public');

        // 💾 Simpan ke database
        AgendaDocumentation::create([
            'agenda_id' => $data->id,
            'filename' => $filename,
            'filepath' => $path,
            'file_type' => 'pdf',
            'caption' => $request->caption,
            'uploaded_by' => Auth::id(),
            'uploaded_at' => now(),
        ]);
        
        Alert::success('Sukses', 'Dokumentasi berhasil diupload');
        return redirect()->route('staff.data-agenda.detail', $data->id);
    }
}