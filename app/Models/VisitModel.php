<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitModel extends Model
{
    protected $table            = 'visits';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'visit_date', 'time_in', 'time_out'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getTodayVisit($userId)
    {
        $today = date('Y-m-d');
        $result = $this->select('visit_date, time_in, time_out, TIMEDIFF(time_out, time_in) AS duration')
            ->where('user_id', $userId)
            ->where('visit_date', $today)
            ->first();
        $result['duration'] = $this->formatDuration($result['duration']);
        return $result;
    }

    private function formatDuration($duration)
    {
        list($jam, $menit, $detik) = explode(":", $duration);
        $jam = (int)$jam;
        $menit = (int)$menit;
        $detik = (int)$detik;
        $result = "";
        if ($jam != 0) {
            $result .= "$jam jam ";
        }
        if ($menit != 0) {
            $result .= "$menit menit ";
        }
        if ($detik != 0) {
            $result .= "$detik detik";
        }
        return $result;
    }

    public function getUserVisits($userId)
    {
        $result =  $this->select('visit_date, time_in, time_out, TIMEDIFF(time_out, time_in) AS duration')
            ->where('user_id', $userId)->orderBy('visit_date', 'DESC')
            ->findAll();
        foreach ($result as &$data) {
            $data['duration'] = $this->formatDuration($data['duration']);
        }
        return $result;
    }

    /**
     * Mengambil entri kunjungan hari ini untuk user tertentu, termasuk durasi.
     */
    public function getTodayVisitWithDuration($userId)
    {
        $today = date('Y-m-d');
        // Gunakan TIMEDIFF untuk menghitung durasi langsung di query
        // IFNULL digunakan agar tidak null jika time_out belum ada
        return $this->select('*, TIMEDIFF(time_out, time_in) AS duration')
            ->where('user_id', $userId)
            ->where('visit_date', $today)
            ->first();
    }

    public function getUserVisitDuration($userId)
    {
        return $this->select('*, TIMEDIFF(time_out, time_in) AS duration')
            ->where('user_id', $userId)
            ->where('time_out IS NOT NULL')
            ->orderBy('visit_date', 'DESC')
            ->orderBy('time_in', 'DESC')
            ->findAll();
    }
}
