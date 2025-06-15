<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser // Tambahkan implements FilamentUser jika belum ada
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Dari UserSeeder Anda
        'farm_id',
        'email_verified_at', // Dari UserSeeder yang saya modifikasi
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }

    public function dailyChecks(): HasMany
    {
        return $this->hasMany(DailyCheck::class);
    }

    // Relasi baru ke Goats yang dimiliki/ditanggungjawabi oleh user ini
    public function goats(): HasMany
    {
        return $this->hasMany(Goat::class);
    }

    // Implementasi FilamentUser
    public function canAccessPanel(Panel $panel): bool
    {
        // Contoh: semua user bisa akses panel admin
        // Anda bisa tambahkan logika di sini jika perlu, misal berdasarkan email, dll.
        // return str_ends_with($this->email, '@karangnongko.id');
        return true;
    }
}