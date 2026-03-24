@extends('layouts.frontend.app')
@section('title')
    {{ $category->name }} Posts
@endsection
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
    <li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection
@section('body')
    <!-- Category Posts Start -->
    <style>
        .post-card-hover { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .post-card-hover:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
        .post-card-hover .card-img-wrapper { overflow: hidden; border-radius: 12px 12px 0 0; }
        .post-card-hover .card-img-top { transition: transform 0.5s ease; }
        .post-card-hover:hover .card-img-top { transform: scale(1.05); }
    </style>
    
    <div class="category-posts pb-5" style="padding-top: 40px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mb-4">
                    <!-- Section Header -->
                    <div class="section-header mb-4 border-bottom pb-3">
                        <h3 class="mb-0 font-weight-bold" style="color: var(--text-dark);">Latest in <span class="text-primary">{{ $category->name }}</span></h3>
                    </div>

                    <div class="row">
                        @forelse ($posts as $post)
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm border-0 h-100 post-card-hover" style="border-radius: 12px;">
                                    <div class="card-img-wrapper" style="height: 200px;">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}" class="d-block w-100 h-100">
                                            <img src="{{ asset($post->images->first()->path) }}" class="card-img-top w-100 h-100" style="object-fit: cover;" alt="{{ $post->title }}" />
                                        </a>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title font-weight-bold mb-2">
                                            <a href="{{ route('frontend.post.show', $post->slug) }}" class="text-dark" title="{{ $post->title }}" style="line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-size: 1.1rem;">
                                                {{ $post->title }}
                                            </a>
                                        </h5>
                                        <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                                            <span class="text-muted small"><i class="far fa-calendar-alt mr-1"></i>{{ $post->created_at->format('M d, Y') }}</span>
                                            <a href="{{ route('frontend.post.show', $post->slug) }}" class="text-primary small font-weight-bold">Read <i class="fas fa-arrow-right ml-1"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-light border shadow-sm text-center py-5" style="border-radius: 12px;">
                                    <i class="fas fa-folder-open text-muted mb-3" style="font-size: 3rem;"></i>
                                    <h5 class="text-secondary font-weight-bold">No Posts Found</h5>
                                    <p class="text-muted mb-0">There are currently no articles in this category. Check back later!</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="sidebar-widget bg-white p-4 shadow-sm border border-light" style="border-radius: 12px;">
                        <h4 class="mb-4 font-weight-bold border-bottom pb-2" style="color: var(--text-dark);">Explore Categories</h4>
                        <div class="list-group list-group-flush">
                            @foreach ($categories as $catItem)
                                <a href="{{ route('frontend.category.posts', $catItem->slug) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 px-0 py-3 {{ $category->id == $catItem->id ? 'text-primary font-weight-bold' : 'text-secondary' }}" style="background-color: transparent;">
                                    <span><i class="fas fa-angle-right mr-2 {{ $category->id == $catItem->id ? 'text-primary' : 'text-muted' }}"></i> {{ $catItem->name }}</span>
                                    @if($category->id == $catItem->id)
                                        <span class="badge badge-primary badge-pill"><i class="fas fa-check"></i></span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Category Posts End -->
@endsection
