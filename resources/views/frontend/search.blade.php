@extends('layouts.frontend.app')
@section('body')
    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                @if($posts->count() > 0)
                <div class="col-lg-12">

                    <div class="row">
                        {{-- post --}}
                        @foreach ($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{ $post->images->first()->path }}" />
                                    <div class="mn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}"
                                            title="{{ $post->title }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>

                    {{ $posts->links() }}
                </div>
                @else
                <div class="col-lg-12">
                    <div class="alert alert-danger">
                        No Posts Founded
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection
