<style>
    /* Custom Dark Green Gradient for Welcome Section */
    .bg-dark-green-section {
        background: linear-gradient(135deg, #064e3b 0%, #022c22 100%);
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .cursor {
        display: inline-block;
        width: 3px;
        background-color: #fbbf24;
        animation: blink 1s infinite;
    }
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0; }
    }
</style>

<div class="bg-dark-green-section text-white relative overflow-hidden rounded-xl my-4">
    <div class="text-center px-4 relative z-10">
        <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-4 drop-shadow-2xl">
            मात्र रु ५०००d हजारमा किन्नुहोस् यो वेबसाइट
        </h1>

        <div class="text-2xl md:text-5xl font-bold text-amber-400 h-16 md:h-24 flex items-center justify-center mb-4">
            <span id="typewriter"></span><span class="cursor ml-2">&nbsp;</span>
        </div>

        <p class="text-lg md:text-2xl text-emerald-100 mb-12 max-w-3xl mx-auto font-light leading-relaxed">
            सत्य, तथ्य र निष्पक्ष समाचारको संवाहक। नयाँ डिजिटल संस्करण ।
        </p>

        <div class="flex flex-col md:flex-row gap-4 justify-center">
            <a href="https://facebook.com/neelamb20" class="bg-amber-500 hover:bg-amber-600 text-green-950 text-xl font-bold py-4 px-10 rounded-lg shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                सम्पर्क गर्नुहोस
            </a>
            <a href="https://facebook.com/neelamb20" target="_blank" class="border-2 border-white/30 hover:bg-white/10 text-white text-xl font-semibold py-4 px-10 rounded-lg transition-all duration-300">
                फेसबुकमा जोडिनुहोस्
            </a>
        </div>
    </div>

    <div class="absolute top-0 left-0 w-64 h-64 bg-emerald-500/10 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-amber-500/5 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl"></div>
</div>

<script>
    const textElement = document.getElementById('typewriter');
    const words = ['यो वेबसाइट बिक्रीमा छ', '? मात्र रु ५००० मा', 'डोमेन र होस्टिङसहित']; 
    let wordIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    let typeSpeed = 100;

    function type() {
        const currentWord = words[wordIndex];
        
        if (isDeleting) {
            textElement.textContent = currentWord.substring(0, charIndex - 1);
            charIndex--;
            typeSpeed = 50;
        } else {
            textElement.textContent = currentWord.substring(0, charIndex + 1);
            charIndex++;
            typeSpeed = 150;
        }

        if (!isDeleting && charIndex === currentWord.length) {
            isDeleting = true;
            typeSpeed = 2000; 
        } else if (isDeleting && charIndex === 0) {
            isDeleting = false;
            wordIndex = (wordIndex + 1) % words.length;
            typeSpeed = 500; 
        }

        setTimeout(type, typeSpeed);
    }

    document.addEventListener('DOMContentLoaded', type);
</script>
