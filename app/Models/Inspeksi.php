<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

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

    private function normalizedJawaban(): array
    {
        $jawaban = $this->jawaban;

        // kalau masih string JSON, paksa decode
        if (is_string($jawaban)) {
            $jawaban = json_decode($jawaban, true) ?? [];
        }

        return is_array($jawaban) ? $jawaban : [];
    }

    public function getTotalChecklistAttribute()
    {
        return count($this->normalizedJawaban());
    }

    public function getTotalBaikAttribute()
    {
        return collect($this->normalizedJawaban())
            ->filter(fn ($value) => $value === 'Baik')
            ->count();
    }

    public function getTotalTidakBaikAttribute()
    {
        return collect($this->normalizedJawaban())
            ->filter(fn ($value) => $value === 'Tidak Baik')
            ->count();
    }
}