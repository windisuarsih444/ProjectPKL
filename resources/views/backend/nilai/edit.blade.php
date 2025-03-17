@extends('backend.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Nilai</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('nilai.update', $nilai->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="student_id">Student</label>
            <select name="student_id" id="student_id" class="form-control" required>
                <option value="">-- Pilih Student --</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $student->id == $nilai->student_id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="teacher_id">Teacher</label>
            <select name="teacher_id" id="teacher_id" class="form-control" required>
                <option value="">-- Pilih Dosen --</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ $teacher->id == $nilai->teacher_id ? 'selected' : '' }}>
                        {{ $teacher->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="mapel_id">Mata Pelajaran</label>
            <select name="mapel_id" id="mapel_id" class="form-control" required>
                <option value="">-- Pilih Mata Pelajaran --</option>
                @foreach($mapels as $mapel)
                    <option value="{{ $mapel->id }}" {{ $mapel->id == $nilai->mapel_id ? 'selected' : '' }}>
                        {{ $mapel->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nilai">Nilai</label>
            <input type="number" name="nilai" id="nilai" class="form-control" min="0" max="100" value="{{ $nilai->nilai }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('nilai') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
