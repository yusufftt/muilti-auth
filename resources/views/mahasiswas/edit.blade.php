@extends('layouts.app')


@section('title', 'Mahasiswa Edit')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Edit Mahasiswa
                    </div>
                    <div class="float-end">
                        <a href="{{ route('mahasiswas.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('mahasiswas.update', $mahasiswa->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                            <div class="col-md-6">
                                <input type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ $mahasiswa->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ $mahasiswa->email }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-end text-start">New Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password_confirmation"
                                class="col-md-4 col-form-label text-md-end text-start">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                            </div>
                        </div>
                        {{-- <div class="mb-3 row">
                            <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Roles</label>
                            <div class="col-md-6">
                                <select class="form-select @error('roles') is-invalid @enderror" multiple aria-label="Roles"
                                    id="roles" name="roles[]">
                                    @forelse ($roles as $role)
                                        @if ($role != 'Super Admin')
                                            <option value="{{ $role }}"
                                                {{ $role== $mahasiswa->roles[0]->name ? 'selected' : '' }}>
                                                {{ $role }}
                                            </option>
                                        @else
                                            @if (Auth::user()->hasRole('Super Admin'))
                                                <option value="{{ $role }}"
                                                    {{ $role== $mahasiswa->roles[0]->name ? 'selected' : '' }}>
                                                    {{ $role }}
                                                </option>
                                            @endif
                                        @endif
                                    @empty
                                    @endforelse
                                </select>
                                @if ($errors->has('roles'))
                                    <span class="text-danger">{{ $errors->first('roles') }}</span>
                                @endif
                            </div>
                        </div> --}}
                        <div class="mb-3 row">
                            <label for="jurusan" class="col-md-4 col-form-label text-md-end text-start">Jurusan</label>
                            <div class="col-md-6">
                                <input type="text"
                                    class="form-control @error('jurusan') is-invalid @enderror"
                                    id="jurusan" name="jurusan" value="{{ $mahasiswa->jurusan }}">
                                @if ($errors->has('jurusan'))
                                    <span class="text-danger">{{ $errors->first('jurusan') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="semester" class="col-md-4 col-form-label text-md-end text-start">Semester</label>
                            <div class="col-md-6">
                                <input type="text"
                                    class="form-control @error('semester') is-invalid @enderror"
                                    id="semester" name="semester" value="{{ $mahasiswa->semester }}">
                                @if ($errors->has('semester'))
                                    <span class="text-danger">{{ $errors->first('semester') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update Mahasiswa">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
