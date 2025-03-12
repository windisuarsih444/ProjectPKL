@extends('backend.app')

@section('content')
<div class="container p-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
            <h3 class="fw-bold mb-0">Edit User</h3>
        </div>
        <div class="card-body bg-light p-4">
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label fw-semibold">Nama</label>
                        <input type="text" class="form-control shadow-sm" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control shadow-sm" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="{{ route('user') }}" class="btn btn-danger fw-semibold px-4 shadow-sm">CLOSE</a>
                    <button type="submit" class="btn btn-success fw-semibold px-4 shadow-sm">UPDATE</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
