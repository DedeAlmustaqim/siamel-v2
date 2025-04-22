$(document).ready(function () {
    $('#TabelUnit').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": true,
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
            url: BASE_URL + "/setting/skpd/get-skpd",
            // data: function(d) {
            //     d.status = $('#Dropdown').val(); // Kirim status ke backend
            // }
        },
        "columns": [{
            "orderable": false,
            "data": function (data) {
                return '<div class="text-left">' + data.id_unit + '</div>'
            }
        },
        {
            "orderable": false,
            "data": function (data) {
                return '<div class="text-left">' + data.nm_unit + '</div>'
            }
        },
        {
            "orderable": false,
            "data": function (data) {
                if (data.nm_pimpinan == null) {
                    return '<div class="text-left"><span class="text-danger">Belum Input</span></div>'
                } else {
                    return '<div class="text-left">' + data.nm_pimpinan + '</div>'
                }
            }
        },
        {
            "orderable": false,
            "data": function (data) {
                return `<div class="demo-inline-spacing">
        <button type="button" class="btn btn-outline-secondary waves-effect btn-sm" title="Edit" onClick="EditSkpd(this)" data-id="${data.id_unit}"><i class="ri-edit-line"></i></button>
        <button type="button" class="btn btn-outline-secondary waves-effect btn-sm" title="Pagu Belanja" onClick="PaguSkpd(this)" data-id="${data.id_unit}" data-nm="${data.nm_unit}"><i class="ri-shopping-cart-2-line"></i></button>
        <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="ri-user-line"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                  <a class="dropdown-item waves-effect" onclick="SetUser(this)" data-id="${data.id_unit}" href="javascript:void(0);">Lihat User</a>
                  <a class="dropdown-item waves-effect" href="javascript:void(0);">Tambah User</a>
                </div>
              </div>
        <button type="button" class="btn btn-outline-danger waves-effect btn-sm" title="Hapus" onClick="DeleteSkpd(${data.id_unit})"><i class="ri-delete-bin-2-line"></i></button>

      </div>`
            }
        },

        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        },
    });
});

function EditSkpd(elem) {
    var id = $(elem).data("id");



    $.ajax({
        type: "GET",
        "url": BASE_URL + "/setting/skpd/get-skpd-by-id/" + id,
        //processData: false,
        contentType: false,
        dataType: "JSON",
        async: true,
        success: function (data) {

            console.log(data)
            // document.getElementById('NmSkpd').innerHTML = nm;

            $('#id_unit').val(data['id_unit']);
            $('#skpd').val(data['nm_unit']);
            $('#pimpinan').val(data['nm_pimpinan']);
            $('#nip').val(data['nip']);
            $('#gol').val(data['gol_jab']);
            $('#stts_pimpinan').val(data['stts_p']);
            $('#ttd').val(data['ttd']);
            $('#ModalSkpd').modal('show');

        },

    })
    return false;
}

function PaguSkpd(elem) {
    var id = $(elem).data("id");


    $.ajax({
        type: "GET",
        "url": BASE_URL + "/setting/skpd/get-pagu/" + id,
        //processData: false,
        contentType: false,
        dataType: "JSON",
        async: true,
        success: function (data) {
            $('#ModalPagu').modal('show');


            $('#id_unit_pg').val(id);
            $('#pg_apbd_pg').val(data['pg_apbd']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
            $('#pg_bl_op_pg').val(data['pg_bl_op']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
            $('#pg_bl_bm_pg').val(data['pg_bl_bm']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
            $('#pg_btt_pg').val(data['pg_btt']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
            $('#pg_bt_pg').val(data['pg_bt']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });

            $('#pg_bl_peg_pg').val(data['pg_bl_peg']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
            $('#pg_bl_sub_pg').val(data['pg_bl_sub']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
            $('#pg_bl_bj_pg').val(data['pg_bl_bj']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
            $('#pg_bl_hibah_pg').val(data['pg_bl_hibah']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
            $('#pg_bl_bansos_pg').val(data['pg_bl_bansos']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
            $('#pg_bm_tanah_pg').val(data['pg_bm_tanah']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
            $('#pg_bm_alat_mesin_pg').val(data['pg_bm_alat_mesin']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
            $('#pg_bm_gedung_pg').val(data['pg_bm_gedung']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
            $('#pg_bm_jalan_pg').val(data['pg_bm_jalan']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
            $('#pg_bm_aset_pg').val(data['pg_bm_aset']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
            $('#pg_bl_bagi_hasil_pg').val(data['pg_bl_bagi_hasil']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
            $('#pg_bl_bantuan_keu_pg').val(data['pg_bl_bantuan_keu']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });

            if (data['btt_disable'] == 1) {
                $('#btt_disable').prop('checked', true); // Checks it
                //$('#btt_disable').val(1); // Checks it
            } else if (data['btt_disable'] == 0) {
                $('#btt_disable').prop('checked', false); // Checks it

            }

            if (data['pg_bl_peg_disable'] == 1) {
                $('#pg_bl_peg_disable').prop('checked', true); // Checks it
                //$('#btt_disable').val(1); // Checks it
            } else if (data['pg_bl_peg_disable'] == 0) {
                $('#pg_bl_peg_disable').prop('checked', false); // Checks it

            }

            if (data['pg_bl_sub_disable'] == 1) {
                $('#pg_bl_sub_disable').prop('checked', true); // Checks it
                //$('#btt_disable').val(1); // Checks it
            } else if (data['pg_bl_sub_disable'] == 0) {
                $('#pg_bl_sub_disable').prop('checked', false); // Checks it

            }

            if (data['pg_bl_bj_disable'] == 1) {
                $('#pg_bl_bj_disable').prop('checked', true); // Checks it
                //$('#btt_disable').val(1); // Checks it
            } else if (data['pg_bl_bj_disable'] == 0) {
                $('#pg_bl_bj_disable').prop('checked', false); // Checks it

            }

            if (data['pg_bl_hibah_disable'] == 1) {
                $('#pg_bl_hibah_disable').prop('checked', true); // Checks it
                //$('#btt_disable').val(1); // Checks it
            } else if (data['pg_bl_hibah_disable'] == 0) {
                $('#pg_bl_hibah_disable').prop('checked', false); // Checks it

            }

            if (data['pg_bl_bansos_disable'] == 1) {
                $('#pg_bl_bansos_disable').prop('checked', true); // Checks it
                //$('#btt_disable').val(1); // Checks it
            } else if (data['pg_bl_bansos_disable'] == 0) {
                $('#pg_bl_bansos_disable').prop('checked', false); // Checks it

            }

            if (data['pg_bm_tanah_disable'] == 1) {
                $('#pg_bm_tanah_disable').prop('checked', true); // Checks it
                //$('#btt_disable').val(1); // Checks it
            } else if (data['pg_bm_tanah_disable'] == 0) {
                $('#pg_bm_tanah_disable').prop('checked', false); // Checks it

            }

            if (data['pg_bm_alat_mesin_disable'] == 1) {
                $('#pg_bm_alat_mesin_disable').prop('checked', true); // Checks it
                //$('#btt_disable').val(1); // Checks it
            } else if (data['pg_bm_alat_mesin_disable'] == 0) {
                $('#pg_bm_alat_mesin_disable').prop('checked', false); // Checks it

            }

            if (data['pg_bm_gedung_disable'] == 1) {
                $('#pg_bm_gedung_disable').prop('checked', true); // Checks it
                //$('#btt_disable').val(1); // Checks it
            } else if (data['pg_bm_gedung_disable'] == 0) {
                $('#pg_bm_gedung_disable').prop('checked', false); // Checks it

            }

            if (data['pg_bm_jalan_disable'] == 1) {
                $('#pg_bm_jalan_disable').prop('checked', true); // Checks it
                //$('#btt_disable').val(1); // Checks it
            } else if (data['pg_bm_jalan_disable'] == 0) {
                $('#pg_bm_jalan_disable').prop('checked', false); // Checks it

            }

            if (data['pg_bm_aset_disable'] == 1) {
                $('#pg_bm_aset_disable').prop('checked', true); // Checks it
                //$('#btt_disable').val(1); // Checks it
            } else if (data['pg_bm_aset_disable'] == 0) {
                $('#pg_bm_aset_disable').prop('checked', false); // Checks it

            }

            if (data['pg_bl_bagi_hasil_disable'] == 1) {
                $('#pg_bl_bagi_hasil_disable').prop('checked', true); // Checks it
                //$('#btt_disable').val(1); // Checks it
            } else if (data['pg_bl_bagi_hasil_disable'] == 0) {
                $('#pg_bl_bagi_hasil_disable').prop('checked', false); // Checks it

            }

            if (data['pg_bl_bantuan_keu_disable'] == 1) {
                $('#pg_bl_bantuan_keu_disable').prop('checked', true); // Checks it
                //$('#btt_disable').val(1); // Checks it
            } else if (data['pg_bl_bantuan_keu_disable'] == 0) {
                $('#pg_bl_bantuan_keu_disable').prop('checked', false); // Checks it

            }

        },

    })
    return false;

}

$('.pg').keyup(function () {
    var sum = 0;
    $("input[class *= 'pg']").each(function () {
        sum += +$(this).val().replace(/,/g, '');
    });
    $('#pg_apbd_pg').val(sum).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
});

$('.pg_op').keyup(function () {
    var sumOp = 0;
    $("input[class *= 'pg_op']").each(function () {
        sumOp += +$(this).val().replace(/,/g, '');
    });
    $('#pg_bl_op_pg').val(sumOp).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
});

$('.pg_bm').keyup(function () {
    var sumBm = 0;
    $("input[class *= 'pg_bm']").each(function () {
        sumBm += +$(this).val().replace(/,/g, '');
    });
    $('#pg_bl_bm_pg').val(sumBm).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
});

$('.pg_bt').keyup(function () {
    var sumBt = 0;
    $("input[class *= 'pg_bt']").each(function () {
        sumBt += +$(this).val().replace(/,/g, '');
    });
    $('#pg_bt_pg').val(sumBt).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
});

$('#FormPagu').on('submit', function (e) {
    e.preventDefault();
    var postData = new FormData($("#FormPagu")[0]);
    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF
    postData.append('_token', csrfToken); // Sertakan token CSRF di FormData
    $.ajax({
        type: "POST",
        url: BASE_URL + "/setting/skpd/update-pagu",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {
            if (data.success == false) {

                data.errors.forEach(function (error) {
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
                $('#ModalPagu').modal('hide');
                $('#TabelUnit').DataTable().ajax.reload(null, false);
            }
        },
    });
    return false;
});

function SetUser(elem) {
    var id = $(elem).data("id");
    $('#ModalSetUser').modal('show');
    $('#TabelUser').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "bAutoWidth": false,
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
            url: BASE_URL + "/setting/user/get-user/" + id,
            // data: function(d) {
            //     d.status = $('#Dropdown').val(); // Kirim status ke backend
            // }
        },
        "columns": [
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.id + '</div>'
                },
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.username + '</div>'
                },
            },
            {
                "orderable": false,
                "data": function (data) {
                    return `<div class="demo-inline-spacing">
            <button type="button" class="btn btn-outline-secondary waves-effect btn-sm" title="Edit" onClick="resetPass(this)" data-id="${data.id_user}">Reset Password</button>
        
            <button type="button" class="btn btn-outline-danger waves-effect btn-sm" title="Hapus" onClick="DeleteUser(this)"><i class="ri-delete-bin-2-line"></i></button>
    
          </div>`
                }
            },


        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        },
    });
}

function resetPass(elem) {
    var id = $(elem).data("id");
    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Reset Password!',
        cancelButtonText: 'Batal',
        customClass: {
            confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
            cancelButton: 'btn btn-outline-secondary waves-effect'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: BASE_URL + "/setting/user/reset-pass/" + id,
                method: "POST",
                data: {
                    _token: csrfToken
                },
                async: false,
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Password default : SiamelBartim',
                            customClass: {
                                confirmButton: 'btn btn-success waves-effect'
                            }
                        });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat mengirimkan token.',
                            customClass: {
                                confirmButton: 'btn btn-danger waves-effect'
                            }
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat mengirimkan token.',
                        customClass: {
                            confirmButton: 'btn btn-danger waves-effect'
                        }
                    });
                }
            });
        }
    });
}

