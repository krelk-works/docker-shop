<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MerchandisingController extends Controller
{
    public function index()
{
    return view('merchandising.merchandising'); // Ajusta esto a la ubicación correcta de tu vista
}
    public function store(Request $request)
    {
    $imageData = $request->input('image'); // La imagen base64

    // Procesar la imagen y almacenarla
    $image = str_replace('data:image/png;base64,', '', $imageData);
    $image = base64_decode($image);

    // Guardar la imagen en el almacenamiento (por ejemplo, en el directorio 'public')
    $imageName = 'custom_design_' . time() . '.png';
    $path = public_path('uploads/' . $imageName);
    file_put_contents($path, $image);

    // Guardar el nombre de la imagen en la base de datos o cualquier otra cosa
    // Ejemplo: Producto::create(['image' => $imageName]);

    return redirect()->route('merchandising.index');  // Redirigir de vuelta a la vista
    }

}

?>
