<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class laporan_pengadaan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'laporan_pengadaan';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function pengadaan()
    {
        return $this->hasMany('App\pengadaan', 'id_laporan');
    }
}
