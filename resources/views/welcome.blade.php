<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Goals Getter — Welcome</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'avocado': '#A8C06A',
                        'avocado-light': '#EAF2D6',
                        'forest': '#12391f'
                    },
                    fontFamily: { poppins: ['Poppins','ui-sans-serif','system-ui'], script:['Pacifico'] }
                }
            }
        }
    </script>
    <style>.script{font-family:Pacifico,cursive}</style>
</head>
<body class="bg-avocado-light text-forest font-poppins min-h-screen">
    <header class="bg-avocado px-6 py-4 shadow-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/logo.svg') }}" alt="Goals Getter" class="w-10 h-10 object-contain">
                <div class="text-white font-bold">Goals Getter</div>
            </div>
            <nav class="flex items-center gap-6 text-white/90">
                <a href="/" class="hover:underline">HOME</a>
                <a href="/dashboard" class="hover:underline">DASHBOARD</a>
                <a href="/settings" class="hover:underline">SETTINGS</a>
                <a href="/login" class="px-3 py-1 bg-white/90 text-avocado rounded">LOGIN</a>
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto p-6">
        <section class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start py-12 md:py-20">
            <div class="pt-2 md:pt-6">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight">Achieve your goals. Stay <span class="script text-3xl sm:text-4xl md:text-5xl">productive</span>.</h1>
                <p class="mt-5 md:mt-6 text-forest/85 text-base sm:text-lg md:text-xl max-w-2xl">Track goals, build habits, and increase productivity with simple tools that keep you focused every day.</p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="/dashboard" class="inline-block bg-forest hover:bg-[#0f2e19] text-white px-6 py-3 rounded-lg font-semibold shadow-lg">Start Journey</a>
                    <a href="#about" class="inline-block bg-white/90 text-avocado px-5 py-3 rounded-lg font-medium border border-white/60">Learn More</a>
                </div>
            </div>
            <div class="flex justify-center md:justify-end">
                <div class="w-full max-w-sm bg-avocado-light/70 rounded-xl p-4 md:p-6 shadow-md">
                    <div class="bg-white/90 rounded-lg p-3 md:p-4">
                        <div class="h-40 md:h-44 bg-avocado/30 rounded-md flex items-center justify-center"> 
                            @if (file_exists(public_path('images/hero-custom.png')))
                                <img src="{{ asset('images/hero-custom.png') }}" alt="illustration" class="max-w-full h-32 md:h-36 object-contain">
                            @else
                                <img src="{{ asset('images/group.svg') }}" alt="illustration" class="max-w-full h-32 md:h-36 object-contain">
                            @endif
                        </div>
                        <div class="mt-3 md:mt-4 bg-white rounded-md p-3">
                            <h4 class="font-semibold text-forest">Quick View</h4>
                            <p class="text-sm text-gray-600 mt-2 hidden sm:block">Overview, calendar, and today's quick tasks.</p>
                            <div class="mt-3 flex items-center gap-3">
                                <div class="w-10 h-10 bg-forest/10 rounded-full"></div>
                                <div>
                                    <div class="text-sm font-semibold">Next Habit</div>
                                    <div class="text-xs text-gray-500">Read 20 pages</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="space-y-4">
                <div class="bg-white rounded-xl p-4 shadow">
                    <h4 class="font-semibold">About Us</h4>
                    <p class="text-sm text-gray-600 mt-2">Goalify helps users manage goals, track progress and build positive habits through a simple and modern productivity platform.</p>
                </div>
            </div>
            <div class="md:col-span-2 bg-white rounded-xl p-6 shadow flex gap-4">
                <div class="flex-1">
                    <h3 class="font-bold">Our Story</h3>
                    <p class="text-sm text-gray-600 mt-2">We focus on simple, daily progress and habit formation. Build routines and track what matters.</p>
                </div>
                <div class="w-48">
                      <img src="{{ asset('images/workspace.svg') }}" alt="workspace" class="rounded">
                </div>
            </div>
        </section>

        <section class="mt-10">
            <h3 class="text-xl font-bold">What Users Say</h3>
            <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg p-4 shadow">
                    <div class="text-yellow-400">★★★★★</div>
                    <p class="mt-2 text-gray-700">This platform helped me stay focused and build consistent habits.</p>
                    <div class="mt-3 text-sm text-gray-500">— Racharam</div>
                </div>
                <div class="bg-white rounded-lg p-4 shadow">
                    <div class="text-yellow-400">★★★★★</div>
                    <p class="mt-2 text-gray-700">My productivity increased significantly using Goalify.</p>
                    <div class="mt-3 text-sm text-gray-500">— Amily</div>
                </div>
                <div class="bg-white rounded-lg p-4 shadow">
                    <div class="text-yellow-400">★★★★★</div>
                    <p class="mt-2 text-gray-700">Very easy and useful for daily goals.</p>
                    <div class="mt-3 text-sm text-gray-500">— John</div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
