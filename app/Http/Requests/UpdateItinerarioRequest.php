<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateItinerarioRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['required'],
            'empresa_id' => ['required'],
            'sucursal_id' => ['required'],
            'bus_id' => ['required'],
            'chofer_id' => ['required'],
            'chofer2_id' => ['nullable'],
            'terramoza_id' => ['required'],
            'terramoza2_id' => ['required'],
            'fecha_partida' => ['required'],
            'fecha_llegada' => ['required'],
            'hora_partida' => ['required'],
            'hora_llegada' => ['required'],
            'origen_id' => ['required'],
            'destino_id' => ['required'],
            'usuario_id' => ['required'],
            'sucursal_partida' => ['required'],
            'sucursal_destino' => ['required'],
        ];
    }

    public function messages(){
        return [
            'id.required' => 'Itinerario ID es requerido',
            'empresa_id.required' => 'Empresa es requerido',
            'sucursal_id.required' => 'Sucursal es requerido',
            'bus_id.required' => 'Bus es requerido',
            'chofer_id.required' => 'Chofer es requerido',
            'terramoza_id.required' => 'Terramoza 1 es requerido',
            'terramoza2_id.required' => 'Terramoza 2 es requerido',
            'fecha_partida.required' => 'Fecha Partida es requerido',
            'fecha_llegada.required' => 'Fecha Llegada es requerido',
            'hora_partida.required' => 'Hora Partida es requerido',
            'hora_llegada.required' => 'Hora Llegada es requerido',
            'origen_id.required' => 'Origen es requerido',
            'destino_id.required' => 'Destino es requerido',
            'usuario_id.required' => 'Usuario es requerido',
            'sucursal_partida.required' => 'Sucursal Partida es requerido',
            'sucursal_destino.required' => 'Sucursal Destino es requerido',
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json(['message'=>'Hubo error(es) al validar los datos','inputs' => $validator->errors(), 'status' => false]));
    }
}
