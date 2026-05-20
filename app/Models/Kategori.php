<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Uraian;
use App\Models\SubUraian;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_kategori',
    ];

    public $timestamps = true;

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    // ✅ Kategori → Uraian
    public function uraians()
    {
        return $this->hasMany(Uraian::class, 'kategori_id');
    }

    // ✅ Kategori → SubUraian (LEWAT Uraian)
    public function subUraians()
    {
        return $this->hasManyThrough(
            SubUraian::class,
            Uraian::class,
            'kategori_id', // foreign key di tabel uraian
            'uraian_id',   // foreign key di tabel sub_uraian
            'id',          // primary key kategori
            'id'           // primary key uraian
        );
    }
}