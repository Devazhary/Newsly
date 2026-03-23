@extends('layouts.frontend.app')
@section('title')
    Home
@endsection
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
@endsection
@section('body')

<style>
    /* Modern News Magazine Custom Styles */
    :root {
        --color-primary: #2563eb; /* Professional Blue */
        --color-dark: #111827; /* Deep Navy */
        --color-gray: #4b5563; /* Slate */
        --color-light: #f3f4f6;
        --color-white: #ffffff;
        --radius-lg: 12px;
        --radius-md: 8px;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
        --shadow-hover: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
        background-color: #f8fafc;
    }

    /* Shared Card Styles */
    .news-card {
        position: relative;
        border-radius: var(--radius-lg);
        overflow: hidden;
        background: var(--color-white);
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        display: flex;
        flex-direction: column;
        height: 100%;
        border: 1px solid rgba(0,0,0,0.03);
    }
    
    .news-card:hover {
        box-shadow: var(--shadow-hover);
        transform: translateY(-4px);
    }

    .news-card .img-wrapper {
        position: relative;
        overflow: hidden;
        width: 100%;
        padding-top: 60%; /* Aspect ratio 16:9 */
    }

    .news-card .img-wrapper img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    }

    .news-card:hover .img-wrapper img {
        transform: scale(1.08); /* Modern slight zoom */
    }

    /* Content Area inside cards */
    .news-card .content {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .news-card .title {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--color-dark);
        margin-bottom: 0.5rem;
        line-height: 1.4;
        text-decoration: none;
        transition: color 0.2s;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-card .title:hover {
        color: var(--color-primary);
    }

    /* Hero Section (Top News) */
    .hero-section {
        padding: 1.5rem 0 2.5rem 0;
        background: #fff;
        margin-bottom: 2.5rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .hero-grid {
        display: grid;
        grid-template-columns: 1.8fr 1fr;
        gap: 1.5rem;
    }

    @media (max-width: 991px) {
        .hero-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Hero main article */
    .hero-main .news-card {
        height: 100%;
        min-height: 480px;
        border: none;
    }
    .hero-main .news-card .img-wrapper {
        padding-top: 0;
        height: 100%;
    }
    .hero-main .news-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 70%;
        background: linear-gradient(to top, rgba(17,24,39,0.95) 0%, rgba(17,24,39,0.4) 50%, rgba(17,24,39,0) 100%);
        pointer-events: none;
    }
    .hero-main .title-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 2.5rem;
        z-index: 10;
        color: #fff;
    }
    .hero-main .title-overlay .title {
        color: #fff;
        font-size: 2.2rem;
        -webkit-line-clamp: 3;
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }
    .hero-main .title-overlay .title:hover {
        color: var(--color-primary);
    }
    .badge-primary-custom {
        display: inline-block;
        background: var(--color-primary);
        color: #fff;
        padding: 0.35rem 0.85rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 1rem;
        letter-spacing: 0.75px;
        box-shadow: 0 2px 4px rgba(230,57,70,0.4);
    }

    /* Hero Side articles */
    .hero-side {
        display: grid;
        grid-template-rows: 1fr 1fr;
        gap: 1.5rem;
    }
    
    .hero-side-card {
        position: relative;
        border-radius: var(--radius-lg);
        overflow: hidden;
        height: 100%;
        min-height: 230px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        border: none;
    }
    .hero-side-card:hover {
        box-shadow: var(--shadow-hover);
        transform: translateY(-3px);
    }
    .hero-side-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
        position: absolute;
    }
    .hero-side-card:hover img {
        transform: scale(1.08); /* Modern subtle zoom */
    }
    .hero-side-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 80%;
        background: linear-gradient(to top, rgba(17,24,39,0.95) 0%, rgba(17,24,39,0.2) 60%, transparent 100%);
        pointer-events: none;
    }
    .hero-side-card .content-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 1.5rem;
        z-index: 10;
    }
    .hero-side-card .title {
        color: #fff;
        font-size: 1.25rem;
        font-weight: 700;
        text-decoration: none;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.2s;
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }
    .hero-side-card .title:hover {
        color: var(--color-primary);
    }

    /* Section Headers */
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.75rem;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 0.75rem;
    }
    .section-header h2 {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--color-dark);
        margin: 0;
        position: relative;
    }
    .section-header h2::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -0.9rem;
        width: 80px;
        height: 4px;
        border-radius: 2px;
        background: var(--color-primary);
    }

    /* Tab News Redesign */
    .custom-tabs .nav-pills {
        border-bottom: 2px solid #e2e8f0;
        margin-bottom: 1.5rem;
    }
    .custom-tabs .nav-link {
        font-weight: 700;
        font-size: 1.05rem;
        color: var(--color-gray);
        border-radius: 0;
        border: none;
        padding: 0.85rem 1rem;
        background: transparent !important;
        position: relative;
        transition: color 0.3s;
    }
    .custom-tabs .nav-link:hover {
        color: var(--color-dark);
    }
    .custom-tabs .nav-link.active {
        background-color: var(--color-primary) !important;
        color: #ffffff !important;
        border-radius: 4px;
        box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
    }
    
    /* List Card (small image left, text right) */
    .list-card {
        display: flex;
        gap: 1.15rem;
        margin-bottom: 1.25rem;
        background: #fff;
        padding: 0.85rem;
        border-radius: var(--radius-md);
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        transition: var(--transition);
        align-items: center;
        border: 1px solid rgba(0,0,0,0.03);
    }
    .list-card:hover {
        transform: translateX(6px);
        box-shadow: var(--shadow-md);
        border-color: rgba(0,0,0,0.06);
    }
    .list-card .img-wrapper {
        flex-shrink: 0;
        width: 110px;
        height: 85px;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
    }
    .list-card .img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    }
    .list-card:hover .img-wrapper img {
        transform: scale(1.1);
    }
    .list-card .content {
        flex-grow: 1;
    }
    .list-card .title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--color-dark);
        text-decoration: none;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .list-card .title:hover {
        color: var(--color-primary);
    }
    .list-card .meta {
        font-size: 0.8rem;
        color: var(--color-gray);
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
</style>

@php
    $latest_three_news = $posts->take(3);
    $hero_main = $latest_three_news->first();
    $hero_sides = $latest_three_news->skip(1)->take(2);
@endphp

<!-- Beautiful Modern Hero Section Start -->
<div class="hero-section">
    <div class="container">
        @if($hero_main)
        <div class="hero-grid">
            <!-- Main Featured Post -->
            <div class="hero-main">
                <div class="news-card">
                    <div class="img-wrapper">
                        <img src="{{ asset($hero_main->images->first()->path) }}" alt="{{ $hero_main->title }}" />
                    </div>
                    <div class="title-overlay">
                        <span class="badge-primary-custom">Featured</span>
                        <a href="{{ route('frontend.post.show', $hero_main->slug) }}" class="title">
                            {{ $hero_main->title }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Side Featured Posts -->
            <div class="hero-side">
                @foreach ($hero_sides as $post)
                <div class="hero-side-card">
                    <img src="{{ asset($post->images->first()->path) }}" alt="{{ $post->title }}" />
                    <div class="content-overlay">
                        <span class="badge-primary-custom" style="background:var(--color-dark); box-shadow:none;">Trending</span>
                        <a href="{{ route('frontend.post.show', $post->slug) }}" class="title">
                            {{ $post->title }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Hero Section End -->

<!-- Main Content Area Start -->
<div class="container" style="margin-bottom: 4rem;">
    <div class="row">
        <!-- Left Column: Main News Grid -->
        <div class="col-lg-8">
            <div class="section-header">
                <h2>Latest Headlines</h2>
            </div>
            
            <div class="row mb-5">
                @if ($posts->count() > 3)
                    @foreach ($posts->skip(3) as $post)
                        <div class="col-md-6 mb-4">
                            <div class="news-card">
                                <div class="img-wrapper">
                                    <img src="{{ asset($post->images->first()->path) }}" alt="{{ $post->title }}" />
                                </div>
                                <div class="content">
                                    <span class="badge-primary-custom" style="background:#e2e8f0; color:var(--color-dark); box-shadow:none; margin-bottom: 0.75rem; display:inline-table; width:max-content; font-size:0.7rem;">News update</span>
                                    <a href="{{ route('frontend.post.show', $post->slug) }}" class="title" title="{{ $post->title }}">
                                        {{ $post->title }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @if($posts->count() == 0)
                    <div class="col-12">
                        <div class="alert alert-danger text-center shadow-sm" style="border-radius: var(--radius-md);">
                            No posts yet. Please check back later.
                        </div>
                    </div>
                    @endif
                @endif
            </div>
            
            <!-- Pagination Wrapper -->
            @if($posts->hasPages())
            <div class="d-flex justify-content-center mb-5">
                {{ $posts->links() }}
            </div>
            @endif

            <!-- Category News Start-->
            @foreach ($categories->take(3) as $category)
            <div class="section-header mt-4">
                <h2>{{ $category->name }}</h2>
            </div>
            <div class="row mb-5">
                @foreach ($category->posts->take(2) as $post)
                    <div class="col-md-6 mb-4">
                        <div class="news-card">
                            <div class="img-wrapper">
                                <img src="{{ asset($post->images->first()->path) }}" alt="{{ $post->title }}" />
                            </div>
                            <div class="content">
                                <span class="badge-primary-custom" style="background:var(--color-primary); margin-bottom: 0.75rem; display:inline-table; width:max-content; font-size:0.7rem;">{{ $category->name }}</span>
                                <a href="{{ route('frontend.post.show', $post->slug) }}" class="title" title="{{ $post->title }}">
                                    {{ $post->title }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endforeach
            <!-- Category News End-->

        </div>

        <!-- Right Column: Sidebar (Tabs & Read More) -->
        <div class="col-lg-4">
            
            <!-- Popular & Oldest Tabs -->
            <div class="custom-tabs bg-white p-4 rounded mb-5" style="border-radius: var(--radius-lg); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);">
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#popular">Popular</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#oldest">Oldest</a>
                    </li>
                </ul>

                <div class="tab-content pt-3">
                    <div id="popular" class="container tab-pane active px-0">
                        @foreach ($popular_posts as $post)
                            <div class="list-card">
                                <div class="img-wrapper">
                                    <img src="{{ asset($post->images->first()->path) }}" alt="{{ $post->title }}" />
                                </div>
                                <div class="content">
                                    <a href="{{ route('frontend.post.show', $post->slug) }}" class="title">
                                        {{ $post->title }}
                                    </a>
                                    <div class="meta"><i class="far fa-comments text-primary" style="color:var(--color-primary)!important;"></i> {{ $post->comments_count }} Comments</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div id="oldest" class="container tab-pane fade px-0">
                        @foreach ($oldest_post as $post)
                            <div class="list-card">
                                <div class="img-wrapper">
                                    <img src="{{ asset($post->images->first()->path) }}" alt="{{ $post->title }}" />
                                </div>
                                <div class="content">
                                    <a href="{{ route('frontend.post.show', $post->slug) }}" class="title">
                                        {{ $post->title }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Latest & Most Read Tabs -->
            <div class="custom-tabs bg-white p-4 rounded mb-5" style="border-radius: var(--radius-lg); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);">
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#m-viewed">Latest</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#m-read">Most Read</a>
                    </li>
                </ul>

                <div class="tab-content pt-3">
                    <div id="m-viewed" class="container tab-pane active px-0">
                        @foreach ($latest_three_news as $post)
                            <div class="list-card">
                                <div class="img-wrapper">
                                    <img src="{{ asset($post->images->first()->path) }}" alt="{{ $post->title }}" />
                                </div>
                                <div class="content">
                                    <a href="{{ route('frontend.post.show', $post->slug) }}" class="title">
                                        {{ $post->title }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div id="m-read" class="container tab-pane fade px-0">
                        @foreach ($posts_most_read as $post)
                            <div class="list-card">
                                <div class="img-wrapper">
                                    <img src="{{ asset($post->images->first()->path) }}" alt="{{ $post->title }}" />
                                </div>
                                <div class="content">
                                    <a href="{{ route('frontend.post.show', $post->slug) }}" class="title">
                                        {{ $post->title }}
                                    </a>
                                    <div class="meta"><i class="far fa-eye text-primary" style="color:var(--color-primary)!important;"></i> {{ $post->num_of_views }} Views</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Main Content Area End -->

@endsection
