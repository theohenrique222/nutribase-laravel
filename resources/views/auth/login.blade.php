@extends('layouts.main')

@section('title', 'Login')

@section('content')
    <section style="background-image: url('{{ asset('img/bg-login.png') }}')" class="bg-cover">
        <div class="w-full flex items-center py-12 px-4 sm:px-6 lg:px-8 bg-linear-to-r from-black min-h-screen">
                <div class="max-w-md w-full space-y-8 bg-lime-100/10 backdrop-blur-sm p-5 rounded-2xl">
                    <div>
                        <a href="{{ url('/') }}" class="flex justify-center mb-6">
                            <h1 class="text-3xl font-bold text-white">Nutribase</h1>
                        </a>

                        <h2 class="mt-6 text-center text-3xl font-extrabold text-lime-500">Entre na sua conta</h2>
                        <p class="mt-2 text-center text-sm text-white">Ou
                            <a href="{{ route('register') }}" class="font-medium text-lime-200 hover:text-lime-500">
                                crie uma nova conta
                            </a>
                        </p>
                    </div>

                    @if (session('status'))
                    <div class="rounded-md bg-green-50 p-4">
                        <div class="flex">
                            <div class="ml-3">
                                <p class="text-sm text-green-700">{{ session('status') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if ($errors->any())
                        <div class="rounded-md bg-red-50 p-4">
                            <div class="flex">
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Algo deu errado</h3>
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

                    <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
                        @csrf

                        <input type="hidden" name="remember" value="0">

                        <div class="rounded-md shadow-sm -space-y-px">
                            <div>
                                <label for="email" class="sr-only">Email</label>
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    class="appearance-none rounded-t-md relative block w-full px-3 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror placeholder-gray-500 text-white focus:outline-none focus:ring-lime-500 focus:border-lime-500 focus:z-10 sm:text-sm"
                                    placeholder="Email" value="{{ old('email') }}">
                            </div>
                            <div>
                                <label for="password" class="sr-only">Senha</label>
                                <input id="password" name="password" type="password" autocomplete="current-password" required
                                    class="appearance-none rounded-b-md relative block w-full px-3 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror placeholder-gray-500 text-white focus:outline-none focus:ring-lime-500 focus:border-lime-500 focus:z-10 sm:text-sm"
                                    placeholder="Senha">
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" name="remember" type="checkbox" value="1" class="h-4 w-4 text-lime-600 focus:ring-lime-500 border-gray-300 rounded" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember_me" class="ml-2 block text-sm text-white">Lembrar-me</label>
                            </div>

                            <div class="text-sm">
                                @if (Route::has('password.request'))
                                    <a class="font-medium text-lime-600 hover:text-lime-500" href="{{ route('password.request') }}">Esqueceu a senha?</a>
                                @endif
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-lime-500 hover:bg-lime-300 cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lime-500">
                                Entrar
                            </button>
                        </div>
                    </form>
                    <p class="mt-6 text-center text-sm text-white">Não tem conta? <a href="{{ route('register') }}" class="text-lime-600 hover:text-lime-500">Crie uma</a></p>
                </div>
                </div>
        </div>
    </section>
@endsection
