<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspeksi extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    protected $table = 'inspeksis';

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'tanggal',

        'ruangan_id',

        'kategori_id',

        'keterangan',

        'nama_petugas_k3rs',

        'nama_petugas_ruangan',

        'ttd_k3rs',

        'ttd_ruangan',

        'jawaban',

        'hasil',

    ];

    /*
    |--------------------------------------------------------------------------
    | CASTING
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'tanggal' => 'date',

        'jawaban' => 'array',

        'hasil' => 'integer',

    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR PERSENTASE
    |--------------------------------------------------------------------------
    */

    public function getPersentaseAttribute()
    {
        return $this->hasil . '%';
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR STATUS
    |--------------------------------------------------------------------------
    */

    public function getStatusAttribute()
    {
        if ($this->hasil >= 85) {
            return 'Sangat Baik';
        }

        if ($this->hasil >= 70) {
            return 'Baik';
        }

        if ($this->hasil >= 50) {
            return 'Cukup';
        }

        return 'Kurang';
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR BADGE COLOR
    |--------------------------------------------------------------------------
    */

    public function getBadgeAttribute()
    {
        if ($this->hasil >= 85) {
            return 'success';
        }

        if ($this->hasil >= 70) {
            return 'primary';
        }

        if ($this->hasil >= 50) {
            return 'warning';
        }

        return 'danger';
    }

    /*
    |--------------------------------------------------------------------------
    | TOTAL CHECKLIST
    |--------------------------------------------------------------------------
    */

    public function getTotalChecklistAttribute()
    {
        return is_array($this->jawaban)
            ? count($this->jawaban)
            : 0;
    }

    /*
    |--------------------------------------------------------------------------
    | TOTAL BAIK
    |--------------------------------------------------------------------------
    */

    public function getTotalBaikAttribute()
    {
        if (!is_array($this->jawaban)) {
            return 0;
        }

        return collect($this->jawaban)
            ->filter(function ($value) {
                return $value === 'Baik';
            })
            ->count();
    }

    /*
    |--------------------------------------------------------------------------
    | TOTAL TIDAK BAIK
    |--------------------------------------------------------------------------
    */

    public function getTotalTidakBaikAttribute()
    {
        if (!is_array($this->jawaban)) {
            return 0;
        }

        return collect($this->jawaban)
            ->filter(function ($value) {
                return $value === 'Tidak Baik';
            })
            ->count();
    }
}