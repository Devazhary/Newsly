@extends('layouts.frontend.app')
@section('title')
    Notification
@endsection
@section('body')
    <!-- Dashboard Start-->
    <div class="dashboard container">
        <!-- Sidebar -->
        <aside class="col-md-3 nav-sticky dashboard-sidebar">
            <!-- User Info Section -->
            <div class="user-info text-center p-3">
                <img src="{{ asset(auth('web')->user()->image) }}" alt="User Image" class="rounded-circle mb-2"
                    style="width: 80px; height: 80px; object-fit: cover" />
                <h5 class="mb-0" style="color: #ff6f61">{{ auth('web')->user()->name }}</h5>
            </div>

            <!-- Sidebar Menu -->
            <div class="list-group profile-sidebar-menu">
                <a href="{{ route('frontend.dashboard.profile.index') }}"
                    class="list-group-item list-group-item-action menu-item" data-section="profile">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="{{ route('frontend.dashboard.notification.index') }}"
                    class="list-group-item list-group-item-action active menu-item" data-section="notifications">
                    <i class="fas fa-bell"></i> Notifications
                </a>
                <a href="{{ route('frontend.dashboard.setting.index') }}"
                    class="list-group-item list-group-item-action menu-item" data-section="settings">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <div class="container">

                <div class="row">
                    <div class="col-6">
                        <h2 class="mb-4">Notifications</h2>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('frontend.dashboard.notification.delete.all') }}" style="margin-left: 277px" class="btn btn-sm btn-danger">Delete All</a>
                    </div>
                </div>

                @forelse (auth('web')->user()->notifications as $notification)
                    <a href="{{ $notification->data['link'] }}?notify={{ $notification->id }}">
                        <div class="notification alert alert-secondary">
                            <strong>{{ $notification->data['user_name'] }}</strong>comment on your post.<br>
                            "{{ substr($notification->data['comment'], 0, 12) }}..."
                            <div class="float-right">
                                <form action="{{ route('frontend.dashboard.notification.delete.one') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="alert alert-light" role="alert">
                        No Notification Yet
                    </div>
                @endforelse

            </div>
        </div>
    </div>
    <!-- Dashboard End-->
@endsection
