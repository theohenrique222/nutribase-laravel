<header>
    <nav class="fixed backdrop-blur-sm border-b border-b-neutral-100/20 w-full items-center z-50">
        <div class="flex max-w-6xl items-center m-auto justify-between h-16">
            <div>
                <h1 class="text-white font-bold text-3xl"><a href="/">Nutribase</a></h1>
            </div>
            <div>
                @if (auth()->check())
                    <ul class="flex text-white space-x-6">
                        <li><a href="{{ route('products.index') }}"
                                class="hover:text-gray-300 transition-all hover:border-b-2 py-5 cursor-pointer text-sm">Produtos</a>
                        </li>
                        <li><a href="{{ route('clients.index') }}"
                                class="hover:text-gray-300 transition-all hover:border-b-2 py-5 cursor-pointer text-sm">Alunos</a>
                        </li>

                    </ul>
                @else
                    <ul class="flex text-white space-x-6">

                        <li><a href="/"
                                class="hover:text-gray-300 transition-all hover:border-b-2 py-5 cursor-pointer text-sm">Início</a>
                        </li>
                        <li><a href="/"
                                class="hover:text-gray-300 transition-all hover:border-b-2 py-5 cursor-pointer text-sm">Contate-nos</a>
                        </li>
                        <li><a href="/"
                                class="hover:text-gray-300 transition-all hover:border-b-2 py-5 cursor-pointer text-sm">Funcionalidades</a>
                        </li>
                    </ul>
                @endif
            </div>
            <div>
                @if (auth()->check())
                    <ul class="flex space-x-4 text-white text-sm items-center">
                        <li><a href="/dashboard" class="transition-all text-white hover:opacity-80">Painel de controle</a>
                        </li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button
                                class="transition-all text-white cursor-pointer bg-lime-500 hover:opacity-80 px-5 py-2 rounded-md">Sair</button>
                        </form>
                    </ul>
                @else
                    <ul class="flex space-x-4 text-white text-sm">
                        <li><a href="{{ route('login') }}" class="hover:text-gray-300 text-white cursor-pointer">Entrar</a>
                        </li>
                        <li><a href="{{ route('register') }}"
                                class="transition-all text-white cursor-pointer bg-lime-500 hover:opacity-80 px-5 py-2 rounded-md">Cadastrar-se</a>
                        </li>
                    </ul>

                @endif
            </div>
        </div>
    </nav>
</header>
