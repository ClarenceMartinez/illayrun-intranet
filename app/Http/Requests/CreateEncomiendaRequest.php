<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateEncomiendaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules(){
        return [
            'empresa_id' => ['required'],
            'sucursal_id' => ['required'],
            'remitente_tipo_documento' => ['required'],
            'remitente_numero_documento' => ['required'],
            'remitente_nombres' => ['required'],
            'remitente_paternos' => ['required'],
            'remitente_maternos' => ['required'],
            'remitente_celular' => ['required'],
            'consignado_tipo_documento' => ['required'],
            'consignado_numero_documento' => ['required'],
            'consignado_nombres' => ['required'],
            'consignado_paternos' => ['required'],
            'consignado_maternos' => ['required'],
            'consignado_celular' => ['required'],
            'sucursal_destino' => ['required'],
            'itinerario_id' => ['required'],
            'contrasenia' => ['required'],
            'fecha_envio' => ['required'],
            'forma_pago' => ['required'],
            'comprobante' => ['required'],
            'correlativo' => ['required'],
            'detalle' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'empresa_id.required' => 'Empresa es requerido',
            'sucursal_id.required' => 'Sucursal es requerido',
            'remitente_tipo_documento.required' => 'Tipo de documento del remitente  es requerido',
            'remitente_numero_documento.required' => 'Nro Doc remitente es requerido',
            'remitente_nombres.required' => 'Nombres del remitente es requerido',
            'remitente_paternos.required' => 'Apellido paterno del remitente es requerido',
            'remitente_maternos.required' => 'pellido materno del remitente es requerido',
            'remitente_celular.required' => 'Teléfono del remitente requerido',
            'consignado_tipo_documento.required' => 'Tipo de documento del consignado  es requerido',
            'consignado_numero_documento.required' => 'Nro Doc consignado es requerido',
            'consignado_nombres.required' => 'Nombres del consignado es requerido',
            'consignado_paternos.required' => 'Apellido paterno del consignado es requerido',
            'consignado_maternos.required' => 'pellido materno del consignado es requerido',
            'consignado_celular.required' => 'Teléfono del consignado requerido',
            'sucursal_destino.required' => 'Sucursal destino es requerido',
            'itinerario_id.required' => 'Itinerario es requerido',
            'contrasenia.required' => 'Contraseña es requerida',
            'fecha_envio.required' => 'Fecha de envio es requerido',
            'forma_pago.required' => 'Forma de pago es requerido',
            'comprobante.required' => 'Comprobante es requerido',
            'correlativo.required' => 'Correlativo es requerido',
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json(['message'=>'Hubo error(es) al validar los datos','inputs' => $validator->errors(), 'status' => false]));
    }
}
