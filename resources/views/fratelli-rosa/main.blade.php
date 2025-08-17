
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fratelli Rosa SA</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-[#FDFDFC] via-white to-pink-50 min-h-screen flex flex-col">
    <!-- Header Section -->
    <div class="w-full max-w-6xl mx-auto flex justify-between items-start py-6 px-4">
        <img src="{{ URL::asset('/images/main-page/logo.png') }}" alt="Logo" class="w-28 md:w-36">
        <a href="{{ route('dashboard') }}" class="text-xs md:text-base font-medium hover:underline mt-2">TORNA ALLA HOME</a>
    </div>

    <!-- Main Info Section -->
    <div class="w-full flex flex-col items-center px-4">
        <div class="flex flex-col md:flex-row items-center justify-center gap-6 w-full max-w-3xl mx-auto">
            <img src="{{ URL::asset('/images/fratelli-rosa/fratellirosaSA.png') }}" alt="Fratelli Rosa SA Logo" class="w-32 md:w-48 mb-4 md:mb-0">
            <div class="flex flex-col items-center md:items-start text-center md:text-left">
                <h1 class="text-2xl md:text-3xl font-light mb-2">Fratelli Rosa SA</h1>
                <p class="text-base md:text-lg font-light mb-4">
                    Come Fratelli Rosa SA, siamo un’impresa generale ci occupiamo di sottostrutture, soprastrutture e Gessature.
                </p>
                <button onclick="document.getElementById('quoteForm').scrollIntoView({behavior: 'smooth'})" class="px-6 py-2 border border-black rounded bg-white hover:bg-pink-200 transition text-xs md:text-sm font-medium">
                    RICHIEDI UN PREVENTIVO
                </button>
            </div>
        </div>
    </div>

    <!-- Filter Bar and Gallery (with Alpine.js) -->
            <div x-data="{
            filter: 'tutte',
            photosByCategory: {
                tutte: [
                    @foreach($photosByCategory['tutte'] as $photo)
                        { id: {{ $photo->id }}, path: '{{ $photo->image_path }}', title: '{{ addslashes($photo->title ?? '') }}' },
                    @endforeach
                ],
            soprastrutture: [
                @foreach($photosByCategory['soprastrutture'] as $photo)
                    { id: {{ $photo->id }}, path: '{{ $photo->image_path }}', title: '{{ addslashes($photo->title ?? '') }}' },
                @endforeach
            ],
            sottostrutture: [
                @foreach($photosByCategory['sottostrutture'] as $photo)
                    { id: {{ $photo->id }}, path: '{{ $photo->image_path }}', title: '{{ addslashes($photo->title ?? '') }}' },
                @endforeach
            ],
            muri: [
                @foreach($photosByCategory['muri'] as $photo)
                    { id: {{ $photo->id }}, path: '{{ $photo->image_path }}', title: '{{ addslashes($photo->title ?? '') }}' },
                @endforeach
            ],
            mezzi: [
                @foreach($photosByCategory['mezzi'] as $photo)
                    { id: {{ $photo->id }}, path: '{{ $photo->image_path }}', title: '{{ addslashes($photo->title ?? '') }}' },
                @endforeach
            ],
        },
        get shown() {
            return this.filter === 'tutte' ? this.photosByCategory.tutte : this.photosByCategory[this.filter];
        },
        modalOpen: false,
        modalIndex: 0,
        openModal(idx) { this.modalIndex = idx; this.modalOpen = true; document.body.style.overflow = 'hidden'; },
        closeModal() { this.modalOpen = false; document.body.style.overflow = ''; },
        prevImg() { this.modalIndex = (this.modalIndex + this.shown.length - 1) % this.shown.length; },
        nextImg() { this.modalIndex = (this.modalIndex + 1) % this.shown.length; }
    }" class="w-full max-w-5xl mx-auto py-8">
        <!-- Filter Bar -->
        <div class="flex flex-wrap justify-center w-full mb-8">
            <!-- Desktop Filter Tabs (hidden on mobile) -->
            <div class="hidden md:block bg-white/80 backdrop-blur-sm rounded-2xl p-2 shadow-lg border border-white/20">
                <template x-for="(label, key) in {tutte: 'Tutte le foto', soprastrutture: 'Soprastrutture', sottostrutture: 'Sottostrutture', muri: 'Muri a secco', mezzi: 'I nostri Mezzi'}" :key="key">
                    <button @click="filter = key" 
                            :class="filter === key ? 'bg-pink-600 text-white shadow-lg scale-105' : 'text-gray-700 hover:text-pink-600 hover:bg-white/50'" 
                            class="px-6 py-3 rounded-xl font-medium transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                        <span x-text="label"></span>
                    </button>
                </template>
            </div>
            
            <!-- Mobile Dropdown Filter (visible only on mobile) -->
            <div class="md:hidden w-full max-w-xs">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" 
                            class="w-full bg-white/80 backdrop-blur-sm rounded-2xl px-6 py-3 shadow-lg border border-white/20 text-gray-700 font-medium flex items-center justify-between transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                        <span x-text="{tutte: 'Tutte le foto', soprastrutture: 'Soprastrutture', sottostrutture: 'Sottostrutture', muri: 'Muri a secco', mezzi: 'I nostri Mezzi'}[filter]"></span>
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
                         class="absolute top-full left-0 right-0 mt-2 bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 z-10">
                        <template x-for="(label, key) in {tutte: 'Tutte le foto', soprastrutture: 'Soprastrutture', sottostrutture: 'Sottostrutture', muri: 'Muri a secco', mezzi: 'I nostri Mezzi'}" :key="key">
                            <button @click="filter = key; open = false" 
                                    :class="filter === key ? 'bg-pink-600 text-white' : 'text-gray-700 hover:text-pink-600 hover:bg-pink-50'" 
                                    class="w-full px-6 py-3 text-left font-medium transition-all duration-200 first:rounded-t-2xl last:rounded-b-2xl focus:outline-none focus:bg-pink-50">
                                <span x-text="label"></span>
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <template x-for="(photo, idx) in shown" :key="photo.id">
                <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer" @click="openModal(idx)">
                    <img :src="photo.path" :alt="photo.title || 'Foto'" class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                    
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Photo Info -->
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        <h3 class="font-semibold text-sm" x-text="photo.title || 'Foto'"></h3>
                        <p class="text-xs opacity-80">Clicca per ingrandire</p>
                    </div>
                    
                    <!-- Click Indicator -->
                    <div class="absolute top-3 right-3 bg-white/90 text-black rounded-full w-8 h-8 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                        </svg>
                    </div>
                </div>
            </template>
        </div>
        <!-- Lightbox Modal -->
        <div x-show="modalOpen" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-white/80 backdrop-blur-md">
            <div class="absolute inset-0 bg-white/80 backdrop-blur-md" @click="closeModal()"></div>
            <div class="relative z-10 flex flex-col items-center w-full max-w-5xl mx-auto p-4">
                <!-- Header -->
                <div class="w-full flex justify-between items-center mb-6">
                    <div class="text-center flex-1">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800" x-text="{tutte: 'Tutte le foto', soprastrutture: 'Soprastrutture', sottostrutture: 'Sottostrutture', muri: 'Muri a secco', mezzi: 'I nostri Mezzi'}[filter]"></h2>
                    </div>
                    <button @click="closeModal()" class="text-4xl text-gray-700 bg-white/80 rounded-full w-12 h-12 flex items-center justify-center hover:bg-white transition-all duration-200 hover:scale-110">&times;</button>
                </div>
                
                <!-- Main Image -->
                <div class="relative w-full flex items-center justify-center">
                    <button @click="prevImg" class="absolute left-4 z-20 text-4xl bg-white/90 rounded-full w-14 h-14 flex items-center justify-center hover:bg-white text-black transition-all duration-200 shadow-lg hover:scale-110">&#8592;</button>
                    
                    <div class="relative max-w-4xl w-full">
                        <img :src="shown[modalIndex].path" :alt="shown[modalIndex].title || 'Foto'" class="w-full max-h-[70vh] object-contain bg-white rounded-lg shadow-2xl">
                        
                        <!-- Photo Counter -->
                        <div class="absolute bottom-4 right-4 bg-white/90 text-gray-800 px-3 py-1 rounded-full text-sm font-medium shadow-lg">
                            <span x-text="(modalIndex + 1) + ' / ' + shown.length"></span>
                        </div>
                        
                        <!-- Photo Title -->
                        <div x-show="shown[modalIndex].title" class="absolute top-4 left-4 bg-white/90 text-gray-800 px-3 py-1 rounded-lg text-sm max-w-xs shadow-lg">
                            <span x-text="shown[modalIndex].title" class="line-clamp-2"></span>
                        </div>
                    </div>
                    
                    <button @click="nextImg" class="absolute right-4 z-20 text-4xl bg-white/90 rounded-full w-14 h-14 flex items-center justify-center hover:bg-white text-black transition-all duration-200 shadow-lg hover:scale-110">&#8594;</button>
                </div>
                
                <!-- Thumbnail Navigation -->
                <div class="flex justify-center items-center gap-3 mt-6">
                    <template x-for="(photo, i) in shown" :key="i">
                        <div @click="modalIndex = i" 
                             :class="i === modalIndex ? 'ring-4 ring-pink-500 scale-110' : 'opacity-60 hover:opacity-100'" 
                             class="w-16 h-16 rounded-lg overflow-hidden cursor-pointer transition-all duration-200 hover:scale-105 border-2 border-white/30">
                            <img :src="photo.path" :alt="photo.title || 'Foto'" class="w-full h-full object-cover">
                        </div>
                    </template>
                </div>
                
                <!-- Navigation Instructions -->
                <div class="text-center text-gray-600 text-sm mt-4">
                    <p>Usa le frecce per navigare o clicca sulle miniature</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quote Request Section -->
    <div class="w-full max-w-6xl mx-auto mt-20 px-4">
        <div class="border-t border-gray-200 pt-16 flex flex-col md:flex-row gap-12">
            <!-- Contact Info -->
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
            
            <!-- Quote Form -->
            <div class="md:w-1/2" id="quoteForm">
                <h3 class="text-2xl font-light mb-6 text-gray-800">Richiedi un preventivo</h3>
                
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif
                
                <form action="{{ route('quote.submit') }}" method="POST" class="flex flex-col gap-5">
                    @csrf
                    <select name="service_type" required class="border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all duration-300 bg-white/80 backdrop-blur-sm shadow-sm hover:shadow-md">
                        <option value="Sotto struttura">Sotto struttura</option>
                        <option value="Sopra struttura">Sopra struttura</option>
                        <option value="Gessatura">Gessatura</option>
                        <option value="Muri a secco">Muri a secco</option>
                        <option value="Gestione immobiliare">Gestione immobiliare</option>
                    </select>
                    <div class="flex gap-4">
                        <input type="text" name="name" required placeholder="Nome e Cognome / Azienda*" class="border border-gray-200 rounded-xl px-4 py-3 w-1/2 text-sm focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all duration-300 bg-white/80 backdrop-blur-sm shadow-sm hover:shadow-md">
                    </div>
                    <div class="flex gap-4">
                        <input type="text" name="phone" placeholder="Telefono" class="border border-gray-200 rounded-xl px-4 py-3 w-1/2 text-sm focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all duration-300 bg-white/80 backdrop-blur-sm shadow-sm hover:shadow-md">
                        <input type="email" name="email" required placeholder="E-Mail*" class="border border-gray-200 rounded-xl px-4 py-3 w-1/2 text-sm focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all duration-300 bg-white/80 backdrop-blur-sm shadow-sm hover:shadow-md">
                    </div>
                    <textarea name="message" required placeholder="Scrivici un messaggio*" class="border border-gray-200 rounded-xl px-4 py-3 text-sm min-h-[120px] focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all duration-300 bg-white/80 backdrop-blur-sm shadow-sm hover:shadow-md resize-none"></textarea>
                    <div class="flex justify-end">
                        <button type="submit" class="border border-gray-300 rounded-xl px-8 py-3 bg-gradient-to-r from-white to-pink-50 hover:from-pink-50 hover:to-pink-100 transition-all duration-300 text-sm font-medium shadow-sm hover:shadow-md hover:scale-105">INVIA RICHIESTA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="w-full border-t border-gray-200 bg-white py-6 flex flex-col items-center gap-3">
        <img src="{{ URL::asset('/images/main-page/logo.png') }}" alt="logo Valentino Rosa" class="w-24 mb-2">
        <div class="text-center text-xs md:text-sm text-black">
            Ufficio: Ai Guastíc 4, 6558 Lostallo<br>
            Magazzino: Fontanín 15, 6558 Lostallo<br>
            +41 91 830 12 85 - rosa.valentino@bluewin.ch
        </div>
        <button onclick="document.getElementById('quoteForm').scrollIntoView({behavior: 'smooth'})" class="mt-2 px-6 py-2 border border-black rounded bg-white hover:bg-pink-200 transition text-xs md:text-sm font-medium">
            RICHIEDI UN PREVENTIVO
        </button>
    </footer>
</body>
</html>