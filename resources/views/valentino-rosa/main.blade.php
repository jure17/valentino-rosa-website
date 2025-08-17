<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valentino Rosa SA</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-[#FDFDFC] via-white to-pink-50 min-h-screen flex flex-col">
    <!-- Header Section -->
    <div class="w-full max-w-6xl mx-auto flex justify-between items-start py-6 px-4">
        <img src="{{ URL::asset('/images/main-page/logo.png') }}" alt="Logo" class="w-28 md:w-36">
        <a href="/" class="text-xs md:text-base font-medium hover:underline mt-2">TORNA ALLA HOME</a>
    </div>

    <!-- Main Info Section -->
    <div class="w-full flex flex-col items-center px-4">
        <div class="flex flex-col md:flex-row items-center justify-center gap-6 w-full max-w-3xl mx-auto">
            <img src="{{ URL::asset('/images/valentino-rosa/valentinorosaSA.png') }}" alt="Valentino Rosa SA Logo" class="w-32 md:w-48 mb-4 md:mb-0">
            <div class="flex flex-col items-center md:items-start text-center md:text-left">
                <h1 class="text-2xl md:text-3xl font-light mb-2">Valentino Rosa SA</h1>
                <p class="text-base md:text-lg font-light mb-4">
                    Con passione ci dedichiamo alla compra e alla vendita di immobili.
                </p>
            </div>
        </div>
    </div>

    <!-- Filter Bar and Property Cards -->
    <div x-data="{
        filter: 'all',
        properties: [
            @forelse($properties as $property)
            {
                id: {{ $property->id }},
                type: '{{ $property->type }}',
                title: '{{ str_replace("'", "\\'", $property->title) }}',
                description: '{{ $property->description ? str_replace("'", "\\'", $property->description) : '' }}',
                disponibilita: '{{ $property->disponibilita ? str_replace("'", "\\'", $property->disponibilita) : '' }}',
                price: '{{ str_replace("'", "\\'", $property->formatted_price) }}',
                img: '{{ $property->coverPhoto && $property->coverPhoto->image_path ? $property->coverPhoto->image_path : "/images/placeholder-property.jpg" }}',
                hasPdf: {{ $property->hasPdf() ? 'true' : 'false' }},
                pdfPath: '{{ $property->pdf_path ?? '' }}',
                photos: [
                    @foreach($property->photos as $photo)
                    '{{ $photo->image_path }}',
                    @endforeach
                ],
            },
            @empty
            @endforelse
        ],
        get filtered() {
            if (this.filter === 'all') return this.properties;
            return this.properties.filter(p => p.type === this.filter);
        },
        modalOpen: false,
        modalIndex: 0,
        currentProperty: null,
        openModal(property, idx) { 
            if (property.photos && property.photos.length > 0) {
                this.currentProperty = property; 
                this.modalIndex = idx; 
                this.modalOpen = true; 
                document.body.style.overflow = 'hidden'; 
            }
        },
        closeModal() { 
            this.modalOpen = false; 
            document.body.style.overflow = ''; 
        },
        prevImg() { 
            if (this.currentProperty && this.currentProperty.photos && this.currentProperty.photos.length > 0) {
                this.modalIndex = (this.modalIndex + this.currentProperty.photos.length - 1) % this.currentProperty.photos.length; 
            }
        },
        nextImg() { 
            if (this.currentProperty && this.currentProperty.photos && this.currentProperty.photos.length > 0) {
                this.modalIndex = (this.modalIndex + 1) % this.currentProperty.photos.length; 
            }
        }
    }" class="w-full max-w-5xl mx-auto mt-8 mb-4 flex flex-col items-center">
        <!-- Desktop Filter Tabs (hidden on mobile) -->
        <div class="hidden md:flex flex-wrap justify-center w-full border-b border-black mb-4">
            <button @click="filter = 'affitti'" :class="filter === 'affitti' ? 'font-semibold border-b-2 border-black text-pink-700' : ''" class="px-6 py-3 focus:outline-none transition">VEDI SOLO GLI AFFITTI</button>
            <button @click="filter = 'vendite'" :class="filter === 'vendite' ? 'font-semibold border-b-2 border-black text-pink-700' : ''" class="px-6 py-3 focus:outline-none transition">VEDI SOLO LE VENDITE</button>
        </div>
        
        <!-- Mobile Dropdown Filter (visible only on mobile) -->
        <div class="md:hidden w-full max-w-xs mx-auto mb-4">
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" 
                        class="w-full bg-white border border-black rounded px-6 py-3 text-gray-700 font-medium flex items-center justify-between transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                    <span x-text="filter === 'affitti' ? 'VEDI SOLO GLI AFFITTI' : filter === 'vendite' ? 'VEDI SOLO LE VENDITE' : 'TUTTI GLI IMMOBILI'"></span>
                    <svg class="w-5 h-5 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     @click.away="open = false"
                     class="absolute top-full left-0 right-0 mt-2 bg-white rounded shadow-xl border border-gray-200 z-10">
                    <button @click="filter = 'affitti'; open = false" 
                            :class="filter === 'affitti' ? 'bg-pink-100 text-pink-700' : 'text-gray-700 hover:bg-gray-50'" 
                            class="w-full px-6 py-3 text-left font-medium transition-all duration-200 first:rounded-t first:border-t-0 border-b border-gray-100 focus:outline-none focus:bg-gray-50">
                        VEDI SOLO GLI AFFITTI
                    </button>
                    <button @click="filter = 'vendite'; open = false" 
                            :class="filter === 'vendite' ? 'bg-pink-100 text-pink-700' : 'text-gray-700 hover:bg-gray-50'" 
                            class="w-full px-6 py-3 text-left font-medium transition-all duration-200 last:rounded-b border-b-0 focus:outline-none focus:bg-gray-50">
                        VEDI SOLO LE VENDITE
                    </button>
                    <button @click="filter = 'all'; open = false" 
                            :class="filter === 'all' ? 'bg-pink-100 text-pink-700' : 'text-gray-700 hover:bg-gray-50'" 
                            class="w-full px-6 py-3 text-left font-medium transition-all duration-200 last:rounded-b border-b-0 focus:outline-none focus:bg-gray-50">
                        TUTTI GLI IMMOBILI
                    </button>
                </div>
            </div>
        </div>

        <!-- Property Cards -->
        <div class="w-full">
            <template x-if="filtered.length > 0">
                <template x-for="property in filtered" :key="property.id">
                    <div class="bg-white rounded-lg shadow-sm border mb-4 flex flex-col md:flex-row items-center p-4 gap-4">
                        <img :src="property.img" alt="Immobile" :class="'w-full md:w-40 h-32 object-cover rounded-md transition-opacity ' + (property.photos && property.photos.length > 0 ? 'cursor-pointer hover:opacity-80' : 'cursor-default')" @click="openModal(property, 0)">
                        <div class="flex-1 flex flex-col gap-1">
                            <div class="flex items-center gap-2">
                            <div class="font-semibold" x-text="property.title"></div>
                                <span class="font-normal text-sm text-blue-600" x-show="property.disponibilita" x-text="property.disponibilita"></span>
                            </div>
                            <div class="text-sm font-bold" x-show="property.description">
                                <span x-text="property.description"></span>
                            </div>
                            <div class="flex gap-2 mt-2">
                                <template x-if="property.hasPdf">
                                    <a :href="property.pdfPath" target="_blank" 
                                       class="text-xs px-3 py-1 border border-black rounded hover:bg-pink-100 flex items-center gap-1">
                                        PIANI IN PDF <span class="text-lg">&#8595;</span>
                                    </a>
                                </template>
                                <template x-if="!property.hasPdf">
                                    <button disabled class="text-xs px-3 py-1 border border-gray-300 rounded text-gray-400 flex items-center gap-1 cursor-not-allowed">
                                        PIANI IN PDF <span class="text-lg">&#8595;</span>
                                    </button>
                                </template>

                            </div>
                        </div>
                        <div class="text-right font-semibold text-sm md:text-base min-w-[120px]" x-text="property.price" x-show="property.price"></div>
                    </div>
                </template>
            </template>
            <template x-if="filtered.length === 0">
                <div class="text-center text-gray-500 py-8">
                    <p x-show="properties.length === 0">Nessun immobile ancora inserito. <a href="/admin/properties/create" class="text-blue-600 hover:underline">Aggiungi il primo immobile</a></p>
                    <p x-show="properties.length > 0">Nessun immobile trovato per questo filtro.</p>
                </div>
            </template>
            <div class="flex justify-center mt-4">
                <button @click="filter = 'all'" class="px-6 py-2 border border-black rounded bg-white hover:bg-pink-200 transition text-xs md:text-sm font-medium">MOSTRA TUTTO</button>
            </div>
        </div>

        <!-- Photo Gallery Modal -->
        <div x-show="modalOpen" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-white/80 backdrop-blur-md">
            <div class="absolute inset-0 bg-white/80 backdrop-blur-md" @click="closeModal()"></div>
            <div class="relative z-10 flex flex-col items-center w-full max-w-5xl mx-auto p-4">
                <!-- Header -->
                <div class="w-full flex justify-between items-center mb-6">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800" x-text="currentProperty ? currentProperty.title : ''"></h2>
                    <button @click="closeModal()" class="text-4xl text-gray-700 bg-white/80 rounded-full w-12 h-12 flex items-center justify-center hover:bg-white transition-all duration-200">&times;</button>
                </div>
                
                <!-- Main Image -->
                <div class="relative w-full flex items-center justify-center">
                    <button @click="prevImg" class="absolute left-4 z-20 text-4xl bg-white/90 rounded-full w-14 h-14 flex items-center justify-center hover:bg-white text-black transition-all duration-200 shadow-lg hover:scale-110">&#8592;</button>
                    
                    <div class="relative max-w-4xl w-full">
                        <img :src="currentProperty && currentProperty.photos && currentProperty.photos[modalIndex] ? currentProperty.photos[modalIndex] : ''" 
                             :alt="currentProperty ? currentProperty.title : ''" 
                             class="w-full max-h-[70vh] object-contain bg-white rounded-lg shadow-2xl">
                        
                        <!-- Photo Counter -->
                        <div class="absolute bottom-4 right-4 bg-white/90 text-gray-800 px-3 py-1 rounded-full text-sm font-medium shadow-lg">
                            <span x-text="(modalIndex + 1) + ' / ' + (currentProperty ? currentProperty.photos.length : 0)"></span>
                        </div>
                    </div>
                    
                    <button @click="nextImg" class="absolute right-4 z-20 text-4xl bg-white/90 rounded-full w-14 h-14 flex items-center justify-center hover:bg-white text-black transition-all duration-200 shadow-lg hover:scale-110">&#8594;</button>
    </div>

                <!-- Thumbnail Navigation -->
                <div class="flex justify-center items-center gap-3 mt-6">
                    <template x-for="(photo, i) in (currentProperty ? currentProperty.photos : [])" :key="i">
                        <div @click="modalIndex = i" 
                             :class="i === modalIndex ? 'ring-4 ring-pink-500 scale-110' : 'opacity-60 hover:opacity-100'" 
                             class="w-16 h-16 rounded-lg overflow-hidden cursor-pointer transition-all duration-200 hover:scale-105 border-2 border-white/30">
                            <img :src="photo" :alt="'Thumbnail ' + (i + 1)" class="w-full h-full object-cover">
                        </div>
                    </template>
                </div>
                
                <!-- No Photos Message -->
                <div x-show="currentProperty && (!currentProperty.photos || currentProperty.photos.length === 0)" 
                     class="text-center text-gray-800 mt-8">
                    <div class="bg-white/90 rounded-lg p-6 backdrop-blur-sm shadow-lg">
                        <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-lg font-medium">Nessuna foto disponibile</p>
                        <p class="text-sm opacity-80">Questo immobile non ha ancora foto caricate</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Contact Section -->
    <div class="w-full max-w-6xl mx-auto mt-20 px-4">
        <div class="border-t border-gray-200 pt-16 flex flex-col md:flex-row gap-12">
            <!-- Enhanced Contact Info -->
            <div class="md:w-1/2 flex flex-col items-center md:items-start gap-6">
                <img src="{{ URL::asset('/images/main-page/logo.png') }}" alt="Logo" class="w-36 mb-2 hover:scale-105 transition-transform duration-300">
                <div class="text-sm md:text-base font-light space-y-3">
                    <div class="bg-white/60 backdrop-blur-sm p-4 rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                        <b class="text-gray-800">Contatti</b><br>
                        <span class="text-gray-600">+41 91 830 12 85</span><br>
                        <span class="text-gray-600">rosa.valentino@bluewin.ch</span>
                    </div>
                    <div class="bg-white/60 backdrop-blur-sm p-4 rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                        <b class="text-gray-800">Società</b><br>
                        <span class="text-gray-600">Valentino Rosa SA</span><br>
                        <span class="text-gray-600">Fratelli Rosa SA</span>
                    </div>
                    <div class="bg-white/60 backdrop-blur-sm p-4 rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                        <b class="text-gray-800">Luogo</b><br>
                        <span class="text-gray-600">Ufficio: Ai Guastíc 4, 6558 Lostallo</span><br>
                        <span class="text-gray-600">Magazzino: Fontanín 15, 6558 Lostallo</span>
                    </div>
                </div>
            </div>
            <!-- Enhanced Form -->
            <div class="md:w-1/2" id="contactForm">
                <h3 class="text-2xl font-light mb-6 text-gray-800">Contattaci e tutto sarà più semplice :)</h3>
                
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-green-700">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-red-700">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="flex flex-col gap-5">
                    @csrf
                    <select name="property_id" required class="border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all duration-300 bg-white/80 backdrop-blur-sm shadow-sm hover:shadow-md">
                        <option value="">Seleziona un immobile...</option>
                        @foreach($properties as $property)
                            <option value="{{ $property->id }}" {{ old('property_id') == $property->id ? 'selected' : '' }}>
                                {{ $property->title }} ({{ ucfirst($property->type) }})
                            </option>
                        @endforeach
                    </select>
                    @error('property_id')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <div class="flex gap-4">
                        <input type="text" name="name" placeholder="Nome e Cognome / Azienda*" 
                               value="{{ old('name') }}" required
                               class="border border-gray-200 rounded-xl px-4 py-3 w-1/2 text-sm focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all duration-300 bg-white/80 backdrop-blur-sm shadow-sm hover:shadow-md">
                    </div>
                    @error('name')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <div class="flex gap-4">
                        <input type="text" name="phone" placeholder="Telefono" 
                               value="{{ old('phone') }}"
                               class="border border-gray-200 rounded-xl px-4 py-3 w-1/2 text-sm focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all duration-300 bg-white/80 backdrop-blur-sm shadow-sm hover:shadow-md">
                        <input type="email" name="email" placeholder="E-mail*" 
                               value="{{ old('email') }}" required
                               class="border border-gray-200 rounded-xl px-4 py-3 w-1/2 text-sm focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all duration-300 bg-white/80 backdrop-blur-sm shadow-sm hover:shadow-md">
                    </div>
                    @error('phone')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @error('email')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <textarea name="message" placeholder="Scrivici un messaggio*" 
                              required class="border border-gray-200 rounded-xl px-4 py-3 text-sm min-h-[120px] focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all duration-300 bg-white/80 backdrop-blur-sm shadow-sm hover:shadow-md resize-none">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <div class="flex justify-end">
                        <button type="submit" class="border border-gray-300 rounded-xl px-8 py-3 bg-gradient-to-r from-white to-pink-50 hover:from-pink-50 hover:to-pink-100 transition-all duration-300 text-sm font-medium shadow-sm hover:shadow-md hover:scale-105 focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                            INVIA
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Enhanced Footer -->
    <footer class="w-full border-t border-gray-200 bg-gradient-to-r from-white to-pink-50 py-10 mt-16 flex flex-col items-center gap-4">
        <img src="{{ URL::asset('/images/main-page/logo.png') }}" alt="logo Valentino Rosa" class="w-28 mb-2 hover:scale-105 transition-transform duration-300">
        <div class="text-center text-xs md:text-sm text-gray-700 bg-white/60 backdrop-blur-sm p-4 rounded-xl shadow-sm">
            Ufficio: Ai Guastíc 4, 6558 Lostallo<br>
            Magazzino: Fontanín 15, 6558 Lostallo<br>
            +41 91 830 12 85 - rosa.valentino@bluewin.ch
        </div>
        <button onclick="document.getElementById('contactForm').scrollIntoView({behavior: 'smooth'})" class="mt-2 px-8 py-3 border border-gray-300 rounded-xl bg-gradient-to-r from-white to-pink-50 hover:from-pink-50 hover:to-pink-100 transition-all duration-300 text-sm font-medium shadow-sm hover:shadow-md hover:scale-105">
            RICHIEDI UN PREVENTIVO
        </button>
    </footer>
</body>
</html>
