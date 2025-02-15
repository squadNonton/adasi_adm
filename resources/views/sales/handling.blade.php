@extends('layout')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Menu Handling</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboardHandling') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Menu Handling</li>

                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tampilan Data Handling</h5>
                            <div class="card-header" style="margin-bottom: 20px;">
                                <a href="{{ route('create') }}" class="btn btn-success btn-sm" style="font-size: 20px;">
                                    <i class="fas fa-plus"></i> Tambah Data
                                </a>
                            </div>
                            <!-- Table with stripped rows -->
                            <div class="table-responsive" style="height: 100%; overflow-y: auto;">
                                <table id="viewSales" class="table table-striped" style="table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="50px">NO</th>
                                            <th class="text-center" width="100px">NO WO</th>
                                            <th class="text-center" width="100px">Kode Pelanggan</th>
                                            <th class="text-center" width="150px">Nama Pelanggan</th>
                                            <th class="text-center" width="100px">Area Pelanggan</th>
                                            <th class="text-center" width="100px">Tipe Bahan</th>
                                            <th class="text-center" width="30px">T</th>
                                            <th class="text-center" width="30px">W</th>
                                            <th class="text-center" width="30px">OD</th>
                                            <th class="text-center" width="30px">ID</th>
                                            <th class="text-center" width="30px">L</th>
                                            <th class="text-center" width="95px">Jumlah(/Kg)</th>
                                            <th class="text-center" width="98px">Jumlah(/Pcs)</th>
                                            <th class="text-center" width="105px">Kategori (NG)</th>
                                            <th class="text-center" width="100px">Tipe proses</th>
                                            <th class="text-center" width="95px">Jenis 1</th>
                                            <th class="text-center" width="95px">Jenis 2</th>
                                            <th class="text-center" width="100px">Gambar</th>
                                            <th class="text-center" width="100px">Pembaruan Terakhir</th>
                                            <th class="text-center" width="100px">Status</th>
                                            <th class="text-center" width="100px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $row)
                                            <tr>
                                                <td class="text-center py-3">{{ ++$i }}</td>
                                                <td class="text-center py-3">{{ $row->no_wo }}</td>
                                                <td class="text-center py-3">{{ $row->customers->customer_code ?? '' }}</td>
                                                <td class="text-center py-3">{{ $row->customers->name_customer ?? '' }}</td>
                                                <td class="text-center py-3">{{ $row->customers->area ?? '' }}</td>
                                                <td class="text-center py-3">{{ $row->type_materials->type_name ?? '' }}
                                                </td>
                                                <td class="text-center py-3">{{ $row->thickness }}</td>
                                                <td class="text-center py-3">{{ $row->weight }}</td>
                                                <td class="text-center py-3">{{ $row->outer_diameter }}</td>
                                                <td class="text-center py-3">{{ $row->inner_diameter }}</td>
                                                <td class="text-center py-3">{{ $row->lenght }}</td>
                                                <td class="text-center py-3">{{ $row->qty }}</td>
                                                <td class="text-center py-3">{{ $row->pcs }}</td>
                                                <td class="text-center py-3">{{ $row->category }}</td>
                                                <td class="text-center py-3">{{ $row->process_type }}</td>
                                                <td class="text-center py-3">{{ $row->type_1 }}</td>
                                                <td class="text-center py-3">{{ $row->type_2 }}</td>
                                                <td class="text-center pt-3">
                                                    <img src="{{ asset('/storage/handling/' . $row->image) }}"
                                                        class="img-fluid rounded" style="max-width: 100%; height: auto;">
                                                </td>
                                                <td class="text-center py-3">{{ $row->created_at }}</td>
                                                <td class="text-center py-4"
                                                    style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                    @if ($row->status == 0)
                                                        <span class="badge bg-success align-items-center"
                                                            style="font-size: 18px;">Open</span>
                                                    @elseif ($row->status == 1)
                                                        <span class="badge bg-warning align-items-center"
                                                            style="font-size: 18px;">On Progress</span>
                                                    @elseif($row->status == 2)
                                                        <span class="badge bg-info align-items-center"
                                                            style="font-size: 18px;">Finish</span>
                                                    @elseif($row->status == 3)
                                                        <span class="badge bg-danger align-items-center"
                                                            style="font-size: 18px;">Close</span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-4">
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                        action="{{ route('delete', $row->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        @if ($row->status != 1 && $row->status != 2 && $row->status != 3)
                                                            <!-- Menambahkan kondisi untuk status yang tidak sama dengan 1, 2, atau 3 -->
                                                            <a href="{{ route('edit', $row->id) }}"
                                                                class="btn btn-sm btn-primary" title="Ubah Data">
                                                                <i class="fa-solid fa-edit fa-1x"></i>
                                                            </a>
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                title="Hapus">
                                                                <i class="fas fa-trash fa-1x"></i>
                                                            </button>
                                                        @elseif($row->status == 1)
                                                        <a href="{{ route('showHistory', $row->id) }}"
                                                            class="btn btn-sm btn-success">
                                                            <i class="fa fa-eye fa-1x" aria-hidden="true"></i>
                                                        </a>
                                                        @elseif ($row->status == 2)
                                                            <!-- Jika status 2 (Finish), tampilkan SweetAlert untuk konfirmasi -->
                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                onclick="confirmStatusChange({{ $row->id }})">
                                                                <i class="fa fa-window-close fa-1x"></i>
                                                            </button>
                                                            <a href="{{ route('showHistory', $row->id) }}"
                                                                class="btn btn-sm btn-success">
                                                                <i class="fa fa-eye fa-1x" aria-hidden="true"></i>
                                                            </a>
                                                            @elseif($row->status == 3)
                                                            <a href="{{ route('showHistory', $row->id) }}"
                                                                class="btn btn-sm btn-success">
                                                                <i class="fa fa-eye fa-1x" aria-hidden="true"></i>
                                                            </a>
                                                        @else
                                                            <!-- Jika status 1 (On Progress), 2 (Close), atau 3 (undefined), tombol Edit dan Hapus dinonaktifkan -->
                                                            <button type="button" class="btn btn-sm btn-primary disabled"
                                                                title="Ubah Data" disabled>
                                                                <i class="fa-solid fa-edit fa-1x" aria-hidden="true"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-danger disabled"
                                                                title="Hapus" disabled>
                                                                <i class="fas fa-trash fa-1x" aria-hidden="true"></i>
                                                            </button>
                                                        @endif
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
            </div>
        </section>

    </main><!-- End #main -->
@endsection
