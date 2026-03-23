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
    <!-- Main News Start-->
    <br><br><br>
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @forelse ($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{ asset($post->images->first()->path) }}" width="350px" height="200px"
                                        style="object-fit: cover;" alt="{{ $post->title }}" />
                                    <div class="mn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}"
                                            title="{{ $post->title }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-info">
                                No posts found in this category.
                            </div>
                        @endforelse
                    </div>
                    {{ $posts->links() }}
                </div>

                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>Read More</h2>
                        <ul>
                            @foreach ($categories as $category)
                                <li><a
                                        href="{{ route('frontend.category.posts', $category->slug) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection
