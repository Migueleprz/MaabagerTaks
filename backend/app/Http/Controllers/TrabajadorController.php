<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrabajadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Trabajador::all(), 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'surname'=>'required|string',
            'dni'=>'required|integer|unique:trabajadors',
            'dependency'=>'required|integer',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error'=> $errors
            ],400);
        }

        $trabajador = Trabajador::create($request->post());
        return response()->json($trabajador,200);
    }

    /**
     * Display the specified resource.
     *
     * @param Trabajador $trabajador
     * @return JsonResponse
     */
    public function show(Trabajador $trabajador)
    {
        return response()->json($trabajador,200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Trabajador $trabajador
     * @return JsonResponse
     */
    public function update(Request $request, Trabajador $trabajador)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'surname'=>'required|string',
            'dni'=>'required|integer|unique:trabajadors',
            'dependency'=>'required|integer',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error'=> $errors
            ],400);
        }

        $trabajador->fill($request->post())->save();
        return response()->json($trabajador,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Trabajador $trabajador
     * @return JsonResponse
     */
    public function destroy(Trabajador $trabajador)
    {
        $trabajador->delete();
        return response()->json(['message'=>'Trabajador eliminado']);
    }
}
