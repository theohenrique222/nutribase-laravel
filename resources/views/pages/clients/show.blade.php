@extends('layouts.main')
@section('title', 'Dados')
@section('content')

    <section class="pt-16 min-h-screen bg-neutral-800">
        <div class="max-w-3xl mx-auto bg-white shadow-xl rounded-2xl p-6 mt-10">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">
                Dados Pessoais
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-xl shadow-sm">
                    <p class="text-sm text-gray-500">Nome</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $clients->name }}</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl shadow-sm">
                    <p class="text-sm text-gray-500">Idade</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $clients->age }} anos</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl shadow-sm">
                    <p class="text-sm text-gray-500">Gênero</p>
                    <p class="text-lg font-semibold text-gray-800">
                        {{ $clients->gender == 1 ? 'Masculino' : 'Feminino' }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl shadow-sm">
                    <p class="text-sm text-gray-500">Peso</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $clients->weight }} kg</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl shadow-sm">
                    <p class="text-sm text-gray-500">Altura</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $clients->height }} cm</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl shadow-sm">
                    <p class="text-sm text-gray-500">Cintura</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $clients->waist }} cm</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl shadow-sm">
                    <p class="text-sm text-gray-500">Nível de atividade</p>
                    <p class="text-lg font-semibold text-gray-800">
                        @switch($clients->activity)
                        @case(1) Sedentário @break
                        @case(2) Moderado @break
                        @case(3) Ativo @break
                        @endswitch
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl shadow-sm">
                    <p class="text-sm text-gray-500">Objetivo</p>
                    <p class="text-lg font-semibold text-gray-800">
                        @switch($clients->goal)
                        @case(1) Emagrecimento @break
                        @case(2) Hipertrofia @break
                        @case(3) Condicionamento @break
                        @endswitch
                    </p>
                </div>
                <div class="bg-gray-50 p-4 rounded-xl shadow-sm">
                    <p class="text-sm text-gray-500">Metabolismo Basal</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $clients->waist }} cm</p>
                </div>

            </div>
        </div>
    </section>
@endsection
