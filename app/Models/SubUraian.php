<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Uraian;

class SubUraian extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    protected $table = 'sub_uraians';

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

        'uraian_id',
        'nama_sub_uraian',

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

    public function uraian()
    {
        return $this->belongsTo(Uraian::class);
    }
}