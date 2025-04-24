@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-lg mt-10">
    <h2 class="text-2xl font-bold mb-4">Editar Recompensa</h2>
    <form action="{{ route('rewards.update', $reward->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2">Nombre</label>
        <input type="text" name="title" value="{{ $reward->title }}" class="w-full border p-2 rounded mb-4">

        <label class="block mb-2">Descripción</label>
        <textarea name="description" class="w-full border p-2 rounded mb-4">{{ $reward->description }}</textarea>

        <label class="block mb-2">Stock</label>
        <input type="number" name="stock" value="{{ $reward->stock }}" class="w-full border p-2 rounded mb-4">

        <label class="block mb-2">Puntos</label>
        <input type="number" name="cost" value="{{ $reward->cost }}" class="w-full border p-2 rounded mb-4">

        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Guardar</button>
        </div>
    </form>
</div>
@endsection
