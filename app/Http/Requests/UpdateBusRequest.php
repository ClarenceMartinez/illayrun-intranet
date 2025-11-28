<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateBusRequest extends FormRequest
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
            'tuc' => ['required'],
            'fecha_emision_tuc' => ['required'],
            'fecha_vencimiento_tuc' => ['required'],
            'citv' => ['required'],
            'ultimo_citv' => ['required'],
            'soat' => ['required'],
            'fecha_emision_soat' => ['required'],
            'fecha_vencimiento_soat' => ['required'],
            'tarjeta_propiedad' => ['required'],
            'tiv_fisico' => ['required'],
            'tiv_electronica' => ['required'],
            'fecha_emision_tiv' => ['required'],
            'fecha_vencimiento_tiv' => ['required'],
            'marca' => ['required'],
            'placa' => ['required'],
            'carroceria_original' => ['required'],
            'categoria' => ['required'],
            'pad' => ['required'],
            'caracteristicas' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'tuc.required' => 'TUC es requerido',
            'fecha_emision_tuc.required' => 'Fecha emision TUC es requerido',
            'fecha_vencimiento_tuc.required' => 'Fecha vencimiento TUC es requerido',
            'citv.required' => 'CITV es requerido',
            'ultimo_citv.required' => 'Ultimo CITV es requerido',
            'soat.required' => 'SOAT es requerido',
            'fecha_emision_soat.required' => 'Fecha emision SOAT es requerido',
            'fecha_vencimiento_soat.required' => 'Fecha vencimiento SOAT es requerido',
            'tarjeta_propiedad.required' => 'Tarjeta propiedad es requerido',
            'tiv_fisico.required' => 'TIV fisico es requerido',
            'tiv_electronica.required' => 'TIV electronica es requerido',
            'fecha_emision_tiv.required' => 'Fecha emision TIV es requerido',
            'fecha_vencimiento_tiv.required' => 'Fecha vencimiento TIV es requerido',
            'marca.required' => 'Marca es requerido',
            'placa.required' => 'Placa es requierido',
            'carroceria_original.required' => 'Carrorecia original es requerido',
            'categoria.required' => 'Categoria es requerido',
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json(['message'=>'Hubo error(es) al validar los datos','inputs' => $validator->errors(), 'status' => false]));
    }
}
