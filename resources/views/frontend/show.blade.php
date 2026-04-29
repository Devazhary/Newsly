@extends('layouts.frontend.app')
@section('title')
    {{ $mainPost->title }}
@endsection
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('frontend.category.posts', $category->slug) }}">{{ $category->name }}</a>
    </li>
    <li class="breadcrumb-item active">{{ $mainPost->title }}</li>
@endsection
@section('body')
    <!-- Single News Start-->
    <div class="single-news">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 mb-5">
                    <!-- Post Header -->
                    <div class="post-header mb-4">
                        <h1 class="font-weight-bold" style="font-size: 2.2rem; line-height: 1.3; color: var(--text-dark);">{{ $mainPost->title }}</h1>
                        <div class="d-flex align-items-center mt-3 pb-3 border-bottom">
                            <img src="{{ asset($mainPost->user->image ?? 'uploads/users/admin.png') }}" class="rounded-circle shadow-sm" alt="{{ $mainPost->user_id == null ? $mainPost->admin->name : $mainPost->user->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                            <div class="ml-3">
                                <h6 class="mb-0 font-weight-bold text-primary" style="font-size: 1.1rem;">{{ $mainPost->user_id == null ? $mainPost->admin->name : $mainPost->user->name }}</h6>
                                <small class="text-muted"><i class="far fa-calendar-alt mr-1"></i>{{ $mainPost->created_at->format('M d, Y') }}</small>
                            </div>
                        </div>
                    </div>

                    <!-- Carousel -->
                    <div id="newsCarousel" class="carousel slide mb-4 rounded shadow-sm overflow-hidden" data-ride="carousel" style="border-radius: 12px !important;">
                        <ol class="carousel-indicators">
                            @foreach ($mainPost->images as $index => $image)
                                <li data-target="#newsCarousel" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($mainPost->images as $index => $image)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img class="d-block w-100" style="object-fit: cover; height: 450px;" src="{{ asset($image->path) }}" alt="Slide {{ $index + 1 }}">
                                    <div class="carousel-caption d-none d-md-block" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); bottom: 0; left: 0; right: 0; padding-bottom: 30px;">
                                        <h5 class="text-white">{{ $mainPost->title }}</h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: drop-shadow(0 0 4px rgba(0,0,0,0.5));"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true" style="filter: drop-shadow(0 0 4px rgba(0,0,0,0.5));"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    
                    <!-- Post Description -->
                    <div class="sn-content bg-white p-4 rounded shadow-sm mb-5" style="font-size: 1.1rem; line-height: 1.8; color: var(--text-dark);">
                        {!! $mainPost->description !!}
                    </div>

                    <!-- Comment Section -->
                    <div class="comment-section mb-5">
                        <h3 class="mb-4 font-weight-bold border-bottom pb-2" style="color: var(--text-dark);">Comments <span class="badge badge-primary badge-pill" style="font-size: 0.9rem;">{{ $mainPost->comments->count() }}</span></h3>

                        <!-- Comment Input -->
                        @if ($mainPost->commentable == true)
                            @auth
                                <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                                    <div class="card-body p-4">
                                        <form id="commentForm">
                                            @csrf
                                            <div class="d-flex">
                                                <img src="{{ asset(auth()->guard('web')->user()->image) }}" class="rounded-circle mr-3 shadow-sm" alt="{{ auth()->guard('web')->user()->name }}" style="width: 45px; height: 45px; object-fit: cover;">
                                                <div class="flex-grow-1">
                                                    <div class="input-group">
                                                        <input name="comment" type="text" class="form-control" placeholder="Add a comment..." id="commentBox" style="border-radius: 25px 0 0 25px; border-color: #e2e8f0; height: 45px; padding-left: 20px; box-shadow: none;" required />
                                                        <input type="hidden" name="post_id" value="{{ $mainPost->id }}">
                                                        <input type="hidden" name="user_id" value="{{ auth()->guard('web')->user()->id }}">
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-primary px-4 font-weight-bold" style="border-radius: 0 25px 25px 0; height: 45px;"><i class="fas fa-paper-plane mr-2"></i>Post</button>
                                                        </div>
                                                    </div>
                                                    <div id="errorMsg" class="text-danger mt-2 ml-3" style="display: none; font-size: 0.85rem;"></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-light border shadow-sm mb-4 d-flex align-items-center" style="border-radius: 12px;">
                                    <i class="fas fa-info-circle text-primary mr-3" style="font-size: 1.5rem;"></i>
                                    <div>
                                        <h6 class="mb-1 font-weight-bold">Join the Conversation</h6>
                                        <p class="mb-0 text-muted small">Please <a href="{{ route('login') }}" class="font-weight-bold text-primary">log in</a> or <a href="{{ route('register') }}" class="font-weight-bold text-primary">register</a> to add a comment.</p>
                                    </div>
                                </div>
                            @endauth
                        @else
                            <div class="alert alert-secondary border-0 shadow-sm mb-4" style="border-radius: 12px;">
                                <i class="fas fa-lock mr-2"></i> Comments are disabled for this post.
                            </div>
                        @endif

                        <!-- Display Comments -->
                        <div class="comments">
                            @foreach ($mainPost->comments->take(5) as $comment)
                                <div class="comment card shadow-sm border-0 mb-3" style="border-radius: 12px;">
                                    <div class="card-body p-3 d-flex">
                                        <img src="{{ asset($comment->user->image) }}" alt="{{ $comment->user->name }}" class="rounded-circle mr-3 shadow-sm border" style="width: 45px; height: 45px; object-fit: cover;" />
                                        <div class="comment-content flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <h6 class="username mb-0 font-weight-bold text-dark" style="font-size: 1rem;">{{ $comment->user->name }}</h6>
                                                <small class="text-muted"><i class="far fa-clock mr-1"></i>{{ $comment->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="comment-text mb-0 text-secondary" style="font-size: 0.95rem; line-height: 1.6;">{{ $comment->comment }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Show More Button -->
                        @if ($mainPost->comments->count() > 5)
                            <div class="text-center mt-4 mb-2">
                                <button id="showMoreBtn" class="btn btn-outline-primary font-weight-bold px-4 rounded-pill" style="height: 40px;">
                                    <i class="fas fa-chevron-down mr-2"></i>Load more comments
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- Related News -->
                    <div class="sn-related">
                        <h2>Related News</h2>
                        <div class="row sn-slider">
                            @foreach ($posts_belong_to_category as $post)
                                <div class="col-md-4">
                                    <div class="sn-img">
                                        <img height="180" width="255" src="{{ asset($post->images->first()->path) }}"
                                            class="img-fluid" alt="{{ $post->title }}" />
                                        <div class="sn-title">
                                            <a href="{{ route('frontend.post.show', $post->slug) }}"
                                                title="{{ $post->title }}">{{ $post->title }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">In This Category</h2>
                            <div class="news-list">

                                @foreach ($posts_belong_to_category as $post)
                                    <div class="nl-item">
                                        <div class="nl-img">
                                            <img height="80" width="120"
                                                src="{{ asset($post->images->first()->path) }}" />
                                        </div>
                                        <div class="nl-title">
                                            <a href="{{ route('frontend.post.show', $post->slug) }}"
                                                title="{{ $post->title }}">{{ $post->title }}</a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <div class="tab-news">
                                <ul class="nav nav-pills nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#Latest">Latest</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#popular">Popular</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div id="Latest" class="container tab-pane active">
                                        @foreach ($latest_posts as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img height="80" width="120"
                                                        src="{{ asset($post->images->first()->path) }}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a href="{{ route('frontend.post.show', $post->slug) }}"
                                                        title="{{ $post->title }}">{{ $post->title }}</a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div id="popular" class="container tab-pane fade">
                                        @foreach ($popular_posts as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img height="80" width="120"
                                                        src="{{ asset($post->images->first()->path) }}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a href="{{ route('frontend.post.show', $post->slug) }}"
                                                        title="{{ $post->title }}">{{ $post->title }}</a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="sidebar-widget">
                <div class="image">
                  <a href="https://htmlcodex.com"
                    ><img src="img/ads-2.jpg" alt="Image"
                  /></a>
                </div>
              </div> --}}

                        <div class="sidebar-widget">
                            <h2 class="sw-title">News Category</h2>
                            <div class="category">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li><a href="{{ route('frontend.category.posts', $category->slug) }}"
                                                title="{{ $category->name }}">{{ $category->name }}</a><span>({{ $category->posts->count() }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        {{-- <div class="sidebar-widget">
                <div class="image">
                  <a href="https://htmlcodex.com"
                    ><img src="img/ads-2.jpg" alt="Image"
                  /></a>
                </div>
              </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single News End-->
@endsection
@push('js')
    <script>
        // get all comments
        $(document).on('click', '#showMoreBtn', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('frontend.post.getAllComments', $mainPost->slug) }}",
                type: 'GET',
                success: function(data) {
                    $('.comments').empty();
                    $('#showMoreBtn').hide();
                    $.each(data, function(key, comment) {
                        $('.comments').append(`
                                <div class="comment card shadow-sm border-0 mb-3" style="border-radius: 12px;">
                                    <div class="card-body p-3 d-flex">
                                        <img src="${comment.user.image}" alt="${comment.user.name}" class="rounded-circle mr-3 shadow-sm border" style="width: 45px; height: 45px; object-fit: cover;" />
                                        <div class="comment-content flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <h6 class="username mb-0 font-weight-bold text-dark" style="font-size: 1rem;">${comment.user.name}</h6>
                                            </div>
                                            <p class="comment-text mb-0 text-secondary" style="font-size: 0.95rem; line-height: 1.6;">${comment.comment}</p>
                                        </div>
                                    </div>
                                </div>
                      `);
                    });
                },
                error: function(data) {},
            });
        });

        // add Comment
        $(document).on('submit', '#commentForm', function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);

            $('#commentBox').val('');

            $.ajax({
                url: "{{ route('frontend.post.comments.store') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#errorMsg').hide();
                    $('.comments').prepend(`
                                <div class="comment card shadow-sm border-0 mb-3" style="border-radius: 12px;">
                                    <div class="card-body p-3 d-flex">
                                        <img src="{{ asset('') }}${data.comment.user.image}" alt="${data.comment.user.name}" class="rounded-circle mr-3 shadow-sm border" style="width: 45px; height: 45px; object-fit: cover;" />
                                        <div class="comment-content flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <h6 class="username mb-0 font-weight-bold text-dark" style="font-size: 1rem;">${data.comment.user.name}</h6>
                                                <small class="text-muted"><i class="far fa-clock mr-1"></i>Just now</small>
                                            </div>
                                            <p class="comment-text mb-0 text-secondary" style="font-size: 0.95rem; line-height: 1.6;">${data.comment.comment}</p>
                                        </div>
                                    </div>
                                </div>
                    `);
                },
                error: function(data) {
                    var response = $.parseJSON(data.responseText);
                    $('#errorMsg').text(response.message).show();
                },
            });

        });
    </script>
@endpush
