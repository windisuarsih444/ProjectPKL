@extends('backend.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-dark text-white text-center">
            <h4 class="mb-0"><b>Tambah Nilai Siswa</b></h4>
        </div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('nilai.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="student_id" class="form-label">Nama Siswa :</label>
                        <select name="student_id" id="student_id" class="form-select select2" required>
                            <option value="">-- Pilih Nama Siswa --</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="teacher_id" class="form-label">Nama Guru :</label>
                        <select name="teacher_id" id="teacher_id" class="form-select select2" required>
                            <option value="">-- Pilih Nama Guru --</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="mapel_id" class="form-label">Mata Pelajaran :</label>
                        <select name="mapel_id" id="mapel_id" class="form-select select2" required>
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            @foreach($mapels as $mapel)
                                <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nilai" class="form-label">Nilai :</label>
                        <input type="number" name="nilai" id="nilai" class="form-control" min="0" max="100" required placeholder="Masukkan nilai (0-100)">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('nilai') }}" class="btn btn-danger me-2">CANCLE</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> SAVE
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({
              
                placeholder: "Pilih opsi",
                allowClear: true
            });
        });
    </script>
@endsection