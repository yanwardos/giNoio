<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = [
        'born',
        'weight',
        'height',
        'gender',
        'user_id',
        'illnessHistory'
    ];

    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function user_id() {
        return $this->user_id;
    }

    public function age(){
        return Carbon::parse($this->attributes['born'])->age;
    }

    public function born(){
        return Carbon::parse($this->attributes['born'])->format('d/m/Y');
    }

    public function gender(){
        return $this->gender?'Laki-laki': 'Perempuan';
    }

    // riwayat
    public function getMonitoringRecords(){
        $records = MonitoringRecord::where(['pasienId' => $this->id])->get();
        foreach ($records as $record) {
            $record->data = json_decode($record->data);
        }

        return $records;
    }

    public function getMonitoringRecordDates()
    {
        return MonitoringRecord::where(['pasienId' => $this->id])->selectRaw('DATE(created_at) as date, COUNT(*) as count')->groupBy('date')->orderBy('date', 'asc')->get();
    }


    public function getTotalTerapiSeconds(){
        return 400;
    }

    public function getTerapiPerkembangan() {
        return 0.7;
    }

    // device
    public function device(){
        return $this->hasOne(Device::class, 'id', 'ownedDeviceId');
    }
}
