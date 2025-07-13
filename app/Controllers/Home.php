<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VisitModel; // Pastikan model VisitModel di-import

class Home extends BaseController
{
    protected $visitModel;

    public function __construct()
    {
        $this->visitModel = new VisitModel();
    }

    public function index()
    {
        $userId = session()->get('user_id'); // Ambil user_id dari sesi

        // 1. Ambil data kunjungan hari ini (termasuk durasi)
        $todayVisit = $this->visitModel->getTodayVisitWithDuration($userId);

        // 2. Ambil semua riwayat kunjungan yang sudah check-out (untuk total durasi keseluruhan)
        $allUserVisitsWithDuration = $this->visitModel->getUserVisitDuration($userId);

        // 3. Hitung total durasi dari semua kunjungan yang sudah check-out
        $totalOverallDurationSeconds = 0;
        foreach ($allUserVisitsWithDuration as $visit) {
            // Kolom 'duration' dari query MySQL akan berbentuk 'HH:MM:SS'
            // Kita perlu mengubahnya ke detik untuk diakumulasi
            if (!empty($visit['duration'])) {
                list($h, $m, $s) = explode(':', $visit['duration']);
                $totalOverallDurationSeconds += ($h * 3600) + ($m * 60) + $s;
            }
        }

        // 4. Format total durasi dalam bentuk yang mudah dibaca (e.g., "X jam Y menit Z detik")
        $formattedTotalOverallDuration = $this->formatSecondsToHMS($totalOverallDurationSeconds);

        $data = [
            'userName' => session()->get('user_name'),
            'userUsername' => session()->get('username'),
            'todayVisit' => $todayVisit, // Sekarang ini juga berisi 'duration'
            'formattedTotalOverallDuration' => $formattedTotalOverallDuration,
        ];

        echo view('dashboard', $data);
    }

    /**
     * Helper function untuk mengubah total detik menjadi format HH:MM:SS atau yang lebih mudah dibaca.
     */
    private function formatSecondsToHMS($seconds) {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds / 60) % 60);
        $remainingSeconds = $seconds % 60;

        $parts = [];
        if ($hours > 0) {
            $parts[] = $hours . ' jam';
        }
        if ($minutes > 0) {
            $parts[] = $minutes . ' menit';
        }
        if ($remainingSeconds > 0 || empty($parts)) { // Pastikan setidaknya detik ditampilkan jika semuanya 0
            $parts[] = $remainingSeconds . ' detik';
        }

        return implode(' ', $parts);
    }
}