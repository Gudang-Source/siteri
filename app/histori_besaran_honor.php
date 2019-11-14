<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class histori_besaran_honor extends Model
{
    protected $table = "histori_besaran_honor";
    public $timestamps = FALSE;

    public function besaran_honor()
    {
        return $this->belongsTo('App\besaran_honor','id_besaran_honor');
    }

    public function detail_honor()
    {
        return $this->hasMany('App\detail_honor', 'id_histori_besaran_honor');
    }

}
