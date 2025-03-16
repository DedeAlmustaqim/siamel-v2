
$(document).ready(function () {

    $('#id_unit_apbd').on('change', function () {
        var id_unit_apbd = $(this).val();
        var bln = $('#bulan_apbd').val();
        if (id_unit_apbd != '' && bln != '') {
            showDak(bln, id_unit_apbd);

        }
    });


    $('#bulan_apbd').on('change', function () {
        var bln = $(this).val();
        var id_unit_apbd = $('#id_unit_apbd').val();
        if (id_unit_apbd != '' && bln != '') {
            showDak(bln, id_unit_apbd);

        }
    });


})

function showDak(id_bln, unit) {
    $.ajax({
        type: "get",
        "url": BASE_URL + "/dak/get-dak-fisik/" + id_bln + '/' + unit,
        dataType: "JSON",

        success: function (data) {
            document.getElementById('BtnDakFisik').innerHTML =
                '<a href="' + BASE_URL + '/dak/report-dak-fisik/' + id_bln + '/' + unit + '" target="_blank" class="btn btn-sm btn-secondary waves-effect waves-light" ><i class="ri-printer-line"></i> DAK Fisik</a>';

            var html = '';
            var count = 1;
            var i;
            for (i = 0; i < data.length; i++) {
                if (data[i].status_dak_fisik == 0) {
                    var status = '<span class="text-warning">Belum Input</span>'
                } else {
                    var status = '<span class="text-success">Sudah Input</span>'
                }
                html += '<tr>' +
                    '<td>' + count++ + '</td>' +
                    '<td>' + data[i].keg + '<br>' + status + '</td>' +

                    '<td class="text-right">' + Rupiah(data[i].pagu) + '</td>' +

                    '<td class="text-right">' + Rupiah(data[i].real_keu) + '</td>' +
                    '<td>' + data[i].real_keu_per + '</td>' +
                    '<td>' + data[i].real_fik + '</td>' +
                    '<td class="text-center">' +
                    '<button type="button" class="btn waves-effect waves-light  btn-sm btn-secondary" onClick="ModalDakFisik(this)" data-id="' + data[i].id_dak_fisik + '" data-bln="' + data[i].id_bln + '"  data-unit="' + data[i].id_unit + '"  title="Edit">Mekanisme <br>Realisasi</button>&nbsp' +
                    '</td>' +
                    '</tr>';
                $('#show_dak_fisik').html('<tr class="bg-light"><td colspan="16" class="text-white"><h5>DANA ALOKASI KHUSUS ( DAK ) FISIK REGULER</h5></td></tr>' + html);
            }
        },

    })
    $.ajax({
        type: "get",
        "url": BASE_URL + "/dak/get-dak-non-fisik/" + id_bln + '/' + unit,
        dataType: "JSON",

        success: function (data) {
            document.getElementById('BtnDakNonFisik').innerHTML =
                '<a href="' + BASE_URL + '/dak/report-dak-non-fisik/' + id_bln + '/' + unit + '" target="_blank" class="btn btn-sm btn-secondary waves-effect waves-light" ><i class="ri-printer-line"></i> DAK Non Fisik</a>';

            var html = '';
            var count = 1;
            var i;
            for (i = 0; i < data.length; i++) {
                if (data[i].status_dak_non_fisik == 0) {
                    var status = '<span class="text-warning">Belum Input</span>'
                } else {
                    var status = '<span class="text-success">Sudah Input</span>'
                }
                html += '<tr>' +
                    '<td>' + count++ + '</td>' +
                    '<td>' + data[i].keg + '<br>' + status + '</td>' +

                    '<td class="text-right">' + Rupiah(data[i].pagu) + '</td>' +

                    '<td class="text-right">' + Rupiah(data[i].real_keu) + '</td>' +
                    '<td>' + data[i].real_keu_per + '</td>' +
                    '<td>' + data[i].real_fik + '</td>' +
                    '<td class="text-center">' +
                    '<button type="button" class="btn waves-effect waves-light  btn-sm btn-secondary" onClick="ModalDakNonFisik(this)" data-id="' + data[i].id_dak_non_fisik + '" data-bln="' + data[i].id_bln + '"  data-unit="' + data[i].id_unit + '"  title="Edit">Mekanisme <br>Realisasi</button>&nbsp' +
                    '</td>' +
                    '</tr>';
                $('#show_dak_non_fisik').html('<tr class="bg-light"><td colspan="16" class="text-white"><h5>DANA ALOKASI KHUSUS ( DAK ) NON FISIK </h5></td></tr>' + html);
            }
        },

    })
}

// DAK FISIK
function ModalDakFisik(elem) {
    var bln = $(elem).data("bln");
    var id = $(elem).data("id");


    $.ajax({
        url: BASE_URL + "/kunci-input/" + bln, // URL endpoint untuk request
        type: "GET", // Metode HTTP
        dataType: "json", // Tipe data yang diharapkan dari server
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
                    "url": BASE_URL + "/dak/get-dak-fisik-by-id/" + id,
                    //processData: false,
                    contentType: false,
                    dataType: "JSON",
                    async: true,
                    success: function (data) {
                        $('#ModalDakFisik').modal('show');

                        $('#id_dak_fisik').val(data['id_dak_fisik']);
                        $('#keg_fisik').val(data['keg']);
                        $('#per_vol_fisik').val(data['per_vol']);
                        $('#per_satuan_fisik').val(data['per_satuan']);
                        $('#per_jlm_penerima_fisik').val(data['per_jlm_penerima']);
                        $('#pagu_fisik').val(data['pagu']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
                        $('#jns_mekanisme_fisik').val(data['jns_mekanisme']);

                        $('#mek_metode_fisik').val(data['mek_metode']);
                        $('#mek_vol_swa_fisik').val(data['mek_vol_swa']);
                        $('#mek_nilai_swa_fisik').val(data['mek_nilai_swa']);
                        $('#mek_vol_kon_fisik').val(data['mek_vol_swa']);
                        $('#mek_nilai_kon_fisik').val(data['mek_nilai_swa']);
                        if (data['jns_mekanisme'] == "Swakelola") {

                            $('#mek_vol_kon_fisik').val(data['mek_vol_kon']).prop('readonly', true).attr('readonly', 'readonly').addClass('readonly-bg');
                            $('#mek_nilai_kon_fisik').val(data['mek_nilai_kon']).prop('readonly', true).attr('readonly', 'readonly').addClass('readonly-bg');

                        } else if (data['jns_mekanisme'] == "Kontraktual") {
                            $('#mek_vol_swa_fisik').val(data['mek_vol_swa']).prop('readonly', true).attr('readonly', 'readonly').addClass('readonly-bg');
                            $('#mek_nilai_swa_fisik').val(data['mek_nilai_swa']).prop('readonly', true).attr('readonly', 'readonly').addClass('readonly-bg');;
                        }
                        $('#real_keu_fisik').val(data['real_keu']);
                        $('#real_keu_per_fisik').val(data['real_keu_per']);
                        $('#real_fik_fisik').val(data['real_fik']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
                        $('#kodefikasi_fisik').val(data['kodefikasi']);

                    },

                })
                return false;
            }
        },
        error: function (xhr, status, error) {
            console.error("Error:", error);
        }
    });


}

$('#FormDakFisikInput').on('submit', function (e) {
    e.preventDefault();
    var postData = new FormData($("#FormDakFisikInput")[0]);
    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF
    postData.append('_token', csrfToken); // Sertakan token CSRF di FormData
    $.ajax({
        type: "POST",
        url: BASE_URL + "/dak/update-dak-fisik",
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
                showDak(bln, id_unit_apbd);
                $('#ModalDakFisik').modal('hide');

            }
        },
    });
    return false;
});

$('#jns_mekanisme_fisik').change(function () {
    const mekanisme = $(this).val();
    const swakelola = mekanisme === "Swakelola";
    $('#mek_vol_swa_fisik, #mek_nilai_swa_fisik').prop('readonly', !swakelola).toggleClass('readonly-bg', !swakelola);
    $('#mek_vol_kon_fisik, #mek_nilai_kon_fisik').prop('readonly', swakelola).toggleClass('readonly-bg', swakelola);
});
$('#real_keu_fisik').keyup(function () {
    var pagu = +$('#pagu_fisik').val().replace(/,/g, '');
    var real = +$('#real_keu_fisik').val().replace(/,/g, '');
    $('#real_keu_per_fisik').val((real / pagu * 100).toFixed(2));
});


// END DAK FISIK

// DAK NON FISIK
function ModalDakNonFisik(elem) {
    var bln = $(elem).data("bln");
    var id = $(elem).data("id");


    $.ajax({
        url: BASE_URL + "/kunci-input/" + bln, // URL endpoint untuk request
        type: "GET", // Metode HTTP
        dataType: "json", // Tipe data yang diharapkan dari server
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
                    "url": BASE_URL + "/dak/get-dak-non-fisik-by-id/" + id,
                    //processData: false,
                    contentType: false,
                    dataType: "JSON",
                    async: true,
                    success: function (data) {
                        $('#ModalDakNonFisik').modal('show');

                        $('#id_dak_non_fisik').val(data['id_dak_non_fisik']);
                        $('#keg_non_fisik').val(data['keg']);
                        $('#per_vol_non_fisik').val(data['per_vol']);
                        $('#per_satuan_non_fisik').val(data['per_satuan']);
                        $('#per_jlm_penerima_non_fisik').val(data['per_jlm_penerima']);
                        $('#pagu_non_fisik').val(data['pagu']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
                        $('#jns_mekanisme_non_fisik').val(data['jns_mekanisme']);

                        $('#mek_metode_non_fisik').val(data['mek_metode']);
                        $('#mek_vol_swa_non_fisik').val(data['mek_vol_swa']);
                        $('#mek_nilai_swa_non_fisik').val(data['mek_nilai_swa']);
                        $('#mek_vol_kon_non_fisik').val(data['mek_vol_swa']);
                        $('#mek_nilai_kon_non_fisik').val(data['mek_nilai_swa']);
                        if (data['jns_mekanisme'] == "Swakelola") {

                            $('#mek_vol_kon_non_fisik').val(data['mek_vol_kon']).prop('readonly', true).attr('readonly', 'readonly').addClass('readonly-bg');
                            $('#mek_nilai_kon_non_fisik').val(data['mek_nilai_kon']).prop('readonly', true).attr('readonly', 'readonly').addClass('readonly-bg');

                        } else if (data['jns_mekanisme'] == "Kontraktual") {
                            $('#mek_vol_swa_non_fisik').val(data['mek_vol_swa']).prop('readonly', true).attr('readonly', 'readonly').addClass('readonly-bg');
                            $('#mek_nilai_swa_non_fisik').val(data['mek_nilai_swa']).prop('readonly', true).attr('readonly', 'readonly').addClass('readonly-bg');;
                        }
                        $('#real_keu_non_fisik').val(data['real_keu']);
                        $('#real_keu_per_non_fisik').val(data['real_keu_per']);
                        $('#real_fik_non_fisik').val(data['real_fik']).formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: -1, eventOnDecimalsEntered: true });
                        $('#kodefikasi_non_fisik').val(data['kodefikasi']);

                    },

                })
                return false;
            }
        },
        error: function (xhr, status, error) {
            console.error("Error:", error);
        }
    });


}

$('#FormDakNonFisikInput').on('submit', function (e) {
    e.preventDefault();
    var postData = new FormData($("#FormDakNonFisikInput")[0]);
    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF
    postData.append('_token', csrfToken); // Sertakan token CSRF di FormData
    $.ajax({
        type: "POST",
        url: BASE_URL + "/dak/update-dak-non-fisik",
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
                showDak(bln, id_unit_apbd);
                $('#ModalDakNonFisik').modal('hide');

            }
        },
    });
    return false;
});


$('#jns_mekanisme_non_fisik').change(function () {
    const swakelola = $(this).val() === "Swakelola";
    $('#mek_vol_swa_non_fisik, #mek_nilai_swa_non_fisik').prop('readonly', !swakelola).toggleClass('readonly-bg', !swakelola);
    $('#mek_vol_kon_non_fisik, #mek_nilai_kon_non_fisik').prop('readonly', swakelola).toggleClass('readonly-bg', swakelola);
});




$('#real_keu_non_fisik').keyup(function () {
    var pagu = +$('#pagu_non_fisik').val().replace(/,/g, '');
    var real = +$('#real_keu_non_fisik').val().replace(/,/g, '');
    $('#real_keu_per_non_fisik').val((real / pagu * 100).toFixed(2));
});

// END DAK NON FISIK
