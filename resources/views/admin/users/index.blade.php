@extends('layouts.admin.app')
@section('title')
    Users
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

            @include('admin.users.filters.user-filter')

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Country</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td style="color: {{ $user->status == 1 ? 'green' : 'red' }}">
                                        {{ $user->status == 1 ? 'Active' : 'Not Active' }}</td>
                                    <td>{{ $user->country }}</td>
                                    <td>{{ $user->created_at->format('y-m-d') }}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="if(confirm('Are you sure to delete this user?')) { document.getElementById('delete_user_{{ $user->id }}').submit(); }"><i class="fas fa-fw fa-trash"></i></a>
                                        <a href="{{ route('admin.user.changeStatus', $user->id) }}"><i class="fas fa-fw @if($user->status == 1) fa-ban @else fa-plus @endif"></i></a>
                                        <a href="{{ route('admin.user.show', $user->id) }}"><i class="fas fa-fw fa-eye"></i></a>
                                    </td>
                                </tr>
                                <form id="delete_user_{{ $user->id }}" action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @empty
                                <tr>
                                    <td class="alert alert-info" colspan="6">No Users Founded</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $users->appends(request()->input())->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
