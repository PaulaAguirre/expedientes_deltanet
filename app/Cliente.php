<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model

    /**
     * @mixin \Eloquent
     */
{
    protected $table = 'clientes';
    protected $primaryKey = "id";

    protected $fillable = [ //asigna los campos de la tabla de BD
        'nombre',
        'ruc',
        'descripcion'

    ];

    public function expedientes()
    {
        return $this->hasMany ('App\Expediente');
    }
}
