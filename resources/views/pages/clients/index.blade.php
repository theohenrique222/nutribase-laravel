@extends('layouts.main')
@section('title', 'Alunos')
@section('content')

<section class="min-h-screen pt-16 bg-neutral-800">
    <div class="text-center mt-10 mb-8">
        <h1 class="text-3xl font-bold text-lime-500">Alunos</h1>
        <p class="text-gray-100">Acompanhe e gerencie seus alunos cadastrados</p>
    </div>

    <div class="bg-gray-100 min-h-80 backdrop-blur-sm shadow-md rounded-xl overflow-hidden max-w-6xl m-auto">

        <div class="grid grid-cols-5 bg-lime-500 text-neutral-50 font-semibold uppercase text-center p-4 border-b">
            <p>Nome</p>
            <p>Idade</p>
            <p>Objetivo</p>
            <p>Dietas</p>
            <p>Ações</p>
        </div>

        @forelse ($clients as $client)
            <div class="grid grid-cols-5 items-center border-b border-neutral-300 p-4 bg-white hover:bg-lime-50 transition">

                {{-- Nome + data --}}
                <div class="text-center sm:text-left">
                    <a href="{{ route('clients.show', $client->id) }}"
                        class="text-lg font-bold text-neutral-800 hover:underline">
                        {{ $client->name }}
                    </a>
                    <p class="text-xs text-neutral-500">
                        Cadastrado em {{ $client->created_at->format('d/m/Y') }}
                    </p>
                </div>

                <div class="text-center">
                    <p class="text-base text-neutral-700">
                        {{ $client->age }}
                    </p>
                </div>

                <div class="text-center">
                    <p class="text-base text-neutral-700">
                        @switch($client->goal)
                            @case(1)
                                Emagrecimento
                                @break
                            @case(2)
                                Hipertrofia
                                @break
                            @case(3)
                                Condicionamento
                                @break
                            @default
                                Não informado
                        @endswitch
                    </p>
                </div>
                <div class="flex justify-center">
                    @if ($client->diet)
                        <a href="{{ route('diet.edit', $client->diet->id) }}"
                           class="bg-lime-500 hover:opacity-80 text-white text-sm font-medium px-3 py-1.5 rounded-md transition">
                            Ver Dieta
                        </a>
                    @else
                        <a href="{{ route('diet.create', ['client_id' => $client->id]) }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium px-3 py-1.5 rounded-md transition">
                            Criar Dieta
                        </a>
                    @endif
                </div>
                <div class="flex justify-center gap-2">
                    <a href="{{ route('clients.edit', $client->id) }}"
                        class="bg-lime-500 hover:opacity-80 text-white text-sm font-medium px-3 py-1.5 rounded-md transition">
                        Editar
                    </a>

                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST"
                        onsubmit="return confirm('Tem certeza que deseja excluir este aluno?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:opacity-80 cursor-pointer text-white text-sm font-medium px-3 py-1.5 rounded-md transition">
                            Excluir
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-8 text-center">
                <p class="text-gray-700 mb-4">Você ainda não possui alunos cadastrados.</p>
            </div>
        @endforelse
        <div class="text-center mt-10">
            <a href="{{ route('clients.create') }}"
            class="inline-block mt-4 bg-lime-500 hover:bg-lime-600 text-white font-medium px-4 py-2 rounded-md transition">
            + Cadastrar Aluno
            </a>
        </div>

    </div>
</section>

@endsection
