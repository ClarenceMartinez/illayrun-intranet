<?php
namespace App\Http\Controllers;

use App\Models\Itinerario;
use App\Repos\ItinerarioRepo;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller {

    public function itinerarioReporte(Itinerario $itinerario, $reporte){

        $repo = (new ItinerarioRepo);
        $data = [];
        switch($reporte){
            case 'manifiesto_ptoventa':
                $data = $repo->getManifiestoPtoVenta($itinerario);
                break;
            case 'manifiesto_pasajeros':
                $data = $repo->getManifiestoPasajeros($itinerario);
                break;
            case 'manifiesto_encomiendas':
                $data = $repo->getManifiestoEncomiendas($itinerario);
                break;
            case 'croquis':
                $data = $repo->getCroquis($itinerario);
                break;
        }
        

        $pdf = Pdf::loadView('pdf.' . $reporte, $data);
        return $pdf->stream();
    }

}