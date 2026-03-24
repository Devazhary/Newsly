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
                <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
                    <h3 class="font-weight-bold mb-0" style="color: var(--text-dark);">
                        <i class="fas fa-edit mr-2 text-primary"></i> Edit Post
                    </h3>
                </div>

                <form action="{{ route('frontend.dashboard.profile.post.edit', $post->slug) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="card shadow-sm border-0 mb-5 pb-3" style="border-radius: 12px;">
                        <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                            <h5 class="font-weight-bold mb-0 text-secondary"><i class="fas fa-file-alt mr-2 text-primary"></i> Post Details</h5>
                            <div>
                                <span class="badge badge-light text-secondary border px-3 py-2 rounded-pill shadow-sm mr-2">
                                    <i class="fas fa-eye text-primary mr-2"></i>{{ $post->num_of_views }}
                                </span>
                                <span class="badge badge-light text-secondary border px-3 py-2 rounded-pill shadow-sm">
                                    <i class="fas fa-comment text-primary mr-2"></i>{{ $post->comments->count() }}
                                </span>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <!-- Editable Title -->
                            <div class="form-group mb-4">
                                <label class="font-weight-bold text-secondary">Title</label>
                                <input name="title" type="text" class="form-control form-control-lg bg-light border-0 post-title" value="{{ $post->title }}" style="border-radius: 8px;" required />
                            </div>

                            <!-- Editable Content -->
                            <div class="form-group mb-4">
                                <label class="font-weight-bold text-secondary">Content</label>
                                <div class="bg-light rounded" style="border: 1px solid #e2e8f0; padding: 1px;">
                                    <textarea name="description" id="text-area" class="form-control border-0 post-content">{!! $post->description !!}</textarea>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <!-- Editable Category Dropdown -->
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="font-weight-bold text-secondary">Category</label>
                                    <select name="category_id" class="form-control custom-select bg-light border-0 post-category" style="border-radius: 8px; height: 45px;" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @selected($post->category_id == $category->id)>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Editable Enable Comments Checkbox -->
                                <div class="col-md-6 d-flex align-items-end pb-2">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="commentable" class="custom-control-input enable-comments" id="enableCommentsSwitch" value="1" @checked($post->commentable == 1)>
                                        <label class="custom-control-label font-weight-bold text-secondary cursor-pointer" for="enableCommentsSwitch" style="padding-top: 2px;">Enable Comments</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Image Upload Input for Editing -->
                            <div class="form-group mb-4">
                                <label class="font-weight-bold text-secondary">Update Images</label>
                                <input name="images[]" type="file" id="input-file" class="form-control-file mt-2 edit-post-image" accept="image/*" multiple />
                            </div>

                            <!-- Post Actions -->
                            <div class="d-flex justify-content-end pt-3 border-top mt-4">
                                <a href="{{ route('frontend.dashboard.profile.index') }}" class="btn btn-outline-secondary font-weight-bold px-4 rounded-pill mr-3 delete-post-btn" style="height: 45px; display: flex; align-items: center;">
                                    <i class="fas fa-arrow-left mr-2"></i> Cancel & Back
                                </a>
                                <button type="submit" class="btn btn-primary font-weight-bold px-5 rounded-pill shadow-sm edit-post-btn" style="height: 45px;">
                                    <i class="fas fa-save mr-2"></i> Save Changes
                                </button>
                            </div>
                        </div>
                    </div>
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
