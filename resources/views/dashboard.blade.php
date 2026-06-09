@extends('layout')

@section('title','Dashboard — GoalsGetter')

@section('content')
  <div class="row">
    <div class="col-lg-3 mb-3">
      <div class="card shadow-sm sticky-top">
        <div class="card-body">
          <h5 class="card-title">Hello, {{ session('user_name') ?? session('user_email') ?? 'Guest' }}</h5>
          <p class="text-muted small">Welcome back — here's your productivity overview.</p>
          <hr>
          <nav class="nav flex-column">
            <a class="nav-link" href="#summary">Overview</a>
            <a class="nav-link" href="#tasks">Tasks</a>
            <a class="nav-link" href="#goals">Goals</a>
            <a class="nav-link" href="#habits">Habits</a>
            <a class="nav-link" href="#analytics">Analytics</a>
          </nav>
        </div>
      </div>
    </div>

    <div class="col-lg-9">
      <div id="summary" class="row g-3 mb-4">
        <div class="col-md-3">
          <div class="card p-3 shadow-sm text-center">
            <div class="text-muted small">Goals</div>
            <div class="display-6 fw-bold">{{ $goals->count() }}</div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card p-3 shadow-sm text-center">
            <div class="text-muted small">Habits</div>
            <div class="display-6 fw-bold">{{ $habits->count() }}</div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card p-3 shadow-sm text-center">
            <div class="text-muted small">Tasks</div>
            <div class="display-6 fw-bold">{{ $tasks->count() }}</div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card p-3 shadow-sm text-center">
            <div class="text-muted small">Productivity</div>
            <div class="display-6 fw-bold">{{ $productivityScore }}%</div>
          </div>
        </div>
      </div>

      <div id="tasks" class="card mb-4 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h5 class="card-title mb-0">Today's Tasks</h5>
              <p class="text-muted small mb-0">Track your scheduled work and completion status.</p>
            </div>
            <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-success">Manage Tasks</a>
          </div>

          @if($tasks->count())
            <div class="table-responsive">
              <table class="table table-borderless mb-0">
                <thead>
                  <tr>
                    <th>Task</th>
                    <th>Due</th>
                    <th>Priority</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($tasks->take(5) as $task)
                    <tr>
                      <td>{{ $task->judul }}</td>
                      <td>{{ $task->tanggal ? \Illuminate\Support\Carbon::parse($task->tanggal)->format('M d, Y') : 'No date' }}</td>
                      <td>{{ ucfirst($task->priority) }}</td>
                      <td>{{ ucfirst($task->status) }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="p-3 text-muted">No tasks scheduled yet. Add a task to keep your day on track.</div>
          @endif
        </div>
      </div>

      <div id="goals" class="card mb-4 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h5 class="card-title mb-0">Goal Management</h5>
              <p class="text-muted small mb-0">Review your active goals and overall progress.</p>
            </div>
            <a href="{{ route('goals.index') }}" class="btn btn-sm btn-success">Manage Goals</a>
          </div>

          @if($goals->count())
            <ul class="list-group list-group-flush">
              @foreach($goals as $goal)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <div>
                    <strong>{{ $goal->title }}</strong>
                    <div class="small text-muted">{{ $goal->category }} · {{ \Illuminate\Support\Str::limit($goal->description, 80) }}</div>
                  </div>
                  <span class="badge bg-success">{{ $goal->progress }}%</span>
                </li>
              @endforeach
            </ul>
          @else
            <div class="p-3 text-muted">No goals created yet.</div>
          @endif
        </div>
      </div>

      <div id="habits" class="card mb-4 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h5 class="card-title mb-0">Habit Tracker</h5>
              <p class="text-muted small mb-0">Stay consistent with your daily and weekly habits.</p>
            </div>
            <a href="{{ route('habits.index') }}" class="btn btn-sm btn-success">View Habits</a>
          </div>

          @if($habits->count())
            @foreach($habits as $habit)
              <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                <div>
                  <strong>{{ $habit->nama }}</strong>
                  <div class="small text-muted">{{ ucfirst($habit->frekuensi) }} habit</div>
                </div>
                <span class="badge bg-primary">{{ ucfirst($habit->status) }}</span>
              </div>
            @endforeach
          @else
            <div class="p-3 text-muted">No habits found. Create one to begin building consistency.</div>
          @endif
        </div>
      </div>

      <div id="analytics" class="row g-3">
        <div class="col-lg-8">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Weekly Analytics</h5>
              <p class="text-muted small">See how your task load changes throughout the week.</p>
              <div class="d-flex gap-2 mt-3">
                @foreach($weekly as $day => $value)
                  <div class="flex-fill text-center">
                    <div class="bg-light rounded py-3">{{ $value }}%</div>
                    <small class="text-muted">{{ $day }}</small>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Upcoming</h5>
              @if($upcoming->count())
                <ul class="list-group list-group-flush">
                  @foreach($upcoming as $task)
                    <li class="list-group-item">
                      <div>{{ $task->judul }}</div>
                      <small class="text-muted">Due {{ $task->tanggal ? \Illuminate\Support\Carbon::parse($task->tanggal)->format('M d') : 'No date' }}</small>
                    </li>
                  @endforeach
                </ul>
              @else
                <div class="p-3 text-muted">No upcoming tasks or goals found.</div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
