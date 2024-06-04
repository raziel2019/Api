<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

          // URL del endpoint externo
          $endpointUrl = 'https://banorte.racielhernandez.com/'; // Cambia esto por la URL real del endpoint

          // Simulación del envío de la solicitud
          $response = Http::post($endpointUrl, $validatedData);

          return response()->json([
            'status' => 'success',
            'data' => $validatedData,
            'response' => $response->json()
        ]);
    }
}
