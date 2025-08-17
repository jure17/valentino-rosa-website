@php
    $tabs = [
        ['label' => 'Sottostrutture', 'active' => true],
        ['label' => 'Soprastrutture', 'active' => true],
        ['label' => 'Gessatura', 'active' => true],
        ['label' => 'Gestione immobiliare', 'active' => true],
    ];
@endphp

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La storia della ditte Rosa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-[#FDFDFC] via-white to-pink-50 min-h-screen flex flex-col">
    <!-- Header -->
    <div class="w-full max-w-6xl mx-auto flex justify-between items-center py-8 px-4">
        <img src="{{ URL::asset('/images/main-page/logo.png') }}" alt="Logo" class="w-32 md:w-40 hover:scale-105 transition-transform duration-300">
        <a href="/" class="text-xs md:text-base font-medium text-black hover:underline transition-colors duration-300">
            TORNA ALLA HOME
        </a>
    </div>

    <!-- Team Section with Enhanced Decorative Elements -->
    <div class="w-full flex justify-center px-2 md:px-0">
        <div class="relative w-full max-w-4xl flex flex-col items-start">
            <!-- Enhanced Pink lines with gradients and shadows -->
            <div class="pointer-events-none select-none">
                <div class="absolute left-0 top-0 h-[60px] w-[4px] bg-gradient-to-b from-[#D12C7A] to-pink-400 rounded-tl-lg z-0 shadow-lg"></div>
                <div class="absolute left-0 top-0 h-[4px] w-[180px] bg-gradient-to-r from-[#D12C7A] to-pink-400 rounded-tl-lg z-0 shadow-lg"></div>
                <div class="absolute right-0 bottom-0 h-[60px] w-[4px] bg-gradient-to-t from-pink-400 to-[#D12C7A] rounded-br-lg z-0 shadow-lg"></div>
                <div class="absolute right-0 bottom-0 h-[4px] w-[180px] bg-gradient-to-l from-pink-400 to-[#D12C7A] rounded-br-lg z-0 shadow-lg"></div>
            </div>
            
            <!-- Enhanced Content with better typography -->
            <div class="pl-4 pt-4 w-full relative z-10">
                <h1 class="text-3xl md:text-5xl font-light text-left mb-2 bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">La nostra squadra</h1>
                <div class="text-lg md:text-xl font-light text-left mb-6 text-gray-600">15 dipendenti, con 3 membri nella direzione</div>
            </div>
            <div class="w-full flex justify-center relative z-10">
                <img src="{{ URL::asset('/images/story/group.png') }}" alt="La squadra" class="rounded-2xl w-full max-w-3xl object-cover shadow-2xl hover:shadow-3xl transition-all duration-500 hover:scale-[1.02]">
            </div>
            
            <!-- Service Categories in Horizontal Line -->
            <div class="w-full flex justify-center relative z-20 mt-6">
                <div class="w-full max-w-2xl">
                    <div class="flex items-center justify-between bg-white rounded-lg shadow-lg border border-gray-200 px-6 py-4">
                        <div class="flex items-center gap-8">
                            <div class="flex items-center text-sm md:text-base text-gray-700">
                                <span class="text-pink-500 mr-2">&#10003;</span>
                                Sottostrutture
                            </div>
                            <div class="flex items-center text-sm md:text-base text-gray-700">
                                <span class="text-pink-500 mr-2">&#10003;</span>
                                Soprastrutture
                            </div>
                            <div class="flex items-center text-sm md:text-base text-gray-700">
                                <span class="text-pink-500 mr-2">&#10003;</span>
                                Gessatura
                            </div>
                            <div class="flex items-center text-sm md:text-base text-gray-700">
                                <span class="text-pink-500 mr-2">&#10003;</span>
                                Gestione immobiliare
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Timeline Section -->
    <div class="w-full max-w-6xl mx-auto mt-16 px-4">
        <h2 class="text-3xl md:text-4xl font-light mb-8 text-left bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">La storia della ditte Rosa</h2>
        <h3>È il 1966 quando papà Valentino Rosa fonda la sua ditta individuale, aiutato dalla mamma Franca che si occupa dell’amministrazione.</h3>
        
        <!-- Two-column layout: Timeline on left, Content on right -->
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Left Column: Timeline Image -->
            <div class="lg:w-1/3">
                <div class="flex justify-center">
                    <img src="{{ URL::asset('/images/story/timeline.png') }}" alt="Timeline della storia" class="w-full max-w-[200px] object-contain">
                </div>
            </div>
            
            <!-- Right Column: Story Content -->
            <div class="lg:w-2/3">
                <div class="flex flex-col gap-8">
                    <!-- Text Block 1 -->
                    <div class="text-sm md:text-base font-light leading-relaxed text-gray-700">
                        <p>Valentino nasce e cresce a Lostallo. A 19 anni, dopo l'apprendistato di muratore, entra in un'importante azienda del bellinzonese come capocantiere. È un gran lavoratore attento e volenteroso d'imparare bene il mestiere. Con coraggio e professionalità dopo 11 anni di lavoro come dipendente, Valentino si sente pronto a fare il grande passo fondando così la "VALENTINO ROSA".</p>
                    </div>

                    <!-- Text Block 2 and Image 1 Row -->
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-1/2 text-sm md:text-base font-light leading-relaxed text-gray-700">
                            <p>Noi, figli di Valentino, cresciamo con un grande interesse per l'attività del nostro papà. Dopo l'impegno, dedizione e nuove competenze, arriviamo ad un altro grande cambiamento; nel 1989 l'azienda si trasforma da ditta individuale a "VALENTINO ROSA SA". La crescita negli anni è costante e continua, papà Valentino nel 2010 cede, e la conduzione dell'azienda è passata completamente a noi; Damiano, Verena, Martina, Valentino Jr. e Gianfranco.</p>
                        </div>
                        <div class="md:w-1/2 flex flex-col gap-1">
                            <img src="{{ URL::asset('/images/story/photo1.png') }}" alt="Valentino Rosa" class="rounded-2xl w-full object-cover shadow-lg hover:shadow-2xl transition-all duration-500 hover:scale-[1.02]">
                        </div>
                    </div>

                    <!-- Image 2 and Image 3 Row -->
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-1/2 flex flex-col gap-1">
                            <img src="{{ URL::asset('/images/story/photo2.png') }}" alt="Gruppo di lavoratori" class="rounded-2xl w-full object-cover shadow-lg hover:shadow-2xl transition-all duration-500 hover:scale-[1.02]">
                        </div>
                        <div class="md:w-1/2 flex flex-col gap-1">
                            <img src="{{ URL::asset('/images/story/photo3.png') }}" alt="Cantiere con escavatore" class="rounded-2xl w-full object-cover shadow-lg hover:shadow-2xl transition-all duration-500 hover:scale-[1.02]">
                        </div>
                    </div>

                    <!-- Text Block 3 -->
                    <div class="text-sm md:text-base font-light leading-relaxed text-gray-700">
                        <p>Dal 2021 la "VALENTINO ROSA SA" diventa unicamente l'immobiliare che gestisce le costruzioni realizzate dalla nuova società: "FRATELLI ROSA SA" che si occupa di: edilizia in generale, di sovrastrutture e di sottostrutture, opere di gessatura e specializzati in realizzazione di muri a secco con più di 10.000 mq in soli vent'anni.</p>
                    </div>

                    <!-- Image 4 and Image 5 Row -->
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-1/2 flex flex-col gap-1">
                            <img src="{{ URL::asset('/images/story/photo4.png') }}" alt="Lavoratori su pendio roccioso" class="rounded-2xl w-full object-cover shadow-lg hover:shadow-2xl transition-all duration-500 hover:scale-[1.02]">
                        </div>
                        <div class="md:w-1/2 flex flex-col gap-1">
                            <img src="{{ URL::asset('/images/story/photo5.png') }}" alt="Team in riunione" class="rounded-2xl w-full object-cover shadow-lg hover:shadow-2xl transition-all duration-500 hover:scale-[1.02]">
                        </div>
                    </div>

                    <!-- Text Block 4 -->
                    <div class="text-sm md:text-base font-light leading-relaxed text-gray-700">
                        <p>Nasciamo e cresciamo a Lostallo, nel nostro comune abbiamo coltivato la nostra passione; con la costruzione di 97 case primarie e di 10 palazzine (Lostallo 2024).</p>
                    </div>

                    <!-- Image 6 and Text Block 5 Row -->
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-1/2 flex flex-col gap-1">
                            <img src="{{ URL::asset('/images/story/photo6.png') }}" alt="Escavatore arancione" class="rounded-2xl w-full object-cover shadow-lg hover:shadow-2xl transition-all duration-500 hover:scale-[1.02]">
                        </div>
                        <div class="md:w-1/2 text-sm md:text-base font-light leading-relaxed text-gray-700">
                            <p>La storia e l'esperienza maturata in tutti questi anni, l'attenzione all'innovazione e la professionalità degli operai, fanno della nostra azienda famigliare un punto di riferimento nella regione.</p>
                        </div>
                    </div>

                    <!-- Text Block 6 -->
                    <div class="text-sm md:text-base font-light leading-relaxed text-gray-700">
                        <p>Inoltre, vorremmo essere all'altezza della nostra responsabilità professionale e sociale, nella regione. Prendiamo sul serio i nostri compiti di datore di lavoro, formatore di apprendisti, produttori, fornitori, partner e clienti.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Request a Quote Section -->
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

    <!-- Enhanced Footer -->
    <footer class="w-full border-t border-gray-200 bg-gradient-to-r from-white to-pink-50 py-10 mt-16 flex flex-col items-center gap-4">
        <img src="{{ URL::asset('/images/main-page/logo.png') }}" alt="logo Valentino Rosa" class="w-28 mb-2 hover:scale-105 transition-transform duration-300">
        <div class="text-center text-xs md:text-sm text-gray-700 bg-white/60 backdrop-blur-sm p-4 rounded-xl shadow-sm">
            Ufficio: Ai Guastíc 4, 6558 Lostallo<br>
            Magazzino: Fontanín 15, 6558 Lostallo<br>
            +41 91 830 12 85 - rosa.valentino@bluewin.ch
        </div>
        <button onclick="document.getElementById('quoteForm').scrollIntoView({behavior: 'smooth'})" class="mt-2 px-8 py-3 border border-gray-300 rounded-xl bg-gradient-to-r from-white to-pink-50 hover:from-pink-50 hover:to-pink-100 transition-all duration-300 text-sm font-medium shadow-sm hover:shadow-md hover:scale-105">
            RICHIEDI UN PREVENTIVO
        </button>
    </footer>
</body>
</html> 