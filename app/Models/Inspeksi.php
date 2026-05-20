<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspeksi extends Model
{
    use HasFactory;

    protected $table = 'inspeksis';

    /*
    |----------------------------------------------------------
    | FILLABLE
    |----------------------------------------------------------
    */
    protected $fillable = [

        'tanggal',

        'ruangan_id',

        'kategori_id',

        'keterangan',

        /*
        |----------------------------------------------------------
        | CATATAN PER KATEGORI
        |----------------------------------------------------------
        */
        'catatan_kategori',

        'nama_petugas_k3rs',

        'nama_petugas_ruangan',

        'ttd_k3rs',

        'ttd_ruangan',

        'jawaban',

        'hasil',

    ];

    /*
    |----------------------------------------------------------
    | CASTS
    |----------------------------------------------------------
    */
    protected $casts = [

        'tanggal' => 'date',

        /*
        |----------------------------------------------------------
        | AUTO CONVERT JSON
        |----------------------------------------------------------
        */
        'jawaban' => 'array',

        'catatan_kategori' => 'array',

        'hasil' => 'integer',

    ];

    /*
    |----------------------------------------------------------
    | RELATION RUANGAN
    |----------------------------------------------------------
    */
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    /*
    |----------------------------------------------------------
    | RELATION KATEGORI
    |----------------------------------------------------------
    */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    /*
    |----------------------------------------------------------
    | PERSENTASE
    |----------------------------------------------------------
    */
    public function getPersentaseAttribute()
    {
        return ($this->hasil ?? 0) . '%';
    }

    /*
    |----------------------------------------------------------
    | STATUS
    |----------------------------------------------------------
    */
    public function getStatusAttribute()
    {
        $hasil = (int) ($this->hasil ?? 0);

        return match (true) {

            $hasil >= 85 => 'Sangat Baik',

            $hasil >= 70 => 'Baik',

            $hasil >= 50 => 'Cukup',

            default => 'Kurang',

        };
    }

    /*
    |----------------------------------------------------------
    | BADGE
    |----------------------------------------------------------
    */
    public function getBadgeAttribute()
    {
        $hasil = (int) ($this->hasil ?? 0);

        return match (true) {

            $hasil >= 85 => 'success',

            $hasil >= 70 => 'primary',

            $hasil >= 50 => 'warning',

            default => 'danger',

        };
    }

    /*
    |----------------------------------------------------------
    | NORMALIZE JAWABAN
    |----------------------------------------------------------
    */
    private function normalizedJawaban(): array
    {
        $jawaban = $this->jawaban;

        /*
        |----------------------------------------------------------
        | JIKA MASIH STRING JSON
        |----------------------------------------------------------
        */
        if (is_string($jawaban)) {

            $jawaban = json_decode($jawaban, true) ?? [];

        }

        return is_array($jawaban)
            ? $jawaban
            : [];
    }

    /*
    |----------------------------------------------------------
    | TOTAL CHECKLIST
    |----------------------------------------------------------
    */
    public function getTotalChecklistAttribute()
    {
        return count($this->normalizedJawaban());
    }

    /*
    |----------------------------------------------------------
    | TOTAL BAIK
    |----------------------------------------------------------
    */
    public function getTotalBaikAttribute()
    {
        return collect($this->normalizedJawaban())

            ->filter(function ($value) {

                return strtolower(trim($value)) == 'baik';

            })

            ->count();
    }

    /*
    |----------------------------------------------------------
    | TOTAL TIDAK BAIK
    |----------------------------------------------------------
    */
    public function getTotalTidakBaikAttribute()
    {
        return collect($this->normalizedJawaban())

            ->filter(function ($value) {

                $value = strtolower(trim($value));

                return
                    $value == 'tidak baik' ||
                    $value == 'tidak_baik' ||
                    $value == 'tidak';

            })

            ->count();
    }

    /*
    |----------------------------------------------------------
    | AMBIL CATATAN PER KATEGORI
    |----------------------------------------------------------
    */
    public function getCatatanKategoriById($kategoriId)
    {
        $catatan = $this->catatan_kategori ?? [];

        return $catatan[$kategoriId] ?? null;
    }
}