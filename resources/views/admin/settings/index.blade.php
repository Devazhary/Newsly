@extends('layouts.admin.app')
@section('title')
    Edit Settings
@endsection
@section('body')
    <center>
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body shadow mb-4 col-10">
                <h1>Edit Settings</h1>
                
                {{-- 1 - Site Name --}}
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="site_name">Site Name</label>
                            <input value="{{ old('site_name', $getSetting->site_name ?? '') }}" type="text" class="form-control form-control-user"
                                id="site_name" name="site_name" placeholder="Enter Site Name">
                            @error('site_name')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- 2 - Social Media Links --}}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input value="{{ old('facebook', $getSetting->facebook ?? '') }}" type="url" class="form-control form-control-user"
                                id="facebook" name="facebook" placeholder="https://facebook.com/...">
                            @error('facebook')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input value="{{ old('instagram', $getSetting->instagram ?? '') }}" type="url" class="form-control form-control-user"
                                id="instagram" name="instagram" placeholder="https://instagram.com/...">
                            @error('instagram')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- 4 - Social Media Links (continued) --}}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="twitter">Twitter</label>
                            <input value="{{ old('twitter', $getSetting->twitter ?? '') }}" type="url" class="form-control form-control-user"
                                id="twitter" name="twitter" placeholder="https://twitter.com/...">
                            @error('twitter')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="youtube">YouTube</label>
                            <input value="{{ old('youtube', $getSetting->youtube ?? '') }}" type="url" class="form-control form-control-user"
                                id="youtube" name="youtube" placeholder="https://youtube.com/...">
                            @error('youtube')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- 5 - Address Information --}}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input value="{{ old('country', $getSetting->country ?? '') }}" type="text" class="form-control form-control-user"
                                id="country" name="country" placeholder="Enter Country">
                            @error('country')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input value="{{ old('city', $getSetting->city ?? '') }}" type="text" class="form-control form-control-user"
                                id="city" name="city" placeholder="Enter City">
                            @error('city')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- 6 - Street Address --}}
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="street">Street Address</label>
                            <input value="{{ old('street', $getSetting->street ?? '') }}" type="text" class="form-control form-control-user"
                                id="street" name="street" placeholder="Enter Street Address">
                            @error('street')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- 7 - Contact Information --}}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input value="{{ old('email', $getSetting->email ?? '') }}" type="email" class="form-control form-control-user"
                                id="email" name="email" placeholder="Enter Email">
                            @error('email')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input value="{{ old('phone', $getSetting->phone ?? '') }}" type="tel" class="form-control form-control-user"
                                id="phone" name="phone" placeholder="Enter Phone Number">
                            @error('phone')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- 8 - Logo & Favicon --}}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" class="form-control form-control-user" id="logo" name="logo" accept="image/*">
                            @error('logo')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="favicon">Favicon</label>
                            <input type="file" class="form-control form-control-user" id="favicon" name="favicon" accept="image/*">
                            @error('favicon')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <input type="hidden" name="setting_id" value="{{ $getSetting->id}}">
                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update Settings</button>
                    </div>
                </div>
            </div>
        </form>
    </center>
@endsection