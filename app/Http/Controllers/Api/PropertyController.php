<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Property\StorePropertyRequest;
use App\Http\Requests\Api\Property\UpdatePropertyRequest;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
     {
         // Creamos una query base
         $query = Property::query();

         // Filtros opcionales más comunes
         if ($request->has('ciudad')) {
              $query->where('ciudad', $request->get('ciudad'));
         }

         if ($request->has('precio_min')) {
              $query->where('precio', '>=', $request->get('precio_min'));
         }

         if ($request->has('precio_max')) {
              $query->where('precio', '<=', $request->get('precio_max'));
         }

         // Paginamos con 10 elementos por página
         $propiedades = $query->paginate(10);

         return response()->json($propiedades, 200);
     }

     /**
      * Store a newly created resource in storage.
      */
     public function store(StorePropertyRequest $request)
     {
         // Creamos una nueva propiedad
         $propiedad = Property::create($request->all());
         return response()->json($propiedad, 201);
     }

     /**
      * Display the specified resource.
      */
     public function show($id)
     {
         // Mostramos una propiedad específica
         $propiedad = Property::find($id);
         if (!$propiedad) {
             return response()->json(['message' => 'Propiedad no encontrada'], 404);
         }
         return response()->json($propiedad, 200);
     }

     /**
      * Update the specified resource in storage.
      */
     public function update(UpdatePropertyRequest $request, $id)
     {
         //Validamos que existe
         $propiedad = Property::find($id);
         if (!$propiedad) {
             return response()->json(['message' => 'Propiedad no encontrada'], 404);
         }

         // Actualizamos una propiedad existente
         $propiedad->update($request->all());
         return response()->json($propiedad, 200);
     }

     /**
      * Remove the specified resource from storage.
      */
     public function destroy($id)
     {
         //Validamos que existe
         $propiedad = Property::find($id);
         if (!$propiedad) {
             return response()->json(['message' => 'Propiedad no encontrada'], 404);
         }
         // Eliminamos una propiedad
         $propiedad->delete();
         return response()->json(['message' => 'Propiedad eliminada correctamente'], 200);
     }

}
