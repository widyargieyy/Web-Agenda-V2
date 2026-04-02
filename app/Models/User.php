<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'email', 'password', 'role_id', 'unit_id', 'nip', 'phone', 'is_active'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function agendasCreated()
    {
        return $this->hasMany(Agenda::class, 'craeted_by');
    }
    public function agendasApproved()
    {
        return $this->hasMany(Agenda::class, 'approved_by');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}