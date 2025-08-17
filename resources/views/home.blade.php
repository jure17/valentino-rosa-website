<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Pagina iniziale</title>
		@vite(['resources/css/app.css', 'resources/js/app.js'])
	</head>
<body class="bg-gradient-to-br from-[#FDFDFC] via-white to-pink-50 min-h-screen flex flex-col">

	<!-- Sezione top: preventivo e info -->
    <div class="relative w-full h-[320px] md:h-[400px] bg-cover bg-center flex items-center justify-center" style="background-image: url('/images/main-page/mountains.jpg');">
        <div class="bg-white/80 rounded-md shadow-lg p-6 md:p-10 flex flex-col gap-3 items-center max-w-md w-full mx-4">
            <img src="{{ URL::asset('/images/main-page/logo.png') }}" alt="logo Valentino Rosa" class="w-40 md:w-52 mb-2">
            <div class="text-center text-xs md:text-sm text-black">
                <b>Valentino Rosa SA e<br>Fratelli Rosa SA</b><br>
                Ai Guastíc 4, 6558 Lostallo<br>
                <span class="text-xs">Ufficio: Ai Guastíc 4, 6558 Lostallo<br>Magazzino: Fontanín 15, 6558 Lostallo</span>
			</div>
        </div>
    </div>

    <!-- Barra rosa con slogan -->
    <div class="w-full bg-[#D12C7A] text-white text-center py-2 text-xs md:text-base font-medium">
        Attenzione e diligenza, costruiamo con precisione e raggiungiamo obbiettivi di vasta portata.
			</div>

    <!-- Sezione centrale: bottoni per sito -->
    <div class="flex-1 flex flex-col items-center justify-center py-6 px-2 md:px-0">
        <div class="flex flex-col gap-4 w-full max-w-2xl">

            <!-- FRATELLI ROSA -->
            <div class="flex flex-col md:flex-row items-center justify-between border-2 border-[#D12C7A] rounded-md px-4 py-4 bg-white hover:shadow-lg transition">
                <div class="text-lg md:text-xl font-light text-black">
                    <span class="font-normal">Fratelli Rosa SA</span>
                    <span class="ml-2 text-xs md:text-sm font-light">Sotto e Sopra strutture/Gessature</span>
                </div>
                <a href="{{ route('fratelli') }}" class="flex items-center gap-2 mt-2 md:mt-0 text-black font-medium group">
                    VEDI IL PORTFOLIO
                    <span class="group-hover:translate-x-1 transition-transform">&#8594;</span>
                </a>
            </div>
            <!-- VALENTINO ROSA -->
            <div class="flex flex-col md:flex-row items-center justify-between border-2 border-[#D12C7A] rounded-md px-4 py-4 bg-white hover:shadow-lg transition">
                <div class="text-lg md:text-xl font-light text-black">
                    <span class="font-normal">Valentino Rosa SA</span>
                    <span class="ml-2 text-xs md:text-sm font-light">Compra e vendita di immobili</span>
                </div>
                <a href="{{ route('valentino') }}" class="flex items-center gap-2 mt-2 md:mt-0 text-black font-medium group">
                    VEDI AFFITTI E VENDITE
                    <span class="group-hover:translate-x-1 transition-transform">&#8594;</span>
                </a>
            </div>
            <!-- STORIA -->
            <div class="flex justify-center">
                <a href="{{ route('story') }}" class="w-full border-2 border-[#D12C7A] rounded-md py-2 text-black text-sm md:text-base font-medium bg-white hover:bg-pink-100 transition flex items-center justify-center gap-2">
                    <span class="inline-block w-8 h-px bg-black mr-2"></span>
                    SCOPRI MEGLIO LE DITTE ROSA
                    <span class="inline-block w-8 h-px bg-black ml-2"></span>
                </a>
            </div>
			
			</div>
		</div>

    <!-- Sezione bottom: Preventivo -->
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