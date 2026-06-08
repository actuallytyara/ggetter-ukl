@extends('layout')

@section('title','GoalsGetter — Home')

@section('content')
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <h1 class="display-5 fw-bold">Bring focus to your goals. Ship better habits.</h1>
          <p class="lead text-muted">A clean, minimal productivity app to manage goals, habits, and daily tasks — inspired by Notion and Trello.</p>
          <div class="mt-4">
            <a href="{{ route('register') }}" class="btn btn-success btn-lg me-2">Get Started</a>
            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">Login</a>
          </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
          <div class="card shadow-sm">
            <div class="card-body mock-ui p-4">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <strong>Today's Progress</strong>
                <small class="text-muted">70%</small>
              </div>
              <div class="progress mb-3" style="height:10px;"><div class="progress-bar bg-success" role="progressbar" style="width:70%"></div></div>
              <div class="row g-3">
                <div class="col-4 text-center"><h5 class="mb-0">3</h5><small class="text-muted">Tasks</small></div>
                <div class="col-4 text-center"><h5 class="mb-0">2</h5><small class="text-muted">Habits</small></div>
                <div class="col-4 text-center"><h5 class="mb-0">1</h5><small class="text-muted">Goals</small></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="features" class="py-5">
    <div class="container">
      <h2 class="h3 mb-4">Features</h2>
      <div class="row g-3">
        <div class="col-md-3">
          <div class="card h-100 border-0 shadow-sm p-3">
            <h5>Goal Management</h5>
            <p class="text-muted small">Define long-term goals and break them into subgoals and tasks.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card h-100 border-0 shadow-sm p-3">
            <h5>Habit Tracker</h5>
            <p class="text-muted small">Streaks, reminders and habit insights to stay consistent.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card h-100 border-0 shadow-sm p-3">
            <h5>Tasks & Scheduling</h5>
            <p class="text-muted small">Plan your day and sync with deadlines.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card h-100 border-0 shadow-sm p-3">
            <h5>Analytics</h5>
            <p class="text-muted small">Weekly progress and productivity scoring.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <h2 class="h3 mb-4">Goal Categories</h2>
      <div class="d-flex flex-wrap gap-2">
        @foreach(['Health','Career','Personal','Learning','Finance'] as $cat)
          <span class="badge rounded-pill bg-white border text-muted px-3 py-2">{{ $cat }}</span>
        @endforeach
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      <h2 class="h3 mb-4">Statistics</h2>
      <div class="row g-3">
        <div class="col-md-4"><div class="card p-3 shadow-sm">Active Users <div class="fs-4 fw-bold">1.2k</div></div></div>
        <div class="col-md-4"><div class="card p-3 shadow-sm">Goals Created <div class="fs-4 fw-bold">4.8k</div></div></div>
        <div class="col-md-4"><div class="card p-3 shadow-sm">Habits Tracked <div class="fs-4 fw-bold">12k</div></div></div>
      </div>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container">
      <h2 class="h3 mb-4">Testimonials</h2>
      <div class="row g-3">
        <div class="col-md-6">
          <blockquote class="blockquote p-3 border-start">
            <p>"Clean and simple — helped me build a morning routine."</p>
            <footer class="blockquote-footer">S. Engineer</footer>
          </blockquote>
        </div>
        <div class="col-md-6">
          <blockquote class="blockquote p-3 border-start">
            <p>"Love the habit streaks and weekly score."</p>
            <footer class="blockquote-footer">A. Product Manager</footer>
          </blockquote>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 text-center">
    <div class="container">
      <h3>Ready to reach your goals?</h3>
      <a href="{{ route('register') }}" class="btn btn-success btn-lg mt-3">Create an account</a>
    </div>
  </section>

@endsection
