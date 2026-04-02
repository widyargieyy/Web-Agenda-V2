<?php

namespace App\Http\Requests\Agenda;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgendaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            
            'place' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',

            'attachments' => 'nullable|array|max:3',
            'attachments.*' => 'file|mimes:pdf|max:5120',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul agenda wajib diisi',
            'date.required' => 'Tanggal wajib diisi',
            'start_time.required' => 'Jam mulai wajib diisi',
            'end_time.after' => 'Jam selesai harus setelah jam mulai',
            'category_id.required' => 'Kategori wajib dipilih',
            'location_id.required' => 'Lokasi wajib diisi',
        ];
    }
}