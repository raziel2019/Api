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

        // Construir la URL con parámetros de consulta
        $endpointUrl = 'https://banorte.racielhernandez.com/receive_data.php';
        $queryParams = http_build_query($validatedData);

        // Redirigir a la URL con los parámetros
        return redirect($endpointUrl . '?' . $queryParams);
    }
}
