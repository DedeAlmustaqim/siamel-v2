@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="row mb-5">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="TabelBulan" class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">NO</th>
                                <th width="20%" class="text-center">BULAN</th>
                                <th width="20%" class="text-center">BATAS AWAL</th>
                                <th width="20%" class="text-center">BATAS AKHIR</th>
                                <th width="15%" class="text-center">STATUS</th>
                                <th width="20%" class="text-center">SETTING</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalJadwal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="NmBln"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="m-t-0" novalidate="" id="FormJadwal" method="post">
                        <div class="row pt-3">
                            <input type="text" hidden id="IdBln" name="IdBln" class="form-control">

                            <div class="col-md-6">
                                <h5>Batas Awal</h5>
                                <div class="form-group">
                                    <label class="control-label">Tanggal</label>
                                    <input type="date" name="TglAwal" id="TglAwal" class="form-control">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="control-label">Pukul</label>
                                    <input class="form-control" type="time" id="WktInputAwal" name="WktInputAwal">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5>Batas Akhir</h5>
                                <div class="form-group">
                                    <label class="control-label">Tanggal</label>
                                    <input type="date" name="TglAkhir" id="TglAkhir" class="form-control">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="control-label">Pukul</label>
                                    <input class="form-control" type="time" id="WktInputAkhir" name="WktInputAkhir">
                                </div>

                            </div>
                            <!--/span-->
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('style')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#TabelBulan').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": false,
                "bInfo": false,
                "bAutoWidth": true,
                "columnDefs": [{
                    "visible": false,
                }],
                "order": [
                    [0, 'asc']
                ],
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ item per halaman",
                    "zeroRecords": "Tidak ada data yang ditampilkan",
                    "info": "Menampilkan Halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data yang ditampilkan",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "search": "Cari",
                    "paginate": {
                        "first": "Awal",
                        "last": "Akhir",
                        "next": ">",
                        "previous": "<"
                    },
                },
                "displayLength": 25,
                ajax: {
                    url: BASE_URL + "/setting/jadwal/get-bln",
                    // data: function(d) {
                    //     d.status = $('#Dropdown').val(); // Kirim status ke backend
                    // }
                },
                "columns": [{
                        "orderable": false,
                        "data": function(data) {
                            return '<div class="text-left">' + data.id_bln + '</div>'
                        }
                    },
                    {
                        "orderable": false,
                        "data": function(data, type, row, meta, dataToSet) {
                            if (data.kunci_bln == 0) {
                                return '<div class="text-left"><h3>' + data.nm_bln +
                                    ' </h3><span class="text-danger"> Terkunci</span></div>'

                            } else {
                                return '<div class="text-left"><h3>' + data.nm_bln +
                                    ' </h3><span class="text-success">Terjadwal</span></div>'

                            }
                        }
                    },
                    {
                        "orderable": false,
                        "data": function(data) {
                            return '<div class="text-left"><h5>' + data.hariAwal + '</h5>' +
                                data
                                .tgl_awal +
                                '</div>'
                        }
                    },
                    {
                        "orderable": false,
                        "data": function(data) {
                            return '<div class="text-left"><h5>' + data.hariAkhir + '</h5>' +
                                data
                                .tgl_akhir + '</div>'
                        }
                    },
                    {
                        "orderable": false,
                        "data": function(data, type, row, meta, dataToSet) {
                            if (data.aktif == 0) {
                                return `<div class="text-center"><div class="btn-group">
                                    <button class="btn btn-warning btn-sm dropdown-toggle waves-effect waves-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Non Aktif
                                    </button>
                                    <ul class="dropdown-menu" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px);">
                                        <li><a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="aktivasi(this)" data-id="${data.id_bln}" data-value="1">Aktifkan</a></li>
                                    </ul>
                                </div></div>`
                            } else if (data.aktif == 1) {
                                return `<div class="text-center"><div class="text-success">Aktif</div></div>`
                            }
                        }
                    },
                    {
                        "orderable": false,
                        "data": function(data) {
                            return `<div class="text-center">
                        <button type="button" class="btn btn-outline-secondary waves-effect btn-sm" title="Jadwal" onClick="modalJadwal(this)" data-id="${data.id_bln}" >Jadwal</button>

                      </div>`
                        }
                    },

                ],
                rowCallback: function(row, data, iDisplayIndex) {
                    var info = this.fnPagingInfo();
                    var page = info.iPage;
                    var length = info.iLength;
                    var index = page * length + (iDisplayIndex + 1);
                    $('td:eq(0)', row).html(index);
                },
            });
        });

        function modalJadwal(e) {
            var id = $(e).data('id');

            $.ajax({
                type: "GET",
                "url": BASE_URL + "/setting/jadwal/get-bln-by-id/" + id,
                processData: false,
                contentType: false,

                dataType: "JSON",
                success: function(data) {
                    $('#IdBln').val(id);
                    $('#TglAwal').val(data.tgl_awal.substring(0, 10));
                    $('#WktInputAwal').val(data.tgl_awal.substring(11));
                    $('#TglAkhir').val(data.tgl_akhir.substring(0, 10));
                    $('#WktInputAkhir').val(data.tgl_akhir.substring(11));

                    document.getElementById('NmBln').innerHTML = data.nm_bln;
                    $('#modalJadwal').modal('show');
                },
                error: function(data) {

                    Swal.fire({
                        title: 'Gagal',
                        text: 'Data Tidak Ditemukan',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500

                    });

                },
            })
            return false;
        }

        $('#FormJadwal').on('submit', function(e) {
            e.preventDefault();
            var postData = new FormData($("#FormJadwal")[0]);
            var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF
            postData.append('_token', csrfToken); // Sertakan token CSRF di FormData
            $.ajax({
                type: "POST",
                url: BASE_URL + "/setting/jadwal/update",
                processData: false,
                contentType: false,
                data: postData,
                dataType: "JSON",
                success: function(data) {
                    if (data.success == false) {

                        data.errors.forEach(function(error) {
                            // Karena error adalah string, kita bisa langsung menampilkannya
                            Swal.fire({
                                title: "Gagal Simpan Data",
                                text: error,
                                icon: "warning",
                                showConfirmButton: false,
                                timer: 2000
                            });

                        });
                    } else if (data.success == true) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Data telah disimpan',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000,
                        });
                        var id_unit_apbd = $('#id_unit_apbd').val();
                        var bln = $('#bulan_apbd').val();
                        $('#modalJadwal').modal('hide');
                        $('#TabelBulan').DataTable().ajax.reload(null, false);
                    }
                },
            });
            return false;
        });

        function aktivasi(elem) {
            var id = $(elem).data("id");
            var value = $(elem).data("value");

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, aktifkan!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                    cancelButton: 'btn btn-outline-secondary waves-effect'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: BASE_URL + "/setting/jadwal/aktivasi/" + id,
                        method: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            value: value
                        },
                        async: false,
                        dataType: 'json',
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Jadwal berhasil diperbarui!',
                                    text: 'Jadwal telah diaktifkan.',
                                    customClass: {
                                        confirmButton: 'btn btn-success waves-effect'
                                    }
                                });
                                location.reload();

                            }
                        }
                    });
                }
            });
        }
    </script>
@endpush
