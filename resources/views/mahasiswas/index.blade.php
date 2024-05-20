@extends('layouts.backend')

@section('title', 'Manage Mahasiswa')

@section('content')
    <div class="card">
        <div class="card-header">Mahasiswa List</div>
        <div class="card-body">
            @can('create-mahasiswa')
                <a href="{{ route('mahasiswas.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i>
                    Add New Mahasiswa</a>
            @endcan
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">S#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswas as $mahasiswa)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $mahasiswa->name }}</td>
                            <td>{{ $mahasiswa->email }}</td>
                            <td>
                                @forelse ($mahasiswa->getRoleNames() as $role)
                                    <span class="badge bg-primary">{{ $role }}</span>
                                @empty
                                @endforelse
                            </td>
                            <td>{{ $mahasiswa->jurusan }}</td>
                            <td>{{ $mahasiswa->semester }}</td>
                            <td>
                                <form action="{{ route('mahasiswas.destroy', $mahasiswa->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    @can('show-mahasiswa')
                                    <a href="{{ route('mahasiswas.show', $mahasiswa->id) }}" class="btn btn-warning btn-sm"><i
                                            class="bi bi-eye"></i> Show</a>
                                    @endcan 
                                    @can('edit-mahasiswa')
                                        <a href="{{ route('mahasiswas.edit', $mahasiswa->id) }}" class="btn btn-primary btn-sm"><i
                                            class="bi bi-pencil-square"></i> Edit</a>
                                    @endcan
                                    @can('delete-mahasiswa')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Do you want to delete this product?');"><i
                                                class="bi bi-trash"></i> Delete</button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                    @empty
                        <td colspan="4">
                            <span class="text-danger">
                                <strong>No Mahasiswas Found!</strong>
                            </span>
                        </td>
                    @endforelse
                </tbody>
            </table>
            {{ $mahasiswas->links() }}
        </div>
    </div>
@endsection
