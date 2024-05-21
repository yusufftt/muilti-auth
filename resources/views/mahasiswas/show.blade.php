@extends('layouts.backend')

@section('title', 'Mahasiswa Show')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Mahasiswa Information
                    </div>
                    <div class="float-end">
                        <a href="{{ route('mahasiswas.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="name"
                            class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $mahasiswa->name }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start"><strong>Email Address:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $mahasiswa->email }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="roles"
                            class="col-md-4 col-form-label text-md-end text-start"><strong>Roles:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            @forelse ($mahasiswa->getRoleNames() as $role)
                                <span class="badge bg-primary">{{ $role }}</span>
                            @empty
                            @endforelse
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan"
                            class="col-md-4 col-form-label text-md-end text-start"><strong>Jurusan:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $mahasiswa->name }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="semester"
                            class="col-md-4 col-form-label text-md-end text-start"><strong>Semester:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $mahasiswa->name }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
