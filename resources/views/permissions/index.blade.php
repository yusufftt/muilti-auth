{{-- yang baru --}}
@extends('layouts.backend')

@section('title', 'CRUD Permission')

@section('content')
    <!-- Main content -->
    <div class="card">
        <div class="card-header">CRUD Permission</div>
        <div class="card-body">
            @can('create-permission')
                <a href="{{ route('permissions.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i>
                    Add New Permission</a>
            @endcan
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#Permission ID</th>
                        <th scope="col">Permission Name</th>
                        <th scope="col">Role</th>
                        <th scope="col" style="width: 250px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                
                    @forelse ($permissions as $permission)
                        {{-- //0=permission.id, 1=permission.name, 2=role.name --}}
                        <tr>
                            <td scope="row">{{ $permission[0] }}</td>
                            <td>

                                {{ $permission[1] }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    @foreach ($permission[2] as $role)
                                        <button type="button" class="btn btn-secondary mr-2">{{ $role }}</button>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <form class="mb-0" action="{{ route('permissions.destroy', $permission[0]) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('permissions.show', $permission[0]) }}"
                                        class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
                                    @if ($permission[2] != 'Super Admin')
                                        @can('edit-permission')
                                            <a href="{{ route('permissions.edit', $permission[0]) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit</a>
                                        @endcan
                                        @can('delete-permission')
                                            @if ($permission[2] != Auth::user()->hasRole($permission[2]))
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Do you want to delete this permission?');"><i
                                                        class="bi bi-trash"></i> Delete</button>
                                            @endif
                                        @endcan
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @empty
                        <td colspan="3">
                            <span class="text-danger">
                                <strong>No Permision Found!</strong>
                            </span>
                        </td>
                    @endforelse
                </tbody>
            </table>
            {{-- {{ $permissions->links() }} --}}
        </div>
    </div>
    <!-- /.content -->
@endsection
