$(document).ready(function () {

    $('#id_unit_apbd').on('change', function () {
        var id_unit_apbd = $(this).val();
        var bln = $('#bulan_apbd').val();
        if (id_unit_apbd != '' && bln != '') {
            getGetppbj(bln, id_unit_apbd);

        }
    });


    $('#bulan_apbd').on('change', function () {
        var bln = $(this).val();
        var id_unit_apbd = $('#id_unit_apbd').val();
        if (id_unit_apbd != '' && bln != '') {
            getGetppbj(bln, id_unit_apbd);

        }
    });


})

$('#FormPpbj50').on('submit', function (e) {
    e.preventDefault();
    var postData = new FormData($("#FormPpbj50")[0]);
    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF
    postData.append('_token', csrfToken); // Sertakan token CSRF di FormData
    $.ajax({
        type: "POST",
        url: BASE_URL + "/ppbj/update-ppbj50",
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
                var id_unit_apbd = $('#id_unit_apbd').val();
                var bln = $('#bulan_apbd').val();
                getGetppbj(bln, id_unit_apbd);
                $('#ModalPpbj50').modal('hide');

            }
        },
    });
    return false;
});


$('#FormPpbj200').on('submit', function (e) {
    e.preventDefault();
    var postData = new FormData($("#FormPpbj200")[0]);
    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF
    postData.append('_token', csrfToken); // Sertakan token CSRF di FormData
    $.ajax({
        type: "POST",
        url: BASE_URL + "/ppbj/update-ppbj200",
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
                var id_unit_apbd = $('#id_unit_apbd').val();
                var bln = $('#bulan_apbd').val();
                getGetppbj(bln, id_unit_apbd);
                $('#ModalPpbj200').modal('hide');

            }
        },
    });
    return false;
});

$('#FormPpbj25').on('submit', function (e) {
    e.preventDefault();
    var postData = new FormData($("#FormPpbj25")[0]);
    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF
    postData.append('_token', csrfToken); // Sertakan token CSRF di FormData
    $.ajax({
        type: "POST",
        url: BASE_URL + "/ppbj/update-ppbj25",
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
                var id_unit_apbd = $('#id_unit_apbd').val();
                var bln = $('#bulan_apbd').val();
                getGetppbj(bln, id_unit_apbd);
                $('#ModalPpbj25').modal('hide');

            }
        },
    });
    return false;
});

function getGetppbj(id_bln, unit) {
    $.ajax({
        url: BASE_URL + "/ppbj/get-ppbj/" + id_bln + "/" + unit,
        type: 'GET',
        async: true,
        dataType: 'json',
        success: function (data) {
            if (data.status_ppbj_50 == 0) {
                var stts_50 = '<span class="badge badge-danger badge-pill noti-icon-badge">Belum Input</span>'
            } else {
                var stts_50 = '<span class="badge badge-success badge-pill noti-icon-badge">Sudah Input</span>'
            }
            if (data.status_ppbj_200 == 0) {
                var stts_200 = '<span class="badge badge-danger badge-pill noti-icon-badge">Belum Input</span>'
            } else {
                var stts_200 = '<span class="badge badge-success badge-pill noti-icon-badge">Sudah Input</span>'
            }
            if (data.status_ppbj_200 == 0) {
                var stts_200 = '<span class="badge badge-danger badge-pill noti-icon-badge">Belum Input</span>'
            } else {
                var stts_200 = '<span class="badge badge-success badge-pill noti-icon-badge">Sudah Input</span>'
            }
            if (data.status_ppbj_25 == 0) {
                var stts_25 = '<span class="badge badge-danger badge-pill noti-icon-badge">Belum Input</span>'
            } else {
                var stts_25 = '<span class="badge badge-success badge-pill noti-icon-badge">Sudah Input</span>'
            }
            if (data.status_ppbj_25 == 0) {
                var stts_25 = '<span class="badge badge-danger badge-pill noti-icon-badge">Belum Input</span>'
            } else {
                var stts_25 = '<span class="badge badge-success badge-pill noti-icon-badge">Sudah Input</span>'
            }
            ppbj50 = `<td class="text-center">1</td>
                <td><b>PAKET NON STRATEGIS (>RP. 50 JT S/D Rp. 200 JT)</b><br>${stts_50} </td>
                <td class="text-center">${data.jml_pkt_50}</td>
                <td class="text-right">${Rupiah(data.jml_pg_50)}</td>
                <td class="text-center">${data.bp_pkt_50}</td>
                <td class="text-right">${Rupiah(data.bp_rp_50)}</td>
                <td class="text-center">
                    <button type="button" class="btn waves-effect waves-light  btn-sm btn-secondary" onClick="ModalPpbj50(this)"  data-bln="${data.id_bln}" data-unit="${data.id_unit}" data-nm_bln="${data.nm_bln}" title="Edit">Proses Pengadaan</button>
                    <a href="${BASE_URL}/ppbj/report-ppbj-50/${data.id_bln}/${data.id_unit}" target="_blank" class="btn waves-effect waves-light  btn-sm btn-secondary" ><i class="ri-printer-line"></i></a>
                </td>`;

            ppbj200 = `<td class="text-center">2</td>
                <td><b>PAKET NON STRATEGIS (>RP. 200 JT S/D Rp. 2,5 M)</b><br>${stts_200} </td>
                <td class="text-center">${data.jml_pkt_200}</td>
                <td class="text-right">${Rupiah(data.jml_pg_200)}</td>
                <td class="text-center">${data.bp_pkt_200}</td>
                <td class="text-right">${Rupiah(data.bp_rp_200)}</td>
                <td class="text-center">
                    <button type="button" class="btn waves-effect waves-light  btn-sm btn-secondary" onClick="ModalPpbj200(this)"  data-bln="${data.id_bln}" data-unit="${data.id_unit}" data-nm_bln="${data.nm_bln}" title="Edit">Proses Pengadaan</button>
                    <a href="${BASE_URL}/ppbj/report-ppbj-200/${data.id_bln}/${data.id_unit}" target="_blank" class="btn waves-effect waves-light  btn-sm btn-secondary" ><i class="ri-printer-line"></i></a>
                </td>`;

            ppbj25 = `<td class="text-center">3</td>
                <td><b>	PAKET NON STRATEGIS (>RP. 2,5 M S/D Rp. 5 M)</b><br>${stts_25} </td>
                <td class="text-center">${data.jml_pkt_25}</td>
                <td class="text-right">${Rupiah(data.jml_pg_25)}</td>
                <td class="text-center">${data.bp_pkt_25}</td>
                <td class="text-right">${Rupiah(data.bp_rp_25)}</td>
                <td class="text-center">
                    <button type="button" class="btn waves-effect waves-light  btn-sm btn-secondary" onClick="ModalPpbj25(this)"  data-bln="${data.id_bln}" data-unit="${data.id_unit}" data-nm_bln="${data.nm_bln}" title="Edit">Proses Pengadaan</button>
                    <a href="${BASE_URL}/ppbj/report-ppbj-25/${data.id_bln}/${data.id_unit}" target="_blank" class="btn waves-effect waves-light  btn-sm btn-secondary" ><i class="ri-printer-line"></i></a>
                </td>`;

            $('.show_ppbj_50').html(ppbj50);
            $('.show_ppbj_200').html(ppbj200);
            $('.show_ppbj_25').html(ppbj25);
        }

    });

}

function ModalPpbj50(elem) {

    var bln = $(elem).data("bln");
    var unit = $(elem).data("unit");
    $.ajax({
        type: "GET",
        url: BASE_URL + "/kunci-input/" + bln, // URL endpoint untuk request

        dataType: "JSON",
        async: true,
        success: function (response) {
            if (response['kunci_bln'] == 0) {
                Swal.fire({
                    title: 'Jadwal Terkunci',
                    // text: 'Data Sudah Input',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500

                });
            } else {
                $.ajax({
                    type: "GET",
                    url: BASE_URL + "/ppbj/get-ppbj/" + bln + "/" + unit,
                    //processData: false,
                    contentType: false,
                    dataType: "JSON",
                    async: true,
                    success: function (data) {
                        $('#ModalPpbj50').modal('show');


                        $('#id_unit').val(data['id_unit']);
                        $('#id_bln').val(data['id_bln']);
                        $('#jml_pkt_50').val(data['jml_pkt_50']);
                        $('#jml_pg_50').val(data['jml_pg_50']).formatCurrency();;
                        $('#pl_pkt_50').val(data['pl_pkt_50']);
                        $('#pl_rp_50').val(data['pl_rp_50']).formatCurrency();;
                        $('#h_pl_pkt_50').val(data['h_pl_pkt_50']);
                        $('#h_pl_rp_50').val(data['h_pl_rp_50']).formatCurrency();;
                        $('#kontrak_pkt_50').val(data['kontrak_pkt_50']);
                        $('#kontrak_rp_50').val(data['kontrak_rp_50']).formatCurrency();;
                        $('#st_pkt_50').val(data['st_pkt_50']);
                        $('#st_rp_50').val(data['st_rp_50']).formatCurrency();;
                        $('#bp_pkt_50').val(data['bp_pkt_50']);
                        $('#bp_rp_50').val(data['bp_rp_50']).formatCurrency();;

                    },

                })
                return false;
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    })


}


function updateValuesPkt50() {
    var jml_pkt_50 = parseInt($('#jml_pkt_50').val()) || 0;
    var pl_pkt_50 = parseInt($('#pl_pkt_50').val()) || 0;
    var pkt_50 = jml_pkt_50 - pl_pkt_50;
    $('#bp_pkt_50').val(pkt_50);

    var jml_pg_50 = parseFloat($('#jml_pg_50').val().replace(/,/g, '')) || 0;
    var pl_rp_50 = parseFloat($('#pl_rp_50').val().replace(/,/g, '')) || 0;
    var rp_50 = jml_pg_50 - pl_rp_50;
    $('#bp_rp_50').val(rp_50);
}

$('#jml_pkt_50, #pl_pkt_50, #jml_pg_50, #pl_rp_50').keyup(updateValuesPkt50);



function ModalPpbj200(elem) {

    var bln = $(elem).data("bln");
    var unit = $(elem).data("unit");
    $.ajax({
        type: "GET",
        url: BASE_URL + "/kunci-input/" + bln, // URL endpoint untuk request

        dataType: "JSON",
        async: true,
        success: function (response) {
            if (response['kunci_bln'] == 0) {
                Swal.fire({
                    title: 'Jadwal Terkunci',
                    // text: 'Data Sudah Input',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500

                });
            } else {
                $.ajax({
                    type: "GET",
                    url: BASE_URL + "/ppbj/get-ppbj/" + bln + "/" + unit,
                    //processData: false,
                    contentType: false,
                    dataType: "JSON",
                    async: true,
                    success: function (data) {
                        $('#ModalPpbj200').modal('show');


                        $('#id_unit_ppbj_200').val(data['id_unit']);
                        $('#id_bln_ppbj_200').val(data['id_bln']);
                        $('#jml_pkt_200').val(data['jml_pkt_200']);
                        $('#jml_pg_200').val(data['jml_pg_200']).formatCurrency();;
                        $('#pl_pkt_200').val(data['pl_pkt_200']);
                        $('#pl_rp_200').val(data['pl_rp_200']).formatCurrency();;
                        $('#h_pl_pkt_200').val(data['h_pl_pkt_200']);
                        $('#h_pl_rp_200').val(data['h_pl_rp_200']).formatCurrency();;
                        $('#kontrak_pkt_200').val(data['kontrak_pkt_200']);
                        $('#kontrak_rp_200').val(data['kontrak_rp_200']).formatCurrency();;
                        $('#st_pkt_200').val(data['st_pkt_200']);
                        $('#st_rp_200').val(data['st_rp_200']).formatCurrency();;
                        $('#bp_pkt_200').val(data['bp_pkt_200']);
                        $('#bp_rp_200').val(data['bp_rp_200']).formatCurrency();;

                    },

                })
                return false;
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    })


}


function updateValuesPkt200() {
    var jml_pkt_200 = parseInt($('#jml_pkt_200').val()) || 0;
    var pl_pkt_200 = parseInt($('#pl_pkt_200').val()) || 0;
    var pkt_200 = jml_pkt_200 - pl_pkt_200;
    $('#bp_pkt_200').val(pkt_200);

    var jml_pg_200 = parseFloat($('#jml_pg_200').val().replace(/,/g, '')) || 0;
    var pl_rp_200 = parseFloat($('#pl_rp_200').val().replace(/,/g, '')) || 0;
    var rp_200 = jml_pg_200 - pl_rp_200;
    $('#bp_rp_200').val(rp_200);
}

$('#jml_pkt_200, #pl_pkt_200, #jml_pg_200, #pl_rp_200').keyup(updateValuesPkt200);


function ModalPpbj25(elem) {

    var bln = $(elem).data("bln");
    var unit = $(elem).data("unit");
    $.ajax({
        type: "GET",
        url: BASE_URL + "/kunci-input/" + bln, // URL endpoint untuk request

        dataType: "JSON",
        async: true,
        success: function (response) {
            if (response['kunci_bln'] == 0) {
                Swal.fire({
                    title: 'Jadwal Terkunci',
                    // text: 'Data Sudah Input',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500

                });
            } else {
                $.ajax({
                    type: "GET",
                    url: BASE_URL + "/ppbj/get-ppbj/" + bln + "/" + unit,
                    //processData: false,
                    contentType: false,
                    dataType: "JSON",
                    async: true,
                    success: function (data) {
                        $('#ModalPpbj25').modal('show');


                        $('#id_unit_ppbj_25').val(data['id_unit']);
                        $('#id_bln_ppbj_25').val(data['id_bln']);
                        $('#jml_pkt_25').val(data['jml_pkt_25']);
                        $('#jml_pg_25').val(data['jml_pg_25']).formatCurrency();;
                        $('#pl_pkt_25').val(data['pl_pkt_25']);
                        $('#pl_rp_25').val(data['pl_rp_25']).formatCurrency();;
                        $('#h_pl_pkt_25').val(data['h_pl_pkt_25']);
                        $('#h_pl_rp_25').val(data['h_pl_rp_25']).formatCurrency();;
                        $('#kontrak_pkt_25').val(data['kontrak_pkt_25']);
                        $('#kontrak_rp_25').val(data['kontrak_rp_25']).formatCurrency();;
                        $('#st_pkt_25').val(data['st_pkt_25']);
                        $('#st_rp_25').val(data['st_rp_25']).formatCurrency();;
                        $('#bp_pkt_25').val(data['bp_pkt_25']);
                        $('#bp_rp_25').val(data['bp_rp_25']).formatCurrency();;

                    },

                })
                return false;
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    })


}


function updateValuesPkt25() {
    var jml_pkt_25 = parseInt($('#jml_pkt_25').val()) || 0;
    var pl_pkt_25 = parseInt($('#pl_pkt_25').val()) || 0;
    var pkt_25 = jml_pkt_25 - pl_pkt_25;
    $('#bp_pkt_25').val(pkt_25);

    var jml_pg_25 = parseFloat($('#jml_pg_25').val().replace(/,/g, '')) || 0;
    var pl_rp_25 = parseFloat($('#pl_rp_25').val().replace(/,/g, '')) || 0;
    var rp_25 = jml_pg_25 - pl_rp_25;
    $('#bp_rp_25').val(rp_25);
}

$('#jml_pkt_25, #pl_pkt_25, #jml_pg_25, #pl_rp_25').keyup(updateValuesPkt25);