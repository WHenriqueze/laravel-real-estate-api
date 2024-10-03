<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Person\StorePersonRequest;
use App\Http\Requests\Api\Person\UpdatePersonRequest;

class PersonController extends Controller
{
  /**
   * Display a listing of the resource.
   */
   public function index(Request $request)
   {
       // Creamos una query base
       $query = Person::query();

       // Filtros opcionales mas comunes
       if ($request->has('nombre')) {
           $query->where('nombre', 'like', '%' . $request->get('nombre') . '%');
       }

       if ($request->has('email')) {
           $query->where('email', 'like', '%' . $request->get('email') . '%');
       }

       // Paginamos con 10 elementos por página
       $personas = $query->paginate(10);

       return response()->json($personas, 200);
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(StorePersonRequest $request)
   {
       // Creamos una nueva persona
       $persona = Person::create($request->all());
       return response()->json($persona, 201);
   }

   /**
    * Display the specified resource.
    */
   public function show($id)
   {
     // Mostramos una persona específica
       $persona = Person::find($id);
       if (!$persona) {
           return response()->json(['message' => 'Persona no encontrada'], 404);
       }
       return response()->json($persona, 200);
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(UpdatePersonRequest $request, $id)
   {
       //Validamos que existe
       $persona = Person::find($id);
       if (!$persona) {
           return response()->json(['message' => 'Persona no encontrada'], 404);
       }

       // Actualizamos una persona existente
       $persona->update($request->all());
       return response()->json($persona, 200);
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy($id)
   {
       //Validamos que existe
       $persona = Person::find($id);
       if (!$persona) {
           return response()->json(['message' => 'Persona no encontrada'], 404);
       }
       // Eliminamos una persona
       $persona->delete();
       return response()->json(['message' => 'Persona eliminada correctamente'], 200);
   }

}
