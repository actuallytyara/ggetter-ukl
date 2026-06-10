@extends('layout')

@section('title','Dashboard — GoalsGetter')

@section('content')
  <div class="row">
    <div class="col-lg-3 mb-3">
      <div class="card shadow-sm sticky-top">
        <div class="card-body">
          <h5 class="card-title">Hello, {{ Auth::user()->name ?? Auth::user()->email }}</h5>
          <p class="text-muted small">Welcome back — here's your overview for today.</p>
          <hr>
          <nav class="nav flex-column">
            <a class="nav-link" href="#tasks">Today's Tasks</a>
            <a class="nav-link" href="#goals">Goals</a>
            <a class="nav-link" href="#habits">Habits</a>
            <a class="nav-link" href="#progress">Weekly</a>
          </nav>
        </div>
      </div>
    </div>

    <div class="col-lg-9">
      <div class="row g-3 mb-3">
        <div class="col-md-6">
          <div class="card p-3 shadow-sm">
            <h6>Today's Tasks</h6>
            @if(!empty($tasks) && count($tasks))
              <ul class="list-group list-group-flush">
                @foreach($tasks as $task)
                  <li class="list-group-item d-flex justify-content-between align-items-center">{{ $task->title }} <span class="badge bg-secondary">{{ $task->due ?? '' }}</span></li>
                @endforeach
              </ul>
            @else
              <div class="p-3 text-muted">No tasks for today — enjoy your focus time.</div>
            @endif
          </div>
        </div>

        <div class="col-md-6">
          <div class="card p-3 shadow-sm">
            <h6>Active Goals</h6>
            @if(!empty($goals) && count($goals))
              <ul class="list-group list-group-flush">
                @foreach($goals as $goal)
                  <li class="list-group-item">{{ $goal->title }} <div class="small text-muted">{{ $goal->progress ?? 0 }}% complete</div></li>
                @endforeach
              </ul>
            @else
              <div class="p-3 text-muted">No active goals. Create one to get started.</div>
            @endif
          </div>
        </div>
      </div>

      <div class="row g-3">
        <div class="col-md-6">
          <div class="card p-3 shadow-sm">
            <h6>Habit Tracker</h6>
            @if(!empty($habits) && count($habits))
              @foreach($habits as $habit)
                <div class="d-flex justify-content-between py-2 border-bottom"><div>{{ $habit->name }}</div><div class="text-muted">{{ $habit->streak ?? 0 }}d</div></div>
              @endforeach
            @else
              <div class="p-3 text-muted">No habits yet — add a habit to start tracking.</div>
            @endif
          </div>
        </div>

        <div class="col-md-6">
          <div class="card p-3 shadow-sm">
            <h6>Productivity Score</h6>
            <div class="display-6 fw-bold">{{ $productivityScore ?? '—' }}</div>
            <div class="mt-3">Weekly Progress</div>
            @if(!empty($weekly) && is_array($weekly))
              <div class="d-flex gap-2 mt-2">
                @foreach($weekly as $day => $val)
                  <div class="flex-fill text-center">
                    <div class="bg-light p-2 rounded">{{ $val }}%</div>
                    <small class="text-muted">{{ $day }}</small>
                  </div>
                @endforeach
              </div>
            @else
              <div class="text-muted">No weekly data yet.</div>
            @endif
          </div>
        </div>
      </div>

      <div class="mt-3">
        <div class="card p-3 shadow-sm">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <strong>Upcoming Goals</strong>
              <div class="text-muted small">Plan ahead and prioritize</div>
            </div>
            <div class="text-end">"Small daily improvements lead to stunning results." — James Clear</div>
          </div>
          @if(!empty($upcoming) && count($upcoming))
            <ul class="list-group list-group-flush mt-3">
              @foreach($upcoming as $g)
                <li class="list-group-item">{{ $g->title }} <small class="text-muted">{{ $g->due ?? '' }}</small></li>
              @endforeach
            </ul>
          @else
            <div class="p-3 text-muted">No upcoming goals. Create milestones to stay on track.</div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
