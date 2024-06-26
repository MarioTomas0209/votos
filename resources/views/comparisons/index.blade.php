<x-app-layout>

    <!-- Mostrar mensajes de éxito o error -->
    @if(session('success'))
    <div class="bg-green-500 py-1 px-4 text-center text-white">
        {{ session('success') }}
    </div>
    @elseif(session('info'))
    <div class="bg-blue-500 py-1 px-4 text-center text-white">
        {{ session('info') }}
    </div>
    @elseif(session('error'))
    <div class="bg-red-500 py-1 px-4 text-center text-white">
        {{ session('error') }}
    </div>
    @endif
    <div class="container mx-auto flex flex-col lg:flex-row py-8">

        <!-- Panel Lateral -->
        <aside
            class="flex-shrink-0 w-full lg:w-1/4 bg-white p-6 rounded-lg shadow-lg mb-8 lg:mb-0 lg:sticky lg:top-8 lg:self-start"
            style="height: min-content;">
            @auth
            <div class="text-center mb-6">
                <h1 class="text-3xl lg:text-3xl font-bold text-blue-600">¡Hola, {{ auth()->user()->name }}!</h1>
                <p class="text-lg lg:text-xl mt-2">¡Vota por tu opción favorita y ayuda a decidir!</p>
            </div>
            @else
            <div class="text-center mb-6">
                <h2 class="text-2xl font-semibold text-blue-600">Menú de la semana</h2>
            </div>
            @endauth

            <ul>
                @foreach($comparisons as $comparison)
                @php
                    $winnerItem = $comparison->votes_item1 >= $comparison->votes_item2 ? $comparison->item1 :
                    $comparison->item2;
                    $winnerVotes = $comparison->votes_item1 >= $comparison->votes_item2 ? $comparison->votes_item1 :
                    $comparison->votes_item2;
                    $winnerColor = $comparison->votes_item1 >= $comparison->votes_item2 ? 'text-green-500' : 'text-red-500';
                @endphp
                <li class="mb-6">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/' . $winnerItem->image_url) }}" alt="{{ $winnerItem->name }}"
                            class="w-16 h-16 mr-4 rounded-full object-cover">
                        <div>
                            <p class="text-xl font-bold">{{ $winnerItem->name }}</p>
                            @auth
                            <p class="text-lg {{ $winnerColor }}">{{ $winnerVotes }}%</p>
                            @endauth
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </aside>

        @auth
        <!-- Contenido Principal -->
        <main class="flex-grow w-full lg:ml-8 overflow-y-auto">

            <!-- Sección de Comparaciones -->
            @foreach($comparisons as $comparison)
                <section class="mb-8">
                    <h2 class="text-3xl font-semibold text-center text-blue-600 mb-4">Comparación {{ $loop->iteration }}</h2>
                    <div class="flex justify-around items-center">
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $comparison->item1->image_url) }}" alt="{{ $comparison->item1->name }}" class="w-40 h-40 mx-auto mb-2 object-cover rounded-lg">
                            <p class="text-xl font-bold">{{ $comparison->item1->name }}</p>
                            <p class="text-lg text-green-500">{{ $comparison->votes_item1 }}%</p>
                            @auth
                                @php
                                    $userVote = $comparison->votes->where('user_id', Auth::id())->first();
                                @endphp
                                @if(!$userVote)
                                    <form action="{{ route('vote.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="comparison_id" value="{{ $comparison->id }}">
                                        <input type="hidden" name="item_id" value="{{ $comparison->item1->id }}">
                                        <button type="submit"
                                            class="bg-green-500 text-white py-1 px-4 rounded-md mt-2">Votar</button>
                                    </form>
                                @elseif($userVote->item_id == $comparison->item1->id)
                                    <div class="bg-green-500 py-1 px-4 rounded-md">😍</div>
                                @endif
                            @endauth
                        </div>
                        <p class="text-2xl font-bold">VS</p>
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $comparison->item2->image_url) }}"
                                alt="{{ $comparison->item2->name }}" class="w-40 h-40 mx-auto mb-2 object-cover rounded-lg">
                            <p class="text-xl font-bold">{{ $comparison->item2->name }}</p>
                            <p class="text-lg text-red-500">{{ $comparison->votes_item2 }}%</p>
                            @auth
                            @if(!$userVote)
                            <form action="{{ route('vote.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="comparison_id" value="{{ $comparison->id }}">
                                <input type="hidden" name="item_id" value="{{ $comparison->item2->id }}">
                                <button type="submit" class="bg-red-500 text-white py-1 px-4 rounded-md mt-2">Votar</button>
                            </form>
                            @elseif($userVote->item_id == $comparison->item2->id)
                            <div class="bg-green-500 py-1 px-4 rounded-md">
                                🥰
                            </div>
                            @endif
                            @endauth
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 text-center mt-3">Publicado: {{ $comparison->created_at->diffForHumans() }}</p>
                </section>
            @endforeach
        </main>
        @endauth
    </div>


</x-app-layout>