<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'umur',
        'noHP',
    ];

    protected function casts(): array
    {
        return [
            'umur' => 'integer',
        ];
    }
}
