<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Valentino Rosa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .admin-bg {
            background: linear-gradient(135deg, #fdfcfc 0%, #ffffff 50%, #fdf2f8 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .pink-gradient {
            background: linear-gradient(135deg, #D12C7A 0%, #e91e63 100%);
        }
    </style>
</head>
<body class="admin-bg min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <img src="{{ URL::asset('/images/main-page/logo.png') }}" alt="Valentino Rosa" class="w-12 h-12">
                    <div>
                        <h1 class="text-xl font-semibold text-gray-900">Admin Dashboard</h1>
                        <p class="text-sm text-gray-600">Gestione Immobili</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.photos.index') }}" class="text-sm text-gray-600 hover:text-pink-600 transition-colors">
                        📸 Gestione Foto
                    </a>
                    <a href="/" class="text-sm text-gray-600 hover:text-pink-600 transition-colors">
                        ← Torna al sito
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-gray-600 hover:text-red-600 transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Totale Immobili</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $properties->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">In Vendita</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $properties->where('type', 'vendite')->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">In Affitto</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $properties->where('type', 'affitti')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('status'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-green-700">{{ session('status') }}</span>
                </div>
            </div>
        @endif

        <!-- Actions Bar -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Immobili</h2>
            <div class="flex space-x-4">
                <a href="{{ route('admin.properties.create') }}" 
                   class="pink-gradient text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                    + Aggiungi Immobile
                </a>
            </div>
        </div>

        <!-- Properties Grid -->
        @if($properties->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($properties as $property)
                    <div class="bg-white rounded-lg shadow-sm border card-hover">
                        <div class="relative">
                            @if($property->coverPhoto)
                                <img src="{{ $property->coverPhoto->image_path }}" alt="{{ $property->title }}" 
                                     class="w-full h-48 object-cover rounded-t-lg">
                            @else
                                <div class="w-full h-48 bg-gray-200 rounded-t-lg flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-2 right-2">
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $property->type === 'vendite' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800' }}">
                                    {{ ucfirst($property->type) }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-semibold text-gray-900 line-clamp-2">
                                    {{ $property->title }}
                                </h3>
                                @if($property->disponibilita)
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                        {{ $property->disponibilita }}
                                    </span>
                                @endif
                            </div>
                            @if($property->description)
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $property->description }}</p>
                            @endif
                            
                            <div class="flex justify-between items-center">
                                <div class="text-sm text-gray-500">
                                    <span class="font-medium text-lg text-gray-900">{{ $property->formatted_price }}</span>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.properties.edit', $property) }}" 
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Modifica
                                    </a>
                                    <form method="POST" action="{{ route('admin.properties.destroy', $property) }}" 
                                          class="inline" onsubmit="return confirm('Sei sicuro di voler eliminare questo immobile?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                            Elimina
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Nessun immobile</h3>
                <p class="mt-1 text-sm text-gray-500">Inizia aggiungendo il tuo primo immobile.</p>
                <div class="mt-6">
                    <a href="{{ route('admin.properties.create') }}" 
                       class="pink-gradient text-white px-4 py-2 rounded-lg font-medium hover:shadow-lg">
                        Aggiungi il primo immobile
                    </a>
                </div>
            </div>
        @endif
    </main>


</body>
</html> 