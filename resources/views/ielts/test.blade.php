<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IELTS Mock Test — ABExam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        dark: {
                            bg: '#212121',
                            sidebar: '#171717',
                            card: '#2f2f2f',
                            border: '#383838',
                            text: '#ececec',
                            muted: '#b4b4b4'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'Söhne', 'ui-sans-serif', 'system-ui', '-apple-system', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .test-content {
            height: calc(100vh - 120px);
        }
        .scroll-custom::-webkit-scrollbar { width: 6px; }
        .scroll-custom::-webkit-scrollbar-thumb { background: #e5e5e5; border-radius: 10px; }
        .dark .scroll-custom::-webkit-scrollbar-thumb { background: #383838; }
        
        /* Reading Split Layout */
        .reading-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            height: 100%;
        }
    </style>
</head>
<body class="bg-[#f9f9f9] dark:bg-dark-bg text-gray-900 dark:text-dark-text font-sans overflow-hidden">
    
    <!-- Test Header -->
    <header class="h-16 bg-white dark:bg-dark-sidebar border-b border-gray-100 dark:border-dark-border px-6 flex items-center justify-between sticky top-0 z-30">
        <div class="flex items-center gap-4">
            <button onclick="window.history.back()" class="p-2 hover:bg-gray-100 dark:hover:bg-dark-hover rounded-lg transition-colors text-gray-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <div>
                <h1 class="font-bold text-sm sm:text-base">IELTS Academic Mock Test #1</h1>
                <p class="text-[10px] text-gray-500 dark:text-dark-muted uppercase tracking-widest font-bold">Reading Section</p>
            </div>
        </div>

        <div class="flex items-center gap-6">
            <!-- Timer -->
            <div class="flex items-center gap-3 px-4 py-2 bg-red-50 dark:bg-red-900/10 text-red-600 dark:text-red-400 rounded-xl border border-red-100 dark:border-red-900/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="font-mono font-bold tracking-tighter" id="timer">59:59</span>
            </div>

            <button class="px-5 py-2 bg-black dark:bg-white text-white dark:text-black rounded-full font-bold text-sm hover:opacity-90 transition-opacity">
                Tugatish
            </button>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="test-content">
        <!-- Section Navigation Tabs -->
        <div class="bg-gray-50 dark:bg-dark-sidebar/50 border-b border-gray-100 dark:border-dark-border px-6 py-2 flex gap-2">
            <button class="px-4 py-1.5 rounded-lg bg-white dark:bg-dark-card shadow-sm border border-gray-200 dark:border-dark-border text-xs font-bold transition-all">Part 1</button>
            <button class="px-4 py-1.5 rounded-lg hover:bg-white dark:hover:bg-dark-card text-xs font-medium text-gray-500 dark:text-dark-muted transition-all">Part 2</button>
            <button class="px-4 py-1.5 rounded-lg hover:bg-white dark:hover:bg-dark-card text-xs font-medium text-gray-500 dark:text-dark-muted transition-all">Part 3</button>
        </div>

        <div class="reading-container">
            <!-- Left: Passage -->
            <div class="border-r border-gray-100 dark:border-dark-border overflow-y-auto scroll-custom p-8 sm:p-12">
                <article class="max-w-2xl mx-auto">
                    <h2 class="text-3xl font-black mb-8 leading-tight">The Impact of AI on Modern Education</h2>
                    <div class="space-y-6 text-gray-700 dark:text-dark-text/90 leading-relaxed text-lg">
                        <p>Artificial Intelligence (AI) has rapidly transformed various sectors, but its impact on education is particularly profound. From personalized learning experiences to automated administrative tasks, AI is reshaping how students learn and teachers instruct.</p>
                        <p>One of the most significant benefits of AI in education is personalization. Conventional classroom settings often struggle to cater to the unique learning paces and styles of individual students. AI-powered platforms can analyze student performance data in real-time to tailor content, adjusting the difficulty level and providing additional resources where needed.</p>
                        <p>Furthermore, AI tools can assist educators by taking over repetitive tasks such as grading multiple-choice assessments and managing attendance. This allows teachers to dedicate more time to mentorship, creative lesson planning, and addressing the social-emotional needs of their students.</p>
                        <p>However, the integration of AI also presents challenges. Concerns regarding data privacy, algorithmic bias, and the potential for reduced human interaction remain at the forefront of educational debates. It is crucial that the implementation of these technologies is guided by ethical considerations and a focus on enhancing, rather than replacing, the human element in education.</p>
                    </div>
                </article>
            </div>

            <!-- Right: Questions -->
            <div class="bg-white dark:bg-dark-bg overflow-y-auto scroll-custom p-8 sm:p-12">
                <div class="max-w-2xl mx-auto">
                    <div class="mb-10">
                        <span class="inline-block px-3 py-1 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 text-[10px] font-black uppercase tracking-widest rounded-full mb-4">Questions 1-5</span>
                        <h3 class="text-xl font-bold mb-6">Choose the correct answer for each question.</h3>
                        
                        <div class="space-y-8">
                            <!-- Question 1 -->
                            <div class="p-6 rounded-2xl bg-gray-50 dark:bg-dark-card border border-gray-100 dark:border-dark-border">
                                <p class="font-bold mb-4">1. What is mentioned as a primary benefit of AI in personalization?</p>
                                <div class="space-y-3">
                                    <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 dark:border-dark-border hover:bg-gray-100 dark:hover:bg-dark-hover cursor-pointer transition-all">
                                        <input type="radio" name="q1" class="w-4 h-4 accent-indigo-600">
                                        <span class="text-sm">Reduced costs for educational institutions</span>
                                    </label>
                                    <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 dark:border-dark-border hover:bg-gray-100 dark:hover:bg-dark-hover cursor-pointer transition-all">
                                        <input type="radio" name="q1" class="w-4 h-4 accent-indigo-600">
                                        <span class="text-sm">Real-time analysis to adjust learning content</span>
                                    </label>
                                    <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 dark:border-dark-border hover:bg-gray-100 dark:hover:bg-dark-hover cursor-pointer transition-all">
                                        <input type="radio" name="q1" class="w-4 h-4 accent-indigo-600">
                                        <span class="text-sm">Complete replacement of traditional textbooks</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Question 2 -->
                            <div class="p-6 rounded-2xl bg-gray-50 dark:bg-dark-card border border-gray-100 dark:border-dark-border">
                                <p class="font-bold mb-4">2. According to the text, how can AI help teachers?</p>
                                <div class="space-y-3">
                                    <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 dark:border-dark-border hover:bg-gray-100 dark:hover:bg-dark-hover cursor-pointer transition-all">
                                        <input type="radio" name="q2" class="w-4 h-4 accent-indigo-600">
                                        <span class="text-sm">By automating creative lesson planning</span>
                                    </label>
                                    <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 dark:border-dark-border hover:bg-gray-100 dark:hover:bg-dark-hover cursor-pointer transition-all">
                                        <input type="radio" name="q2" class="w-4 h-4 accent-indigo-600">
                                        <span class="text-sm">By handling repetitive administrative tasks</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer: Question Navigation -->
    <footer class="h-14 bg-white dark:bg-dark-sidebar border-t border-gray-100 dark:border-dark-border px-6 flex items-center justify-between sticky bottom-0 z-30">
        <div class="flex items-center gap-2 overflow-x-auto py-1 no-scrollbar">
            @for($i = 1; $i <= 40; $i++)
                <button class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold transition-all shrink-0 {{ $i <= 2 ? 'bg-indigo-600 text-white' : 'bg-gray-100 dark:bg-dark-card text-gray-500 dark:text-dark-muted hover:bg-gray-200 dark:hover:bg-dark-hover' }}">
                    {{ $i }}
                </button>
            @endfor
        </div>
        
        <div class="flex items-center gap-4 shrink-0 pl-4 border-l border-gray-100 dark:border-dark-border ml-4">
            <button class="p-2 hover:bg-gray-100 dark:hover:bg-dark-hover rounded-lg transition-colors text-gray-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button class="p-2 hover:bg-gray-100 dark:hover:bg-dark-hover rounded-lg transition-colors text-gray-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </footer>

    <script>
        // Simple Timer
        let time = 3600;
        const timerElement = document.getElementById('timer');
        setInterval(() => {
            const minutes = Math.floor(time / 60);
            const seconds = time % 60;
            timerElement.innerText = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            if (time > 0) time--;
        }, 1000);

        // Sync Dark Mode from LocalStorage
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }

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
    </script>
</body>
</html>
