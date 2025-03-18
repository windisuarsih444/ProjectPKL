@extends('backend.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-dark text-center text-white">
            <h4 class="mb-0">Edit Nilai</h4>
        </div>
        <div class="card-body p-4">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('nilai.update', $nilai->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="student_id" class="form-label fw-bold">Nama Siswa :</label>
                        <select name="student_id" id="student_id" class="form-control select2" required>
                            <option value="">-- Pilih Nama Siswa --</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ $student->id == $nilai->student_id ? 'selected' : '' }}>
                                    {{ $student->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="teacher_id" class="form-label fw-bold">Nama Guru :</label>
                        <select name="teacher_id" id="teacher_id" class="form-control select2" required>
                            <option value="">-- Pilih Nama Guru --</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ $teacher->id == $nilai->teacher_id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label for="mapel_id" class="form-label fw-bold">Mata Pelajaran :</label>
                        <select name="mapel_id" id="mapel_id" class="form-control select2" required>
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            @foreach($mapels as $mapel)
                                <option value="{{ $mapel->id }}" {{ $mapel->id == $nilai->mapel_id ? 'selected' : '' }}>
                                    {{ $mapel->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="nilai" class="form-label fw-bold">Nilai :</label>
                        <input type="number" name="nilai" id="nilai" class="form-control" min="0" max="100" value="{{ $nilai->nilai }}" required>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('nilai') }}" class="btn btn-danger me-2 px-4">CANCEL</a>
                    <button type="submit" class="btn btn-success px-4">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <!-- Tambahkan jQuery jika belum ada -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Tambahkan CSS Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Tambahkan JS Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: "Pilih salah satu",
                allowClear: true
            });
        });
    </script>
@endsection
