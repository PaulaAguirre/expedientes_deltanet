<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
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
