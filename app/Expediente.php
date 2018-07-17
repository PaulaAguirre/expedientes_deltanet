<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class Expediente extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * @mixin \Eloquent
     */

    protected $table = 'expedientes';
    protected $primaryKey = "id";


    protected $fillable = [ //asigna los campos de la tabla de BD
        'user_id',
        'tipo_id',
        'memo',
        'fecha_creacion',
        'obra',
        'cliente',
        'ot_id',
        'proveedor_id',
        'referencia',
        'monto_factura',
        'monto',
        'notas'
    ];

    protected $guarded = [ //campos que no se quieren incluir

    ];

    public function creador ()
    {
        return $this->belongsTo ('App\User', 'user_id');
    }

    public function tipoexpediente()
    {
        return $this->belongsTo ('App\Tipoexpediente', 'tipo_id');
    }

    public function histories ()
    {
        return $this->hasMany ('App\History');
    }

    public function proveedor()
    {
        return $this->belongsTo ('App\Proveedor', 'proveedor_id');
    }

    public function  ot()
    {
        return $this->belongsTo ('App\Ot');
    }

    public function cliente()
    {
        return $this->belongsTo ('App\Cliente');
    }
}
