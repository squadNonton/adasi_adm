@extends('layout')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Form Elements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Create mesin</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Form Create Mesin</h5>

                            <form id="mesinForm" action="{{ route('mesins.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama_mesin" class="form-label">
                                        Nama Mesin<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="nama_mesin" name="nama_mesin">
                                </div>

                                <div class="mb-3">
                                    <label for="no_mesin" class="form-label">
                                        No Mesin<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="no_mesin" name="no_mesin">
                                </div>

                                <div class="mb-3">
                                    <label for="merk" class="form-label">
                                        Merk<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="merk" name="merk">
                                </div>

                                <div class="mb-3">
                                    <label for="type" class="form-label">
                                        Type<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="type" name="type">
                                </div>

                                <div class="mb-3">
                                    <label for="mfg_date" class="form-label">
                                        Manufacturing date<span style="color: red;">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="mfg_date" name="mfg_date" placeholder="YYYY" min="1900" max="{{ date('Y') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="acq_date" class="form-label">
                                        Acquisition date<span style="color: red;">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="acq_date" name="acq_date" placeholder="YYYY" min="1900" max="{{ date('Y') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="age" class="form-label">Age<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="age" name="age" readonly>
                                    <!-- Jika Anda ingin melakukan perhitungan Age secara otomatis, Anda perlu menambahkan JavaScript untuk menghitungnya. -->
                                </div>

                                <div class="mb-3">
                                    <label for="preventive_date" class="form-label">Schedule Preventive Date</label>
                                    <input type="date" class="form-control" id="preventive_date" name="preventive_date">
                                </div>

                                <img id="fotoPreview" src="" alt="" style="max-width: 300px; max-height: 200px; display: none;">

                                <div class="mb-3">
                                    <label for="foto" class="form-label">Upload Foto (Jika ada)</label>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>

                                <img id="sparepartPreview" src="" alt="Preview Sparepart" style="max-width: 300px; max-height: 200px; display: none;">

                                <div class="mb-3">
                                    <label for="sparepart" class="form-label">Upload Data Sparepart (Jika ada)</label>
                                    <input type="file" class="form-control" id="sparepart" name="sparepart">
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ route('mesins.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function resetForm() {
            document.getElementById('mesinForm').reset();
        }
    </script>
    <script>
        function handleFormSubmission() {
            // Mendapatkan nilai input dari formulir
            var nama_mesin = document.getElementById('nama_mesin').value.trim();
            var no_mesin = document.getElementById('no_mesin').value.trim();
            var merk = document.getElementById('merk').value.trim();
            var type = document.getElementById('type').value.trim();
            var mfg_date = document.getElementById('mfg_date').value.trim();
            var acq_date = document.getElementById('acq_date').value.trim();

            // Melakukan validasi input
            if (nama_mesin === '' || no_mesin === '' || merk === '' || type === '' || mfg_date === '' || acq_date === '') {
                // Menampilkan SweetAlert jika ada isian yang kosong
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Harap lengkapi semua isian yang diperlukan.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return false; // Menghentikan pengiriman formulir karena ada isian yang kosong
            }

            // Jika semua isian sudah terisi, lanjutkan pengiriman formulir
            document.getElementById('mesinForm').submit();
        }

        // Event listener untuk submit form
        document.getElementById('mesinForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir secara default

            // Memanggil fungsi untuk menangani pengiriman formulir dan menampilkan SweetAlert
            handleFormSubmission();
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Tambahkan skrip JavaScript untuk menghitung Age saat mengisi form
        document.getElementById('mfg_date').addEventListener('input', function() {
            calculateAge();
        });

        document.getElementById('acq_date').addEventListener('input', function() {
            calculateAge();
        });

        function calculateAge() {
            let mfgdate = parseInt(document.getElementById('mfg_date').value);
            let acquisitiondate = parseInt(document.getElementById('acq_date').value);

            if (!isNaN(mfgdate) && !isNaN(acquisitiondate)) {
                let age = acquisitiondate - mfgdate;
                document.getElementById('age').value = age >= 0 ? age : '';
            }
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Menangkap elemen input file
            var fotoInput = document.getElementById('foto');
            var sparepartInput = document.getElementById('sparepart');

            // Menangkap elemen gambar preview
            var fotoPreview = document.getElementById('fotoPreview');
            var sparepartPreview = document.getElementById('sparepartPreview');

            // Mengatur listener untuk input file
            fotoInput.addEventListener('change', function() {
                previewImage(this, fotoPreview);
            });

            sparepartInput.addEventListener('change', function() {
                previewImage(this, sparepartPreview);
            });

            // Fungsi untuk menampilkan preview gambar
            function previewImage(input, previewElement) {
                var file = input.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    previewElement.src = e.target.result;
                    previewElement.style.display = 'block'; // Menampilkan preview setelah gambar diunggah
                };

                reader.readAsDataURL(file);
            }
        });
    </script>

</main><!-- End #main -->
@endsection
