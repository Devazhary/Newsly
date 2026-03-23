@extends('layouts.frontend.app')
@section('title')
    Notification
@endsection
@section('body')
    <!-- Dashboard Start-->
    <div class="dashboard container">
        <!-- Sidebar -->
        @include('frontend.dashboard._sidebar', ['notification_active'=>'active'])

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
                            "{{ substr($notification->data['comment'], 0, 12) }}..."<br>
                            {{ $notification->created_at->diffFOrHumans() }}
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
