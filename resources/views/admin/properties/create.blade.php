<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuovo Immobile - Admin</title>
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
        .image-preview {
            max-width: 200px;
            max-height: 150px;
            object-fit: cover;
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
                        <h1 class="text-xl font-semibold text-gray-900">Nuovo Immobile</h1>
                        <p class="text-sm text-gray-600">Aggiungi un nuovo immobile</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.properties.index') }}" class="text-sm text-gray-600 hover:text-pink-600 transition-colors">
                        ← Torna alla lista
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="form-card rounded-2xl shadow-2xl p-8">
            <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-red-700">Si sono verificati alcuni errori. Controlla i campi sottostanti.</span>
                        </div>
                    </div>
                @endif

                @if($errors->has('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-red-700">{{ $errors->first('error') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Type Selection -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipo *</label>
                    <select name="type" id="type" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                        <option value="">Seleziona tipo...</option>
                        <option value="vendite" {{ old('type') === 'vendite' ? 'selected' : '' }}>Vendite</option>
                        <option value="affitti" {{ old('type') === 'affitti' ? 'selected' : '' }}>Affitti</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titolo *</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                           placeholder="Es: Appartamento moderno in centro">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descrizione</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                              placeholder="Descrizione dettagliata dell'immobile...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Prezzo (CHF) *</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" required min="0" step="0.01"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                           placeholder="Es: 850000">
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Disponibilità -->
                <div>
                    <label for="disponibilita" class="block text-sm font-medium text-gray-700 mb-2">Disponibilità</label>
                    <input type="text" name="disponibilita" id="disponibilita" value="{{ old('disponibilita') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                           placeholder="Es: Disponibile dal 1° settembre">
                    @error('disponibilita')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>



                <!-- PDF File -->
                <div>
                    <label for="pdf_file" class="block text-sm font-medium text-gray-700 mb-2">Piani in PDF</label>
                    <input type="file" name="pdf_file" id="pdf_file" accept=".pdf"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    <p class="mt-1 text-sm text-gray-500">Carica un file PDF con i piani dell'immobile. Dimensione massima: 10MB</p>
                    @error('pdf_file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Images -->
                <div>
                    <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Immagini *</label>
                    <input type="file" name="images[]" id="images" accept="image/*" multiple required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    <p class="mt-1 text-sm text-gray-500">Seleziona una o più immagini. La prima immagine sarà la copertina.</p>
                    @error('images.*')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cover Image Selection -->
                <div>
                    <label for="cover_image" class="block text-sm font-medium text-gray-700 mb-2">Immagine di Copertina *</label>
                    <select name="cover_image" id="cover_image" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                        <option value="">Seleziona l'immagine di copertina...</option>
                        <option value="0" {{ old('cover_image') === '0' ? 'selected' : '' }}>Prima immagine</option>
                    </select>
                    <p class="mt-1 text-sm text-gray-500">Seleziona quale immagine usare come copertina.</p>
                    @error('cover_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-6">
                    <a href="{{ route('admin.properties.index') }}" 
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Annulla
                    </a>
                    <button type="submit" 
                            class="pink-gradient text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                        Aggiungi Immobile
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Update cover image options when images are selected
        document.getElementById('images').addEventListener('change', function() {
            const coverSelect = document.getElementById('cover_image');
            const files = this.files;
            
            // Clear existing options except the first one
            while (coverSelect.children.length > 1) {
                coverSelect.removeChild(coverSelect.lastChild);
            }
            
            // Add options for each selected file
            for (let i = 0; i < files.length; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = `Immagine ${i + 1}: ${files[i].name}`;
                coverSelect.appendChild(option);
            }
        });
    </script>
</body>
</html> 