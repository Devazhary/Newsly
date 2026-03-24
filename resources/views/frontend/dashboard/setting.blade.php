@extends('layouts.frontend.app')
@section('title')
    Setting
@endsection
@section('body')
    <!-- Settings Start -->
    <div class="settings pb-5" style="padding-top: 20px;">
        <div class="container">
            <!-- Section Header -->
            <div class="section-header mb-4 pb-3 border-bottom d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="mb-1 font-weight-bold" style="color: var(--text-dark);">
                        <i class="fas fa-cog mr-2 text-primary"></i> Settings
                    </h3>
                    <p class="text-muted mb-0">Manage your profile information and security preferences</p>
                </div>
            </div>

            <div class="row">
                <!-- Profile Settings Card -->
                <div class="col-lg-8 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                            <h5 class="font-weight-bold mb-0 text-dark">Personal Information</h5>
                        </div>
                        <div class="card-body p-4">
                            <form class="settings-form" action="{{ route('frontend.dashboard.setting.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="name" class="font-weight-bold text-secondary text-sm">Full Name</label>
                                            <input name="name" type="text" id="name" class="form-control bg-light border-0 py-4" style="border-radius: 8px;" value="{{ $user->name }}" placeholder="Your full name" />
                                            @error('name') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="username" class="font-weight-bold text-secondary text-sm">Username</label>
                                            <input name="username" type="text" id="username" class="form-control bg-light border-0 py-4" style="border-radius: 8px;" value="{{ $user->username }}" placeholder="Your username" />
                                            @error('username') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="email" class="font-weight-bold text-secondary text-sm">Email Address</label>
                                            <input name="email" type="email" id="email" class="form-control bg-light border-0 py-4" style="border-radius: 8px;" value="{{ $user->email }}" placeholder="Email address" />
                                            @error('email') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="phone" class="font-weight-bold text-secondary text-sm">Phone Number</label>
                                            <input name="phone" type="text" id="phone" class="form-control bg-light border-0 py-4" style="border-radius: 8px;" value="{{ $user->phone }}" placeholder="Your phone number" />
                                            @error('phone') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="profile-image" class="font-weight-bold text-secondary text-sm">Profile Image</label>
                                            <div class="custom-file">
                                                <input name="image" type="file" class="custom-file-input" id="profile-image" accept="image/*">
                                                <label class="custom-file-label border-0 bg-light" for="profile-image" style="border-radius: 8px; padding-top: 10px;">Choose image...</label>
                                            </div>
                                            @error('image') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="country" class="font-weight-bold text-secondary text-sm">Country</label>
                                            <input name="country" type="text" id="country" class="form-control bg-light border-0 py-4" style="border-radius: 8px;" value="{{ $user->country }}" placeholder="Country" />
                                            @error('country') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="city" class="font-weight-bold text-secondary text-sm">City</label>
                                            <input name="city" type="text" id="city" class="form-control bg-light border-0 py-4" style="border-radius: 8px;" value="{{ $user->city }}" placeholder="City" />
                                            @error('city') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="street" class="font-weight-bold text-secondary text-sm">Street</label>
                                            <input name="street" type="text" id="street" class="form-control bg-light border-0 py-4" style="border-radius: 8px;" value="{{ $user->street }}" placeholder="Street" />
                                            @error('street') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 pt-3 border-top d-flex justify-content-end">
                                    <a href="{{ route('frontend.dashboard.profile.index') }}" class="btn btn-outline-secondary px-4 py-2 font-weight-bold rounded-pill mr-2 shadow-sm transition-all hover-lift">
                                        <i class="fas fa-arrow-left mr-2"></i> Back
                                    </a>
                                    <button type="submit" class="btn btn-primary px-5 py-2 font-weight-bold rounded-pill shadow-sm">
                                        <i class="fas fa-check mr-2"></i> Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Security Settings Card -->
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                            <h5 class="font-weight-bold mb-0 text-dark">Security Settings</h5>
                        </div>
                        <div class="card-body p-4">
                            <form class="change-password-form" method="POST" action="{{ route('frontend.dashboard.setting.changePassword') }}">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="current-password" class="font-weight-bold text-secondary text-sm">Current Password</label>
                                    <input name="current_password" type="password" id="current-password" class="form-control bg-light border-0 py-4" style="border-radius: 8px;" placeholder="Current password" />
                                    @error('current_password') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label for="new-password" class="font-weight-bold text-secondary text-sm">New Password</label>
                                    <input name="password" type="password" id="new-password" class="form-control bg-light border-0 py-4" style="border-radius: 8px;" placeholder="New password" />
                                    @error('password') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label for="confirm-password" class="font-weight-bold text-secondary text-sm">Confirm Password</label>
                                    <input name="password_confirmation" type="password" id="confirm-password" class="form-control bg-light border-0 py-4" style="border-radius: 8px;" placeholder="Confirm new password" />
                                </div>
                                <div class="mt-4 pt-4 border-top d-flex gap-2">
                                    <a href="{{ route('frontend.dashboard.profile.index') }}" class="btn btn-outline-secondary btn-block py-2 font-weight-bold rounded-pill shadow-sm transition-all hover-lift mt-0 mr-2">
                                        Back
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold rounded-pill shadow-sm transition-all hover-lift mt-0">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Settings End -->
@endsection
@push('js')
<script>
    // To show file name in custom input
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
@endpush
