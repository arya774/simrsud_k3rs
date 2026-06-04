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
    | 🔒 FILLABLE (AMAN)
    |----------------------------------------------------------
    */
    protected $fillable = [
        // ❌ tanggal DIHAPUS dari fillable (biar tidak bisa diupdate)
        'ruangan_id',
        'kategori_id',
        'keterangan',

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
    | 🔥 GUARDED (PROTECT TANGGAL)
    |----------------------------------------------------------
    */
    protected $guarded = [
        'tanggal'
    ];

    /*
    |----------------------------------------------------------
    | CASTS
    |----------------------------------------------------------
    */
    protected $casts = [
        'tanggal' => 'date',
        'jawaban' => 'array',
        'catatan_kategori' => 'array',
        'hasil' => 'integer',
    ];

    /*
    |----------------------------------------------------------
    | 🔒 AUTO LOCK TANGGAL SAAT UPDATE
    |----------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {

            // ❗ paksa tanggal tetap
            $model->tanggal = $model->getOriginal('tanggal');

        });
    }

    /*
    |----------------------------------------------------------
    | RELATION
    |----------------------------------------------------------
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
    |----------------------------------------------------------
    | 🔥 FORMAT TANGGAL (OPSIONAL BAGUS BANGET)
    |----------------------------------------------------------
    */
    public function getTanggalFormatAttribute()
    {
        return $this->tanggal
            ? $this->tanggal->format('d-m-Y')
            : '-';
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
            default      => 'Kurang',
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
            default      => 'danger',
        };
    }

    /*
    |----------------------------------------------------------
    | 🔥 NORMALIZE JAWABAN (ANTI ERROR JSON)
    |----------------------------------------------------------
    */
    private function normalizedJawaban(): array
    {
        $jawaban = $this->jawaban;

        if (is_string($jawaban)) {
            $jawaban = json_decode($jawaban, true) ?? [];
        }

        return is_array($jawaban) ? $jawaban : [];
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
            ->filter(fn($v) => strtolower(trim($v)) === 'baik')
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
            ->filter(function ($v) {

                $v = strtolower(trim($v));

                return in_array($v, [
                    'tidak',
                    'tidak baik',
                    'tidak_baik'
                ]);
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