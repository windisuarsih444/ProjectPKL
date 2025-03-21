<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Siswa Baru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin-top: 50px;
        }

        .card {
            border-radius: 10px;
        }

        .btn-success {
            width: 100%;
        }

        .invalid-feedback {
            display: none;
            color: red;
            font-size: 0.875em;
        }

        .is-invalid {
            border-color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="fw-bold mb-3 text-center">Tambah Pendaftaran</h1>
        <a href="{{ route('pendaftaran') }}" class="btn btn-dark btn-sm mb-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form id="pendaftaranForm" action="{{ route('pendaftaran.store') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                            <div class="invalid-feedback">Nama harus diisi.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="nisn" class="form-label fw-bold">NISN</label>
                            <input type="number" class="form-control" id="nisn" name="nisn" required pattern="\d{10}">
                            <div class="invalid-feedback">NISN harus 10 digit angka.</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tempat_lahir" class="form-label fw-bold">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                            <div class="invalid-feedback">Tempat lahir harus diisi.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label fw-bold">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            <div class="invalid-feedback">Tanggal lahir harus diisi.</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label fw-bold">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <div class="invalid-feedback">Pilih salah satu jenis kelamin.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="asal_sekolah" class="form-label fw-bold">Asal Sekolah</label>
                            <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required>
                            <div class="invalid-feedback">Asal sekolah harus diisi.</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nomor_hp" class="form-label fw-bold">Nomor HP</label>
                            <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" required
                                pattern="\d{10,13}">
                            <div class="invalid-feedback">Nomor HP harus 10-13 digit angka.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">Masukkan email yang valid.</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nama_ayah" class="form-label fw-bold">Nama Ayah</label>
                            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" required>
                            <div class="invalid-feedback">Nama ayah harus diisi.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="nama_ibu" class="form-label fw-bold">Nama Ibu</label>
                            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" required>
                            <div class="invalid-feedback">Nama ibu harus diisi.</div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('pendaftaranForm').addEventListener('submit', function (event) {
            let valid = true;
            const inputs = this.querySelectorAll('input, select');

            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    input.classList.add('is-invalid');
                    input.nextElementSibling.style.display = 'block';
                    valid = false;
                } else {
                    input.classList.remove('is-invalid');
                    input.nextElementSibling.style.display = 'none';
                }
            });

            if (!valid) {
                event.preventDefault();
            }
        });

        document.querySelectorAll('input, select').forEach(input => {
            input.addEventListener('input', function () {
                if (this.checkValidity()) {
                    this.classList.remove('is-invalid');
                    this.nextElementSibling.style.display = 'none';
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    @if(session('success'))
        Swal.fire({
            title: "Berhasil!",
            text: "{{ session('success') }}",
            icon: "success",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
        });
    @endif
</script>
</body>

</html>