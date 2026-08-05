<!DOCTYPE html>
<html lang="ne">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>नेपाल न्यूज एक्सप्रेस - <?= esc($title) ?></title>
    
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css' rel='stylesheet'/>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Mukta', sans-serif; background-color: #f4f7f6; }
        .h2-nav-bar { background-color: #d32f2f; }
        .h2-main-menu li a { color: white; font-weight: 600; transition: all 0.3s; }
        .h2-main-menu li a:hover { color: #fbbf24; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        #weatherWidgetBox { transition: all 0.3s ease-in-out; }
    </style>
</head>
<body>

<header class="w-full shadow-md bg-white">
    <div class="bg-gray-100 border-b py-1 text-sm hidden md:block">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center text-gray-600 font-semibold">
            <div class="flex space-x-6">
                <span><i class='fa-solid fa-gamepad mr-1 text-red-600'></i> Games</span>
                <span><i class='fa-solid fa-keyboard mr-1 text-red-600'></i> युनिकोड</span>
                <span><i class='fa-solid fa-calendar-alt mr-1 text-red-600'></i> मिति रूपान्तरण</span>
            </div>
            
            <button onclick="toggleWeather()" class="flex items-center text-red-700 hover:text-black transition uppercase text-xs tracking-wider">
                <i class="fa-solid fa-cloud-sun-rain mr-2 text-blue-500 text-lg"></i> मौसम हेर्नुहोस्
            </button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-4 flex flex-wrap justify-between items-center">
        <div class="flex items-center space-x-4 order-2 md:order-1">
            <i class='fa-solid fa-bars text-3xl cursor-pointer text-gray-700 hover:text-red-700'></i>
            <div class="border-l-2 border-gray-200 pl-4 hidden sm:block">
                <div id='h2-nepali-date' class="font-bold text-gray-800 text-lg">मिति लोड हुँदै...</div>
                <div class="mt-0">
                    <iframe scrolling="no" border="0" frameborder="0" marginwidth="0" marginheight="0" allowtransparency="true" src="https://www.ashesh.com.np/linknepali-time.php?dwn=only&font_color=d32f2f&font_size=14&bikram_sambat=0&api=9011x2p216" width="130" height="22"></iframe>
                </div>
            </div>
        </div>

        <div class="order-1 md:order-2 w-full md:w-auto text-center mb-4 md:mb-0">
            <a href="/">
                <h1 class="text-4xl md:text-5xl font-black text-red-700 tracking-tighter uppercase drop-shadow-sm">
                    नेपाल न्यूज एक्सप्रेस
                </h1>
            </a>
        </div>

        <div class="flex items-center space-x-5 text-2xl text-gray-600 order-3">
            <i class='fa-regular fa-user-circle cursor-pointer hover:text-red-700 transition'></i>
            <span class='font-bold text-sm cursor-pointer border-2 border-gray-300 px-2 py-0.5 rounded-md hover:bg-gray-100'>EN</span>
            <i class='fa-solid fa-magnifying-glass cursor-pointer hover:text-red-700 transition'></i>
        </div>
    </div>

    <nav class="h2-nav-bar sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <ul class='h2-main-menu flex items-center overflow-x-auto no-scrollbar py-1'>
                <li><a href='/' class="px-4 py-3 text-xl"><i class='fa-solid fa-house text-yellow-400'></i></a></li>
                <li><a href='/news' class="px-4 py-3 whitespace-nowrap text-lg">समाचार</a></li>
                <li><a href='#' class="px-4 py-3 whitespace-nowrap text-lg">विशेष</a></li>
                <li><a href='#' class="px-4 py-3 whitespace-nowrap text-lg">प्रदेश</a></li>
                <li><a href='#' class="px-4 py-3 whitespace-nowrap text-lg">अर्थतन्त्र</a></li>
                <li><a href='#' class="px-4 py-3 whitespace-nowrap text-lg">विचार</a></li>
                <li><a href='#' class="px-4 py-3 whitespace-nowrap text-lg">खेलकुद</a></li>
                <li><a href='/news/create' class="ml-4 px-4 py-2 bg-yellow-500 text-red-900 rounded font-bold hover:bg-white transition-all shadow-md">थप्नुहोस्</a></li>
            </ul>
            
            <div class='hidden lg:flex space-x-2'>
                <a href='#' class='bg-white/20 hover:bg-white/30 text-white px-3 py-1.5 rounded flex items-center text-sm font-bold'>
                    <i class='fa-solid fa-calendar-days mr-2 text-yellow-400'></i> पात्रो
                </a>
                <a href='#' class='bg-white/20 hover:bg-white/30 text-white px-3 py-1.5 rounded flex items-center text-sm font-bold'>
                    <i class='fa-solid fa-radio mr-2 text-yellow-400'></i> रेडियो
                </a>
            </div>
        </div>
    </nav>
</header>

<div id="weatherWidgetBox" class="hidden fixed top-24 left-6 z-[9999] shadow-2xl rounded-xl border-4 border-red-700 overflow-hidden bg-white">
    <div class="bg-red-700 text-white px-3 py-2 flex justify-between items-center">
        <span class="font-bold text-sm"><i class="fa-solid fa-cloud-sun mr-2"></i> मौसम जानकारी</span>
        <button onclick="toggleWeather()" class="bg-white text-red-700 rounded-full h-6 w-6 flex items-center justify-center font-bold">✕</button>
    </div>
    <iframe src="https://educationnepal.eu.org/weather-widget.html" 
            style="width: 320px; height: 350px; border: none; overflow: hidden;" 
            scrolling="no" allowtransparency="true">
    </iframe>
</div>

<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-white shadow-sm min-h-screen">
    <?php 
        /* यहाँबाट स्वागत छ र अन्य स्वचालित टाइटलहरू हटाइएको छ । 
           अब मुख्य सामग्री (Content) मात्र यहाँ देखिनेछ । */
    ?>

<script src='https://cdn.jsdelivr.net/gh/designers2077/code/header-2.js' type='text/javascript'></script>
<script>
    function toggleWeather() {
        const box = document.getElementById('weatherWidgetBox');
        box.classList.toggle('hidden');
    }
</script>
