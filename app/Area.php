<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model

    /**
     * @mixin \Eloquent
     */
{
    protected $table = 'areas';
    protected $primaryKey = "id";
    //public $timestamps = false; //laravel crea dos columnas que contienen informacion de cuando un registro se creó y se actualizó

    protected $fillable = [ //asigna los campos de la tabla de BD
        'nombre',
        'descripcion',
        'tipo',
        'user_id',
        'dependencia_id'

    ];

    protected $guarded = [ //campos que no se quieren incluir

    ];

    public function user (){ //responsable del area
        return $this->belongsTo  ('App\User');
    }

    public function dependencia(){
        return $this->belongsTo ('App\Area', 'dependencia_id');
    }

    public function tipoexpedientes()
    {
        return $this->belongsToMany ('App\Tipoexpediente');
    }

    public function funcionarios(){
        return $this->hasMany ('App\Funcionario');
    }

}

