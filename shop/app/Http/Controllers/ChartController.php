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

    // Método en el controlador para obtener los productos más vendidos
    public function getTopSellingProducts()
    {
        // Realizar una consulta para obtener los 10 productos más vendidos
        $topSellingProducts = DB::table('order_items')
                                ->join('shoes', 'order_items.shoe_id', '=', 'shoes.id')
                                ->select('shoes.id', 'shoes.model_id', 'shoes.stock', 'shoes.model.name', DB::raw('SUM(order_items.quantity) as total_sales'))
                                ->groupBy('shoes.id', 'shoes.model_id', 'shoes.stock', 'shoes.model.name')
                                ->orderByDesc('total_sales')  // Ordenar por el total de ventas
                                ->limit(10)  // Solo los 10 productos más vendidos
                                ->get();

        return response()->json($topSellingProducts);
    }

}


?>