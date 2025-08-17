<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Immobile - Admin</title>
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
        
        function deletePhoto(photoId) {
            if (confirm('Eliminare questa foto?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/admin/properties/photos/' + photoId;
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
                
                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
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
                        <h1 class="text-xl font-semibold text-gray-900">Modifica Immobile</h1>
                        <p class="text-sm text-gray-600">ID: {{ $property->id }}</p>
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
            <form action="{{ route('admin.properties.update', $property) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

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
                        <option value="vendite" {{ old('type', $property->type) === 'vendite' ? 'selected' : '' }}>Vendite</option>
                        <option value="affitti" {{ old('type', $property->type) === 'affitti' ? 'selected' : '' }}>Affitti</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titolo *</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $property->title) }}" required
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
                              placeholder="Descrizione dettagliata dell'immobile...">{{ old('description', $property->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Prezzo (CHF) *</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $property->price) }}" required min="0" step="0.01"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                           placeholder="Es: 850000">
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Disponibilità -->
                <div>
                    <label for="disponibilita" class="block text-sm font-medium text-gray-700 mb-2">Disponibilità</label>
                    <input type="text" name="disponibilita" id="disponibilita" value="{{ old('disponibilita', $property->disponibilita) }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                           placeholder="Es: Disponibile dal 1° settembre">
                    @error('disponibilita')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>



                <!-- Current PDF -->
                @if($property->hasPdf())
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">PDF Attuale</label>
                        <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg">
                            <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                            </svg>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Piani dell'immobile</p>
                                <p class="text-xs text-gray-500">Carica un nuovo PDF per sostituirlo</p>
                            </div>
                            <a href="{{ $property->pdf_path }}" target="_blank" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Visualizza
                            </a>
                        </div>
                    </div>
                @endif

                <!-- New PDF File -->
                <div>
                    <label for="pdf_file" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $property->hasPdf() ? 'Sostituisci PDF' : 'Piani in PDF' }}
                    </label>
                    <input type="file" name="pdf_file" id="pdf_file" accept=".pdf"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    <p class="mt-1 text-sm text-gray-500">Carica un file PDF con i piani dell'immobile. Dimensione massima: 10MB</p>
                    @error('pdf_file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Photos -->
                @if($property->photos->count() > 0)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Attuali</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                            @foreach($property->photos as $photo)
                                <div class="relative border rounded-lg p-2">
                                    <img src="{{ $photo->image_path }}" alt="Foto immobile" class="w-full h-32 object-cover rounded">
                                    <div class="absolute top-2 right-2">
                                        @if($photo->is_cover)
                                            <span class="bg-green-500 text-white text-xs px-2 py-1 rounded">Copertina</span>
                                        @endif
                                    </div>
                                    <div class="mt-2 flex justify-between items-center">
                                        <label class="flex items-center">
                                            <input type="radio" name="cover_photo_id" value="{{ $photo->id }}" 
                                                   {{ $photo->is_cover ? 'checked' : '' }} class="mr-1">
                                            <span class="text-xs">Copertina</span>
                                        </label>
                                        <button type="button" onclick="deletePhoto({{ $photo->id }})" class="text-red-600 hover:text-red-800 text-xs">
                                            Elimina
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- New Images -->
                <div>
                    <label for="new_images" class="block text-sm font-medium text-gray-700 mb-2">Aggiungi Nuove Immagini</label>
                    <input type="file" name="new_images[]" id="new_images" accept="image/*" multiple
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    <p class="mt-1 text-sm text-gray-500">Seleziona nuove immagini da aggiungere. Formati supportati: JPG, PNG. Dimensione massima: 6MB</p>
                    @error('new_images.*')
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
                            class="bg-pink-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-pink-700 transition-colors">
                        Aggiorna Immobile
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html> 