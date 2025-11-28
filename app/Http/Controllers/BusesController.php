<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBusRequest;
use App\Http\Requests\UpdateBusRequest;
use App\Models\Bus;
use Illuminate\Http\Request;
use App\Repos\BusRepo;

class BusesController extends Controller
{
    private $repo = null;
    
    public function __construct(BusRepo $repo){
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $obj = $this->repo->filter(request()->all());
        $retorno['TOTAL'] = count($obj);
        $retorno['LISTA'] = $obj;

        return response()->json($retorno);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateBusRequest $request)
    {
        try {

            $params = $request->validated();
            $params['estado'] = 1;
            $this->repo->create($params);
            return response()->json(['message'=>'El bus se registró correctamente', 'status'=>true]);
        } catch (\Exception $e){
            return response()->json(['message'=>$e->getMessage(), 'status'=>false]);
        }     
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bus $buses
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function show(Bus $bus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bus $buses
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {
        $retorno =[];
        $retorno['status'] = false;
        if (!$request->has("id"))
        {
            $retorno['message'] = 'Por favor ingrese id';
            return response()->json($retorno);
        }

        $input =json_decode(file_get_contents('php://input'),true);
        $lista = Bus::find($input["id"]);

        $retorno['status'] = true;
        $retorno['lista'] = $lista;

        return response()->json($retorno);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bus $bus
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBusRequest $request, Bus $bus)
    {
        try {
            $params = $request->validated();
            $this->repo->update($bus, $params);
            return response()->json(['message'=>'El bus se registró correctamente', 'status'=>true]);
        } catch (\Exception $e){
            return response()->json(['message'=>$e->getMessage(), 'status'=>false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bus $bus
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Bus $bus)
    {
        $this->repo->delete($bus);
        $retorno['status'] = true;
        $retorno['message'] = 'El bus se elimino correctamente';
        return response()->json($retorno);
    }

    public function saveAsientos(Bus $bus){
        $this->repo->saveAsientos($bus, request()->all());
        $retorno['status'] = true;
        $retorno['message'] = 'Los asientos se registraron correctamente';
        return response()->json($retorno);
    }
}
