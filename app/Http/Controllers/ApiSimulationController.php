<?php
namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Transaccion;
use Illuminate\Support\Facades\Http;


class ApiSimulationController extends Controller
{
    public function simulate(Request $request)
    {
        $uniqueID = Str::uuid()->toString();

        // Validar los datos recibidos
        $validatedData = $request->validate([
            'nombre' => 'required|string',
            'codigo_postal' => 'required|numeric',
            'email' => 'required|string',
            'telefono' => 'required|string',
            'rfc' => 'required|string',
            'selected-assistances' => 'required|string',
            'total-price' => 'required|numeric'
            ]);

                // Guardar los datos en la base de datos
                Transaccion::create([
                    'id_transaccion' => $uniqueID,
                    'nombre' => $validatedData['nombre'],
                    'codigo_postal' => $validatedData['codigo_postal'],
                    'email' => $validatedData['email'],
                    'telefono' => $validatedData['telefono'],
                    'rfc' => $validatedData['rfc'],
                    'selected_assistances' => $validatedData['selected-assistances'],
                    'total_price' => $validatedData['total-price'],
                ]);

        // Convertir la data reciba en array
        $data = [
            'id_transaccion' => $uniqueID,
            'nombre' => $validatedData['nombre'],
            'codigo_postal' => $validatedData['codigo_postal'],
            'email' => $validatedData['email'],
            'telefono' => $validatedData['telefono'],
            'rfc' => $validatedData['rfc'],
            'selected_assistances' => $validatedData['selected-assistances'],
            'total_price' => $validatedData['total-price']
        ];


        // URL del endpoint externo
        $response = Http::post('https://banorte.racielhernandez.com/', $data);


        if ($response->successful()) {
            return response()->json([
                'status' => 'success',
                'url' => "https://banorte.racielhernandez.com?id_transaccion={$uniqueID}"
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al enviar los datos al endpoint externo'
            ], 500);
        }
    }

    public function obtenerDatos(Request $request)
    {
            $idTransaccion = $request->query('id_transaccion');
            $transaccion = Transaccion::where('id_transaccion', $idTransaccion)->first();

            if ($transaccion) {
                return response()->json(['status' => 'success', 'data' => $transaccion]);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Transacción no encontrada']);
            }
        }
}
