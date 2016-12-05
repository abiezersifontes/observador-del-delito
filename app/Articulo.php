<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Articulo extends Model
{
    use SoftDeletes;

    protected $table = 'articulos';
    protected $fillable = ['titulo', 'descripcion', 'link','periodico','delito','estado','municipio','parroquia','fecha'];
    protected $dates = ['deleted_at'];

}
