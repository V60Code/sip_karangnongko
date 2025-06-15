<?php

namespace App\Filament\Pages;

use App\Models\DailyCheck;
use App\Models\Goat;
use App\Models\User;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema; // Ditambahkan untuk mengecek kolom

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $title = 'Dashboard';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static string $view = 'filament.pages.dashboard';

    // Atur urutan navigasi untuk Dashboard
    protected static ?int $navigationSort = 1; // Dashboard di paling atas

    public array $weeklyCheckData = [];
    public $recentGoats;

    public function mount(): void
    {
        $this->weeklyCheckData = $this->getWeeklyCheckData();
        $this->recentGoats = $this->getRecentGoats();
    }

    public function getCards(): array
    {
        $user = auth()->user();

        $goatCount = Goat::query()
            ->when($user->role !== 'admin', fn ($q) => $q->where('farm_id', $user->farm_id))
            ->count();

        $checkToday = DailyCheck::query()
            ->when($user->role !== 'admin', fn ($q) => $q->where('user_id', $user->id))
            ->whereDate('check_date', today()) // Menggunakan whereDate untuk membandingkan tanggal saja
            ->exists();

        // Pastikan kolom 'any_sick_goat' ada di tabel 'daily_checks'
        // Jika tidak, query ini mungkin perlu disesuaikan atau dihapus
        // Jika 'any_sick_goat' adalah boolean atau integer (0 atau 1)
        $sickToday = 0; // Default value
        if (Schema::hasColumn('daily_checks', 'any_sick_goat')) { // Cek apakah kolom ada
            $sickToday = DailyCheck::query()
                ->whereDate('check_date', today()) // Menggunakan whereDate
                ->where('any_sick_goat', '>', 0) // Mengasumsikan 'any_sick_goat' adalah jumlah, atau true jika boolean
                ->when($user->role !== 'admin', fn ($q) => $q->where('user_id', $user->id))
                ->count();
        }


        return [
            ['title' => 'Jumlah Kambing', 'value' => $goatCount],
            ['title' => 'Status Absensi Hari Ini', 'value' => $checkToday ? 'Sudah' : 'Belum'],
            ['title' => 'Laporan Sakit Hari Ini', 'value' => $sickToday > 0 ? $sickToday . ' Kasus' : 'Aman'], // Tampilan lebih informatif
            ['title' => 'Jumlah Peternak', 'value' => User::whereIn('role', ['barat', 'timur'])->count()],
        ];
    }

    public function getWeeklyCheckData(): array
    {
        $user = auth()->user();

        $data = collect(range(0, 6))->mapWithKeys(function ($daysAgo) use ($user) {
            $date = now()->subDays($daysAgo); // Biarkan sebagai objek Carbon untuk formatting nanti jika perlu
            $count = DailyCheck::query()
                ->when($user->role !== 'admin', fn ($q) => $q->where('user_id', $user->id))
                ->whereDate('check_date', $date)
                ->count();
            // Format tanggal untuk key array agar konsisten
            return [$date->toDateString() => $count];
        });

        return $data->reverse()->toArray();
    }

    public function getRecentGoats()
    {
        $user = auth()->user();

        return Goat::query()
            ->when($user->role !== 'admin', fn ($q) => $q->where('farm_id', $user->farm_id))
            ->latest() // Mengambil berdasarkan created_at descending (atau 'id' jika preferensi)
            ->take(5)
            ->get();
    }

    // Method ini bisa dipanggil dari view jika ada tombol refresh manual
    public function refreshDashboardData()
    {
        $this->weeklyCheckData = $this->getWeeklyCheckData();
        $this->recentGoats = $this->getRecentGoats();
        $this->dispatch('refreshDashboard'); // Event untuk memberitahu view agar refresh
        $this->notify('success', 'Dashboard data refreshed successfully!');
    }
}