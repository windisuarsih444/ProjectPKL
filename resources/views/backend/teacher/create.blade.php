@extends('backend.app')

@section('content')
<div class="container p-4">
    <h3 class="fw-bold text-center bg-primary text-white mb-4">Add Teacher</h3>
    <div class="card shadow rounded border-0">
        <div class="card-body p-4">
            <form action="{{ route('teacher.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Guru</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label fw-semibold">Telepon</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="gender" class="form-label fw-semibold">Jenis Kelamin</label>
                        <select id="gender" class="form-select" name="gender" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="address" class="form-label fw-semibold">Alamat</label>
                    <textarea name="address" class="form-control" rows="3" required></textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <select id="status" class="form-select" name="status" required>
                            <option value="">-- Status Guru --</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="photo" class="form-label fw-semibold">Foto (Opsional)</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                </div>
                
                <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-warning">SAVE</button>
                                <a href="{{ route('teacher') }}" class="btn btn-danger">CLOSE</a>
                            </div>
            </form>
        </div>
    </div>
</div>
@endsection