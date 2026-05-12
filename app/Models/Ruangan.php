<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    protected $table = 'ruangans';

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'nama_ruangan',
        'lokasi',
    ];

    /*
    |--------------------------------------------------------------------------
    | ATTRIBUTE CASTING
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
    */

    public function getLokasiLabelAttribute()
    {
        return $this->lokasi ?: '-';
    }
}