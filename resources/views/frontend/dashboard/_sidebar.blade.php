 <!-- Sidebar -->
        <aside class="col-md-3 nav-sticky dashboard-sidebar">
            <!-- User Info Section -->
            <div class="user-info text-center p-3">
                <img src="{{ asset(auth('web')->user()->image) }}" alt="User Image" class="rounded-circle mb-2"
                    style="width: 80px; height: 80px; object-fit: cover" />
                <h5 class="mb-0" style="color: #ff6f61"></h5>
            </div>

            <!-- Sidebar Menu -->
            <div class="list-group profile-sidebar-menu">
                <a href="{{ route('frontend.dashboard.profile.index') }}"
                    class="list-group-item list-group-item-action {{ $profile_active ?? '' }} menu-item" data-section="profile">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="{{ route('frontend.dashboard.notification.index') }}" class="list-group-item list-group-item-action {{ $notification_active ?? '' }} menu-item" data-section="notifications">
                    <i class="fas fa-bell"></i> Notifications
                </a>
                <a href="{{ route('frontend.dashboard.setting.index') }}"
                    class="list-group-item list-group-item-action {{ $settings_active ?? '' }} menu-item" data-section="settings">
                    <i class="fas fa-cog"></i> Settings
                </a>
                {{-- logout --}}
                <a href="javascript:void(0)" onclick="document.getElementById('LogoutForm').submit()"
                    class="list-group-item list-group-item-action menu-item" data-section="settings">
                    <i class="fa fa-power-off" aria-hidden="true"></i> Logout
                </a>
                <form id="LogoutForm" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        </aside>