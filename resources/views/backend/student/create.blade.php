@extends('backend.app')

@section('content')
<div class="container py-4" style="min-height: 100vh; overflow-y: auto;">
    <div class="page-inner">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0 rounded-lg">
                    <div class="card-header text-center bg-primary text-white">
                        <h4 class="card-title mb-0">Add Student</h4>
                    </div>
                    <div class="card-body" style="max-height: 80vh; overflow-y: auto;">
                        <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Telepon</label>
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="class" class="form-label">Kelas</label>
                                    <input id="class" type="text" class="form-control @error('class') is-invalid @enderror" name="class" value="{{ old('class') }}" required>
                                    @error('class')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <textarea class="form-control" id="address" name="address" required>{{ old('address') }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Jenis Kelamin</label>
                                    <select id="gender" class="form-select @error('gender') is-invalid @enderror" name="gender" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('gender')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select id="status" class="form-select @error('status') is-invalid @enderror" name="status" required>
                                        <option value="">-- Status Siswa --</option>
                                        <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="photo" class="form-label">Upload Foto</label>
                                <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" accept="image/*">
                                <small class="text-muted">Format: jpeg, png, jpg, gif | Maks: 2MB</small>
                                @error('photo')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-warning">Simpan</button>
                                <a href="{{ route('students') }}" class="btn btn-danger">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection