<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['name', 'code'];

    public function users(){
        return $this->hasMany(User::class);
    }
    public function agendas(){
        return $this->hasMany(Agenda::class);
    }
}