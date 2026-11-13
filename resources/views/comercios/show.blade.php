{{-- Semana 7 · Blade --}}
{{-- resources/views/comercios/show.blade.php --}}
@extends('layouts.app')

@section('titulo', $comercio->nombre_comercio)

@section('contenido')
    <h1>{{ $comercio->nombre_comercio }}</h1>
    <a href="{{ route('transacciones.create', $comercio) }}">
    + Nueva transacción
    </a>

    <!-- Ejercicio Práctico: Resumen de actividad -->
    @if ($comercio->transacciones->count() === 0)
        <p class="meta">Este comercio es nuevo, aún no registra actividad.</p>
    @elseif ($comercio->transacciones->count() === 1)
        <p class="meta">Este comercio tiene su primera transacción registrada.</p>
    @else
        <p class="meta">Este comercio tiene un historial de {{ $comercio->transacciones->count() }} transacciones.</p>
    @endif

    <h2>Transacciones</h2>
@forelse ($comercio->transacciones as $t)
    <div class="transaccion">
        <strong>${{ $t->monto }}</strong> - {{ $t->cliente_nombre }}
        <x-badge-estado estado="{{ $t->estado }}" />
        <a href="{{ route('transacciones.edit', $t) }}">Editar</a>
        <form action="{{ route('transacciones.destroy', $t) }}" 
              method="POST" 
              onsubmit="return confirm('¿Eliminar esta transacción? Esta acción no se puede deshacer.')" 
              style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar</button>
        </form>
    </div>
@empty
    <p>Sin transacciones</p>
@endforelse

@endsection
