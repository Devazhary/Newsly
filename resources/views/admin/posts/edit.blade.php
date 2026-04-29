@extends('layouts.admin.app')
@section('title')
    Edit Post
@endsection
@section('body')
    <center>
        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body shadow mb-4 col-10">
                <h1>Edit Post</h1>
                {{-- 1 --}}
                <div class="row">
                    {{-- title --}}
                    <div class="col-12">
                        <div class="form-group">
                            <input value="{{ old('title', $post->title) }}" type="text" class="form-control form-control-user"
                                id="title" name="title" placeholder="Enter Title">
                            @error('title')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- 2 --}}
                <div class="row">
                    {{-- description --}}
                    <div class="col-12">
                        <div class="form-group">
                            <textarea class="form-control form-control-user" id="text-area" name="description" placeholder="Enter Description"
                                rows="3">{{ old('description', $post->description) }}</textarea>
                            @error('description')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- 3 --}}
                <div class="row">
                    {{-- post status --}}
                    <div class="col-6">
                        <div class="form-group">
                            <select name="status" id="status" class="form-control form-control-user">
                                <option value="" selected disabled>Select Post Status</option>
                                <option value="1" {{ old('status', $post->status) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $post->status) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- commentable status --}}
                    <div class="col-6">
                        <div class="form-group">
                            <select name="commentable" id="commentable" class="form-control form-control-user">
                                <option value="" selected disabled>Select Commentable Status</option>
                                <option value="1" {{ old('commentable', $post->commentable) == 1 ? 'selected' : '' }}>Commentable</option>
                                <option value="0" {{ old('commentable', $post->commentable) == 0 ? 'selected' : '' }}>Not Commentable</option>
                            </select>
                            @error('commentable')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- 4 --}}
                <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <select name="category_id" id="category_id" class="form-control form-control-user">
                                <option value="" selected disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- 5 --}}
                <div class="row">
                    {{-- image --}}
                    <div class="col-12">
                        <div class="form-group">
                            <input type="file" class="form-control form-control-user" id="input-file" name="images[]"
                                multiple placeholder="Enter Image">
                            @error('images')
                                <span class="text-danger small mt-1 pl-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Post</button>
                <a href="{{ route('admin.adminPosts') }}" class="btn btn-info">Back to Posts</a>
            </div>
        </form>
    </center>
@endsection
@push('js')
    <script>
        $(document).ready(function() {

            $("#input-file").fileinput({
                theme: 'fa5',
                allowedFileTypes: ['image'],
                MaxFileCount: 5,
                showUpload: false,
                initialPreview: [
                    @if ($post->images->count() > 0)
                        @foreach ($post->images as $image)
                            "{{ asset($image->path) }}",
                        @endforeach
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewConfig: [
                    @if ($post->images->count() > 0)
                        @foreach ($post->images as $image)
                            {
                                width: '120px',
                                url: "{{ route('admin.post.delete.image', ['_token' => csrf_token()]) }}",
                                key: "{{ $image->id }}",
                            },
                        @endforeach
                    @endif
                ]
            });


            $('#text-area').summernote({
                height: 300,
            });
        });
    </script>
@endpush

