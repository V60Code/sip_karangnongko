<?php

namespace App\Filament\Pages;

use App\Models\DailyCheck;
use App\Models\Goat;
use App\Models\User;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $title = 'Dashboard';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static string $view = 'filament.pages.dashboard';

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
            ->where('check_date', today())
            ->exists();

        $sickToday = DailyCheck::query()
            ->where('check_date', today())
            ->where('any_sick_goat', true)
            ->when($user->role !== 'admin', fn ($q) => $q->where('user_id', $user->id))
            ->count();

        return [
            ['title' => 'Jumlah Kambing', 'value' => $goatCount],
            ['title' => 'Status Absensi Hari Ini', 'value' => $checkToday ? 'Sudah' : 'Belum'],
            ['title' => 'Laporan Sakit Hari Ini', 'value' => $sickToday],
            ['title' => 'Jumlah Peternak', 'value' => User::whereIn('role', ['barat', 'timur'])->count()],
        ];
    }

    public function getWeeklyCheckData(): array
    {
        $user = auth()->user();

        $data = collect(range(0, 6))->mapWithKeys(function ($daysAgo) use ($user) {
            $date = now()->subDays($daysAgo)->toDateString();
            $count = DailyCheck::query()
                ->when($user->role !== 'admin', fn ($q) => $q->where('user_id', $user->id))
                ->whereDate('check_date', $date)
                ->count();
            return [$date => $count];
        });

        return $data->reverse()->toArray();
    }

    public function getRecentGoats()
    {
        $user = auth()->user();

        return Goat::query()
            ->when($user->role !== 'admin', fn ($q) => $q->where('farm_id', $user->farm_id))
            ->latest()
            ->take(5)
            ->get();
    }

    // Add this method to refresh data manually if needed
    public function refreshDashboard()
    {
        $this->weeklyCheckData = $this->getWeeklyCheckData();
        $this->recentGoats = $this->getRecentGoats();
    }
}
