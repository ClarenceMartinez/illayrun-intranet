<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encomienda extends Model {

    protected $table = 'encomiendas';

    protected $fillable = ['empresa_id', 'sucursal_id', 'remitente_tipo_documento', 'remitente_numero_documento', 'remitente_nombres', 'remitente_paternos', 'remitente_maternos', 'remitente_celular', 'consignado_tipo_documento', 'consignado_numero_documento', 'consignado_nombres', 'consignado_paternos', 'consignado_maternos', 'consignado_celular', 'sucursal_destino', 'contrasenia', 'fecha_envio', 'itinerario_id', 'forma_pago', 'comprobante', 'correlativo', 'estado', 'totalgravada', 'totaligv', 'totalventa', 'pdf', 'xml_cpe', 'xml_cdr'];

    public function detalle(){
        return $this->hasMany(EncomiendaDetalle::class, 'encomienda_id', 'id');
    }

    public function sucursaldestino(){
        return $this->belongsTo(Sucursal::class, 'sucursal_destino', 'id');
    }

    public function remitente_tidodoc(){
        return $this->belongsTo(TipoDocumento::class, 'remitente_tipo_documento', 'id');
    }

    public function consignado_tidodoc(){
        return $this->belongsTo(TipoDocumento::class, 'consignado_tipo_documento', 'id');
    }

    public function itinerario(){
        return $this->belongsTo(Itinerario::class, 'itinerario_id', 'id');
    }
}