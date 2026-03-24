@extends('layouts.frontend.app')
@section('title')
    Search Results
@endsection
@section('body')
    <!-- Search Results Start -->
    <style>
        .post-card-hover { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .post-card-hover:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
        .post-card-hover .card-img-wrapper { overflow: hidden; border-radius: 12px 12px 0 0; }
        .post-card-hover .card-img-top { transition: transform 0.5s ease; }
        .post-card-hover:hover .card-img-top { transform: scale(1.05); }
    </style>

    <div class="search-results pb-5" style="padding-top: 40px;">
        <div class="container">
            <!-- Section Header -->
            <div class="section-header mb-5 border-bottom pb-4 d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="mb-1 font-weight-bold" style="color: var(--text-dark);">
                        <i class="fas fa-search mr-2 text-primary"></i> Search Results
                    </h3>
                    <p class="text-muted mb-0">Found <span class="text-primary font-weight-bold">{{ $posts->total() }}</span> articles matching your query</p>
                </div>
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
                                    <a href="{{ route('frontend.post.show', $post->slug) }}" class="text-primary small font-weight-bold">Read More <i class="fas fa-arrow-right ml-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="bg-light d-inline-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 100px; height: 100px;">
                            <i class="fas fa-search-minus text-muted" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="font-weight-bold text-secondary">No Results Found</h4>
                        <p class="text-muted mx-auto" style="max-width: 400px;">We couldn't find any articles matching your search. Try different keywords or browse our categories.</p>
                        <a href="{{ route('frontend.home') }}" class="btn btn-primary px-4 mt-3 rounded-pill shadow-sm">
                            <i class="fas fa-home mr-2"></i>Back to Home
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
    <!-- Search Results End -->
@endsection
