<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Pastikan ini di-import

class DailyCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'check_date',
        'notes',
        // Tambahkan field lain jika ada di migrasi tabel daily_checks
    ];

    protected $casts = [
        'check_date' => 'date',
    ];

    /**
     * The relationships that should always be loaded.
     * Removed automatic eager loading to improve performance
     *
     * @var array
     */
    // protected $with = ['user'];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 25;

    /**
     * Mendapatkan pengguna yang melakukan pengecekan.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendapatkan kambing-kambing yang terkait dengan pengecekan harian ini.
     */
    // public function goats(): BelongsToMany // Pastikan nama method adalah 'goats' (plural)
    // {
        // Nama tabel pivot defaultnya adalah 'daily_check_goat' (sesuai urutan nama model alphabetis)
        // Jika nama tabel pivot Anda berbeda, sebutkan secara eksplisit.
        // Contoh: return $this->belongsToMany(Goat::class, 'nama_tabel_pivot_anda');
        // return $this->belongsToMany(Goat::class, 'daily_check_goat');
    // }
}