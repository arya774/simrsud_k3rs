<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInspeksi extends Model
{
    use HasFactory;

    protected $table = 'detail_inspeksis';

    protected $fillable = [

        'inspeksi_id',

        'sub_uraian_id',

        'jawaban',

        'keterangan',

        'nilai',

    ];

    /*
    |----------------------------------------------------------
    | RELATION
    |----------------------------------------------------------
    */

    public function inspeksi()
    {
        return $this->belongsTo(Inspeksi::class);
    }

    public function subUraian()
    {
        return $this->belongsTo(SubUraian::class);
    }
}
