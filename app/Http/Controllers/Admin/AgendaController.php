<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agenda;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\AgendaAttachments;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Agenda\StoreAgendaRequest;

class AgendaController extends Controller
{
    public function index()
    {
        $dataAgenda = Agenda::with(['category', 'creator'])
            ->latest()
            ->get();
        $dataKategori = Category::all();
        return view('admin.agendas.index', [
            'dataAgenda' => $dataAgenda,
            'dataKategori' => $dataKategori,
        ]);
    }

    public function show(Agenda $data)
    {
        return view('admin.agendas.show', [
            'data' => $data,
        ]);
    }

    public function update(StoreAgendaRequest $request, Agenda $data)
    {
        // $status = $request->action === 'submit' ? 'PENDING' : 'DRAFT';

        // 🔹 Update data utama
        $data->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'place' => $request->place,
            'category_id' => $request->category_id,
            'status' => $request->status,
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
        return redirect()->route('admin.data-agenda.index');
    }

    public function edit(Agenda $data)
    {
        $dataKategori = Category::all();
        return view('admin.agendas.edit', [
            'data' => $data,
            'dataKategori' => $dataKategori,
        ]);
    }

    public function destroy(Agenda $data)
    {
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
        return redirect()->route('admin.data-agenda.index');
    }
}