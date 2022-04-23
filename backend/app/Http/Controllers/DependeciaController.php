<?php

namespace App\Http\Controllers;

use App\Models\Dependecia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DependeciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Dependecia::all(['id','name']),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $dependecia = Dependecia::create($request->post());
        return response()->json($dependecia,200);
    }

    /**
     * Display the specified resource.
     *
     * @param Dependecia $dependecia
     * @return JsonResponse
     */
    public function show(Dependecia $dependecia)
    {
        return response()->json($dependecia,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Dependecia $dependecia
     * @return JsonResponse
     */
    public function update(Request $request, Dependecia $dependecia)
    {
        $dependecia->fill($request->post())->save();
        return response()->json($dependecia,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Dependecia $dependecia
     * @return JsonResponse
     */
    public function destroy(Dependecia $dependecia)
    {
        $dependecia->delete();
        return response()->json(['message'=>'Dependencia eliminada']);
    }
}
