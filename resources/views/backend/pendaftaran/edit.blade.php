@extends('backend.app')

@section('content')
    <div class="container py-4">
        <h1 class="fw-bold text-center text-primary mb-4">Edit Pendaftaran</h1>

        @if(session('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    Swal.fire({
                        title: "Berhasil!",
                        text: @json(session('success')),
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                });
            </script>
        @endif

        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-body p-4">
                <div class="table-responsive p-3" style="max-height: 500px; overflow-y: auto;">
                    <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="{{ old('nama', $pendaftaran->nama) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">NISN</label>
                                <input type="text" name="nisn" class="form-control" value="{{ old('nisn', $pendaftaran->nisn) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $pendaftaran->tempat_lahir) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $pendaftaran->tanggal_lahir) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="Laki-laki" {{ $pendaftaran->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $pendaftaran->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Asal Sekolah</label>
                                <input type="text" name="asal_sekolah" class="form-control" value="{{ old('asal_sekolah', $pendaftaran->asal_sekolah) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nomor HP</label>
                                <input type="text" name="nomor_hp" class="form-control" value="{{ old('nomor_hp', $pendaftaran->nomor_hp) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $pendaftaran->email) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Ayah</label>
                                <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah', $pendaftaran->nama_ayah) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Ibu</label>
                                <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu', $pendaftaran->nama_ibu) }}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('pendaftaran') }}" class="btn btn-secondary px-4">Kembali</a>
                            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                @if(session('error'))
                    Swal.fire({
                        title: "Error!",
                        text: @json(session('error')),
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                @endif
            });
        </script>

        <style>
            .card {
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            }

            .form-control, .form-select {
                border-radius: 8px;
                padding: 10px;
            }

            .btn {
                border-radius: 8px;
                font-weight: bold;
            }
        </style>
    @endsection
@endsection