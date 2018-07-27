<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Funcionario extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    /**
     * @mixin \Eloquent
     */

    protected $table = 'funcionarios';
    protected $primaryKey = "id";
    //public $timestamps = false; //laravel crea dos columnas que contienen informacion de cuando un registro se creó y se actualizó

    protected $fillable = [ //asigna los campos de la tabla de BD
        'user_id',
        'departamento_id'
    ];

    protected $guarded = [ //campos que no se quieren incluir

    ];

    public function user()
    {
        return $this->belongsTo ('App\User');
    }

    /*public function area()
    {
        return $this->belongsTo ('App\Area', 'departamento_id');
    }*/

    public function departamento ()
    {
        return $this->belongsTo ('App\Area', 'departamento_id');
    }
}

