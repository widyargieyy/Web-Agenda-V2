<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class AgendaDocumentation extends Model
{
    protected $fillable = ['agenda_id', 'caption', 'filename', 'filepath', 'file_type', 'uploaded_by', 'uploaded_at'];
    
    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function setCaptionAttribute($value)
    {
        $this->attributes['caption'] = Str::title($value);
    }

    public function getHumanUploadAttribute()
    {
        if (!$this->uploaded_at) {
            return '-';
        }

        $date = \Carbon\Carbon::parse($this->uploaded_at);

        if ($date->isToday()) {
            $label = 'Hari ini';
        } elseif ($date->isYesterday()) {
            $label = 'Kemarin';
        } else {
            $diff = (int) $date->diffInDays(now());
            $label = $diff . ' hari yg lalu';
        }
    
        return $label . ' ' . $date->format('H:i') . ' WIB' . ' - ' . $date->format('d M, Y');
    }
}