@extends('backend.app')

@section('content')

<div class="container">
    <h3 class="fw-bold mb-3"><b>Data Users</b></h3>
    <a href="{{ route('user.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> Add User
    </a>

    <!-- Form Pencarian -->
    <form action="{{ route('user') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari user..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i> Cari
            </button>
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

    <div class="card">
        <class="card-body">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                    <tr>
                        <td>{{ $users->firstItem() + $index }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">EDIT</a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDelete(event)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">DELETE</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            <div class="alert alert-warning mt-3">Tidak ada data user yang ditemukan.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
             
            <!-- Paginasi -->
            <div class="d-flex justify-content-center flex-wrap w-100 mt-3">
    <nav>
        <ul class="pagination">
            <!-- Tombol Previous -->
            @if ($users->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $users->previousPageUrl() }}">Previous</a>
                </li>
            @endif
            <!-- Info Halaman -->
            <li class="page-item disabled">
                <span class="page-link text-muted">Page {{ $users->currentPage() }} dari {{ $users->lastPage() }}</span>
            </li>
                <!-- Tombol Next -->
            @if ($users->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $users->nextPageUrl() }}">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Next</span>
                </li>
            @endif
        </ul>
    </nav>
</div>
</class>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(event) {
        event.preventDefault();
        let form = event.target;
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "User akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>

@endsection