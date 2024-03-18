@extends('layout')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.20.0/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>

    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List Data mesin</h5>
                        <div class="text-right mb-3">
                            <a class="btn btn-success float-right" href="{{ route('mesins.create') }}">
                                <i class="bi bi-plus"></i> Tambah Mesin
                            </a>
                        </div>

                        <!-- Table with stripped rows -->
                        <table class="table table-striped table-bordered table-hover datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Mesin</th>
                                    <th scope="col">No Mesin</th>
                                    <th scope="col">Merk</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">MFG Date</th>
                                    <th scope="col">Acquisition Date</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Last Update</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mesins as $mesin)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $mesin->nama_mesin }}</td>
                                    <td>{{ $mesin->no_mesin }}</td>
                                    <td>{{ $mesin->merk }}</td>
                                    <td>{{ $mesin->type }}</td>
                                    <td>{{ $mesin->mfg_date }}</td>
                                    <td>{{ $mesin->acq_date }}</td>
                                    <td>{{ $mesin->age }}</td>
                                    <td>{{ $mesin->created_at }}</td>
                                    <td>{{ $mesin->updated_at }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('mesins.edit', $mesin->id) }}">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <a class="btn btn-warning" href="{{ route('mesins.show', $mesin->id) }}">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" onclick="deletemesin({{$mesin->id}})">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                        <form id="mesinForm_{{ $mesin->id }}" action="{{ route('mesins.destroy', $mesin->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


</main><!-- End #main -->
@endsection
<script>
    function deletemesin(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data yang dihapus tidak bisa dipakai kembali!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // If user clicks "Ya, hapus!" button, perform the deletion
                Swal.fire({
                    title: "Berhasil!",
                    text: "Nomor mesin Berhasil dihapus.",
                    icon: "success",
                    timer: 1000, // Penundaan (delay) sebelum mengeksekusi aksi berikutnya (dalam milidetik)
                    showConfirmButton: false // Menyembunyikan tombol OK
                }).then(() => {
                    // Add a button "OK" after the confirmation
                    Swal.fire({
                        title: "Info",
                        text: "Data berhasil dihapus!",
                        icon: "info",
                        showConfirmButton: true,
                        confirmButtonText: "OK"
                    }).then((okResult) => {
                        // Check if the user clicked "OK"
                        if (okResult.isConfirmed) {
                            // Submit the form
                            document.getElementById('mesinForm_' + id).submit();
                        }
                    });
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    title: "Gagal",
                    text: "Nomor mesin gagal dihapus",
                    icon: "error"
                });
            }
        });
    }
</script>