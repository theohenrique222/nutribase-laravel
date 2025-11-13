@extends('layouts.main')
@section('title', 'Dieta')
@section('content')

<section class="pt-16 bg-neutral-800 min-h-screen">
    <div class="text-center mt-10 mb-8">
        <h1 class="text-3xl font-bold text-lime-500">🍎 Minhas Dietas</h1>
        <p class="text-gray-100">Acompanhe e gerencie suas dietas cadastradas</p>
    </div>

    <div class="bg-gray-100 backdrop-blur-sm shadow-md rounded-xl overflow-hidden max-w-6xl m-auto">
        @forelse ($diets as $diet)
            <div
                class="flex flex-col sm:flex-row justify-between min-w-2xl items-center border-b border-gray-100 p-4 hover:bg-gray-200 transition">
                <div class="text-left">
                    <a href="{{ route('diet.show', $diet->id) }}">
                        <p class="text-lg font-semibold text-gray-700 hover:underline">
                            {{ $diet->name }}
                        </p>
                    </a>
                    <p class="text-sm text-gray-500">
                        Atualizada em {{ $diet->updated_at->format('d/m/Y') }}
                    </p>
                </div>

                <div class="flex gap-2 mt-3 sm:mt-0">
                    <a href="{{ route('diet.edit', $diet->id) }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium px-3 py-1.5 rounded-md transition">
                        Editar
                    </a>

                    <form action="{{ route('diet.destroy', $diet->id) }}" method="POST"
                        onsubmit="return confirm('Tem certeza que deseja excluir esta dieta?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white text-sm font-medium px-3 py-1.5 rounded-md transition">
                            Excluir
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-6 text-center">
                <p class="text-white mb-4">Você ainda não possui dietas cadastradas.</p>
            </div>
        @endforelse
        <div class="p-6 text-center">
            <a href="{{ route('diet.create') }}"
                class="inline-block bg-lime-500 hover:bg-lime-600 text-white font-medium px-4 py-2 rounded-md transition">
                Criar nova dieta
            </a>
        </div>
    </div>


</section>

@endsection