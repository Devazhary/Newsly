<!-- Sidebar Container -->
<aside class="col-md-3">
    <div class="dashboard-sidebar bg-white shadow-sm border-0 rounded overflow-hidden" style="border-radius: 12px; position: sticky; top: 100px;">
        <!-- User Info Section -->
        <div class="user-info text-center p-4 border-bottom" style="background: linear-gradient(to bottom, #f8fafc, #ffffff);">
            <div class="position-relative d-inline-block mb-3">
                <img src="{{ asset(auth('web')->user()->image) }}" alt="{{ auth('web')->user()->name }}" class="rounded-circle shadow-sm border border-white"
                    style="width: 100px; height: 100px; object-fit: cover; border-width: 4px !important;" />
                <div class="position-absolute" style="bottom: 5px; right: 5px;">
                    <span class="badge badge-success border border-white rounded-circle p-2" title="Online" style="width: 12px; height: 12px;"></span>
                </div>
            </div>
            <h6 class="text-muted small mb-1">Welcome back,</h6>
            <h5 class="font-weight-bold mb-0" style="color: var(--text-dark);">{{ auth('web')->user()->name }}</h5>
        </div>

        <!-- Sidebar Menu -->
        <div class="list-group list-group-flush profile-sidebar-menu">
            <style>
                .profile-sidebar-menu .menu-item {
                    border: 0;
                    padding: 14px 24px;
                    font-weight: 600;
                    font-size: 0.95rem;
                    color: var(--text-muted);
                    transition: all 0.2s ease;
                }
                .profile-sidebar-menu .menu-item:hover {
                    background-color: var(--bg-light);
                    color: var(--primary-color);
                    padding-left: 28px;
                }
                .profile-sidebar-menu .menu-item.active {
                    background-color: #eff6ff !important;
                    color: var(--primary-color) !important;
                    border-left: 4px solid var(--primary-color);
                }
                .profile-sidebar-menu .menu-item i {
                    width: 24px;
                    font-size: 1.1rem;
                    margin-right: 12px;
                    transition: 0.2s;
                }
                .profile-sidebar-menu .menu-item:hover i {
                    transform: scale(1.1);
                    color: var(--primary-color);
                }
                .profile-sidebar-menu .menu-item.active i {
                    color: var(--primary-color);
                }
                .profile-sidebar-menu .logout-item:hover {
                    background-color: #fef2f2;
                    color: #dc2626 !important;
                }
            </style>

            <a href="{{ route('frontend.dashboard.profile.index') }}"
                class="list-group-item list-group-item-action {{ $profile_active ?? '' }} menu-item d-flex align-items-center">
                <i class="fas fa-user-circle"></i> Profile
            </a>
            
            <a href="{{ route('frontend.dashboard.notification.index') }}" 
                class="list-group-item list-group-item-action {{ $notification_active ?? '' }} menu-item d-flex align-items-center">
                <i class="fas fa-bell"></i> Notifications
                @if(auth('web')->user()->unreadNotifications->count() > 0)
                    <span class="badge badge-primary badge-pill ml-auto">{{ auth('web')->user()->unreadNotifications->count() }}</span>
                @endif
            </a>
            
            <a href="{{ route('frontend.dashboard.setting.index') }}"
                class="list-group-item list-group-item-action {{ $settings_active ?? '' }} menu-item d-flex align-items-center">
                <i class="fas fa-cog"></i> Settings
            </a>

            <div class="border-top my-1"></div>
            
            <a href="javascript:void(0)" onclick="if(confirm('Are you sure?')){ document.getElementById('LogoutForm').submit() }"
                class="list-group-item list-group-item-action menu-item logout-item d-flex align-items-center text-danger">
                <i class="fas fa-power-off"></i> Logout
            </a>
            
            <form id="LogoutForm" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</aside>