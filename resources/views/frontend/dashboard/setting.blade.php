@extends('layouts.frontend.app')
@section('title')
    Setting
@endsection
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Setting</li>
@endsection
@section('body')
    <!-- Dashboard Start-->

    <div class="dashboard container">
        <!-- Sidebar -->
        <aside class="col-md-3 nav-sticky dashboard-sidebar">
            <!-- User Info Section -->
            <div class="user-info text-center p-3">
                <img src="{{ asset(auth()->guard('web')->user()->image) }}" alt="User Image" class="rounded-circle mb-2"
                    style="width: 80px; height: 80px; object-fit: cover" />
                <h5 class="mb-0" style="color: #ff6f61">{{ auth()->guard('web')->user()->name }}</h5>
            </div>

            <!-- Sidebar Menu -->
            <div class="list-group profile-sidebar-menu">
                <a href="{{ route('frontend.dashboard.profile.index') }}" class="list-group-item list-group-item-action menu-item" data-section="profile">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="{{ route('frontend.dashboard.notification.index') }}" class="list-group-item list-group-item-action menu-item"
                    data-section="notifications">
                    <i class="fas fa-bell"></i> Notifications
                </a>
                <a href="{{ route('frontend.dashboard.setting.index') }}" class="list-group-item list-group-item-action active menu-item"
                    data-section="settings">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">

            <h2>Setting</h2>
            <form class="settings-form" action="{{ route('frontend.dashboard.setting.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- name --}}
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input name="name" type="text" id="name" value="{{ $user->name }}" />
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- username --}}
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input name="username" type="text" id="username" value="{{ $user->username }}" />
                    @error('username')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- email --}}
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input name="email" type="email" id="email" value="{{ $user->email }}" />
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- phone --}}
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input name="phone" type="string" id="phone" value="{{ $user->phone }}" />
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- image --}}
                <div class="form-group">
                    <label for="profile-image">Profile Image:</label>
                    <input name="image" type="file" id="profile-image" accept="image/*" />
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- country --}}
                <div class="form-group">
                    <label for="country">Country:</label>
                    <input name="country" type="text" id="country" value="{{ $user->country }}" />
                    @error('country')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- city --}}
                <div class="form-group">
                    <label for="city">City:</label>
                    <input name="city" type="text" id="city" value="{{ $user->city }}" />
                    @error('city')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- street --}}
                <div class="form-group">
                    <label for="street">Street:</label>
                    <input name="street" type="text" id="street" value="{{ $user->street }}" />
                    @error('street')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="save-settings-btn">
                    Save Changes
                </button>
            </form>

            <!-- Form to change the password -->
            <form class="change-password-form" method="POST" action="{{ route('frontend.dashboard.setting.changePassword') }}">
                @csrf
                <h2>Change Password</h2>
                <div class="form-group">
                    <label for="current-password">Current Password:</label>
                    <input name="current_password" type="password" id="current-password" placeholder="Enter Current Password" />
                    @error('current_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="new-password">New Password:</label>
                    <input name="password" type="password" id="new-password" placeholder="Enter New Password" />
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm New Password:</label>
                    <input name="password_confirmation" type="password" id="confirm-password" placeholder="Enter Confirm New " />
                </div>
                <button type="submit" class="change-password-btn">
                    Change Password
                </button>
            </form>

        </div>

    </div>
    <br><br>

    <!-- Dashboard End-->
@endsection
