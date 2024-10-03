<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Visit\StoreVisitRequest;
use App\Http\Requests\Api\Visit\UpdateVisitRequest;


class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
     {
         // Creamos una query base
         $query = Visit::with(['persona', 'propiedad']);

         // Filtros opcionales más comunes
         if ($request->has('persona_id')) {
             $query->where('persona_id', $request->get('persona_id'));
         }

         if ($request->has('propiedad_id')) {
             $query->where('propiedad_id', $request->get('propiedad_id'));
         }

         if ($request->has('fecha_inicio')) {
             $query->where('fecha_visita', '>=', $request->get('fecha_inicio'));
         }

         if ($request->has('fecha_fin')) {
             $query->where('fecha_visita', '<=', $request->get('fecha_fin'));
         }

         // Paginamos con 10 elementos por página
         $solicitudes = $query->paginate(10);

         return response()->json($solicitudes, 200);
     }

     /**
      * Store a newly created resource in storage.
      */
     public function store(Request $request)
     {
         // Creamos una nueva solicitud de visita
         $solicitud = Visit::create($request->all());
         return response()->json($solicitud, 201);
     }

     /**
      * Display the specified resource.
      */
     public function show($id)
     {
         // Mostramos una solicitud de visita específica
         $solicitud = Visit::with(['persona', 'propiedad'])->find($id);
         if (!$solicitud) {
             return response()->json(['message' => 'Solicitud de visita no encontrada'], 404);
         }
         return response()->json($solicitud, 200);
     }

     /**
      * Update the specified resource in storage.
      */
     public function update(Request $request, $id)
     {
         //Validamos si existe registro
         $solicitud = Visit::find($id);
         if (!$solicitud) {
             return response()->json(['message' => 'Solicitud de visita no encontrada'], 404);
         }

         // Actualizamos una solicitud de visita existente
         $solicitud->update($request->all());
         return response()->json($solicitud, 200);
     }

     /**
      * Remove the specified resource from storage.
      */
     public function destroy($id)
     {
         //Validamos si existe registro
         $solicitud = Visit::find($id);
         if (!$solicitud) {
             return response()->json(['message' => 'Solicitud de visita no encontrada'], 404);
         }

         // Eliminamos una solicitud de visita
         $solicitud->delete();
         return response()->json(['message' => 'Solicitud de visita eliminada correctamente'], 200);
     }

}
