<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Siswa Baru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* General Styling */
        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin-top: 50px;
        }

        h1 {
            font-size: 2rem;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: center;
        }

        a.btn-dark {
            background-color: #2c3e50;
            border-color: #2c3e50;
        }

        a.btn-dark:hover {
            background-color: #1a252f;
            border-color: #1a252f;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2rem;
        }

        label {
            font-weight: bold;
            color: #2c3e50;
        }

        input.form-control,
        select.form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        input.form-control:focus,
        select.form-control:focus {
            border-color: #2c3e50;
            box-shadow: 0 0 5px rgba(44, 62, 80, 0.3);
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            width: 100%;
            font-size: 1rem;
            padding: 10px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .invalid-feedback {
            display: none;
            color: #dc3545;
            font-size: 0.875em;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .alert {
            border-radius: 5px;
        }

        .alert.alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .alert.alert-success .btn-close {
            color: #155724;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="fw-bold mb-3">Pendaftaran Siswa Baru</h1>
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
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                            <div class="invalid-feedback">Nama harus diisi.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="number" class="form-control" id="nisn" name="nisn" required pattern="\d{10}">
                            <div class="invalid-feedback">NISN harus 10 digit angka.</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                            <div class="invalid-feedback">Tempat lahir harus diisi.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            <div class="invalid-feedback">Tanggal lahir harus diisi.</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <div class="invalid-feedback">Pilih salah satu jenis kelamin.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                            <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required>
                            <div class="invalid-feedback">Asal sekolah harus diisi.</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nomor_hp" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" required
                                pattern="\d{10,13}">
                            <div class="invalid-feedback">Nomor HP harus 10-13 digit angka.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">Masukkan email yang valid.</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nama_ayah" class="form-label">Nama Ayah</label>
                            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" required>
                            <div class="invalid-feedback">Nama ayah harus diisi.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="nama_ibu" class="form-label">Nama Ibu</label>
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