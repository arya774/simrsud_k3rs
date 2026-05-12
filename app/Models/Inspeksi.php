<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspeksi extends Model
{
    use HasFactory;

    protected $table = 'inspeksis';

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

    protected $casts = [
        'tanggal' => 'date',
        'jawaban' => 'array',
        'hasil'   => 'integer',
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function getPersentaseAttribute()
    {
        return ($this->hasil ?? 0) . '%';
    }

    public function getStatusAttribute()
    {
        $hasil = (int) ($this->hasil ?? 0);

        return match (true) {
            $hasil >= 85 => 'Sangat Baik',
            $hasil >= 70 => 'Baik',
            $hasil >= 50 => 'Cukup',
            default      => 'Kurang',
        };
    }

    public function getBadgeAttribute()
    {
        $hasil = (int) ($this->hasil ?? 0);

        return match (true) {
            $hasil >= 85 => 'success',
            $hasil >= 70 => 'primary',
            $hasil >= 50 => 'warning',
            default      => 'danger',
        };
    }

    public function getTotalChecklistAttribute()
    {
        return is_array($this->jawaban ?? null)
            ? count($this->jawaban)
            : 0;
    }

    public function getTotalBaikAttribute()
    {
        if (!is_array($this->jawaban ?? null)) return 0;

        return collect($this->jawaban)
            ->filter(fn ($value) => $value === 'Baik')
            ->count();
    }

    public function getTotalTidakBaikAttribute()
    {
        if (!is_array($this->jawaban ?? null)) return 0;

        return collect($this->jawaban)
            ->filter(fn ($value) => $value === 'Tidak Baik')
            ->count();
    }
}