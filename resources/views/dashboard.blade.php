<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — ABExam</title>
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
                            bg: '#212121', // ChatGPT main bg
                            sidebar: '#171717', // ChatGPT sidebar
                            card: '#2f2f2f', // ChatGPT card/input bg
                            hover: '#2a2a2a',
                            border: '#383838',
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
        body { transition: background-color 0.3s, color 0.3s; height: 100vh; display: flex; overflow: hidden; }
        
        .sidebar {
            width: 260px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            border-right: 1px solid rgba(0,0,0,0.05);
        }

        .dark .sidebar { border-right: none; }

        .sidebar-collapsed .sidebar {
            width: 68px;
        }

        /* ChatGPT Style: Hide labels and text entirely */
        .sidebar-collapsed .nav-label,
        .sidebar-collapsed .sidebar span,
        .sidebar-collapsed .sidebar .ml-auto {
            display: none !important;
        }

        .sidebar-collapsed #sidebar-toggle-btn {
            margin-left: 0 !important;
            margin-right: 0 !important;
            width: 100% !important;
        }

        .sidebar-collapsed .sidebar button,
        .sidebar-collapsed .sidebar a {
            justify-content: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            gap: 0 !important;
        }

        .sidebar-collapsed .sidebar .shrink-0 {
            margin: 0 !important;
        }
        
        .main-content {
            flex-grow: 1;
            overflow-y: auto;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ChatGPT Style Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e5e5e5; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #383838; }
        ::-webkit-scrollbar-thumb:hover { background: #d1d1d1; }
        .dark ::-webkit-scrollbar-thumb:hover { background: #4d4d4d; }

        #theme-toggle svg { transition: transform 0.5s ease; }
        .dark #theme-toggle .moon { display: none; }
        .dark #theme-toggle .sun { display: block; }
        #theme-toggle .sun { display: none; }

        /* Mobile Sidebar Overlay */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                z-index: 50;
                height: 100vh;
                left: -260px;
            }
            .sidebar-open .sidebar {
                left: 0;
                width: 260px;
            }
            .sidebar-collapsed .sidebar {
                width: 260px;
                left: -260px;
            }
            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.5);
                z-index: 40;
                backdrop-filter: blur(2px);
            }
            .sidebar-open .sidebar-overlay {
                display: block;
            }
        }
    </style>
</head>
<body class="bg-white dark:bg-dark-bg text-gray-900 dark:text-dark-text font-sans">
    
    <div id="overlay" class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar (Official ChatGPT Style) -->
    <aside class="sidebar bg-[#f9f9f9] dark:bg-dark-sidebar">
        <div class="p-3 h-full flex flex-col overflow-hidden">
            <!-- Sidebar Toggle (Top) -->
            <button id="sidebar-toggle-btn" onclick="toggleSidebar()" class="p-2 hover:bg-gray-200 dark:hover:bg-dark-hover rounded-lg transition-colors text-gray-500 dark:text-dark-muted mb-4 mx-auto md:mx-0 w-10 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
            </button>

            <!-- New Test Button -->
            <button class="flex items-center gap-3 w-full p-2.5 rounded-lg hover:bg-gray-200 dark:hover:bg-dark-hover text-gray-900 dark:text-white transition-colors mb-4 group border border-gray-200 dark:border-none shrink-0" title="Yangi test">
                <div class="w-7 h-7 bg-black/5 dark:bg-white/10 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <span class="nav-label font-medium text-sm truncate">Yangi test</span>
            </button>

            <!-- Navigation Items -->
            <nav class="flex-grow space-y-1 mt-2">
                <div class="px-3 mb-2 text-[11px] font-bold text-gray-400 dark:text-dark-muted uppercase tracking-wider nav-label">Asosiy menyu</div>
                <a href="/dashboard" class="flex items-center gap-3 px-3 py-2 text-gray-900 dark:text-white bg-gray-200 dark:bg-dark-hover rounded-lg transition-all text-sm group" title="Dashboard">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span class="nav-label truncate">Dashboard</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2 text-gray-600 dark:text-dark-text hover:bg-gray-200 dark:hover:bg-dark-hover rounded-lg transition-all text-sm group" title="Statistikam">
                    <svg class="w-5 h-5 text-blue-500 dark:text-blue-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    <span class="nav-label truncate">Statistikam</span>
                </a>
            </nav>

            <!-- User Info -->
            <div class="mt-auto shrink-0">
                <button class="w-full flex items-center gap-3 p-2 rounded-xl hover:bg-gray-200 dark:hover:bg-dark-hover text-gray-900 dark:text-white transition-colors" title="{{ auth()->user()->name }}">
                    <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center text-xs font-bold uppercase text-white shadow-inner shrink-0">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="text-left overflow-hidden nav-label shadow-sm">
                        <div class="text-sm font-medium truncate">{{ auth()->user()->name }}</div>
                        <div class="text-[10px] text-gray-500 dark:text-dark-muted truncate">Bepul reja</div>
                    </div>
                </button>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="main-content flex flex-col bg-white dark:bg-dark-bg">
        <!-- Minimalistic Header -->
        <header class="flex items-center justify-between px-6 py-3 border-b border-gray-50 dark:border-[#2f2f2f] bg-white/80 dark:bg-dark-bg/80 backdrop-blur-md sticky top-0 z-20">
            <div class="flex items-center gap-1">
                <a href="/" class="flex items-center group">
                    <span class="text-[#d32d27] text-2xl font-serif font-black italic -skew-x-6" style="font-family: 'Georgia', serif;">Ab</span>
                    <span class="text-[#3b368f] text-xl font-black uppercase ml-1 tracking-tight" style="font-family: 'Impact', sans-serif;">Exam</span>
                </a>
            </div>

            <div class="flex items-center gap-3">
                <div class="hidden sm:block px-3 py-1 rounded-full border border-gray-100 dark:border-dark-border bg-gray-50/50 dark:bg-dark-sidebar/50 text-xs font-medium text-gray-500 dark:text-dark-muted">
                    Premium: <span class="text-green-500">Faol emas</span>
                </div>
                <div class="flex items-center gap-1">
                    <button id="theme-toggle" class="p-2 hover:bg-gray-100 dark:hover:bg-dark-hover rounded-lg transition-colors text-gray-500 dark:text-dark-muted hover:text-white">
                        <svg class="sun w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"/></svg>
                        <svg class="moon w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/></svg>
                    </button>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button class="p-2 hover:bg-red-900/10 text-gray-500 dark:text-dark-muted hover:text-red-500 rounded-lg transition-colors" title="Chiqish">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="px-6 py-10 max-w-5xl mx-auto w-full">
            <div class="mb-10">
                <h1 class="text-3xl font-bold mb-2">Xush kelibsiz, {{ Auth::user()->name }} 👋</h1>
                <p class="text-gray-500 dark:text-dark-muted">Bugun qanday test topshiramiz?</p>
            </div>

            <!-- Dashboard Grid -->
            <div class="grid lg:grid-cols-2 gap-8 mb-12">
                <!-- Status -->
                <div class="p-8 border border-gray-100 dark:border-dark-border rounded-3xl bg-white dark:bg-dark-card flex items-center justify-between shadow-sm hover:shadow-md transition-shadow">
                    <div>
                        <div class="text-gray-500 dark:text-dark-muted text-sm font-medium mb-1 uppercase tracking-wider">Mening holatim</div>
                        <div class="text-3xl font-bold">Progress ko'rsatigichi</div>
                    </div>
                    <div class="w-16 h-16 bg-blue-500/10 dark:bg-blue-500/20 rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                </div>

                <!-- Active Test -->
                <div class="p-8 border border-gray-100 dark:border-dark-border rounded-3xl bg-white dark:bg-dark-card flex items-center justify-between shadow-sm hover:shadow-md transition-shadow">
                    <div>
                        <div class="text-gray-500 dark:text-dark-muted text-sm font-medium mb-1 uppercase tracking-wider">O'rtacha natija</div>
                        <div class="text-3xl font-bold">Band 7.5</div>
                    </div>
                    <div class="w-16 h-16 bg-green-500/10 dark:bg-green-500/20 rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
            </div>

            <!-- Tests Section -->
            <div class="mb-12">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-bold">Mavjud IELTS testlari</h2>
                    <a href="#" class="text-green-600 dark:text-green-500 font-medium hover:underline">Barchasi</a>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @php
                        $mockTests = [
                            ['id' => 1, 'title' => 'IELTS Mock Test 1', 'type' => 'Academic', 'time' => '180 daqiqa', 'icon' => 'indigo', 'path' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168 0.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332 0.477-4.5 1.253'],
                            ['id' => 2, 'title' => 'IELTS Mock Test 2', 'type' => 'General', 'time' => '180 daqiqa', 'icon' => 'blue', 'path' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168 0.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332 0.477-4.5 1.253'],
                            ['id' => 3, 'title' => 'Listening Mashq 24', 'type' => 'Listening', 'time' => '30 daqiqa', 'icon' => 'red', 'path' => 'M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z']
                        ];
                    @endphp

                    @foreach($mockTests as $test)
                    <div class="test-card group p-6 border border-gray-100 dark:border-dark-border rounded-3xl bg-white dark:bg-dark-card hover:bg-gray-50 dark:hover:bg-dark-hover transition-all duration-300">
                        <div class="w-12 h-12 rounded-2xl bg-{{ $test['icon'] }}-500/10 dark:bg-{{ $test['icon'] }}-500/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-{{ $test['icon'] }}-600 dark:text-{{ $test['icon'] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $test['path'] }}"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-lg mb-1">{{ $test['title'] }}</h3>
                        <div class="flex items-center gap-2 text-xs text-gray-400 dark:text-dark-muted mb-6 font-medium">
                            <span>{{ $test['type'] }}</span>
                            <span class="w-1 h-1 rounded-full bg-gray-300 dark:bg-dark-border"></span>
                            <span>{{ $test['time'] }}</span>
                        </div>
                        <a href="{{ route('ielts.test', ['id' => $test['id']]) }}" class="block w-full py-3 bg-black dark:bg-white text-white dark:text-black rounded-2xl font-bold text-sm text-center transform group-hover:translate-y-[-2px] transition-all shadow-lg shadow-black/5">
                            Boshlash
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Results -->
            <section>
                <h2 class="text-2xl font-bold mb-6">Oxirgi natijalar</h2>
                <div class="p-10 border border-dashed border-gray-200 dark:border-dark-border rounded-3xl text-center bg-gray-50/50 dark:bg-dark-sidebar/10">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-dark-sidebar rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="text-gray-500 dark:text-dark-muted">Hali hech qanday test topshirilmagan.</p>
                </div>
            </section>
        </div>
    </main>

    <script>
        const themeToggle = document.getElementById('theme-toggle');

        // Security: Prevent Right Click and F12
        document.addEventListener('contextmenu', event => event.preventDefault());
        document.onkeydown = function(e) {
            if (e.keyCode == 123) return false; // F12
            if (e.ctrlKey && e.shiftKey && (e.keyCode == 'I'.charCodeAt(0) || e.keyCode == 'i'.charCodeAt(0))) return false; // Ctrl+Shift+I
            if (e.ctrlKey && e.shiftKey && (e.keyCode == 'C'.charCodeAt(0) || e.keyCode == 'c'.charCodeAt(0))) return false; // Ctrl+Shift+C
            if (e.ctrlKey && e.shiftKey && (e.keyCode == 'J'.charCodeAt(0) || e.keyCode == 'j'.charCodeAt(0))) return false; // Ctrl+Shift+J
            if (e.ctrlKey && (e.keyCode == 'U'.charCodeAt(0) || e.keyCode == 'u'.charCodeAt(0))) return false; // Ctrl+U
            if (e.ctrlKey && (e.keyCode == 'S'.charCodeAt(0) || e.keyCode == 's'.charCodeAt(0))) return false; // Ctrl+S
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

        // Sidebar logic
        const toggleSidebar = () => {
            if (window.innerWidth <= 768) {
                document.body.classList.toggle('sidebar-open');
            } else {
                document.body.classList.toggle('sidebar-collapsed');
                localStorage.setItem('sidebar-collapsed', document.body.classList.contains('sidebar-collapsed'));
            }
        };

        // Initialize sidebar state
        if (window.innerWidth > 768 && localStorage.getItem('sidebar-collapsed') === 'true') {
            document.body.classList.add('sidebar-collapsed');
        }
    </script>
</body>
</html>
