<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Trabajador;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $status
     * @return JsonResponse
     */
    public function index()
    {

        $tareas = Tarea::select(
            'tareas.id',
            'trabajadorId',
            'title',
            'description',
            'delivery_date',
            'status',
            'trabajadors.name',
            'surname')

            ->join('trabajadors','trabajadorId','trabajadors.id')
            ->paginate(3);
        return response()->json($tareas,200);
    }

    public function getTareas($status)
    {
        $tareas = Tarea::where('status', $status)
            ->select(
            'tareas.id',
            'trabajadorId',
            'title',
            'description',
            'delivery_date',
            'status',
            'trabajadors.name',
            'trabajadors.surname'
        )
            ->join('trabajadors','trabajadorId','trabajadors.id')
            ->paginate(3);

        return response()->json($tareas,200);
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
            'trabajadorId'=>'required|integer',
            'title'=>'required|string|max:50',
            'description'=>'required|string|max:500',
            'delivery_date'=>'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error'=> $errors
            ],400);
        }

        $tarea = Tarea::create($request->post());

        return response()->json(['tarea'=>$tarea, 'trabajador'=>$tarea->Trabajador],200);


    }

    /**
     * Display the specified resource.
     *
     * @param Tarea $tarea
     * @return JsonResponse
     */
    public function show(Tarea $tarea)
    {
        return response()->json($tarea,200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Tarea $tarea
     * @return JsonResponse
     */
    public function update(Request $request, Tarea $tarea)
    {
        $validator = Validator::make($request->all(), [
            'trabajadorId'=>'required|integer',
            'title'=>'required|string|size:50',
            'description'=>'required|string|size:500',
            'delivery_date'=>'required',
            'status'=>'required',
            'observation'=>'required|string|size:500',
            'observation_date'=>'required',

        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error'=> $errors
            ],400);
        }
        $tarea->fill($request->post())->save();
        return response()->json($tarea,200);
    }


    /**
     * Update Status the specified resource in storage.
     *
     * @param Request $request
     * @param Tarea $tarea
     * @return JsonResponse
     */
    public function updateStatus(Request $request, Tarea $tarea)
    {
        $validator = Validator::make($request->all(), [
            'status'=>'required',
            'observation'=>'required|string|size:500',
            'observation_date'=>'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error'=> $errors
            ],400);
        }
        $tarea->fill($request->post())->save();
        return response()->json($tarea,200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Tarea $tarea
     * @return JsonResponse
     */
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return response()->json(['message'=>'Tarea eliminada']);
    }
}
