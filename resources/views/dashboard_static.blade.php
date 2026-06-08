<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Goals Getter — Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: { 'avocado':'#A8C06A','avocado-light':'#EAF2D6','forest':'#12391f' },
          fontFamily: { poppins:['Poppins','ui-sans-serif','system-ui'] }
        }
      }
    }
  </script>
  <style>
    .score-circle{width:72px;height:72px;border-radius:9999px;background:white;display:flex;align-items:center;justify-content:center;box-shadow:0 6px 18px rgba(0,0,0,0.08)}
  </style>
</head>
<body class="bg-avocado-light font-poppins text-forest min-h-screen">
  <header class="bg-avocado px-6 py-4 shadow-sm">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
      <div class="flex items-center gap-4">
        <img src="{{ asset('images/logo.svg') }}" alt="logo" class="w-10 h-10">
        <div class="font-bold text-white">Goals Getter</div>
      </div>
                        <nav class="flex items-center gap-6 text-white/90">
                                <a href="/" class="hover:underline">HOME</a>
                                <a href="/login" class="hover:underline">USER CENTER</a>
                                <a href="/settings" class="hover:underline">SETTINGS</a>
                                <form method="POST" action="/logout" class="inline">
                                  @csrf
                                  <button type="submit" class="hover:underline text-white/90 bg-transparent">LOGOUT</button>
                                </form>
                        </nav>
    </div>
  </header>

  <main class="max-w-7xl mx-auto p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left column: goals list -->
    <section class="lg:col-span-2 space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white rounded-xl p-4 shadow">
          <h4 class="text-sm text-gray-500">TODAY'S goals</h4>
          <div class="mt-3 flex items-center justify-between">
            <div>
              <h3 class="font-bold">Focus: Design Review</h3>
              <p class="text-xs text-gray-500">Nature & productivity tips</p>
            </div>
            <img src="{{ asset('images/flower.svg') }}" alt="flower" class="w-20 h-20 object-cover rounded">
          </div>
        </div>

        <div class="bg-white rounded-xl p-4 shadow">
          <h4 class="text-sm text-gray-500">ACHIEVEMENT</h4>
          <div class="mt-4 flex items-center justify-between">
            <div>
              <div class="text-2xl font-bold">{{ $achievement ?? '87%' }}</div>
              <div class="text-xs text-gray-400">Productivity Score</div>
            </div>
            <div class="score-circle">{{ $achievement_number ?? '87' }}%</div>
          </div>
        </div>
      </div>

      <!-- Interactive goals spaces -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Study card -->
        <div class="bg-white rounded-lg p-4 shadow">
          <div class="flex items-center justify-between">
            <div>
              <h5 class="font-bold">Study</h5>
              <div class="text-sm text-gray-500">Track exams and assignments.</div>
            </div>
            <svg width="48" height="48" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="18" cy="18" r="16" stroke="#E6E6E6" stroke-width="4"/><circle cx="18" cy="18" r="16" stroke="#A8C06A" stroke-width="4" stroke-dasharray="100" stroke-dashoffset="40" transform="rotate(-90 18 18)"/></svg>
          </div>
          <div class="mt-4">
            <div class="w-full bg-gray-100 h-3 rounded"><div class="h-3 bg-avocado rounded" style="width:60%"></div></div>
          </div>
        </div>

        <!-- Fitness card -->
        <div class="bg-white rounded-lg p-4 shadow">
          <div class="flex items-center justify-between">
            <div>
              <h5 class="font-bold">Fitness</h5>
              <div class="text-sm text-gray-500">Create healthy routines.</div>
            </div>
            <svg width="48" height="48" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="18" cy="18" r="16" stroke="#E6E6E6" stroke-width="4"/><circle cx="18" cy="18" r="16" stroke="#A8C06A" stroke-width="4" stroke-dasharray="100" stroke-dashoffset="20" transform="rotate(-90 18 18)"/></svg>
          </div>
          <div class="mt-4">
            <div class="w-full bg-gray-100 h-3 rounded"><div class="h-3 bg-avocado rounded" style="width:80%"></div></div>
          </div>
        </div>

        <!-- Career card -->
        <div class="bg-white rounded-lg p-4 shadow">
          <div class="flex items-center justify-between">
            <div>
              <h5 class="font-bold">Career</h5>
              <div class="text-sm text-gray-500">Develop your professional skills.</div>
            </div>
            <svg width="48" height="48" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="18" cy="18" r="16" stroke="#E6E6E6" stroke-width="4"/><circle cx="18" cy="18" r="16" stroke="#A8C06A" stroke-width="4" stroke-dasharray="100" stroke-dashoffset="70" transform="rotate(-90 18 18)"/></svg>
          </div>
          <div class="mt-4">
            <div class="w-full bg-gray-100 h-3 rounded"><div class="h-3 bg-avocado rounded" style="width:30%"></div></div>
          </div>
        </div>

        <!-- Financial card -->
        <div class="bg-white rounded-lg p-4 shadow">
          <div class="flex items-center justify-between">
            <div>
              <h5 class="font-bold">Financial</h5>
              <div class="text-sm text-gray-500">Manage saving targets.</div>
            </div>
            <svg width="48" height="48" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="18" cy="18" r="16" stroke="#E6E6E6" stroke-width="4"/><circle cx="18" cy="18" r="16" stroke="#A8C06A" stroke-width="4" stroke-dasharray="100" stroke-dashoffset="55" transform="rotate(-90 18 18)"/></svg>
          </div>
          <div class="mt-4">
            <div class="w-full bg-gray-100 h-3 rounded"><div class="h-3 bg-avocado rounded" style="width:45%"></div></div>
          </div>
        </div>
      </div>

      <!-- Large motivational cards -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-white rounded-lg p-4 shadow col-span-2">
                                        <img src="{{ asset('images/office.svg') }}" alt="office" class="w-full h-36 object-cover rounded">
                                        <p class="mt-3 text-sm text-gray-500">Productivity highlight — build consistent routines and focus sessions.</p>
                                </div>
                                <div class="bg-white rounded-lg p-4 shadow flex items-center justify-center">
                                        <div class="text-center">
                                                <div class="text-sm text-gray-500">Featured</div>
                                                <div class="mt-2 font-bold">Productivity Tip</div>
                                        </div>
                                </div>
                        </div>
    </section>

    <!-- Right column: form and quick actions -->
    <aside class="space-y-6">
      <div class="bg-white rounded-xl p-4 shadow">
        <h4 class="font-bold">Log Quick Task</h4>
        <form method="POST" action="#" class="mt-3 space-y-3">
          <input type="text" name="task" placeholder="What did you complete?" class="w-full px-3 py-2 border rounded" />
          <select name="category" class="w-full px-3 py-2 border rounded">
            <option>Study</option>
            <option>Fitness</option>
            <option>Career</option>
            <option>Financial</option>
          </select>
          <button class="w-full bg-forest text-white py-2 rounded">Add</button>
        </form>
      </div>

      <div class="bg-white rounded-xl p-4 shadow">
        <h5 class="font-bold">Quick Stats</h5>
        <div class="mt-3 grid grid-cols-2 gap-3">
          <div class="p-3 bg-gray-50 rounded text-center">
            <div class="text-sm text-gray-500">Goals</div>
            <div class="font-bold">12</div>
          </div>
          <div class="p-3 bg-gray-50 rounded text-center">
            <div class="text-sm text-gray-500">Habits</div>
            <div class="font-bold">8</div>
          </div>
        </div>
      </div>
    </aside>
  </main>
</body>
</html>