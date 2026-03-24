@extends('layouts.frontend.app')
@section('title')
    Contact Us
@endsection
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
    <li class="breadcrumb-item active">Contact Us</li>
@endsection
@section('body')
    <!-- Contact Start -->
    <div class="contact pb-5" style="padding-top: 40px;">
        <div class="container">
            <!-- Section Header -->
            <div class="section-header mb-5 pb-3 border-bottom d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="mb-1 font-weight-bold" style="color: var(--text-dark);">
                        <i class="fas fa-paper-plane mr-2 text-primary"></i> Contact Us
                    </h3>
                    <p class="text-muted mb-0">Have questions? We'd love to hear from you.</p>
                </div>
            </div>

            <div class="row">
                <!-- Contact Form Card -->
                <div class="col-lg-8 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                            <h5 class="font-weight-bold mb-0 text-dark">Send us a Message</h5>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('frontend.contact.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold text-secondary text-sm">Full Name</label>
                                            <input name="name" type="text" class="form-control bg-light border-0 py-4" style="border-radius: 8px;" placeholder="Your Name" />
                                            @error('name') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold text-secondary text-sm">Email Address</label>
                                            <input name="email" type="email" class="form-control bg-light border-0 py-4" style="border-radius: 8px;" placeholder="Your Email" />
                                            @error('email') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold text-secondary text-sm">Phone Number</label>
                                            <input name="phone" type="text" class="form-control bg-light border-0 py-4" style="border-radius: 8px;" placeholder="Your Phone" />
                                            @error('phone') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold text-secondary text-sm">Subject</label>
                                            <input name="title" type="text" class="form-control bg-light border-0 py-4" style="border-radius: 8px;" placeholder="Subject" />
                                            @error('title') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold text-secondary text-sm">Your Message</label>
                                            <textarea name="body" class="form-control bg-light border-0 py-3" rows="5" style="border-radius: 8px;" placeholder="Message"></textarea>
                                            @error('body') <small class="text-danger font-weight-bold">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 text-right">
                                    <button class="btn btn-primary px-5 py-2 font-weight-bold rounded-pill shadow-sm transition-all hover-lift" type="submit">
                                        <i class="fas fa-paper-plane mr-2"></i> Send Message
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Contact Info Card -->
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm border-0 h-100" style="border-radius: 12px; background: linear-gradient(to bottom, #ffffff, #f8faff);">
                        <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                            <h5 class="font-weight-bold mb-0 text-dark">Get in Touch</h5>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <p class="text-muted mb-4" style="line-height: 1.6;">We're here to help! Whether you have a question about our news, technical issues, or anything else, our team is ready to answer all your questions.</p>

                            <div class="contact-details mb-4">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mr-3 shadow-sm" style="width: 45px; height: 45px; min-width: 45px;">
                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="font-weight-bold mb-0 text-dark">Location</h6>
                                        <p class="text-muted mb-0 text-sm">{{ $getSetting->street }}, {{ $getSetting->city }}, {{ $getSetting->country }}</p>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mb-4">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mr-3 shadow-sm" style="width: 45px; height: 45px; min-width: 45px;">
                                        <i class="fas fa-envelope text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="font-weight-bold mb-0 text-dark">Email Support</h6>
                                        <p class="text-muted mb-0 text-sm">{{ $getSetting->email }}</p>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mr-3 shadow-sm" style="width: 45px; height: 45px; min-width: 45px;">
                                        <i class="fas fa-phone-alt text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="font-weight-bold mb-0 text-dark">Call Us</h6>
                                        <p class="text-muted mb-0 text-sm">{{ $getSetting->phone }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-auto pt-4 border-top">
                                <h6 class="font-weight-bold mb-3 text-dark">Follow us</h6>
                                <div class="social d-flex flex-wrap">
                                    <a href="{{ $getSetting->twitter }}" class="btn btn-light rounded-circle shadow-sm mr-2 mb-2 d-flex align-items-center justify-content-center transition-all hover-primary" style="width: 38px; height: 38px;" title="X"><i class="fab fa-twitter"></i></a>
                                    <a href="{{ $getSetting->facebook }}" class="btn btn-light rounded-circle shadow-sm mr-2 mb-2 d-flex align-items-center justify-content-center transition-all hover-primary" style="width: 38px; height: 38px;" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ $getSetting->instagram }}" class="btn btn-light rounded-circle shadow-sm mr-2 mb-2 d-flex align-items-center justify-content-center transition-all hover-primary" style="width: 38px; height: 38px;" title="Instagram"><i class="fab fa-instagram"></i></a>
                                    <a href="{{ $getSetting->youtube }}" class="btn btn-light rounded-circle shadow-sm mb-2 d-flex align-items-center justify-content-center transition-all hover-primary" style="width: 38px; height: 38px;" title="YouTube"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
