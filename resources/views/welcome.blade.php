<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABExam — IELTS Mock Exam Platform</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        green: {
                            500: '#10a37f',
                            600: '#1a7f64',
                        },
                        dark: {
                            bg: '#0d0d0d',
                            secondary: '#212121',
                            border: '#2f2f2f',
                            text: '#ececec',
                            muted: '#b4b4b4'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'Söhne', 'ui-sans-serif', 'system-ui', '-apple-system', 'Segoe UI', 'Roboto', 'Ubuntu', 'Cantarell', 'Noto Sans', 'sans-serif', 'Helvetica Neue', 'Arial'],
                    }
                }
            }
        }
    </script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { transition: background-color 0.3s, color 0.3s; }
        
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .openai-btn {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .openai-btn:hover {
            transform: scale(1.02);
            filter: brightness(1.1);
        }
        
        .feature-card {
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-4px);
            border-color: #10a37f;
            box-shadow: 0 10px 30px -10px rgba(16, 163, 127, 0.1);
        }

        /* Glowing effect for hero */
        .glow {
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(16, 163, 127, 0.15) 0%, rgba(16, 163, 127, 0) 70%);
            z-index: -1;
            top: 10%;
            left: 50%;
            transform: translateX(-50%);
            pointer-events: none;
        }

        #theme-toggle svg { transition: transform 0.5s ease; }
        .dark #theme-toggle .moon { display: none; }
        .dark #theme-toggle .sun { display: block; }
        #theme-toggle .sun { display: none; }
    </style>
</head>
<body class="bg-white dark:bg-dark-bg text-gray-900 dark:text-dark-text font-sans">
    <div class="glow"></div>
    
    <!-- Nav -->
    <nav class="sticky top-0 z-50 border-b border-gray-100 dark:border-dark-border bg-white/80 dark:bg-dark-bg/80 backdrop-blur-md">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center group">
                <span class="text-[#d32d27] text-3xl font-serif font-black italic -skew-x-6" style="font-family: 'Georgia', serif;">Ab</span>
                <span class="text-[#3b368f] text-2xl font-black uppercase ml-1 tracking-tight" style="font-family: 'Impact', sans-serif;">Exam</span>
            </a>
            
            <div class="flex gap-4 items-center">
                <button id="theme-toggle" class="p-2 hover:bg-gray-100 dark:hover:bg-dark-secondary rounded-lg transition-colors">
                    <svg class="sun w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"/></svg>
                    <svg class="moon w-5 h-5 text-gray-700" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/></svg>
                </button>
                @auth
                    <a href="/dashboard" class="flex items-center gap-3 px-3 py-1.5 hover:bg-gray-100 dark:hover:bg-dark-secondary rounded-full transition-colors group">
                        <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center text-xs font-bold uppercase text-white shadow-inner">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <span class="font-medium text-sm hidden sm:block">{{ auth()->user()->name }}</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button class="p-2 hover:bg-red-50 dark:hover:bg-red-900/20 text-red-500 rounded-lg transition-colors" title="Chiqish">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                @else
                    <button onclick="openModal('login')" class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-dark-secondary rounded-lg transition-colors font-medium">Kirish</button>
                    <button onclick="openModal('register')" class="px-5 py-2.5 bg-green-500 hover:bg-green-600 text-white rounded-full font-medium openai-btn shadow-lg shadow-green-500/20">Boshlash</button>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Modals -->
    <div id="auth-modal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-[450px] p-6">
            <div class="bg-white dark:bg-dark-secondary border border-gray-100 dark:border-dark-border rounded-3xl shadow-2xl overflow-hidden relative">
                <button onclick="closeModal()" class="absolute top-4 right-4 p-2 hover:bg-gray-100 dark:hover:bg-dark-bg rounded-full transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <!-- Login View -->
                <div id="login-view" class="p-8">
                    <div class="text-center mb-8">
                        <div class="flex items-center justify-center mb-4">
                            <span class="text-[#d32d27] text-4xl font-serif font-black italic -skew-x-6" style="font-family: 'Georgia', serif;">Ab</span>
                            <span class="text-[#3b368f] text-3xl font-black uppercase ml-1 tracking-tight" style="font-family: 'Impact', sans-serif;">Exam</span>
                        </div>
                        <h2 class="text-2xl font-bold">Xush kelibsiz</h2>
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold mb-2 ml-1">Email manzilingiz</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-200 dark:border-dark-border rounded-2xl bg-gray-50 dark:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2 ml-1">Parol</label>
                            <input type="password" name="password" required class="w-full px-4 py-3 border border-gray-200 dark:border-dark-border rounded-2xl bg-gray-50 dark:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                        </div>
                        <button type="submit" class="w-full py-4 bg-green-500 hover:bg-green-600 text-white rounded-full font-bold text-lg shadow-lg shadow-green-500/20 transition-all hover:scale-[1.02]">
                            Kirish
                        </button>
                    </form>
                    <div class="mt-6 text-center text-sm">
                        <span class="text-gray-500 dark:text-dark-muted">Akkauntingiz yo'qmi?</span>
                        <button onclick="switchView('register')" class="text-green-500 font-bold hover:underline ml-1">Ro'yxatdan o'ting</button>
                    </div>
                </div>

                <!-- Register View -->
                <div id="register-view" class="p-8 hidden">
                    <div class="text-center mb-8">
                        <div class="flex items-center justify-center mb-4">
                            <span class="text-[#d32d27] text-4xl font-serif font-black italic -skew-x-6" style="font-family: 'Georgia', serif;">Ab</span>
                            <span class="text-[#3b368f] text-3xl font-black uppercase ml-1 tracking-tight" style="font-family: 'Impact', sans-serif;">Exam</span>
                        </div>
                        <h2 class="text-2xl font-bold">Akkaunt yaratish</h2>
                    </div>
                    <form method="POST" action="{{ route('register') }}" class="space-y-4 max-h-[60vh] overflow-y-auto px-1">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold mb-1 ml-1">Ism</label>
                                <input type="text" name="name" required class="w-full px-4 py-2.5 border border-gray-200 dark:border-dark-border rounded-xl bg-gray-50 dark:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1 ml-1">Rol</label>
                                <select name="role" class="w-full px-4 py-2.5 border border-gray-200 dark:border-dark-border rounded-xl bg-gray-50 dark:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                                    <option value="student">O'quvchi</option>
                                    <option value="teacher">O'qituvchi</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1 ml-1">Email</label>
                            <input type="email" name="email" required class="w-full px-4 py-2.5 border border-gray-200 dark:border-dark-border rounded-xl bg-gray-50 dark:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold mb-1 ml-1">Parol</label>
                                <input type="password" name="password" required class="w-full px-4 py-2.5 border border-gray-200 dark:border-dark-border rounded-xl bg-gray-50 dark:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1 ml-1">Tasdiqlash</label>
                                <input type="password" name="password_confirmation" required class="w-full px-4 py-2.5 border border-gray-200 dark:border-dark-border rounded-xl bg-gray-50 dark:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                            </div>
                        </div>
                        <button type="submit" class="w-full py-3.5 bg-green-500 hover:bg-green-600 text-white rounded-full font-bold text-lg shadow-lg shadow-green-500/20 transition-all hover:scale-[1.02]">
                            Ro'yxatdan o'tish
                        </button>
                    </form>
                    <div class="mt-6 text-center text-sm">
                        <span class="text-gray-500 dark:text-dark-muted">Akkauntingiz bormi?</span>
                        <button onclick="switchView('login')" class="text-green-500 font-bold hover:underline ml-1">Kiring</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero -->
    <header class="max-w-4xl mx-auto px-6 pt-32 pb-20 text-center relative">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 text-green-700 dark:text-green-400 text-sm font-medium mb-8">
            <span class="relative flex h-2 w-2">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
            </span>
            IELTS Mock 2026 yangilanishi
        </div>
        <h1 class="text-6xl md:text-7xl font-bold mb-8 tracking-tight leading-[1.1]">
            IELTS imtihoniga <span class="text-green-500">aqlli</span> tayyorgarlik
        </h1>
        <p class="text-xl text-gray-600 dark:text-dark-muted mb-12 max-w-2xl mx-auto leading-relaxed">
            Haqiqiy imtihon formatida 355 dan ortiq testlar, AI tahlil va real-time natijalar bilan maqsadingizga tezroq erishing.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            @auth
                <a href="/dashboard" class="w-full sm:w-auto px-8 py-4 bg-black dark:bg-white text-white dark:text-black rounded-full font-semibold text-lg openai-btn shadow-xl shadow-black/10 dark:shadow-white/5">
                    Dashboardga o'tish
                </a>
            @else
                <button onclick="openModal('register')" class="w-full sm:w-auto px-8 py-4 bg-black dark:bg-white text-white dark:text-black rounded-full font-semibold text-lg openai-btn shadow-xl shadow-black/10 dark:shadow-white/5">
                    Bepul boshlash
                </button>
            @endauth
            <a href="#features" class="w-full sm:w-auto px-8 py-4 border border-gray-200 dark:border-dark-border rounded-full font-semibold text-lg hover:bg-gray-50 dark:hover:bg-dark-secondary transition-colors">
                Batafsil
            </a>
        </div>
    </header>

    <!-- Stats -->
    <section class="max-w-5xl mx-auto px-6 py-12">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-8 p-12 glass rounded-3xl border border-gray-100 dark:border-dark-border shadow-2xl">
            <div class="text-center">
                <div class="text-5xl font-bold mb-2">355<span class="text-green-500">+</span></div>
                <div class="text-sm uppercase tracking-widest text-gray-500 font-bold">Mock Testlar</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold mb-2">10K<span class="text-green-500">+</span></div>
                <div class="text-sm uppercase tracking-widest text-gray-500 font-bold">O'quvchilar</div>
            </div>
            <div class="text-center col-span-2 md:col-span-1 border-t md:border-t-0 md:border-l border-gray-100 dark:border-dark-border pt-8 md:pt-0">
                <div class="text-5xl font-bold mb-2">90<span class="text-green-500">%</span></div>
                <div class="text-sm uppercase tracking-widest text-gray-500 font-bold">Muvaffaqiyat</div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="max-w-6xl mx-auto px-6 py-32">
        <div class="text-center mb-20">
            <h2 class="text-4xl font-bold mb-4">Nima uchun ABExam?</h2>
            <p class="text-gray-600 dark:text-dark-muted">Platformamiz imtihon topshirish tajribangizni o'zgartiradi</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="p-8 border border-gray-100 dark:border-dark-border rounded-3xl bg-white dark:bg-dark-secondary/10 feature-card">
                <div class="w-14 h-14 bg-green-500/10 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">Real Format</h3>
                <p class="text-gray-600 dark:text-dark-muted leading-relaxed">Haqiqiy IELTS imtihon interfeysi va vaqt chegarasi bilan tajriba orttiring.</p>
            </div>
            <div class="p-8 border border-gray-100 dark:border-dark-border rounded-3xl bg-white dark:bg-dark-secondary/10 feature-card">
                <div class="w-14 h-14 bg-blue-500/10 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">Batafsil Tahlil</h3>
                <p class="text-gray-600 dark:text-dark-muted leading-relaxed">AI yordamida har bir xatoingizni tushunib oling va rivojlanish statitikasini ko'ring.</p>
            </div>
            <div class="p-8 border border-gray-100 dark:border-dark-border rounded-3xl bg-white dark:bg-dark-secondary/10 feature-card">
                <div class="w-14 h-14 bg-orange-500/10 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">Tez Natija</h3>
                <p class="text-gray-600 dark:text-dark-muted leading-relaxed">Testni tugatgan zahotingiz natijangizni va javoblar tahlilini yuklab oling.</p>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section class="bg-gray-50 dark:bg-dark-secondary/20 py-32 border-y border-gray-100 dark:border-dark-border">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-16">IELTS barcha qismlarini qamrab olamiz</h2>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach([
                    ['Listening', 'purple', 'M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z'],
                    ['Reading', 'blue', 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                    ['Writing', 'green', 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
                    ['Speaking', 'red', 'M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z']
                ] as [$name, $color, $svg])
                <div class="p-8 rounded-3xl border border-gray-100 dark:border-dark-border bg-white dark:bg-dark-bg hover:shadow-xl transition-shadow group">
                    <div class="w-16 h-16 bg-{{ $color }}-500/10 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-{{ $color }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $svg }}"/></svg>
                    </div>
                    <div class="text-xl font-bold">{{ $name }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="max-w-4xl mx-auto px-6 py-40 text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-green-500/5 -z-10 blur-3xl rounded-full"></div>
        <h2 class="text-5xl font-bold mb-8">Maqsadingizga bir qadam qoldi</h2>
        <p class="text-xl text-gray-600 dark:text-dark-muted mb-12">Hoziroq ro'yxatdan o'ting va birinchi mock testni bepul topshiring.</p>
        <button onclick="openModal('register')" class="inline-block px-12 py-5 bg-green-500 hover:bg-green-600 text-white rounded-full font-bold text-xl openai-btn shadow-2xl shadow-green-500/30">
            Ro'yxatdan o'tish
        </button>
    </section>

    <!-- Footer -->
    <footer class="border-t border-gray-100 dark:border-dark-border">
        <div class="max-w-6xl mx-auto px-6 py-20">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12 mb-20">
                <div class="col-span-2 md:col-span-1">
                    <div class="flex items-center group mb-6">
                        <span class="text-[#d32d27] text-3xl font-serif font-black italic -skew-x-6" style="font-family: 'Georgia', serif;">Ab</span>
                        <span class="text-[#3b368f] text-2xl font-black uppercase ml-1 tracking-tight" style="font-family: 'Impact', sans-serif;">Exam</span>
                    </div>
                    <p class="text-gray-500 dark:text-dark-muted leading-relaxed">
                        IELTS tayyorgarligi uchun innovatsion va ishonchli platforma.
                    </p>
                </div>
                <div class="space-y-4">
                    <h4 class="font-bold text-lg">Xizmatlar</h4>
                    <ul class="space-y-3 text-gray-500 dark:text-dark-muted">
                        <li><a href="#" class="hover:text-green-500 transition-colors">Mock Testlar</a></li>
                        <li><a href="#" class="hover:text-green-500 transition-colors">AI Tahlil</a></li>
                        <li><a href="#" class="hover:text-green-500 transition-colors">Sertifikatlar</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h4 class="font-bold text-lg">Kompaniya</h4>
                    <ul class="space-y-3 text-gray-500 dark:text-dark-muted">
                        <li><a href="#" class="hover:text-green-500 transition-colors">Biz haqimizda</a></li>
                        <li><a href="#" class="hover:text-green-500 transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-green-500 transition-colors">Aloqa</a></li>
                    </ul>
                </div>
                <div class="space-y-4 text-sm">
                    <h4 class="font-bold text-lg">Ijtimoiy</h4>
                    <div class="flex gap-4">
                        <a href="https://t.me/abexam" class="w-10 h-10 rounded-full border border-gray-100 dark:border-dark-border flex items-center justify-center hover:border-green-500 hover:text-green-500 transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.562 8.161c-.18.717-.962 4.084-1.362 5.441-.168.575-.532.768-.783.791-.55.051-.967-.362-1.501-.712-.835-.547-1.307-.887-2.115-1.419-.934-.615-.328-.953.204-1.503.139-.144 2.553-2.341 2.6-2.539.006-.024.011-.115-.041-.162s-.129-.031-.185-.019c-.078.018-1.332.847-3.757 2.484-.355.244-.677.365-.965.358-.317-.008-.928-.181-1.382-.328-.557-.18-1-.276-.962-.583.02-.16.241-.323.663-.489 2.597-1.131 4.327-1.876 5.191-2.234 2.47-.999 2.984-1.173 3.319-1.179.074-.001.239.017.345.103.089.073.114.171.123.242.009.076.012.219-.001.352z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex flex-col md:flex-row justify-between items-center gap-6 pt-12 border-t border-gray-100 dark:border-dark-border text-gray-500 dark:text-dark-muted">
                <p>&copy; 2026 ABExam. Barcha huquqlar himoyalangan.</p>
                <div class="flex gap-8 text-sm">
                    <a href="#" class="hover:text-green-500">Privacy Policy</a>
                    <a href="#" class="hover:text-green-500">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const authModal = document.getElementById('auth-modal');
        const loginView = document.getElementById('login-view');
        const registerView = document.getElementById('register-view');

        const openModal = (view) => {
            authModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            switchView(view);
        };

        const closeModal = () => {
            authModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        };

        const switchView = (view) => {
            if (view === 'login') {
                loginView.classList.remove('hidden');
                registerView.classList.add('hidden');
            } else {
                loginView.classList.add('hidden');
                registerView.classList.remove('hidden');
            }
        };

        const applyTheme = (theme) => {
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            localStorage.setItem('theme', theme);
        };

        const savedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        applyTheme(savedTheme);

        themeToggle.addEventListener('click', () => {
            const isDark = document.documentElement.classList.contains('dark');
            applyTheme(isDark ? 'light' : 'dark');
        });
    </script>
</body>
</html>
