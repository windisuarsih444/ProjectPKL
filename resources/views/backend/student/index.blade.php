@extends('backend.app')

@section('content')

<div class="container mb-5"> <!-- Tambahkan margin bawah agar tidak tertutup footer -->
    <h3 class="fw-bold mb-3">Data Siswa</h3>
    <a href="{{ route('students.create') }}" class="btn btn-success btn-sm mb-3">
        <i class="fas fa-plus"></i> Tambah Siswa
    </a>

    <!-- Form Pencarian -->
    <form action="{{ route('students') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari siswa..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
            @if(request('search'))
                <a href="{{ route('user') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Reset
                </a>
            @endif
        </div>
    </form>

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

    <div class="card shadow-sm">
        <div class="card-body p-2">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-sm text-center small">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Kelas</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Status</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $index => $student)
                        <tr>
                            <td>{{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}</td>
                            <td class="text-start">{{ $student->name }}</td>
                            <td class="text-nowrap">{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td><span class="badge bg-primary">{{ $student->class }}</span></td>
                            <td class="text-start text-nowrap">{{ $student->address }}</td>
                            <td>
                                <span class="badge {{ $student->gender == 'L' ? 'bg-info' : 'bg-warning' }}">
                                    <i class="fas {{ $student->gender == 'L' ? 'fa-male' : 'fa-female' }}"></i>
                                    {{ $student->gender }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $student->status == 'Aktif' ? 'bg-success' : 'bg-danger' }}">
                                    <i class="fas {{ $student->status == 'Aktif' ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                    {{ $student->status }}
                                </span>
                            </td>
                            <td>
                                <img src="{{ asset($student->photo) }}" 
                                     alt="Foto Siswa" class="img-thumbnail rounded-circle" width="50" 
                                     onerror="this.onerror=null;this.src='{{ asset('backend/images/default.png') }}';">
                            </td>
                            <td class="text-nowrap">
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-xs" data-bs-toggle="tooltip" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs" data-bs-toggle="tooltip" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Paginasi -->
                <div class="d-flex justify-content-center flex-wrap w-100 mt-3">
    <nav>
        <ul class="pagination">
            <!-- Tombol Previous -->
            @if ($students->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $students->previousPageUrl() }}">Previous</a>
                </li>
            @endif

            <!-- Info Halaman -->
            <li class="page-item disabled">
                <span class="page-link text-muted">Page {{ $students->currentPage() }} dari {{ $students->lastPage() }}</span>
            </li>

            <!-- Tombol Next -->
            @if ($students->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $students->nextPageUrl() }}">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Next</span>
                </li>
            @endif
        </ul>
    </nav>
</div>
</div>
</div>
</div>
</div>
            </div>
        </div>
    </div>
</div>

@endsection
