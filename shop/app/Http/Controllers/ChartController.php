<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Asegúrate de que tienes un modelo Order

class ChartController extends Controller
{
    public function getChartData()
    {
        // Obtener ventas agrupadas por mes
        $ventasMensuales = Order::selectRaw('MONTH(created_at) as mes, SUM(total) as total')
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes');

        // Si no hay datos, devolver mensaje de error
        if ($ventasMensuales->isEmpty()) {
            return response()->json(["error" => "No hay datos de ventas"], 400);
        }

        return response()->json([
            "ventasMensuales" => $ventasMensuales
        ]);
    }
}


?>