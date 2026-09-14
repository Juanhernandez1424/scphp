<?php

namespace App\Http\Controllers;

use App\DTOs\StoreComprobantePagoDTO;
use App\Http\Requests\StoreComprobantePagoRequest;
use App\Services\ComprobantePagoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ComprobantePagoController extends Controller
{
    public function __construct(private ComprobantePagoService $comprobantePagoService) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {}

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
    public function store(StoreComprobantePagoRequest $request): JsonResponse
    {
        try {
            $comprobante = $this->comprobantePagoService->registrar(
                StoreComprobantePagoDTO::fromRequest($request->validated())
            );

            return response()->json([
                'success' => true,
                'message' => 'Comprobante registrado correctamente',
                'data' => $comprobante
            ], 201);
        } catch (\RuntimeException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        $comprobante = $this->comprobantePagoService->obtenerPorReserva((int) $id);

        return response()->json([
            'success' => true,
            'message' => 'Comprobante obtenido correctamente',
            'data' => $comprobante
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
