@extends('backend.app')

@section('content')
<div class="container overflow-auto p-4 bg-light shadow rounded" style="max-height: 90vh;">
    <h3 class="fw-bold mb-4 text-center text-primary">Edit Guru</h3>
    <form action="{{ route('teacher.update', $teacher->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label fw-semibold">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $teacher->name) }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $teacher->email) }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label fw-semibold">Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $teacher->phone) }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="gender" class="form-label fw-semibold">Jenis Kelamin</label>
                <select id="gender" class="form-select" name="gender" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label fw-semibold">Alamat</label>
            <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', $teacher->address) }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="status" class="form-label fw-semibold">Status</label>
                <select id="status" class="form-select" name="status" required>
                    <option value="">-- Status Guru --</option>
                    <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="photo" class="form-label fw-semibold">Foto</label>
                <input type="file" class="form-control" id="photo" name="photo">
                @if (!empty($teacher->photo) && is_string($teacher->photo))
                    <div class="mt-2 text-center">
                        <img src="{{ asset('backend/images/' . $teacher->photo) }}" class="img-thumbnail rounded shadow" width="120" alt="Foto Guru">
                    </div>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="{{ route('teacher') }}" class="btn btn-danger fw-semibold px-4 shadow-sm">CLOSE</a>
                    <button type="submit" class="btn btn-success fw-semibold px-4 shadow-sm">UPDATE</button>
                </div>
    </form>
</div>
@endsection
