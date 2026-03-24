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
        <div class="main-content flex-grow-1">
            <div class="container py-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h3 class="font-weight-bold mb-0" style="color: var(--text-dark);">
                        <i class="fas fa-bell mr-2 text-primary"></i> Notifications
                    </h3>
                    @if(auth('web')->user()->notifications->count() > 0)
                        <a href="{{ route('frontend.dashboard.notification.delete.all') }}" 
                           class="btn btn-sm btn-outline-danger font-weight-bold px-3 rounded-pill"
                           onclick="return confirm('Are you sure you want to delete all notifications?')">
                            <i class="fas fa-trash-alt mr-1"></i> Delete All
                        </a>
                    @endif
                </div>

                <div class="notification-list">
                    @forelse (auth('web')->user()->notifications as $notification)
                        <div class="card shadow-sm border-0 mb-3 overflow-hidden position-relative" 
                             style="border-radius: 12px; transition: all 0.2s ease; cursor: pointer;"
                             onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)';"
                             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 2px rgba(0,0,0,0.05)';">
                            
                            <div class="card-body p-3">
                                <div class="d-flex align-items-start">
                                    <div class="bg-light rounded-circle p-2 mr-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                        <i class="fas fa-comment-dots text-primary" style="font-size: 1.2rem;"></i>
                                    </div>
                                    
                                    <div class="flex-grow-1 pr-5">
                                        <a href="{{ $notification->data['link'] }}?notify={{ $notification->id }}" class="text-decoration-none text-dark">
                                            <p class="mb-1" style="font-size: 0.95rem; line-height: 1.5;">
                                                <span class="font-weight-bold text-primary">{{ $notification->data['user_name'] }}</span> 
                                                commented on your post.
                                            </p>
                                            <div class="bg-light p-2 rounded mb-2 font-italic small text-muted border-left" style="border-width: 3px !important; border-color: var(--primary-color) !important;">
                                                "{{ Str::limit($notification->data['comment'], 50) }}"
                                            </div>
                                            <small class="text-muted"><i class="far fa-clock mr-1"></i>{{ $notification->created_at->diffForHumans() }}</small>
                                        </a>
                                    </div>

                                    <div class="position-absolute" style="top: 15px; right: 15px;">
                                        <form action="{{ route('frontend.dashboard.notification.delete.one') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                                            <button type="submit" class="btn btn-link text-danger p-0 delete-btn" title="Delete notification">
                                                <i class="fas fa-times-circle" style="font-size: 1.2rem;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card shadow-sm border-0 text-center py-5" style="border-radius: 12px;">
                            <div class="card-body">
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <i class="fas fa-bell-slash text-muted" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5 class="font-weight-bold text-secondary">No Notifications Yet</h5>
                                <p class="text-muted">When you get notifications, they'll appear here.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard End-->
@endsection
