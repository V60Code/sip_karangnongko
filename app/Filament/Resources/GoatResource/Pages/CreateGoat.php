<?php

namespace App\Filament\Resources\GoatResource\Pages;

use App\Filament\Resources\GoatResource;
use Filament\Actions; // Bisa dihapus jika tidak ada Actions::make() yang digunakan di sini
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException; // Untuk melempar exception jika tidak terautentikasi


class CreateGoat extends CreateRecord
{
    protected static string $resource = GoatResource::class;

    /**
     * Mengarahkan pengguna kembali ke halaman index setelah berhasil membuat record.
     *
     * @return string
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    /**
     * Memodifikasi data form sebelum record dibuat.
     * Di sini kita akan mengisi user_id dan memastikan farm_id terisi jika memungkinkan.
     *
     * @param array $data Data dari form.
     * @return array Data yang sudah dimodifikasi.
     * @throws AuthenticationException Jika user tidak terautentikasi.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Auth::user();

        if (!$user) {
            // Ini seharusnya sudah ditangani oleh middleware autentikasi Filament,
            // tetapi sebagai lapisan keamanan tambahan, kita lempar exception.
            throw new AuthenticationException(
                'Unauthenticated during goat creation attempt.'
            );
        }

        // Set user_id dari pengguna yang sedang login
        $data['user_id'] = $user->id;

        // Logika untuk mengisi farm_id, yang akan digunakan untuk prefix tag_number di model Goat
        // Jika farm_id sudah diisi dari form (misalnya oleh Admin), kita tidak menimpanya.
        if (!isset($data['farm_id'])) {
            // Jika pengguna yang login bukan admin dan memiliki farm_id,
            // maka set farm_id kambing sesuai dengan farm_id pengguna tersebut.
            if (isset($user->role) && $user->role !== 'admin' && isset($user->farm_id)) {
                $data['farm_id'] = $user->farm_id;
            }
            // Jika pengguna adalah admin, dan farm_id tidak diisi dari form,
            // farm_id akan tetap null. Logika di model Goat (generateUniqueTagNumber)
            // akan menggunakan prefix default seperti 'KG' jika farm_id null.
            // Anda bisa menambahkan logika di sini jika ingin farm_id wajib diisi
            // atau memiliki default tertentu bahkan untuk admin yang tidak memilih.
        }
        // Kolom 'tag_number' tidak perlu di-set di sini karena akan digenerate
        // secara otomatis oleh event 'creating' di model Goat.

        return $data;
    }

    /**
     * Pesan notifikasi setelah record berhasil dibuat.
     *
     * @return string|null
     */
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Data Kambing berhasil ditambahkan';
    }
}