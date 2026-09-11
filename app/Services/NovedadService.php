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
     * @param StoreNovedadDTO $dto
     * @return Novedad
     * @throws Exception
     */
    public function registrarNovedad(StoreNovedadDTO $dto): Novedad
    {
        return DB::transaction(function () use ($dto) {
            $esInterna = $dto->idReserva === null;

            $novedad = Novedad::create([
                'tipo_novedad' => $dto->tipoNovedad,
                'descripcion_novedad' => $dto->descripcionNovedad,
                'ticket_novedad' => $this->generarTicket($esInterna),
                'no_documento_colaborador' => $dto->noDocumentoColaborador,
                'no_documento_cliente' => $dto->noDocumentoCliente,
                'etapa_novedad' => $dto->etapaNovedad ?? 'Pendiente',
                'id_reserva' => $dto->idReserva,
                'estado_novedad' => true
            ]);

            return $novedad;
        });
    }

    private function generarTicket(bool $esInterna): string
    {
        $prefijo = $esInterna ? 'I' : 'C';
        $ultimo = Novedad::where('ticket_novedad', 'like', $prefijo . '%')
            ->orderByRaw('CAST(SUBSTRING(ticket_novedad, 2) AS UNSIGNED) DESC')
            ->first();

        $siguienteNumero = $ultimo ? ((int) substr($ultimo->ticket_novedad, 1)) + 1 : 1;

        return $prefijo . str_pad($siguienteNumero, 4, '0', STR_PAD_LEFT);
    }
}
