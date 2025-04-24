<?php
namespace App\Models;

use CodeIgniter\Model;

class TugasModel extends Model
{
    protected $table = 'tugas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['creator_id', 'tugas', 'tanggal', 'waktu', 'status', 'alarm','date_due','time_due','date_finished','time_finished'];

    public function search1($keyword, $perPage, $creator_id)
    {
        return $this->where('creator_id', $creator_id)
            ->groupStart()
            ->like('tugas', $keyword)
            ->orLike('status', $keyword)
            ->groupEnd()
            ->paginate($perPage);
    }

    public function search($keyword, $perPage)
    {
        return $this->like('tugas', $keyword)
            ->orLike('status', $keyword)
            ->paginate($perPage);
    }
    public function getDashboardData()
    {
        return [
            'todo' => $this->where('status', 'to do')->countAllResults(),
            'doing' => $this->where('status', 'doing')->countAllResults(),
            'selesai' => $this->where('status', 'selesai')->countAllResults(),
            'batal' => $this->where('status', 'batal')->countAllResults()
        ];
    }

    public function getUpcomingTasks()
    {
        return $this->where('status !=', 'selesai')
                    ->where('date_due >=', date('Y-m-d'))
                    ->orderBy('date_due', 'ASC')
                    ->limit(5)
                    ->findAll();
    }

    public function getCalendarEvents()
    {
        $this->select('tugas, date_due, time_due');
        $this->whereIn('status', ['to do', 'doing']);
        $this->where('date_due IS NOT NULL', null, false);

        $query = $this->get();
        $events = [];

        foreach ($query->getResult() as $row) {
            $start = $row->date_due;
            if (!empty($row->time_due)) {
                $start .= 'T' . $row->time_due;
            }

            $events[] = [
                'title' => $row->tugas,
                'start' => $start
            ];
        }

        return $events;
    }
}