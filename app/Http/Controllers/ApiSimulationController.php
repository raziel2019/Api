<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiSimulationController extends Controller
{
    public function simulate(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'petition.id' => 'required|string',
            'amountDetails.totalAmount' => 'required|numeric',
            'amountDetails.currency' => 'required|string|max:3',
        ]);

        // Convertir la estructura anidada en una plana para que sea compatible con la URL
        $queryParams = http_build_query([
            'petition_id' => $validatedData['petition']['id'],
            'totalAmount' => $validatedData['amountDetails']['totalAmount'],
            'currency' => $validatedData['amountDetails']['currency'],
        ]);

        // URL del endpoint externo
        $endpointUrl = 'https://banorte.racielhernandez.com/?' . $queryParams;

        // Retornar la URL generada
        return response()->json([
            'status' => 'success',
            'url' => $endpointUrl
        ]);
    }
}
