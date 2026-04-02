<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaParticipant extends Model
{
    protected $fillable = ['agenda_id', 'user_id', 'name', 'instansi_name', 'role', 'invited'];

    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}