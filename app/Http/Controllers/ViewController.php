<?php namespace App\Http\Controllers;

use App\Repos\BusRepo;
use App\Repos\DestinoRepo;
use App\Repos\EmpresaRepo;
use App\Repos\SucursalRepo;
use App\Repos\UsuarioRepo;

class ViewController extends Controller {

    public function busesIndex(){
        return view('buses/index', [
            'caracteristicas_base' => (new \App\Repos\CaracteristicaBusRepo)->search(),
            'empresas' => (new EmpresaRepo)->search(['estado'=>1]),
        ]);
    }

    public function caracteristicasBusBase(){
        return view('caracteristicasbasesbuses/index');
    }

    public function clientesIndex(){
        return view('clientes/index');
    }

    public function destinosIndex(){
        return view('destinos/index');
    }

    public function empresasIndex(){
        return view('empresas/index', [
            'tableRows' => []
        ]);
    }

    public function encomiendasIndex(){
        $sucursales = (new SucursalRepo)->search( ['empresa_id'=>auth()->user()->empresa] );
        $tipodocs = \App\Models\TipoDocumento::get();
        
        return view('encomiendas.index', ['sucursales'=>$sucursales, 'tipodocumentos'=>$tipodocs]);
    }

    public function itinerariosIndex(){
        return view('itinerarios/index', [
            'empresas' => (new EmpresaRepo)->search(['estado'=>1]),
            'sucursales' => (new SucursalRepo)->search(['estado'=>1]),
            'buses' => (new BusRepo)->search(),
            'choferes' => (new UsuarioRepo)->search(),
            'destinos' => (new DestinoRepo)->search(),
        ]);
    }

    public function sucursalesIndex(){
        return view('sucursales/index', [
            'tableRows' => [],
            'empresas' => (new EmpresaRepo)->search(['estado'=>1]),
            'departamentos' => \App\Models\Departamento::all(),
            'provincias' => \App\Models\Provincia::all(),
            'distritos' => \App\Models\Distrito::all()
        ]);
    }

    public function tipousuariosIndex(){
        return view('tipo_usuarios/index');
    }

    public function usuariosIndex(){
        return view('usuarios/index', [
            'tiposUsuario' => (new \App\Repos\TipoUsuarioRepo)->search(['estado'=>1]),
            'empresas' => (new EmpresaRepo)->search(['estado'=>1]),
        ]);
    }

    public function ventasIndex(){
        return view('ventas/index', [
            'sucursales' => (new SucursalRepo)->search(['estado'=>1])
        ]);
    }

}