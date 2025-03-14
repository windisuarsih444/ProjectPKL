@extends('backend.app')

@section('content')
<div class="container p-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
            <h3 class="fw-bold mb-0">Edit Mata Pelajaran</h3>
        </div>
        <div class="card-body bg-light p-4">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('mapel.update', $mapel->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Mata Pelajaran</label>
                    <input type="text" class="form-control shadow-sm" id="nama" name="nama" value="{{ old('nama', $mapel->nama) }}" required>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="{{ route('mapel') }}" class="btn btn-danger fw-semibold px-4 shadow-sm">CLOSE</a>
                    <button type="submit" class="btn btn-success fw-semibold px-4 shadow-sm">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
