<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Foto - Admin</title>
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
        .category-badge {
            position: absolute;
            top: 8px;
            left: 8px;
            z-index: 10;
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
                        <h1 class="text-xl font-semibold text-gray-900">Gestione Foto</h1>
                        <p class="text-sm text-gray-600">Galleria Fratelli Rosa</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.properties.index') }}" class="text-sm text-gray-600 hover:text-pink-600 transition-colors">
                        🏠 Gestione Immobili
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
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            @foreach($categories as $key => $label)
            <div class="bg-white rounded-lg shadow-sm p-6 card-hover">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-{{ $key === 'soprastrutture' ? 'green' : ($key === 'sottostrutture' ? 'purple' : ($key === 'muri' ? 'blue' : ($key === 'mezzi' ? 'orange' : 'pink'))) }}-100">
                        <svg class="w-6 h-6 text-{{ $key === 'soprastrutture' ? 'green' : ($key === 'sottostrutture' ? 'purple' : ($key === 'muri' ? 'blue' : ($key === 'mezzi' ? 'orange' : 'pink'))) }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">{{ $label }}</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $photos->where('category', $key)->count() }}</p>
                    </div>
                </div>
            </div>
            @endforeach
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
            <h2 class="text-2xl font-semibold text-gray-900">Foto</h2>
            <a href="{{ route('admin.photos.create') }}" 
               class="pink-gradient text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                + Aggiungi Foto
            </a>
        </div>

        <!-- Photos Grid -->
        @if($photos->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($photos as $photo)
                    <div class="bg-white rounded-lg shadow-sm border card-hover">
                        <div class="relative">
                            <img src="{{ $photo->image_path }}" alt="{{ $photo->title ?: 'Foto' }}" 
                                 class="w-full h-48 object-cover rounded-t-lg">
                            <div class="category-badge">
                                <span class="px-2 py-1 text-xs font-medium rounded-full 
                                    {{ $photo->category === 'soprastrutture' ? 'bg-green-100 text-green-800' : 
                                       ($photo->category === 'sottostrutture' ? 'bg-purple-100 text-purple-800' : 
                                       ($photo->category === 'muri' ? 'bg-blue-100 text-blue-800' : 
                                       ($photo->category === 'mezzi' ? 'bg-orange-100 text-orange-800' : 
                                       'bg-pink-100 text-pink-800'))) }}">
                                    {{ $photo->category_label }}
                                </span>
                            </div>
                            @if($photo->order > 0)
                                <div class="absolute top-8 right-8">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                        #{{ $photo->order }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                                {{ $photo->title ?: 'Foto senza titolo' }}
                            </h3>
                            @if($photo->description)
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $photo->description }}</p>
                            @endif
                            
                            <div class="flex justify-between items-center">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.photos.edit', $photo) }}" 
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Modifica
                                    </a>
                                    <form method="POST" action="{{ route('admin.photos.destroy', $photo) }}" 
                                          class="inline" onsubmit="return confirm('Sei sicuro di voler eliminare questa foto?')">
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Nessuna foto</h3>
                <p class="mt-1 text-sm text-gray-500">Inizia aggiungendo la tua prima foto alla galleria.</p>
                <div class="mt-6">
                    <a href="{{ route('admin.photos.create') }}" 
                       class="pink-gradient text-white px-4 py-2 rounded-lg font-medium hover:shadow-lg">
                        Aggiungi la prima foto
                    </a>
                </div>
            </div>
        @endif
    </main>
</body>
</html> 