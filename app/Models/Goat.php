<?php

namespace App\Models;

use App\Enums\GenderEnum; // Pastikan file app/Enums/GenderEnum.php sudah ada
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str; // Untuk Str::after
// Pastikan Anda mengimpor model Farm jika belum
// use App\Models\Farm;


class Goat extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'farm_id',
        'user_id',         // Pastikan migrasi untuk user_id sudah ada dan dijalankan
        'tag_number',      // Akan diisi otomatis oleh event 'creating'
        'gender',
        'type',            // Sesuai migrasi Anda
        'birth_date',      // Sesuai migrasi Anda
        'weight',          // Sesuai migrasi Anda
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
        'gender' => GenderEnum::class,
        'weight' => 'float',
    ];

    /**
     * The relationships that should always be loaded.
     * Removed automatic eager loading to improve performance
     *
     * @var array
     */
    // protected $with = ['farm'];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 25;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::creating(function (Goat $goat) {
            // Generate tag_number otomatis jika belum ada
            if (empty($goat->tag_number)) {
                // Pastikan $goat->farm_id sudah terisi sebelum event ini
                // atau tangani kasus jika $goat->farm_id null di dalam generateUniqueTagNumber
                $goat->tag_number = self::generateUniqueTagNumber($goat->farm_id);
            }
        });
    }

    /**
     * Helper function to generate a unique tag number.
     *
     * @param int|null $farmId
     * @return string
     */
    public static function generateUniqueTagNumber(?int $farmId): string
    {
        $prefix = 'K'; // Default prefix jika farm tidak teridentifikasi

        if ($farmId) {
            // Gunakan Full Qualified Class Name jika tidak di-import di atas
            $farm = \App\Models\Farm::find($farmId); // Menggunakan FQCN untuk Farm
            if ($farm && $farm->name) {
                // Menggunakan inisial nama farm sebagai dasar prefix, dikombinasikan dengan 'K'
                // Misalnya, Farm "Barat" -> "KB", Farm "Timur" -> "KT"
                $farmNameInitial = strtoupper(substr($farm->name, 0, 1));
                if (!empty($farmNameInitial)) {
                    $prefix = 'K' . $farmNameInitial;
                } else {
                    $prefix = 'KF'; // Prefix jika nama farm kosong tapi farm_id ada (Farm Found but no name)
                }
            } else {
              $prefix = 'KU'; // Prefix jika farm_id ada tapi farm tidak ditemukan (Unknown Farm)
            }
        } else {
            // Jika farm_id tidak ada (misalnya, admin tidak memilih farm dan tidak ada default)
             $prefix = 'KG'; // Contoh: Kandang General (General Goat)
        }

        // Logika untuk mendapatkan nomor urut berikutnya yang unik
        $nextNumber = 1;
        // Mencari record terakhir dengan prefix yang sama untuk menentukan nomor berikutnya
        $lastGoatWithPrefix = self::where('tag_number', 'LIKE', $prefix . '%')
                                  ->orderBy('id', 'desc') // Urutkan berdasarkan ID untuk mendapatkan yang terbaru
                                  ->first();

        if ($lastGoatWithPrefix) {
            // Ekstrak nomor dari tag_number terakhir, contoh: KB005 -> 005
            $lastNumberStr = Str::after($lastGoatWithPrefix->tag_number, $prefix);
            if (is_numeric($lastNumberStr)) {
                $nextNumber = (int)$lastNumberStr + 1;
            }
            // Jika format nomor tidak terduga setelah prefix (misal KBABC),
            // $nextNumber akan tetap 1, atau Anda bisa tambahkan error handling.
        }
        
        // Membuat tag_number dengan padding nol di depan
        $tagNumber = $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Opsional: Loop untuk memastikan keunikan jika ada potensi race condition atau gap
        // Ini bisa jadi mahal jika datanya sangat banyak. Untuk kebanyakan kasus, penomoran di atas cukup.
        // $counter = 0; // Untuk mencegah infinite loop jika ada masalah
        // while (self::where('tag_number', $tagNumber)->exists() && $counter < 10) {
        //     $nextNumber++;
        //     $tagNumber = $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        //     $counter++;
        // }
        // if ($counter >= 10) {
        //     // Handle error: tidak bisa generate tag unik setelah beberapa percobaan
        //     // Mungkin throw exception atau log error
        //     // Untuk sementara, bisa tambahkan suffix random jika terjadi
        //     $tagNumber .= '_' . Str::random(3);
        // }

        return $tagNumber;
    }

    // Relasi-relasi
    public function farm(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Farm::class); // Menggunakan FQCN untuk Farm
    }

    public function user(): BelongsTo // Pastikan kolom user_id ada di tabel goats
    {
        return $this->belongsTo(\App\Models\User::class); // Menggunakan FQCN untuk User
    }

    // public function dailyChecks(): BelongsToMany // Relasi ini mungkin ada di file Anda
    // {
    //     // Sesuaikan dengan nama model dan tabel pivot Anda jika berbeda
    //     return $this->belongsToMany(\App\Models\DailyCheck::class, 'daily_check_goat'); // Menggunakan FQCN
    // }
}