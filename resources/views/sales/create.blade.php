@extends('layout')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Halaman Tambah Data</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboardHandling') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Menu Handling</a></li>
                    <li class="breadcrumb-item active">Halaman Tambah Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Tambah Data</h5>
                        <form id="formInputHandling" action="{{ route('store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="no_wo" class="col-sm-2 col-form-label">No. WO</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="no_wo" name="no_wo" maxlength="25" style="width: 100%; max-width: 400px;" required>
                                </div>
                                <label for="image_upload" class="col-sm-2 col-form-label">Unggah Gambar</label>
                                <div class="col-sm-4">
                                    <div class="d-flex align-items-center">
                                        <input class="form-control @error('image') is-invalid @enderror"" type="file" id="formFile" name="image" accept="image/*" style="width: calc(100% - 100px);" onchange="previewImage(event);" required>
                                        <button type="button" id="cancelUpload" class="btn btn-danger ms-2" style="display:none;">Batalkan Unggahan</button>
                                    </div>
                                    <small id="fileError" class="text-danger" style="display:none;">Format berkas tidak sesuai. Silakan unggah gambar.</small>
                                    <!-- error message untuk title -->
                                    @error('image')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <!-- Preview Image -->
                                    <div id="imagePreview" class="mt-2" style="display:none;">
                                        <img id="preview" src="" alt="Preview Image" style="max-width: 100%; max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="customer_code" class="col-sm-2 col-form-label">Kode Pelanggan</label>
                                <div class="col-sm-10">
                                    <select name="customer_id" class="select2" style="width: 400px;" required>
                                        <option value="" disabled selected>🔍 Search or select customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}" data-name_customer="{{ $customer->name_customer }}" data-area="{{ $customer->area }}">{{ $customer->customer_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name_customer" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                                <div class="col-sm-10">
                                    <select name="name_customer" class="select2" id="name_customer" style="width: 400px;"
                                        required disabled>
                                        <option>🔍 Search or select customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->name_customer }}">
                                                {{ $customer->name_customer }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="area" class="col-sm-2 col-form-label">Area Pelanggan</label>
                                <div class="col-sm-10">
                                    <select name="area" class="select2" id="area" style="width: 400px;" required disabled>
                                        <option>🔍 Search or select area</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->area }}">
                                                {{ $customer->area }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="type_material" class="col-sm-2 col-form-label">Tipe Bahan</label>
                                <div class="col-sm-10">
                                    <select name="type_id" class="form-select" style="width: 400px;" required>
                                        <option value="">------------- Type Material ------------</option>
                                        @foreach ($type_materials as $typematerial)
                                            <option value="{{ $typematerial->id }}">{{ $typematerial->type_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2 ps-5">
                                <div class="col-md-1">
                                    <label for="t" class="form-label">T:</label>
                                    <input type="text" class="form-control input-sm" id="thickness" name="thickness"
                                        placeholder="Thickness" style="max-width: 150px;">
                                </div>
                                <div class="col-md-1">
                                    <label for="w" class="form-label">W:</label>
                                    <input type="text" class="form-control input-sm" id="weight" name="weight"
                                        placeholder="Weight" style="max-width: 150px;">
                                </div>
                                <div class="col-md-2">
                                    <label for="w" class="form-label">L:</label>
                                    <input type="text" class="form-control input-sm" id="lenght" name="lenght"
                                        placeholder="Lenght" style="max-width: 150px;">
                                </div>
                            </div>
                            <div class="row mb-2 ps-5">
                                <div class="col-md-1">
                                    <label for="w" class="form-label">OD:</label>
                                    <input type="text" class="form-control input-sm" id="outer_diameter"
                                        name="outer_diameter" placeholder="Outer Diameter" style="max-width: 150px;">
                                </div>
                                <div class="col-md-1">
                                    <label for="w" class="form-label">ID:</label>
                                    <input type="text" class="form-control input-sm" id="inner_diameter"
                                        name="inner_diameter" placeholder="Inner Diameter" style="max-width: 150px;">
                                </div>
                            </div>
                            <div class="row mb-2 ps-5">
                                <div class="col-md-1">
                                    <label for="qty" class="form-label">Jumlah:</label>
                                    <input type="text" class="form-control input-sm" id="qty" name="qty"
                                        placeholder="(/KG)" style="max-width: 150px;" required>
                                </div>
                                <div class="col-md-1">
                                    <label for="pcs" class="form-label">Jumlah</label>
                                    <input type="text" class="form-control input-sm" id="pcs" name="pcs"
                                        placeholder="(/PCS)" style="max-width: 150px;" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="cataegory" class="col-sm-2 col-form-label">Kategori (NG)</label>
                                <div class="col-sm-10">
                                    <select name="category" class="form-control" id="category" name="category"
                                        style="width: 400px;" required>
                                        <option value="">------------------- Kategori -----------------</option>
                                        <option value="Retak">Retak</option>
                                        <option value="Pecah">Pecah</option>
                                        <option value="Etc">Etc</option>
                                        <!-- Tambahkan opsi statis lainnya jika diperlukan -->
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="process_type" class="col-sm-2 col-form-label">Jenis Proses</label>
                                <div class="col-sm-10">
                                    <select name="process_type" class="form-control" id="process_type"
                                        style="width: 400px;" required>
                                        <option value="">------------------- Tipe Proses -----------------</option>
                                        <option value="HeatTreatment">Heat treatment</option>
                                        <option value="Cutting">Cutting</option>
                                        <option value="Machining">Machining</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="proses_type" class="col-sm-2 col-form-label">Jenis</label>
                                <div class="col-sm-10" @required(true)>
                                    <div class="form-check mr-2">
                                        <input type="checkbox" class="form-check-input" id="type_1" name="type_1"
                                            value="Klaim">
                                        <label class="form-check-label" for="check1">Klaim</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="type_1" name="type_1"
                                            value="Komplain">
                                        <label class="form-check-label" for="check2">Komplain</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3" style="margin-top: 2%">
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button id="saveButton" type="submit" class="btn btn-primary mb-4 me-3"
                                        onclick="validateAndSubmit()">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <button type="button" class="btn btn-primary mb-4 me-3" onclick="goToIndex()">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            </div>
            </div>
            </div>
        </section>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Ambil elemen-elemen yang diperlukan
                var customerIdSelect = document.querySelector('select[name="customer_id"]');
                var nameCustomerSelect = document.querySelector('select[name="name_customer"]');
                var areaCustomerSelect = document.querySelector('select[name="area"]');
        
                // Tambahkan event listener untuk perubahan pada pilihan customer_id
                customerIdSelect.addEventListener('change', function() {
                    // Ambil opsi yang dipilih
                    var selectedOption = customerIdSelect.options[customerIdSelect.selectedIndex];
        
                    // Set nilai name_customer dan area sesuai dengan data yang dipilih
                    nameCustomerSelect.value = selectedOption.getAttribute('data-name_customer');
                    areaCustomerSelect.value = selectedOption.getAttribute('data-area');
                });
            });
        </script>
        

    </main><!-- End #main -->
@endsection
