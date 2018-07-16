<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'expediente_id','area_id','estado', 'fecha_entrada', 'observaciones', 'observaciones_regularizacion', 'aprobado_por', 'orden'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       //
    ];

    public function expediente()
    {
        return $this->belongsTo ('App\Expediente');
    }

    public function area ()
    {
        return $this->belongsTo ('App\Area');
    }

    public function user ()
    {
        return $this->belongsTo ('App\User', 'aprobado_por');
    }
}
