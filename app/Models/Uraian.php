<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\SubUraian;

class Uraian extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    protected $table = 'uraians';

    /*
    |--------------------------------------------------------------------------
    | PRIMARY KEY
    |--------------------------------------------------------------------------
    */

    protected $primaryKey = 'id';

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'kategori_id',
        'nama_uraian',

    ];

    /*
    |--------------------------------------------------------------------------
    | TIMESTAMPS
    |--------------------------------------------------------------------------
    */

    public $timestamps = true;

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function subUraians()
    {
        return $this->hasMany(SubUraian::class);
    }
}