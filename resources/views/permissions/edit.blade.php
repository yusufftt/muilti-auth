@extends('layouts.backend')
@section('title', 'CRUD Permission')


@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Edit Permission
                    </div>
                    <div class="float-end">
                        <a href="/crud-permission" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('permissions.update', $permission->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ $permission->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                        <div class="col-md-4 text-md-end">
                            <label for="roles"
                                class="col-form-label  text-start">Roles</label>
                            <div class="fw-light fs-6 font-monospace">Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.</div>
                        </div>
                            <div class="col-md-6">
                                <select class="form-select @error('roles') is-invalid @enderror" multiple
                                    aria-label="roles" id="roles" name="roles[]" style="height:210px;">
                                    @forelse ($roles as $role)
                                    @continue($role->name == 'Super Admin')
                                        <option value="{{ $role->id }}"
                                            {{ in_array($role->id, old('roles') ?? []) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>

                                @if ($errors->has('roles'))
                                    <span class="text-danger">{{ $errors->first('roles') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update Permission">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
