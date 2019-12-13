<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Municipio extends Model
{
    //
    protected $table = 'tb_municipio';
    protected $fillable = ['muni_nomb','muni_codi'];
    protected $primaryKey = 'muni_codi';
}
