<?php

namespace App\Http\Controllers;

use App\Services\MetodoPagoService;
use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    public function __construct(private MetodoPagoService $metodoPagoService) {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metodosPago = $this->metodoPagoService->getAll();
        return response()->json([
            'success' => true,
            'message' => 'Métodos de pago obtenidos correctamente',
            'data' => $metodosPago
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $metodoPago = $this->metodoPagoService->getById((int) $id);
        return response()->json([
            'success' => true,
            'message' => 'Método de pago obtenido correctamente',
            'data' => $metodoPago
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
