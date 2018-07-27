<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Proveedor extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'proveedores';
    protected $primaryKey = 'id';


    protected $fillable = [
        'name',
        'ruc',
        'phone',
        'mobile',
        'email',
    ];

    protected $guarded=[];

    public function expedientes()
    {
        return $this->hasMany ('App\Expediente');
    }
}
