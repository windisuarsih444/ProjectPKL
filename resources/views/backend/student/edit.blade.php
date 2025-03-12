@extends('backend.app')

@section('content')
<div class="container py-4" style="min-height: 100vh; overflow-y: auto;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg" style="background: linear-gradient(to right, #ff9a9e, #fad0c4); color: white;">
                <div class="card-header text-center bg-white text-white rounded-top">
                    <h4 class="card-title mb-0">Edit Siswa</h4>
                </div>
                <div class="card-body p-4" style="background: white; color: black; border-radius: 0 0 10px 10px;">
                    @if(session('success'))
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                Swal.fire({
                                    title: "Berhasil!",
                                    text: "{{ session('success') }}",
                                    icon: "success",
                                    confirmButtonText: "OK"
                                });
                            });
                        </script>
                    @endif

                    <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data" onsubmit="confirmUpdate(event)">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control border-secondary" id="name" name="name" value="{{ old('name', $student->name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control border-secondary" id="email" name="email" value="{{ old('email', $student->email) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Telepon</label>
                                <input type="text" class="form-control border-secondary" id="phone" name="phone" value="{{ old('phone', $student->phone) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="class" class="form-label">Kelas</label>
                                <input type="text" class="form-control border-secondary" id="class" name="class" value="{{ old('class', $student->class) }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control border-secondary" id="address" name="address" required>{{ old('address', $student->address) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select class="form-select border-secondary" id="gender" name="gender" required>
                                    <option value="L" {{ old('gender', $student->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('gender', $student->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select border-secondary" id="status" name="status" required>
                                    <option value="Aktif" {{ old('status', $student->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ old('status', $student->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <label class="form-label">Foto Siswa</label><br>
                            @if($student->photo && file_exists(public_path($student->photo)))
                                <img id="previewImage" src="{{ asset($student->photo) }}" class="img-thumbnail rounded shadow" width="150">
                            @else
                                <p class="text-muted">Tidak ada foto</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">Ganti Foto (Opsional)</label>
                            <input type="file" class="form-control border-secondary" id="photo" name="photo" accept="image/*" onchange="previewFile()">
                            <small class="text-muted">Format: jpeg, png, jpg, gif | Maks: 2MB</small>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('students') }}" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmUpdate(event) {
        event.preventDefault();
        let form = event.target;
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data siswa akan diperbarui!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ff758c",
            cancelButtonColor: "#dc3545",
            confirmButtonText: "Ya, Update!"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    function previewFile() {
        const preview = document.getElementById('previewImage');
        const file = document.getElementById('photo').files[0];
        const reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection