<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ot extends Model
{
    protected $table = 'ots';
    protected $primaryKey = "id";
    //public $timestamps = false; //laravel crea dos columnas que contienen informacion de cuando un registro se creó y se actualizó

    protected $fillable = [ //asigna los campos de la tabla de BD
        'codigo',
        'obra',
        'referencia'
    ];

    protected $guarded = [ //campos que no se quieren incluir

    ];

    public function expedientes()
    {
        return $this->hasMany ('App\Expedientes');
    }
}
