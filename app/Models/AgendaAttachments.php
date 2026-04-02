<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaAttachments extends Model
{
    protected $fillable = ['agenda_id', 'filename', 'filepath', 'mime_type', 'file_size', 'uploaded_by', 'is_primary', 'uploaded_at'];

    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    
   
}