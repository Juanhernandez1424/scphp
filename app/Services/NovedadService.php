<?php

namespace App\Services;

use App\DTOs\StoreNovedadDTO;
use App\Models\Novedad;
use Illuminate\Support\Facades\DB;

class NovedadService
{
    public function getAll()
    {
        return Novedad::with([
            'cliente',
            'colaborador',
            'reserva'
        ])
            ->orderBy('id_novedad', 'desc')
            ->get();
    }

    public function getById(int $idNovedad): Novedad
    {
        return Novedad::with([
            'cliente',
            'colaborador',
            'reserva'
        ])->findOrFail($idNovedad);
    }

    /**
     * Registra una novedad.
     * 
     * @param StoreNovedadDTO $dto
     * @return Novedad
     * @throws Exception
     */

    public function registrarNovedad(StoreNovedadDTO $dto): Novedad
    {
        return DB::transaction(function () use ($dto){
            $novedad = Novedad::create([
                'tipo_novedad' => $dto->tipoNovedad,
                'descripcion_novedad' => $dto->descripcionNovedad,
                'ticket_novedad' => $dto->ticketNovedad,
                'no_documento_colaborador' => $dto->noDocumentoColaborador,
                'no_documento_cliente' => $dto->noDocumentoCliente,
                'etapo_novedad' => $dto->etapoNovedad,
                'id_reserva' => $dto->idReserva
            ]);
            
            return $novedad;
        });
    }
}
