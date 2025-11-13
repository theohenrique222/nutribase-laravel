@extends('layouts.main')
@section('title', 'Atualiazr Dados')
@section('content')

    <section class="pt-16 min-h-screen bg-neutral-800 pb-10">

        <div class="text-center mt-10 mb-8">
            <h1 class="text-3xl font-bold text-lime-500">🧍‍♂️ Editar Dados Pessoais</h1>
            <p class="text-white">Edição de dados</p>
        </div>


        <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-2xl p-6 mt-10">
            <form action="{{ route('clients.update', $clients->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome:</label>
                        <input type="text" name="name" placeholder="Digite seu nome" value="{{ $clients->name }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition" />
                    </div>
                    <div>
                        <label for="age" class="block text-sm font-medium text-gray-700 mb-1">Idade</label>
                        <input type="number" name="age" placeholder="Digite sua idade" value="{{ $clients->age }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition">
                    </div>
                    <div>

                    </div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gênero</label>
                    <select name="gender" id="gender"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition">
                        <option value="1" {{ $clients->gender == 1 ? 'selected' : '' }}>Masculino</option>
                        <option value="2" {{ $clients->gender == 2 ? 'selected' : '' }}>Feminino</option>
                    </select>
                    <div>
                        <label for="weight" class="block text-sm font-medium text-gray-700 mb-1">Peso (kg)</label>
                        <input type="number" name="weight" placeholder="Ex: 72.5" value="{{ $clients->weight }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition">
                    </div>
                    <div>
                        <label for="height" class="block text-sm font-medium text-gray-700 mb-1">Altura (cm)</label>
                        <input type="number" name="height" placeholder="Digite sua altura em centimetros"
                            value="{{ $clients->height }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition">
                    </div>
                    <div>
                        <label for="waist" class="block text-sm font-medium text-gray-700 mb-1">Cinrcunferencia da cintura
                            (cm)</label>
                        <input type="number" name="waist" placeholder="Ex: 85" value="{{ $clients->waist }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition">
                    </div>
                    <div>
                        <label for="activity" class="block text-sm font-medium text-gray-700 mb-1">Nível de
                            atividade</label>
                        <select name="activity" id="activity"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition">
                            <option value="1" {{ $clients->activity == 1 ? 'selected' : '' }}>Sedentário</option>
                            <option value="2" {{ $clients->activity == 2 ? 'selected' : '' }}>Moderado</option>
                            <option value="3" {{ $clients->activity == 3 ? 'selected' : '' }}>Ativo</option>
                        </select>
                    </div>
                    <div>
                        <label for="goal" class="block text-sm font-medium text-gray-700 mb-1">Objetivo</label>
                        <select name="goal" id="goal"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white focus:ring-2 focus:ring-lime-500 focus:border-lime-500 outline-none transition">
                            <option value="1" {{ $clients->goal == 1 ? 'selected' : '' }}>Emagrecimento</option>
                            <option value="2" {{ $clients->goal == 2 ? 'selected' : '' }}>Hipertrofia</option>
                            <option value="3" {{ $clients->goal == 3 ? 'selected' : '' }}>Condicionamento</option>
                        </select>
                    </div>
                </div>
                <div class="text-center pt-4">
                    <button type="submit"
                        class="px-6 py-2 bg-lime-500 text-white font-semibold rounded-md cursor-pointer hover:bg-lime-700 transition-all duration-200">
                        Editar Dados
                    </button>
                </div>
            </form>
        </div>
    </section>

@endsection