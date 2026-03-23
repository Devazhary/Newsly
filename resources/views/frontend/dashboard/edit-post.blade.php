@extends('layouts.frontend.app')
@section('title')
    Edit | {{ $post->title }}
@endsection
@section('body')
    <div class="dashboard container">
        <!-- Sidebar -->
        @include('frontend.dashboard._sidebar', ['profile_active'=>'active'])

        <!-- Main Content -->
        <div class="main-content col-md-9">
            <!-- Show/Edit Post Section -->
            <section id="posts-section" class="posts-section">
                <h2>Your Posts</h2>
                <form action="{{ route('frontend.dashboard.profile.post.edit', $post->slug) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <ul class="list-unstyled user-posts">
                        <!-- Example of a Post Item -->
                        <li class="post-item">
                            <!-- Editable Title -->
                            <input name="title" type="text" class="form-control mb-2 post-title"
                                value="{{ $post->title }}" />

                            <!-- Editable Content -->
                            <textarea name="description" id="text-area" class="form-control mb-2 post-content">
                                {!! $post->description !!}
                            </textarea>


                            <!-- Image Upload Input for Editing -->
                            <input name="images[]" type="file" id="input-file" class="form-control mt-2 edit-post-image"
                                accept="image/*" multiple />

                            <!-- Editable Category Dropdown -->
                            <select name="category_id" class="form-control mb-2 post-category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($post->category_id == $category->id)>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Editable Enable Comments Checkbox -->
                            <div class="form-check mb-2">
                                <input name="commentable" @checked($post->commentable == 1)
                                    class="form-check-input enable-comments" type="checkbox" />
                                <label class="form-check-label">
                                    Enable Comments
                                </label>
                            </div>

                            <!-- Post Meta: Views and Comments -->
                            <div class="post-meta d-flex justify-content-between">
                                <span class="views">
                                    <i class="fas fa-eye"></i>{{ $post->num_of_views }}
                                </span>
                                <span class="post-comments">
                                    <i class="fas fa-comment"></i>{{ $post->comments->count() }}
                                </span>
                            </div>

                            <!-- Post Actions -->
                            <div class="post-actions mt-2">
                                <button type="submit" class="btn btn-primary edit-post-btn">Edit</button>
                                <a href="{{ route('frontend.dashboard.profile.index') }}"
                                    class="btn btn-info delete-post-btn">Back</a>
                                {{-- <button class="btn btn-success save-post-btn d-none">
                                    Save
                                </button>
                                <button class="btn btn-secondary cancel-edit-btn d-none">
                                    Cancel
                                </button> --}}
                            </div>

                        </li>
                        <!-- Additional posts will be added dynamically -->
                    </ul>
                </form>
            </section>
        </div>
    </div>
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
                                url: "{{ route('frontend.dashboard.profile.post.delete.image', ['_token' => csrf_token()]) }}",
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
