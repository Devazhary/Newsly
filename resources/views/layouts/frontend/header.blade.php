<!-- Ultra Compact Modern Sticky Header -->
<div class="compact-header shadow-sm bg-white sticky-top" style="z-index: 1020;">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-white px-0 py-2">
            <!-- Left: Logo -->
            <a href="{{ route('frontend.home') }}" class="navbar-brand m-0 p-0 mr-4">
                <img src="{{ asset($getSetting->logo) }}" alt="Logo" class="d-inline-block align-top" style="max-height: 45px; width: auto; object-fit: contain;" />
            </a>
            
            <button type="button" class="navbar-toggler border-0" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Center & Right: Navigation and Actions -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <!-- Center: Navigation Links -->
                <div class="navbar-nav font-weight-bold mr-auto">
                    <a href="{{ route('frontend.home') }}" class="nav-item nav-link">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
                        <div class="dropdown-menu shadow-sm border-0 m-0" style="border-radius: 8px;">
                            @foreach ($categories as $category)
                                <a href="{{ route('frontend.category.posts', $category->slug) }}" class="dropdown-item py-2">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('frontend.contact.show') }}" class="nav-item nav-link">Contact Us</a>
                </div>
                
                <!-- Right: Search, Notification, Auth -->
                <div class="d-flex align-items-center ml-auto">
                    <!-- Search Form -->
                    <form action="{{ route('frontend.search') }}" method="post" class="mb-0 d-none d-sm-block mr-3" style="min-width: 200px;">
                        @csrf
                        <div class="input-group input-group-sm">
                            <input name="search" type="text" class="form-control border-right-0" placeholder="Search..." style="border-radius: 20px 0 0 20px; box-shadow: none; border-color: #e2e8f0; height: 35px; padding-left: 15px;" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary d-inline-flex align-items-center justify-content-center" style="border-radius: 0 20px 20px 0; height: 35px; min-width: 42px;"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>

                    <!-- User Actions (Notifications & Account) -->
                    <div class="d-flex align-items-center">
                        @auth
                        <!-- Notifications -->
                        <div class="nav-item dropdown mr-3">
                            <a href="#" class="nav-link p-0 position-relative" data-toggle="dropdown" style="color:var(--text-dark);">
                                <i class="fas fa-bell" style="font-size: 1.2rem;"></i>
                                <span id="notify-count" class="badge badge-danger position-absolute" style="top: -6px; right: -8px; font-size: 0.6rem; padding: 0.25em 0.45em; border-radius: 50%;">
                                    {{ auth('web')->user()->unreadNotifications->count() }}
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow-sm border-0 mt-2" style="width: 300px; border-radius: 8px;">
                                <h6 class="dropdown-header font-weight-bold" style="background: #f8fafc; padding: 10px 15px; border-bottom: 1px solid #e2e8f0; border-radius: 8px 8px 0 0;">Notifications</h6>
                                <div id="notify-msg">
                                    @forelse (auth('web')->user()->unreadNotifications->take(5) as $notification)
                                        <div class="dropdown-item d-flex justify-content-between align-items-center border-bottom py-2 px-3" style="white-space: normal; font-size: 0.85rem;">
                                            <span><strong>{{ $notification->data['user_name'] }}</strong> added comment</span>
                                            <a href="{{ $notification->data['link'] }}?notify={{ $notification->id }}" class="btn btn-sm btn-link p-0 text-primary ml-2"><i class="fas fa-eye"></i></a>
                                        </div>
                                    @empty
                                        <div class="dropdown-item text-center py-3 text-muted no-notif">No notifications</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- Account Dropdown -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link p-0 dropdown-toggle font-weight-bold d-flex align-items-center" data-toggle="dropdown" style="color:var(--text-dark);">
                                <div style="width: 28px; height: 28px; border-radius: 50%; background: var(--bg-light-alt); text-align: center; line-height: 28px; margin-right: 6px;">
                                    <i class="fas fa-user-circle" style="color: var(--primary-color); font-size: 1rem;"></i>
                                </div>
                                <span class="d-none d-md-inline">Account</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow-sm border-0 mt-2" style="border-radius: 8px; min-width: 160px;">
                                <a href="{{ route('frontend.dashboard.profile.index') }}" class="dropdown-item py-2 small font-weight-bold"><i class="fas fa-chart-line mr-2 text-muted"></i> Dashboard</a>
                                <div class="dropdown-divider m-0"></div>
                                <a href="javascript:void(0)" class="dropdown-item text-danger py-2 small font-weight-bold" onclick="if(confirm('Are you sure?')){ document.getElementById('logoutForm').submit(); } return false"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
                            </div>
                        </div>
                        <form method="Post" action="{{ route('logout') }}" id="logoutForm" class="d-none">@csrf</form>
                        @endauth

                        @guest
                        <div class="d-flex align-items-center">
                            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary font-weight-bold mr-2 d-inline-flex align-items-center justify-content-center" style="border-radius: 20px; height: 35px; padding: 0 20px;">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-sm btn-primary font-weight-bold d-inline-flex align-items-center justify-content-center" style="border-radius: 20px; height: 35px; padding: 0 20px;">Register</a>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Ultra Compact Modern Sticky Header End -->
