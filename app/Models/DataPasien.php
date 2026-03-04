<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPasien extends Model
{
    use HasFactory;

    protected $table = 'data-pasien';

    protected $fillable = [
        'nama',
        'nik',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_telepon',
        'email',
        'golongan_darah',
        'riwayat_penyakit',
        'alergi',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function getUmurAttribute()
    {
        return $this->tanggal_lahir->age;
    }
}
