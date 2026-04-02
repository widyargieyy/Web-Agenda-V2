<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    public $table = 'instansis';
    protected $fillable = ['name', 'contact'];
    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }
}