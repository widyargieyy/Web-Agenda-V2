<?php

namespace App\Http\Controllers\Operator;

use App\Models\Agenda;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\AgendaAttachments;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Agenda\StoreAgendaRequest;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    public function index()
    {
        $dataAgenda = Agenda::where('created_by', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();

        $dataKategori = Category::all();
        // return $dataKategori;

        $title = 'Hapus Agenda!';
        $text = 'Apakah Anda Yakin Ingin Hapus Agenda?';
        confirmDelete($title, $text);
        return view('operator.agendas.index', [
            'dataAgenda' => $dataAgenda,
            'datakategori' => $dataKategori,
        ]);
    }

    public function create()
    {
        $dataKategori = Category::all();
        return view('operator.agendas.create', [
            'dataKategori' => $dataKategori,
        ]);
    }

    public function show(Agenda $data)
    {
        return view('operator.agendas.show', [
            'data' => $data,
        ]);
    }

    public function store(StoreAgendaRequest $request)
    {
        // 🔹 Tentukan status berdasarkan tombol
        $status = $request->action === 'submit' ? 'PENDING' : 'DRAFT';

        // 🔹 Simpan agenda utama
        $agenda = Agenda::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,

            'place' => $request->place,
            'category_id' => $request->category_id,

            'status' => $status,
            'created_by' => Auth::id(),
        ]);

        // 🔹 Upload attachment (multiple PDF dari Dropzone)
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                $path = $file->storeAs('agendas', $filename, 'public');

                AgendaAttachments::create([
                    'agenda_id' => $agenda->id,
                    'filename' => $filename,
                    'filepath' => $path,
                    'mime_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(),
                    'uploaded_by' => Auth::id(),
                    'uploaded_at' => now(),
                ]);
            }
        }

        // 🔹 Message dinamis
        $message = $status === 'PENDING' ? 'Agenda berhasil dikirim ke Kabid untuk persetujuan!' : 'Agenda berhasil disimpan sebagai draft.';

        // 🔹 Redirect
        Alert::success('Berhasil!', $message);
        return redirect()->route('operator.agenda-saya.index');
    }

    public function update(StoreAgendaRequest $request, Agenda $data)
    {
        $status = $request->action === 'submit' ? 'PENDING' : 'DRAFT';

        // 🔹 Update data utama
        $data->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'place' => $request->place,
            'category_id' => $request->category_id,
            'status' => $status,
        ]);

        // 🔥 CEK JIKA ADA FILE BARU
        if ($request->hasFile('attachments')) {
            // 🔥 1. HAPUS FILE LAMA
            $oldFiles = AgendaAttachments::where('agenda_id', $data->id)->get();

            foreach ($oldFiles as $file) {
                if ($file->filepath && Storage::disk('public')->exists($file->filepath)) {
                    Storage::disk('public')->delete($file->filepath);
                }
                $file->delete();
            }
    
            // 🔥 2. UPLOAD FILE BARU
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('agendas', $filename, 'public');

                AgendaAttachments::create([
                    'agenda_id' => $data->id,
                    'filename' => $filename,
                    'filepath' => $path,
                    'mime_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(),
                    'uploaded_by' => Auth::id(),
                    'uploaded_at' => now(),
                ]);
            }
        }

        Alert::success('Berhasil!', 'Agenda berhasil diperbarui!');
        return redirect()->route('operator.agenda-saya.index');
    }
    public function kirim(Agenda $data)
    {
        $data->update(['status' => 'PENDING']);
        Alert::success('Berhasil!', 'Agenda berhasil dikirim ke Kabid untuk persetujuan!');
        return redirect()->route('operator.agenda-saya.index');
    }

    public function edit(Agenda $data)
    {
        $dataKategori = Category::all();
        return view('operator.agendas.edit', [
            'data' => $data,
            'dataKategori' => $dataKategori,
        ]);
    }

    public function destroy(Agenda $data)
    {
        // 🔒 Optional: pastikan hanya pemilik yang bisa hapus
        if ($data->created_by !== Auth::user()->id) {
            return back()->with('error', 'Tidak punya izin menghapus agenda ini.');
        }
        $attachments = AgendaAttachments::where('agenda_id', $data->id)->get();

        foreach ($attachments as $file) {
            // Hapus file dari storage
            if ($file->filepath && Storage::disk('public')->exists($file->filepath)) {
                Storage::disk('public')->delete($file->filepath);
            }
            // Hapus record database
            $file->delete();
        }

        // 🔥 Hapus agenda utama
        $data->delete();
        Alert::success('Berhasil!', 'Agenda berhasil dihapus!');
        return redirect()->route('operator.agenda-saya.index');
    }
}