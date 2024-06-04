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

          try {
            // Simulación del envío de la solicitud
            $response = Http::post($endpointUrl, $validatedData);

            // Verificar si la solicitud fue exitosa
            if ($response->successful()) {
                $responseData = $response->json();
            } else {
                $responseData = [
                    'error' => 'Failed to connect to the external endpoint',
                    'status' => $response->status(),
                    'body' => $response->body()
                ];
            }
        } catch (\Exception $e) {
            $responseData = [
                'error' => 'Exception occurred while trying to connect to the external endpoint',
                'message' => $e->getMessage()
            ];
        }

        // Retornar la respuesta
        return response()->json([
            'status' => 'success',
            'data' => $validatedData,
            'response' => $responseData
        ]);
    }
}
