<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VisitModel;
use CodeIgniter\HTTP\ResponseInterface;

class VisitController extends BaseController
{
    protected $visitModel;
    public function __construct()
    {
        $this->visitModel = new VisitModel();
    }

    /**
     * Menampilkan halaman daftar kunjungan dan opsi check-in/out.
     */
    public function index()
    {
        $userId = session()->get('user_id'); // Ambil user_id dari sesi

        // Dapatkan entri kunjungan hari ini
        $todayVisit = $this->visitModel->getTodayVisit($userId);

        // Dapatkan riwayat kunjungan
        $userVisits = $this->visitModel->getUserVisits($userId); // Ambil 10 kunjungan terakhir

        $data = [
            'todayVisit' => $todayVisit,
            'userVisits' => $userVisits
        ];

        echo view('visits/index', $data);
    }

    /**
     * Proses untuk mencatat waktu check-in.
     */
    public function checkIn()
    {
        $userId = session()->get('user_id');
        $today = date('Y-m-d');
        $currentTime = date('H:i:s');

        // Cek apakah sudah ada entri check-in hari ini
        $existingVisit = $this->visitModel->getTodayVisit($userId);

        if ($existingVisit) {
            session()->setFlashdata('error', 'Anda sudah melakukan check-in hari ini.');
        } else {
            // Buat entri baru untuk check-in
            $data = [
                'user_id'    => $userId,
                'visit_date' => $today,
                'time_in'    => $currentTime,
            ];
            if ($this->visitModel->insert($data)) {
                session()->setFlashdata('success', 'Check-in berhasil pada ' . $currentTime . '.');
            } else {
                session()->setFlashdata('error', 'Gagal melakukan check-in.');
            }
        }

        return redirect()->to('/visits'); // Kembali ke halaman kunjungan
    }

    /**
     * Proses untuk mencatat waktu check-out.
     */
    public function checkOut()
    {
        $userId = session()->get('user_id');
        $currentTime = date('H:i:s');

        // Cari entri kunjungan hari ini yang sudah ada dan belum ada time_out
        $todayVisit = $this->visitModel->getTodayVisit($userId);

        if ($todayVisit && empty($todayVisit['time_out'])) {
            // Update time_out
            $data = [
                'time_out' => $currentTime,
            ];
            if ($this->visitModel->update($todayVisit['id'], $data)) {
                session()->setFlashdata('success', 'Check-out berhasil pada ' . $currentTime . '.');
            } else {
                session()->setFlashdata('error', 'Gagal melakukan check-out.');
            }
        } elseif (!$todayVisit) {
            session()->setFlashdata('error', 'Anda belum melakukan check-in hari ini.');
        } else {
            session()->setFlashdata('error', 'Anda sudah melakukan check-out hari ini.');
        }

        return redirect()->to('/visits'); // Kembali ke halaman kunjungan
    }
}
