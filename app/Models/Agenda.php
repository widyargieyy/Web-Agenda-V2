<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = ['title', 'description', 'date', 'start_time', 'end_time', 'category_id', 'location_id', 'place', 'instansi_id', 'unit_id', 'status', 'created_by', 'approved_by', 'approved_at', 'rejected_reason'];

    // 🔗 RELASI
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function participants()
    {
        return $this->hasMany(AgendaParticipant::class);
    }

    public function attachments()
    {
        return $this->hasMany(AgendaAttachments::class);
    }

    public function documentations()
    {
        return $this->hasMany(AgendaDocumentation::class);
    }

    protected function createdAt(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(get: fn($value) => \Carbon\Carbon::parse($value)->translatedFormat('d F Y H:i \W\I\B'));
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::title($value);
    }

    protected function date(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(get: fn($value) => \Carbon\Carbon::parse($value)->translatedFormat('d F Y'));
    }
}