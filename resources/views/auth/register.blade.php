<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ro'yxatdan o'tish — ABExam</title>
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
        body { transition: background-color 0.3s, color 0.3s; }
    </style>
</head>
<body class="bg-white dark:bg-dark-bg text-gray-900 dark:text-dark-text font-sans min-h-screen flex flex-col items-center justify-center p-6 py-20">
    
    <div class="w-full max-w-[450px]">
        <div class="text-center mb-10">
            <div class="flex items-center justify-center mb-4">
                <span class="text-[#d32d27] text-4xl font-serif font-black italic -skew-x-6" style="font-family: 'Georgia', serif;">Ab</span>
                <span class="text-[#3b368f] text-3xl font-black uppercase ml-1 tracking-tight" style="font-family: 'Impact', sans-serif;">Exam</span>
            </div>
            <h1 class="text-3xl font-bold tracking-tight">Akkaunt yaratish</h1>
        </div>
        
        <div class="bg-white dark:bg-dark-secondary/50 border border-gray-100 dark:border-dark-border rounded-3xl p-8 shadow-xl">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-800 rounded-2xl text-sm text-red-600 dark:text-red-400">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-2 ml-1">Ismingiz</label>
                        <input type="text" name="name" value="{{ old('name') }}" required 
                            class="w-full px-4 py-3 border border-gray-200 dark:border-dark-border rounded-2xl bg-gray-50 dark:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2 ml-1">Rol</label>
                        <select name="role" class="w-full px-4 py-3 border border-gray-200 dark:border-dark-border rounded-2xl bg-gray-50 dark:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                            <option value="student">O'quvchi</option>
                            <option value="teacher">O'qituvchi</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold mb-2 ml-1">Email manzilingiz</label>
                    <input type="email" name="email" value="{{ old('email') }}" required 
                        class="w-full px-4 py-3 border border-gray-200 dark:border-dark-border rounded-2xl bg-gray-50 dark:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-2 ml-1">Parol</label>
                        <input type="password" name="password" required 
                            class="w-full px-4 py-3 border border-gray-200 dark:border-dark-border rounded-2xl bg-gray-50 dark:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2 ml-1">Tasdiqlang</label>
                        <input type="password" name="password_confirmation" required 
                            class="w-full px-4 py-3 border border-gray-200 dark:border-dark-border rounded-2xl bg-gray-50 dark:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-2 ml-1">Davlat</label>
                        <input type="text" name="country" value="{{ old('country') }}" placeholder="Ixtiyoriy"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-dark-border rounded-2xl bg-gray-50 dark:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2 ml-1">Telefon</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Ixtiyoriy"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-dark-border rounded-2xl bg-gray-50 dark:bg-dark-bg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                    </div>
                </div>

                <button type="submit" class="w-full py-4 bg-green-500 hover:bg-green-600 text-white rounded-full font-bold text-lg shadow-lg shadow-green-500/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                    Ro'yxatdan o'tish
                </button>
            </form>

            <div class="mt-8 text-center text-sm">
                <span class="text-gray-500 dark:text-dark-muted">Akkauntingiz bormi?</span>
                <a href="{{ route('login') }}" class="text-green-500 font-bold hover:underline ml-1">Kiring</a>
            </div>
        </div>

        <div class="text-center mt-10">
            <a href="/" class="text-sm font-medium text-gray-500 dark:text-dark-muted hover:text-green-500 transition-colors flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Bosh sahifaga qaytish
            </a>
        </div>
    </div>

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</body>
</html>
