@extends('layouts.admin.app')
@section('title')
    Posts
@endsection
@section('body')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
                DataTables documentation</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>

            @include('admin.posts.filters.post-filter')

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($posts as $post)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ $post->admin->name }}</td>
                                    <td style="color: {{ $post->status == 1 ? 'green' : 'red' }}">
                                        {{ $post->status == 1 ? 'Active' : 'Not Active' }}</td>
                                    <td>{{ $post->num_of_views }}</td>
                                    <td>
                                        <a href="javascript:void(0)"
                                            onclick="if(confirm('Are you sure to delete this post?')) { document.getElementById('delete_post_{{ $post->id }}').submit(); }"><i
                                                class="fas fa-fw fa-trash"></i></a>
                                        <a href="{{ route('admin.posts.changeStatus', $post->id) }}"><i
                                                class="fas fa-fw @if ($post->status == 1) fa-ban @else fa-plus @endif"></i></a>
                                        <a href="{{ route('admin.posts.show', $post->id) }}"><i
                                                class="fas fa-fw fa-eye"></i></a>
                                        <a href="{{ route('admin.posts.edit', $post->id) }}"><i
                                                class="fas fa-fw fa-edit"></i></a>
                                    </td>
                                </tr>
                                <form id="delete_post_{{ $post->id }}"
                                    action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @empty
                                <tr>
                                    <td class="alert alert-info" colspan="7">No Posts Founded</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $posts->appends(request()->input())->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
