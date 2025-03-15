
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
                    '<button type="button" class="btn waves-effect waves-light  btn-sm btn-secondary" onClick="ModalDakFisik(this)" data-id="' + data[i].id_dak_fisik + '" data-kunci="' + data[i].kunci_bln + '" data-bln="' + data[i].id_bln + '" data-unit="' + data[i].id_unit + '" data-nm_bln="' + data[i].nm_bln + '" title="Edit">Mekanisme <br>Realisasi</button>&nbsp' +
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
                    '<button type="button" class="btn waves-effect waves-light  btn-sm btn-secondary" onClick="ModalDakNonFisik(this)" data-id="' + data[i].id_dak_fisik + '" data-kunci="' + data[i].kunci_bln + '" data-bln="' + data[i].id_bln + '" data-unit="' + data[i].id_unit + '" data-nm_bln="' + data[i].nm_bln + '" title="Edit">Mekanisme <br>Realisasi</button>&nbsp' +
                    '</td>' +
                    '</tr>';
                $('#show_dak_non_fisik').html('<tr class="bg-light"><td colspan="16" class="text-white"><h5>DANA ALOKASI KHUSUS ( DAK ) NON FISIK </h5></td></tr>' + html);
            }
        },

    })
}