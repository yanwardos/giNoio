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
        'user_id'
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
    public function getTotalTerapiSeconds(){
        return 400;
    }

    public function getTerapiPerkembangan() {
        return 0.7;
    }
}
