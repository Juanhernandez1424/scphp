<?php

namespace Tests\Unit;

use App\DTOs\StoreVehiculoDTO;
use App\Services\VehiculoService;
use PHPUnit\Framework\TestCase;

class VehiculoServiceTest extends TestCase
{
    public function test_registrar_vehiculo_acepta_dto_vehiculo(): void
    {
        $method = new \ReflectionMethod(VehiculoService::class, 'registrarVehiculo');
        $parameters = $method->getParameters();

        $this->assertCount(1, $parameters);
        $this->assertSame(StoreVehiculoDTO::class, (string) $parameters[0]->getType());
    }
}
