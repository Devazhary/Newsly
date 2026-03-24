@extends('layouts.frontend.app')
@section('title')
    Profile
@endsection
@section('body')
    <!-- Profile Start -->
    <div class="dashboard container">
        <!-- Sidebar -->
        @include('frontend.dashboard._sidebar', ['profile_active'=>'active'])

        <!-- Main Content -->
        <div class="main-content">
            <!-- Profile Section -->
            <!-- Profile Section -->
            <section id="profile" class="content-section active">
                <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
                    <h3 class="font-weight-bold mb-0" style="color: var(--text-dark);">
                        <i class="fas fa-user-circle mr-2 text-primary"></i> User Profile
                    </h3>
                </div>

                <div class="card shadow-sm border-0 mb-5" style="border-radius: 12px; background: linear-gradient(to right, #ffffff, #f8fafc);">
                    <div class="card-body p-4 d-flex align-items-center">
                        <img src="{{ asset(Auth::guard('web')->user()->image) }}" alt="{{ Auth::guard('web')->user()->name }}"
                            class="rounded-circle shadow-sm border border-white" style="width: 100px; height: 100px; object-fit: cover; border-width: 4px !important;" />
                        <div class="ml-4">
                            <h4 class="font-weight-bold mb-1" style="color: var(--text-dark);">{{ Auth::guard('web')->user()->name }}</h4>
                            <p class="text-muted mb-0"><i class="fas fa-envelope mr-2"></i>{{ Auth::guard('web')->user()->email }}</p>
                        </div>
                    </div>
                </div>

                @if (session()->has('errors'))
                    <div class="alert alert-danger border-0 shadow-sm" style="border-radius: 12px;">
                        <ul class="mb-0 px-3">
                            @foreach (session('errors')->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('frontend.dashboard.profile.post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Add Post Section -->
                    <section id="add-post" class="add-post-section mb-5">
                        <div class="card shadow-sm border-0" style="border-radius: 12px;">
                            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                                <h4 class="font-weight-bold mb-0" style="color: var(--text-dark);"><i class="fas fa-pen-fancy mr-2 text-primary"></i> Create New Post</h4>
                            </div>
                            <div class="card-body p-4">
                                <!-- Post Title -->
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold text-secondary">Post Title</label>
                                    <input name="title" type="text" id="postTitle" class="form-control form-control-lg bg-light border-0" placeholder="Enter an engaging title..." style="border-radius: 8px;" required />
                                </div>

                                <!-- Post Content -->
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold text-secondary">Content</label>
                                    <div class="bg-light rounded" style="border: 1px solid #e2e8f0; padding: 1px;">
                                        <textarea name="description" id="postContent" class="form-control border-0" rows="5" placeholder="What's on your mind?"></textarea>
                                    </div>
                                </div>

                                <!-- Category & Comments Row -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="font-weight-bold text-secondary">Category</label>
                                        <select name="category_id" id="postCategory" class="form-control custom-select bg-light border-0" style="border-radius: 8px; height: 45px;" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-end pb-2">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="commentable" class="custom-control-input" id="enableCommentsSwitch" checked>
                                            <label class="custom-control-label font-weight-bold text-secondary cursor-pointer" for="enableCommentsSwitch" style="padding-top: 2px;">Enable Comments</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image Upload -->
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold text-secondary">Upload Images</label>
                                    <input name="images[]" type="file" id="postImage" class="form-control-file" accept="image/*" multiple />
                                    <div class="tn-slider mt-3">
                                        <div id="imagePreview" class="slick-slider"></div>
                                    </div>
                                </div>

                                <!-- Post Button -->
                                <div class="text-right mt-2">
                                    <button class="btn btn-primary font-weight-bold px-5 rounded-pill shadow-sm" style="height: 45px;">
                                        <i class="fas fa-paper-plane mr-2"></i> Publish Post
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>

                <!-- Show Posts Section -->
                <section id="posts" class="posts-section">
                    <h4 class="font-weight-bold mb-4 pb-2 border-bottom" style="color: var(--text-dark);">
                        <i class="fas fa-history mr-2 text-primary"></i> Your Recent Posts
                    </h4>
                    
                    <div class="post-list">
                        @forelse ($posts as $post)
                            <!-- Post Card -->
                            <div class="card shadow-sm border-0 mb-5" style="border-radius: 12px; overflow: hidden;">
                                <div class="card-body p-4">
                                    <!-- Post Header -->
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset(auth()->guard('web')->user()->image) }}" alt="{{ auth()->guard('web')->user()->name }}"
                                                class="rounded-circle shadow-sm border" style="width: 50px; height: 50px; object-fit: cover;" />
                                            <div class="ml-3">
                                                <h6 class="mb-0 font-weight-bold text-dark" style="font-size: 1.1rem;">{{ auth()->guard('web')->user()->name }}</h6>
                                                <small class="text-muted"><i class="far fa-clock mr-1"></i>{{ $post->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="badge badge-light text-secondary border px-3 py-2 rounded-pill shadow-sm">
                                                <i class="fas fa-eye mr-2 text-primary"></i> {{ $post->num_of_views }} Views
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <!-- Post Title & Content -->
                                    <h4 class="font-weight-bold mb-3 text-dark">{{ $post->title }}</h4>
                                    <div class="post-content mb-4 text-secondary" style="font-size: 1.05rem; line-height: 1.7;">
                                        {!! $post->description !!}
                                    </div>

                                    <!-- Carousel -->
                                    @if($post->images->count() > 0)
                                    <div id="newsCarousel{{ $post->id }}" class="carousel slide mb-4 shadow-sm" data-ride="carousel" style="border-radius: 12px; overflow: hidden;">
                                        <ol class="carousel-indicators">
                                            @foreach ($post->images as $key => $image)
                                                <li data-target="#newsCarousel{{ $post->id }}" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                                            @endforeach
                                        </ol>
                                        <div class="carousel-inner">
                                            @foreach ($post->images as $key => $image)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                    <img src="{{ asset($image->path) }}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="{{ $post->title }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        @if($post->images->count() > 1)
                                        <a class="carousel-control-prev" href="#newsCarousel{{ $post->id }}" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#newsCarousel{{ $post->id }}" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                        @endif
                                    </div>
                                    @endif

                                    <!-- Post Actions -->
                                    <div class="d-flex justify-content-end align-items-center pt-3 border-top mt-2">
                                        <button id="commentBtn_{{ $post->id }}" class="commentBtn btn btn-outline-primary rounded-pill font-weight-bold px-4 mr-2" post_id="{{ $post->id }}">
                                            <i class="far fa-comment-dots mr-2"></i> <span class="d-none d-sm-inline">Comments</span>
                                        </button>

                                        <button id="hideBtn_{{ $post->id }}" class="hideBtn btn btn-primary rounded-pill font-weight-bold px-4 mr-2" post_id="{{ $post->id }}" style="display: none;">
                                            <i class="fas fa-comment-slash mr-2"></i> <span class="d-none d-sm-inline">Hide Comments</span>
                                        </button>

                                        <a href="{{ route('frontend.dashboard.profile.post.show.form', $post->slug) }}" class="btn btn-outline-secondary rounded-pill font-weight-bold px-4 mr-2">
                                            <i class="far fa-edit mr-2"></i> <span class="d-none d-sm-inline">Edit</span>
                                        </a>
                                        
                                        <a href="javascript:void(0)" onclick="if(confirm('Are you sure you want to delete this post? This action cannot be undone.')){ document.getElementById('formDelete{{ $post->id }}').submit() } return false;" class="btn btn-outline-danger rounded-pill font-weight-bold px-4">
                                            <i class="far fa-trash-alt mr-2"></i> <span class="d-none d-sm-inline">Delete</span>
                                        </a>

                                        <form id="formDelete{{ $post->id }}" action="{{ route('frontend.dashboard.profile.post.delete', $post->slug) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>

                                    <!-- Display Comments -->
                                    <div class="comments{{ $post->id }} mt-4 px-3 p-3 bg-light rounded" style="display: none; border: 1px solid #e2e8f0;">
                                        <!-- Comments injected via AJAX -->
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card shadow-sm border-0 text-center py-5" style="border-radius: 12px;">
                                <div class="card-body">
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="fas fa-pen-nib text-muted" style="font-size: 2.5rem;"></i>
                                    </div>
                                    <h5 class="font-weight-bold text-secondary">No Posts Yet</h5>
                                    <p class="text-muted mb-0">You haven't published any articles. Use the form above to create your first post!</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </section>
            </section>
        </div>
    </div>
    <!-- Profile End -->
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            //  initialize with defaults
            $("#postImage").fileinput({
                theme: 'fa5',
                allowedFileTypes: ['image'],
                MaxFileCount: 5,
                showUpload: false,
            });

            //summernote
            $('#postContent').summernote({
                height: 300,
            });
        });

        // get comments
        $(document).on('click', '.commentBtn', function(e) {
            e.preventDefault();
            var post_id = $(this).attr('post_id');

            $.ajax({
                type: 'GET',
                url: "{{ route('frontend.dashboard.profile.post.getComments', ':post_id') }}".replace(
                    ':post_id', post_id),
                success: function(response) {
                    var commentsContainer = $('.comments'+post_id);
                    commentsContainer.empty();
                    
                    if (response.data && response.data.length > 0) {
                        $.each(response.data, function(key, comment) {
                            commentsContainer.append(`
                                <div class="card bg-white shadow-sm border-0 mb-3" style="border-radius: 12px;">
                                    <div class="card-body p-3 d-flex">
                                        <img src="{{ asset('') }}${comment.user.image}" alt="${comment.user.name}" class="rounded-circle mr-3 shadow-sm border" style="width: 45px; height: 45px; object-fit: cover;" />
                                        <div class="comment-content flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <h6 class="mb-0 font-weight-bold text-dark" style="font-size: 1rem;">${comment.user.name}</h6>
                                            </div>
                                            <p class="mb-0 text-secondary" style="font-size: 0.95rem; line-height: 1.6;">${comment.comment}</p>
                                        </div>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        commentsContainer.append('<div class="text-center text-muted p-3"><i class="fas fa-comment-slash d-block mb-2 text-secondary" style="font-size: 2rem;"></i><span class="font-weight-bold">No comments yet.</span></div>');
                    }
                    
                    commentsContainer.slideDown('fast');
                    
                    $('#commentBtn_'+post_id).hide();
                    $('#hideBtn_'+post_id).show();
                },
            });
        });

        //hide button
        $(document).on('click', '.hideBtn', function(e){
            e.preventDefault();
            var post_id = $(this).attr('post_id');

            //hide comments section
            $('.comments'+post_id).slideUp('fast');
            //show commentBtn
            $('#commentBtn_'+post_id).show();
            //hide hideBtn
            $('#hideBtn_'+post_id).hide();
        });
    </script>
@endpush
