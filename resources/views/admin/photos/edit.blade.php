<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Foto - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .admin-bg {
            background: linear-gradient(135deg, #fdfcfc 0%, #ffffff 50%, #fdf2f8 100%);
        }
        .pink-gradient {
            background: linear-gradient(135deg, #D12C7A 0%, #e91e63 100%);
        }
        .form-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
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
                        <h1 class="text-xl font-semibold text-gray-900">Modifica Foto</h1>
                        <p class="text-sm text-gray-600">ID: {{ $photo->id }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.photos.index') }}" class="text-sm text-gray-600 hover:text-pink-600 transition-colors">
                        ← Torna alla lista
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="form-card rounded-2xl shadow-2xl p-8">
            <form action="{{ route('admin.photos.update', $photo) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Current Image Preview -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Immagine Attuale</label>
                    <div class="flex items-center space-x-4">
                        <img src="{{ $photo->image_path }}" alt="Immagine attuale" class="w-32 h-24 object-cover rounded-lg border">
                        <div class="text-sm text-gray-600">
                            <p>Percorso: {{ $photo->image_path }}</p>
                            <p class="mt-1">Carica una nuova immagine per sostituirla</p>
                        </div>
                    </div>
                </div>

                <!-- Category Selection -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Categoria *</label>
                    <select name="category" id="category" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                        @foreach($categories as $key => $label)
                            <option value="{{ $key }}" {{ old('category', $photo->category) === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titolo</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $photo->title) }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                           placeholder="Es: Struttura in cemento armato">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descrizione</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                              placeholder="Descrizione dettagliata della foto...">{{ old('description', $photo->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Order -->
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Ordine di Visualizzazione</label>
                    <input type="number" name="order" id="order" value="{{ old('order', $photo->order) }}" min="0"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                           placeholder="0">
                    <p class="mt-1 text-sm text-gray-500">Numero più basso = visualizzato prima. 0 = ordine automatico.</p>
                    @error('order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Nuova Immagine (opzionale)</label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    <p class="mt-1 text-sm text-gray-500">Lascia vuoto per mantenere l'immagine attuale. Formati supportati: JPG, PNG. Dimensione massima: 6MB</p>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-6">
                    <a href="{{ route('admin.photos.index') }}" 
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Annulla
                    </a>
                    <button type="submit" 
                            class="pink-gradient text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                        Aggiorna Foto
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html> 