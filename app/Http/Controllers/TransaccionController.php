<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use App\Models\Transaccion;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\GuardarTransaccionRequest;
use App\Http\Requests\StoreTransaccionRequest;


class TransaccionController extends Controller
{
    public function create(Comercio $comercio): View
    {
        return view('transacciones.create', compact('comercio'));
    }

public function store(GuardarTransaccionRequest $request)
    {
        $transaccion = Transaccion::create($request->only([
            'comercio_id', 'cliente_nombre', 'monto',
        ]));

        return redirect()
            ->route('comercios.show', $transaccion->comercio_id)
            ->with('mensaje', 'Transacción registrada con éxito.');
    
        $transaccion = Transaccion::create($request->only([
            'comercio_id', 'cliente_nombre', 'monto',
        ]));

        return redirect()
            ->route('comercios.show', $transaccion->comercio_id)
            ->with('mensaje', 'Transacción registrada con éxito.');
    }
public function edit(Transaccion $transaccion)
    {
        $comercios = Comercio::orderBy('nombre_comercio')->get();
        return view('transacciones.edit',
        compact('transaccion', 'comercios'));
    }
    public function duplicarUltima(GuardarTransaccionRequest $request)
    {
        dd($request->validated());
    }

public function update(
    StoreTransaccionRequest $request,
    Transaccion $transaccion
) {
    $transaccion->update($request->validated());
 
   return redirect()
    ->route('comercios.show', $transaccion->comercio_id)
    ->with('mensaje', 'Transacción actualizada correctamente.');
}
public function destroy(Transaccion $transaccion)
{
    $comercioId = $transaccion->comercio_id;
    $nombreCliente = $transaccion->cliente_nombre;
    $transaccion->delete();
 
    return redirect()
        ->route('comercios.show', $comercioId)
        ->with('mensaje', "Transacción de {$nombreCliente} eliminada.");   

        }
        
public function moverEstado(Transaccion $transaccion, string $estado)
{
    // Mapa de transiciones válidas según el estado actual
    $transiciones = [
        'Iniciada'   => ['Completada', 'Fallida'],
        'Completada' => [],
        'Fallida'    => ['Iniciada'],
    ];

    // Validamos si el nuevo estado está permitido basándonos en el estado ACTUAL de la transacción
    if (!in_array($estado, $transiciones[$transaccion->estado] ?? [])) {
        abort(400, "No se puede mover de {$transaccion->estado} a {$estado}.");
    }
    
    $transaccion->update(['estado' => $estado]);
    
    return redirect()
        ->route('comercios.show', $transaccion->comercio_id)
        ->with('mensaje', "Transacción movida a {$estado}.");
}
}