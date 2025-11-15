@extends('layouts.main')

@section('title', 'Registrar')

@section('content')
    <section style="background-image: url('{{ asset('img/bg-login.png') }}')" class="bg-cover">
        <div class="w-full min-h-screen flex items-center py-12 px-4 sm:px-6 lg:px-8 bg-linear-to-r from-black">
             <div class="max-w-md w-full space-y-8 bg-lime-100/10 backdrop-blur-sm p-5 rounded-2xl">
                <div>
                    <a href="{{ url('/') }}" class="flex justify-center mb-6">
                        <h1 class="text-3xl font-bold text-white">Nutribase</h1>
                    </a>

                    <h2 class="mt-6 text-center text-3xl font-extrabold text-lime-500">Crie sua conta</h2>
                    <p class="mt-2 text-center text-sm text-white">
                        Já tem conta?
                        <a href="{{ route('login') }}" class="font-medium text-lime-600 hover:text-lime-500">Entre aqui</a>
                    </p>
                </div>

                @if ($errors->any())
                    <div class="rounded-md bg-red-50 p-4">
                        <div class="flex">
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Ocorreram alguns erros</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form class="mt-8 space-y-6" action="{{ route('register.store') }}" method="POST">
                    @csrf

                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="name" class="sr-only">Nome</label>
                            <input id="name" name="name" type="text" required autofocus autocomplete="name"
                                class="appearance-none rounded-t-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-white focus:outline-none focus:ring-lime-500 focus:border-lime-500 sm:text-sm"
                                placeholder="Nome completo" value="{{ old('name') }}">
                        </div>
                        <div>
                            <label for="email" class="sr-only">Email</label>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-white focus:outline-none focus:ring-lime-500 focus:border-lime-500 sm:text-sm"
                                placeholder="Email" value="{{ old('email') }}">
                        </div>
                        <div>
                            <label for="password" class="sr-only">Senha</label>
                            <input id="password" name="password" type="password" autocomplete="new-password" required
                                class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-white focus:outline-none focus:ring-lime-500 focus:border-lime-500 sm:text-sm"
                                placeholder="Senha">
                        </div>
                        <div>
                            <label for="password_confirmation" class="sr-only">Confirmar Senha</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                                class="appearance-none rounded-b-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-white focus:outline-none focus:ring-lime-500 focus:border-lime-500 sm:text-sm"
                                placeholder="Confirmar senha">
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-lime-600 hover:bg-lime-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Registrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
