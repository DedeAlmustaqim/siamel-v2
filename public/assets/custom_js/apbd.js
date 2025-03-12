
$(document).ready(function () {

    $('#id_unit_apbd').on('change', function () {
        var id_unit_apbd = $(this).val();
        var bln = $('#bulan_apbd').val();
        if (id_unit_apbd != '' && bln != '') {
            getData(id_unit_apbd, bln);
        }
    });


    $('#bulan_apbd').on('change', function () {
        var bln = $(this).val();
        var id_unit_apbd = $('#id_unit_apbd').val();
        if (id_unit_apbd != '' && bln != '') {
            getData(id_unit_apbd, bln);
        }
    });


})

function getData(id_unit, bln) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            async: true,
            type: "get",
            url: BASE_URL + "/apbd/get-apbd/" + id_unit + "/" + bln,


            success: function (response) {
                console.log(response)
                resolve(response);



                $('#pg_bl_op_detail').html(response.pg_bl_op ? response.pg_bl_op : 0);
                $('#rk_keu_op_rp_detail').html(response.rk_keu_op_rp ? response.rk_keu_op_rp :
                    0);
                $('#rk_keu_op_per_detail').html(response.rk_keu_op_per ? response
                    .rk_keu_op_per : 0);
                $('#rf_op_detail').html(response.rf_op ? response.rf_op : 0);

                $('#pg_bl_bm_detail').html(response.pg_bl_bm ? response.pg_bl_bm : 0);
                $('#rk_keu_bm_rp_detail').html(response.rk_keu_bm_rp ? response.rk_keu_bm_rp :
                    0);
                $('#rk_keu_bm_per_detail').html(response.rk_keu_bm_per ? response
                    .rk_keu_bm_per : 0);
                $('#rf_bm_detail').html(response.rf_bm ? response.rf_bm : 0);

                $('#pg_btt_detail').html(response.pg_btt ? response.pg_btt : 0);
                $('#rk_keu_btt_rp_detail').html(response.rk_keu_btt_rp ? response
                    .rk_keu_btt_rp : 0);
                $('#rk_keu_btt_per_detail').html(response.rk_keu_btt_per ? response
                    .rk_keu_btt_per : 0);
                $('#rf_btt_detail').html(response.rf_btt ? response.rf_btt : 0);

                $('#pg_bl_bt_detail').html(response.pg_bl_bt ? response.pg_bl_bt : 0);
                $('#rk_keu_bt_rp_detail').html(response.rk_keu_bt_rp ? response.rk_keu_bt_rp :
                    0);
                $('#rk_keu_bt_per_detail').html(response.rk_keu_bt_per ? response
                    .rk_keu_bt_per : 0);
                $('#rf_bt_detail').html(response.rf_bt ? response.rf_bt : 0);

                $('#pg_apbd_detail').html(response.pg_apbd ? response.pg_apbd : 0);
                $('#real_apbd_detail').html(response.real_apbd ? response.real_apbd : 0);
                $('#real_apbd_per_detail').html(response.real_apbd_per ? response
                    .real_apbd_per : 0);
                $('#real_apbd_fisik_detail').html(response.real_apbd_fisik ? response
                    .real_apbd_fisik : 0);


                var btnApbd = `<button type="button" class="btn btn-primary waves-effect waves-light" data-id="${response.id_apdb ?? 0}" data-kunci="${response.kunci_input}" onclick="modalEdit(this)"><i class="ri-pencil-line"></i>  Edit</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light">Cetak</button>`;
                $('#btnApbd').html(btnApbd);
            },
            error: function (xhr, status, error) {
                reject(error);
            }
        });
    });


}

function modalEdit(elem) {
    var id_apbd = $(elem).data('id');
    var kunci_input = $(elem).data('kunci');

    if (kunci_input == 0) {
        Swal.fire({
            title: 'Jadwal Terkunci',
            // text: 'Data Sudah Input',
            icon: 'error',

        });
    } else {
        if (id_apbd == 0) {
            Swal.fire({
                title: 'Gagal',
                text: 'Data Tidak Ditemukan',
                icon: 'error',

            });
        } else {
            var id_unit_apbd = $('#id_unit_apbd').val();
            var bln = $('#bulan_apbd').val();
            $('#modalApbd').modal('show');
            $('#pg_bl_op').attr('readonly', 'readonly').addClass('readonly-bg');
            $('#pg_bl_bm').attr('readonly', 'readonly').addClass('readonly-bg');
            $('#pg_btt').attr('readonly', 'readonly').addClass('readonly-bg');
            $('#pg_bl_bt').attr('readonly', 'readonly').addClass('readonly-bg');

            $('#pg_bl_peg').attr('readonly', 'readonly').addClass('readonly-bg');
            $('#pg_bl_sub').attr('readonly', 'readonly').addClass('readonly-bg');
            $('#pg_bl_bj').attr('readonly', 'readonly').addClass('readonly-bg');
            $('#pg_bl_hibah').attr('readonly', 'readonly').addClass('readonly-bg');
            $('#pg_bl_bansos').attr('readonly', 'readonly').addClass('readonly-bg');
            $('#pg_bm_tanah').attr('readonly', 'readonly').addClass('readonly-bg');
            $('#pg_bm_alat_mesin').attr('readonly', 'readonly').addClass('readonly-bg');
            $('#pg_bm_gedung').attr('readonly', 'readonly').addClass('readonly-bg');
            $('#pg_bm_jalan').attr('readonly', 'readonly').addClass('readonly-bg');
            $('#pg_bm_aset').attr('readonly', 'readonly').addClass('readonly-bg');
            $('#pg_bl_bagi_hasil').attr('readonly', 'readonly').addClass('readonly-bg');
            $('#pg_bl_bantuan_keu').attr('readonly', 'readonly').addClass('readonly-bg');


            $.ajax({
                type: "GET",
                "url": BASE_URL + "/apbd/get-pagu/" + id_unit_apbd,
                //processData: false,
                contentType: false,
                dataType: "JSON",
                async: true,
                success: function (data) {
                    if (data['btt_disable'] == 1) {
                        $('#rk_keu_btt_rp').attr('readonly', 'readonly').addClass('readonly-bg');
                        $('#rf_btt').attr('readonly', 'readonly').addClass('readonly-bg');
                    }

                    if (data['pg_bl_peg_disable'] == 1) {
                        $('#rk_keu_peg_rp').attr('readonly', 'readonly').addClass('readonly-bg');
                        $('#rf_peg').attr('readonly', 'readonly').addClass('readonly-bg');
                    }

                    if (data['pg_bl_sub_disable'] == 1) {
                        $('#rk_keu_sub_rp').attr('readonly', 'readonly').addClass('readonly-bg');
                        $('#rf_sub').attr('readonly', 'readonly').addClass('readonly-bg');
                    }

                    if (data['pg_bl_bj_disable'] == 1) {
                        $('#rk_keu_bj_rp').attr('readonly', 'readonly').addClass('readonly-bg');
                        $('#rf_bj').attr('readonly', 'readonly').addClass('readonly-bg');
                    }

                    if (data['pg_bl_hibah_disable'] == 1) {
                        $('#rk_keu_hibah_rp').attr('readonly', 'readonly').addClass('readonly-bg');
                        $('#rf_hibah').attr('readonly', 'readonly').addClass('readonly-bg');
                    }

                    if (data['pg_bl_bansos_disable'] == 1) {
                        $('#rk_keu_bansos_rp').attr('readonly', 'readonly').addClass('readonly-bg');
                        $('#rf_bansos').attr('readonly', 'readonly').addClass('readonly-bg');
                    }

                    if (data['pg_bm_tanah_disable'] == 1) {
                        $('#rk_keu_bm_tanah_rp').attr('readonly', 'readonly').addClass('readonly-bg');
                        $('#rf_bm_tanah').attr('readonly', 'readonly').addClass('readonly-bg');
                    }

                    if (data['pg_bm_alat_mesin_disable'] == 1) {
                        $('#rk_keu_alat_mesin_rp').attr('readonly', 'readonly').addClass('readonly-bg');
                        $('#rf_alat_mesin').attr('readonly', 'readonly').addClass('readonly-bg');
                    }

                    if (data['pg_bm_gedung_disable'] == 1) {
                        $('#rk_keu_gedung_rp').attr('readonly', 'readonly').addClass('readonly-bg');
                        $('#rf_gedung').attr('readonly', 'readonly').addClass('readonly-bg');
                    }

                    if (data['pg_bm_jalan_disable'] == 1) {
                        $('#rk_keu_jalan_rp').attr('readonly', 'readonly').addClass('readonly-bg');
                        $('#rf_jalan').attr('readonly', 'readonly').addClass('readonly-bg');
                    }

                    if (data['pg_bm_aset_disable'] == 1) {
                        $('#rk_keu_aset_rp').attr('readonly', 'readonly').addClass('readonly-bg');
                        $('#rf_aset').attr('readonly', 'readonly').addClass('readonly-bg');
                    }

                    if (data['pg_bl_bagi_hasil_disable'] == 1) {
                        $('#rk_keu_bagi_hasil_rp').attr('readonly', 'readonly').addClass('readonly-bg');
                        $('#rf_bagi_hasil').attr('readonly', 'readonly').addClass('readonly-bg');
                    }

                    if (data['pg_bl_bantuan_keu_disable'] == 1) {
                        $('#rk_keu_bantuan_keu_rp').attr('readonly', 'readonly').addClass(
                            'readonly-bg');
                        $('#rf_bantuan_keu').attr('readonly', 'readonly').addClass('readonly-bg');
                    }

                    $('#pg_apbd').val(data['pg_apbd']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#pg_bl_op').val(data['pg_bl_op']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#pg_bl_bm').val(data['pg_bl_bm']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#pg_btt').val(data['pg_btt']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#pg_bl_bt').val(data['pg_bt']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#pg_bl_peg').val(data['pg_bl_peg']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#pg_bl_sub').val(data['pg_bl_sub']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#pg_bl_sub').val(data['pg_bl_sub']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#pg_bl_sub').val(data['pg_bl_sub']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#pg_bl_bj').val(data['pg_bl_bj']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#pg_bl_hibah').val(data['pg_bl_hibah']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#pg_bl_bansos').val(data['pg_bl_bansos']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#pg_bm_tanah').val(data['pg_bm_tanah']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#pg_bm_alat_mesin').val(data['pg_bm_alat_mesin']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#pg_bm_gedung').val(data['pg_bm_gedung']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#pg_bm_jalan').val(data['pg_bm_jalan']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#pg_bm_aset').val(data['pg_bm_aset']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#pg_bl_bagi_hasil').val(data['pg_bl_bagi_hasil']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#pg_bl_bantuan_keu').val(data['pg_bl_bantuan_keu']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                },
            })
            $.ajax({
                type: "GET",
                "url": BASE_URL + "/apbd/get-apbd/" + id_unit_apbd + "/" + bln,
                contentType: false,
                dataType: "JSON",
                async: true,
                success: function (data) {
                    $('#id_unit').val(data['id_unit']);
                    $('#id_bln').val(data['id_bln']);
                    $('#real_apbd').val(data['real_apbd']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#real_apbd_per').val(data['real_apbd_per']);
                    $('#real_apbd_fisik').val(data['real_apbd_fisik']);
                    $('#rk_keu_op_rp').val(data['rk_keu_op_rp']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#rk_keu_op_per').val(data['rk_keu_op_per']);
                    $('#rf_op').val(data['rf_op']);
                    $('#rk_keu_bm_rp').val(data['rk_keu_bm_rp']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#rk_keu_bm_per').val(data['rk_keu_bm_per']);
                    $('#rf_bm').val(data['rf_bm']);
                    $('#rk_keu_btt_rp').val(data['rk_keu_btt_rp']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#rk_keu_btt_per').val(data['rk_keu_btt_per']);
                    $('#rf_btt').val(data['rf_btt']);
                    $('#rk_keu_bt_rp').val(data['rk_keu_bt_rp']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#rk_keu_bt_per').val(data['rk_keu_bt_per']);
                    $('#rf_bt').val(data['rf_bt']);
                    $('#rk_keu_peg_rp').val(data['rk_keu_peg_rp']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#rk_keu_peg_per').val(data['rk_keu_peg_per']);
                    $('#rf_peg').val(data['rf_peg']);
                    $('#rk_keu_sub_rp').val(data['rk_keu_sub_rp']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#rk_keu_sub_per').val(data['rk_keu_sub_per']);
                    $('#rf_sub').val(data['rf_sub']);
                    $('#rk_keu_bj_rp').val(data['rk_keu_bj_rp']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#rk_keu_bj_per').val(data['rk_keu_bj_per']);
                    $('#rf_bj').val(data['rf_bj']);
                    $('#rk_keu_hibah_rp').val(data['rk_keu_hibah_rp']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#rk_keu_hibah_per').val(data['rk_keu_hibah_per']);
                    $('#rf_hibah').val(data['rf_hibah']);
                    $('#rk_keu_bansos_rp').val(data['rk_keu_bansos_rp']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#rk_keu_bansos_per').val(data['rk_keu_bansos_per']);
                    $('#rf_bansos').val(data['rf_bansos']);
                    $('#rk_keu_bm_tanah_rp').val(data['rk_keu_bm_tanah_rp']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#rk_keu_bm_tanah_per').val(data['rk_keu_bm_tanah_per']);
                    $('#rf_bm_tanah').val(data['rf_bm_tanah']);
                    $('#rk_keu_alat_mesin_rp').val(data['rk_keu_alat_mesin_rp']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#rk_keu_alat_mesin_per').val(data['rk_keu_alat_mesin_per']);
                    $('#rf_alat_mesin').val(data['rf_alat_mesin']);
                    $('#rk_keu_gedung_rp').val(data['rk_keu_gedung_rp']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#rk_keu_gedung_per').val(data['rk_keu_gedung_per']);
                    $('#rf_gedung').val(data['rf_gedung']);
                    $('#rk_keu_jalan_rp').val(data['rk_keu_jalan_rp']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#rk_keu_jalan_per').val(data['rk_keu_jalan_per']);
                    $('#rf_jalan').val(data['rf_jalan']);
                    $('#rk_keu_aset_rp').val(data['rk_keu_aset_rp']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#rk_keu_aset_per').val(data['rk_keu_aset_per']);
                    $('#rf_aset').val(data['rf_aset']);
                    $('#rk_keu_bagi_hasil_rp').val(data['rk_keu_bagi_hasil_rp']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#rk_keu_bagi_hasil_per').val(data['rk_keu_bagi_hasil_per']);
                    $('#rf_bagi_hasil').val(data['rf_bagi_hasil']);
                    $('#rk_keu_bantuan_keu_rp').val(data['rk_keu_bantuan_keu_rp']).formatCurrency({
                        colorize: true,
                        negativeFormat: '-%s%n',
                        roundToDecimalPlace: -1,
                        eventOnDecimalsEntered: true
                    });
                    $('#rk_keu_bantuan_keu_per').val(data['rk_keu_bantuan_keu_per']);
                    $('#rf_bantuan_keu').val(data['rf_bantuan_keu']);
                    $('#permasalahan').val(data['permasalahan']);
                },

            })

        }
    }



}

$('#pg_bl_peg, #rk_keu_peg_rp').keyup(function (e) {
    var var1 = $('#pg_bl_peg').val().replace(/,/g, '');
    var var2 = $('#rk_keu_peg_rp').val().replace(/,/g, '');
    var var3 = var2 / var1 * 100;
    var per = var3.toFixed(2)
    $('#rk_keu_peg_per').val(per);

});

$('#pg_bl_sub, #rk_keu_sub_rp').keyup(function (e) {
    var var1 = $('#pg_bl_sub').val().replace(/,/g, '');
    var var2 = $('#rk_keu_sub_rp').val().replace(/,/g, '');
    var var3 = var2 / var1 * 100;
    var per = var3.toFixed(2)
    $('#rk_keu_sub_per').val(per);
    console.log(var1);
    console.log(var2);
    console.log(var3);
    console.log(per);
});

$('#pg_bl_bj, #rk_keu_bj_rp').keyup(function (e) {
    var var1 = $('#pg_bl_bj').val().replace(/,/g, '');
    var var2 = $('#rk_keu_bj_rp').val().replace(/,/g, '');
    var var3 = var2 / var1 * 100;
    var per = var3.toFixed(2)
    $('#rk_keu_bj_per').val(per);
});

$('#pg_bl_hibah, #rk_keu_hibah_rp').keyup(function (e) {
    var var1 = $('#pg_bl_hibah').val().replace(/,/g, '');
    var var2 = $('#rk_keu_hibah_rp').val().replace(/,/g, '');
    var var3 = var2 / var1 * 100;
    var per = var3.toFixed(2)
    $('#rk_keu_hibah_per').val(per);
});

$('#pg_bl_bansos, #rk_keu_bansos_rp').keyup(function (e) {
    var var1 = $('#pg_bl_bansos').val().replace(/,/g, '');
    var var2 = $('#rk_keu_bansos_rp').val().replace(/,/g, '');
    var var3 = var2 / var1 * 100;
    var per = var3.toFixed(2)
    $('#rk_keu_bansos_per').val(per);
});


$('#pg_bl_bm, #rk_keu_bm_rp').keyup(function (e) {
    var pg_bl_bm = $('#pg_bl_bm').val().replace(/,/g, '');
    var rk_keu_bm_rp = $('#rk_keu_bm_rp').val().replace(/,/g, '');
    var rk_keu_bm_per = rk_keu_bm_rp / pg_bl_bm * 100;
    var per_bm = rk_keu_bm_per.toFixed(2)
    $('#rk_keu_bm_per').val(per_bm);
});

$('#pg_bm_tanah, #rk_keu_bm_tanah_rp').keyup(function (e) {
    var var1 = $('#pg_bm_tanah').val().replace(/,/g, '');
    var var2 = $('#rk_keu_bm_tanah_rp').val().replace(/,/g, '');
    var var3 = var2 / var1 * 100;
    var per = var3.toFixed(2)
    $('#rk_keu_bm_tanah_per').val(per);
});

$('#pg_bm_alat_mesin, #rk_keu_alat_mesin_rp').keyup(function (e) {
    var var1 = $('#pg_bm_alat_mesin').val().replace(/,/g, '');
    var var2 = $('#rk_keu_alat_mesin_rp').val().replace(/,/g, '');
    var var3 = var2 / var1 * 100;
    var per = var3.toFixed(2)
    $('#rk_keu_alat_mesin_per').val(per);
});

$('#pg_bm_gedung, #rk_keu_gedung_rp').keyup(function (e) {
    var var1 = $('#pg_bm_gedung').val().replace(/,/g, '');
    var var2 = $('#rk_keu_gedung_rp').val().replace(/,/g, '');
    var var3 = var2 / var1 * 100;
    var per = var3.toFixed(2)
    $('#rk_keu_gedung_per').val(per);
});

$('#pg_bm_jalan, #rk_keu_jalan_rp').keyup(function (e) {
    var var1 = $('#pg_bm_jalan').val().replace(/,/g, '');
    var var2 = $('#rk_keu_jalan_rp').val().replace(/,/g, '');
    var var3 = var2 / var1 * 100;
    var per = var3.toFixed(2)
    $('#rk_keu_jalan_per').val(per);
});

$('#pg_bm_aset, #rk_keu_aset_rp').keyup(function (e) {
    var var1 = $('#pg_bm_aset').val().replace(/,/g, '');
    var var2 = $('#rk_keu_aset_rp').val().replace(/,/g, '');
    var var3 = var2 / var1 * 100;
    var per = var3.toFixed(2)
    $('#rk_keu_aset_per').val(per);
});

$('#pg_bl_bagi_hasil, #rk_keu_bagi_hasil_rp').keyup(function (e) {
    var var1 = $('#pg_bl_bagi_hasil').val().replace(/,/g, '');
    var var2 = $('#rk_keu_bagi_hasil_rp').val().replace(/,/g, '');
    var var3 = var2 / var1 * 100;
    var per = var3.toFixed(2)
    $('#rk_keu_bagi_hasil_per').val(per);
});

$('#pg_bl_bantuan_keu, #rk_keu_bantuan_keu_rp').keyup(function (e) {
    var var1 = $('#pg_bl_bantuan_keu').val().replace(/,/g, '');
    var var2 = $('#rk_keu_bantuan_keu_rp').val().replace(/,/g, '');
    var var3 = var2 / var1 * 100;
    var per = var3.toFixed(2)
    $('#rk_keu_bantuan_keu_per').val(per);
});




$('#pg_btt, #rk_keu_btt_rp').keyup(function (e) {
    var pg_btt = $('#pg_btt').val().replace(/,/g, '');
    var rk_keu_btt_rp = $('#rk_keu_btt_rp').val().replace(/,/g, '');
    var rk_keu_btt_per = rk_keu_btt_rp / pg_btt * 100;
    var per_btt = rk_keu_btt_per.toFixed(2)
    $('#rk_keu_btt_per').val(per_btt);
});

$('#pg_bl_bt, #rk_keu_bt_rp').keyup(function (e) {
    var pg_bl_bt = $('#pg_bl_bt').val().replace(/,/g, '');
    var rk_keu_bt_rp = $('#rk_keu_bt_rp').val().replace(/,/g, '');
    var rk_keu_bt_per = rk_keu_bt_rp / pg_bl_bt * 100;
    var per_bl_bt = rk_keu_bt_per.toFixed(2)
    $('#rk_keu_bt_per').val(per_bl_bt);
});


$('.apbd_real').keyup(function (e) {

    var sum2 = 0;
    $("input[class *= 'apbd_real']").each(function () {
        sum2 += +$(this).val().replace(/,/g, '');
    });
    $("#real_apbd").val(sum2).formatCurrency({});;
});


$('.apbd_real').keyup(function (e) {

    var pg_apbd = $('#pg_apbd').val().replace(/,/g, '');
    var real_apbd = $('#real_apbd').val().replace(/,/g, '');

    var real_apbd_per = real_apbd / pg_apbd * 100;
    var per_apbd = real_apbd_per.toFixed(2)
    $('#real_apbd_per').val(per_apbd);
});

// sum realisasi belanja op
$('.sumRealOp').keyup(function (e) {
    var pg_bl_op = $('#pg_bl_op').val().replace(/,/g, '');
    var sum_op = 0;
    $("input[class *= 'sumRealOp']").each(function () {
        sum_op += +$(this).val().replace(/,/g, '');
    });

    var real_op = sum_op / pg_bl_op * 100;
    var convert_op = real_op.toFixed(2);
    $("#rk_keu_op_rp").val(sum_op);
    $('#rk_keu_op_per').val(convert_op);
});

$('.sumRealBm').keyup(function (e) {
    var pg_bl_bm = $('#pg_bl_bm').val().replace(/,/g, '');
    var sum_bm = 0;
    $("input[class *= 'sumRealBm']").each(function () {
        sum_bm += +$(this).val().replace(/,/g, '');
    });

    var real_bm = sum_bm / pg_bl_bm * 100;
    var convert_bm = real_bm.toFixed(2);
    $("#rk_keu_bm_rp").val(sum_bm);
    $('#rk_keu_bm_per').val(convert_bm);
});

$('.sumRealBt').keyup(function (e) {
    var pg_bl_bt = $('#pg_bl_bt').val().replace(/,/g, '');
    var sum_bt = 0;
    $("input[class *= 'sumRealBt']").each(function () {
        sum_bt += +$(this).val().replace(/,/g, '');
    });

    var real_bt = sum_bt / pg_bl_bt * 100;
    var convert_bt = real_bt.toFixed(2);
    $("#rk_keu_bt_rp").val(sum_bt);
    $('#rk_keu_bt_per').val(convert_bt);
});


$('.fisik').keyup(function (e) {
    var rf_peg = $('#rf_peg').val().replace(/,/g, '');
    var rf_sub = $('#rf_sub').val().replace(/,/g, '');
    var rf_bj = $('#rf_bj').val().replace(/,/g, '');
    var rf_hibah = $('#rf_hibah').val().replace(/,/g, '');
    var rf_bansos = $('#rf_bansos').val().replace(/,/g, '');

    var rf_bm_tanah = $('#rf_bm_tanah').val().replace(/,/g, '');
    var rf_alat_mesin = $('#rf_alat_mesin').val().replace(/,/g, '');
    var rf_gedung = $('#rf_gedung').val().replace(/,/g, '');
    var rf_jalan = $('#rf_jalan').val().replace(/,/g, '');
    var rf_aset = $('#rf_aset').val().replace(/,/g, '');

    var rf_bagi_hasil = $('#rf_bagi_hasil').val().replace(/,/g, '');
    var rf_bantuan_keu = $('#rf_bantuan_keu').val().replace(/,/g, '');
    var rf_btt = $('#rf_btt').val().replace(/,/g, '');

    var pg_apbd = $('#pg_apbd').val().replace(/,/g, '');
    var pg_bl_op = $('#pg_bl_op').val().replace(/,/g, '');
    var pg_bl_peg = $('#pg_bl_peg').val().replace(/,/g, '');
    var pg_bl_sub = $('#pg_bl_sub').val().replace(/,/g, '');
    var pg_bl_bj = $('#pg_bl_bj').val().replace(/,/g, '');
    var pg_bl_hibah = $('#pg_bl_hibah').val().replace(/,/g, '');
    var pg_bl_bansos = $('#pg_bl_bansos').val().replace(/,/g, '');
    var pg_bl_bm = $('#pg_bl_bm').val().replace(/,/g, '');
    var pg_bm_tanah = $('#pg_bm_tanah').val().replace(/,/g, '');
    var pg_bm_alat_mesin = $('#pg_bm_alat_mesin').val().replace(/,/g, '');
    var pg_bm_gedung = $('#pg_bm_gedung').val().replace(/,/g, '');
    var pg_bm_jalan = $('#pg_bm_jalan').val().replace(/,/g, '');
    var pg_btt = $('#pg_btt').val().replace(/,/g, '');

    var pg_bm_aset = $('#pg_bm_aset').val().replace(/,/g, '');

    var pg_bl_bt = $('#pg_bl_bt').val().replace(/,/g, '');
    var pg_bl_bagi_hasil = $('#pg_bl_bagi_hasil').val().replace(/,/g, '');
    var pg_bl_bantuan_keu = $('#pg_bl_bantuan_keu').val().replace(/,/g, '');

    // fisik Belanja Operasi
    var1 = (rf_peg * pg_bl_peg) / 100
    var2 = (rf_sub * pg_bl_sub) / 100
    var3 = (rf_bj * pg_bl_bj) / 100
    var4 = (rf_hibah * pg_bl_hibah) / 100
    var5 = (rf_bansos * pg_bl_bansos) / 100

    total_fisik_bl_op = var1 + var2 + var3 + var4 + var5

    fisik_bl_op = total_fisik_bl_op / pg_bl_op * 100
    var convert_bl_op = fisik_bl_op.toFixed(2);

    $('#rf_op').val(convert_bl_op);

    // fisik Belanja Modal

    // fisik Belanja Operasi
    var6 = (rf_bm_tanah * pg_bm_tanah) / 100
    var7 = (rf_alat_mesin * pg_bm_alat_mesin) / 100
    var8 = (rf_gedung * pg_bm_gedung) / 100
    var9 = (rf_jalan * pg_bm_jalan) / 100
    var10 = (rf_aset * pg_bm_aset) / 100

    total_fisik_bl_bm = var6 + var7 + var8 + var9 + var10

    fisik_bl_bm = total_fisik_bl_bm / pg_bl_bm * 100
    var convert_bl_bm = fisik_bl_bm.toFixed(2);

    $('#rf_bm').val(convert_bl_bm);

    // fisik Belanja Modal

    // fisik Belanja Operasi
    var11 = (rf_bagi_hasil * pg_bl_bagi_hasil) / 100
    var12 = (rf_bantuan_keu * pg_bl_bantuan_keu) / 100

    total_fisik_bl_bt = var11 + var12;

    fisik_bl_bt = total_fisik_bl_bt / pg_bl_bt * 100
    var convert_rf_bt = fisik_bl_bt.toFixed(2);

    $('#rf_bt').val(convert_rf_bt);

    // var rf_op = $('#rf_op').val().replace(/,/g, '');
    // var rf_bm = $('#rf_bm').val().replace(/,/g, '');
    // var rf_btt = $('#rf_btt').val().replace(/,/g, '');
    // var rf_bt = $('#rf_bt').val().replace(/,/g, '');

    // var pg_btt = $('#pg_btt').val().replace(/,/g, '');

    // var13 = (rf_op * pg_bl_op) / 100
    // var14 = (rf_bm * pg_bl_bm) / 100
    // var15 = (rf_btt * pg_btt) / 100
    // var16 = (rf_bt * pg_bl_bt) / 100

    // total_fisik = var13 + var14 + var15 + var16;

    // fisik = total_fisik / pg_apbd * 100
    // var convert_fisik = fisik.toFixed(2);

    // $('#real_apbd_fisik').val(convert_fisik);





    //  Total Fisik

    rf_peg_fisik = (rf_peg * pg_bl_peg) / 100
    rf_sub_fisik = (rf_sub * pg_bl_sub) / 100
    rf_bj_fisik = (rf_bj * pg_bl_bj) / 100
    rf_hibah_fisik = (rf_hibah * pg_bl_hibah) / 100
    rf_bansos_fisik = (rf_bansos * pg_bl_bansos) / 100
    rf_bm_tanah_fisik = (rf_bm_tanah * pg_bm_tanah) / 100
    rf_alat_mesin_fisik = (rf_alat_mesin * pg_bm_alat_mesin) / 100
    rf_gedung_fisik = (rf_gedung * pg_bm_gedung) / 100
    rf_jalan_fisik = (rf_jalan * pg_bm_jalan) / 100
    rf_aset_fisik = (rf_aset * pg_bm_aset) / 100
    rf_btt_fisik = (rf_btt * pg_btt) / 100
    rf_bagi_hasil_fisik = (rf_bagi_hasil * pg_bl_bagi_hasil) / 100
    rf_bantuan_keu_fisik = (rf_bantuan_keu * pg_bl_bantuan_keu) / 100

    total_fisik = rf_peg_fisik + rf_sub_fisik + rf_bj_fisik + rf_hibah_fisik + rf_bansos_fisik +
        rf_bm_tanah_fisik +
        rf_alat_mesin_fisik + rf_gedung_fisik + rf_jalan_fisik + rf_aset_fisik + rf_btt_fisik +
        rf_bagi_hasil_fisik + rf_bantuan_keu_fisik

    fisik_total = total_fisik / pg_apbd * 100

    var convert_rf_total = fisik_total.toFixed(2)
    $('#real_apbd_fisik').val(convert_rf_total);

    // console.log(rf_peg_fisik)
    // console.log(rf_sub_fisik)
    // console.log(rf_bj_fisik)
    // console.log(rf_hibah_fisik)
    // console.log(rf_bansos_fisik)
    // console.log(rf_bm_tanah_fisik)
    // console.log(rf_alat_mesin_fisik)
    // console.log(rf_gedung_fisik)
    // console.log(rf_jalan_fisik)
    // console.log(rf_aset_fisik)
    // console.log(rf_btt_fisik)
    // console.log(rf_bagi_hasil_fisik)
    // console.log(rf_bantuan_keu_fisik)

    // console.log(total_fisik)

    // $('#FormApbd').on('submit', function (e) {
    //     var id_bln = $('#bln_apbd').val()
    //     var unit = $('#unit_apbd').val()
    //     var postData = new FormData($("#FormApbd")[0]);
    //     var realkeu = $('#rk_keu_op_rp').val().replace(/,/g, '');
    //     var rf_op = $('#rf_op').val().replace(/,/g, '');
    //     var rk_keu_bm_rp = $('#rk_keu_bm_rp').val().replace(/,/g, '');
    //     var rf_bm = $('#rf_bm').val().replace(/,/g, '');
    //     var rk_keu_btt_rp = $('#rk_keu_btt_rp').val().replace(/,/g, '');
    //     var rf_btt = $('#rf_btt').val().replace(/,/g, '');
    //     var rk_keu_bt_rp = $('#rk_keu_bt_rp').val().replace(/,/g, '');
    //     var rf_bt = $('#rf_bt').val().replace(/,/g, '');

    //     var rk_keu_peg_rp = $('#rk_keu_peg_rp').val().replace(/,/g, '');
    //     var rf_peg = $('#rf_peg').val().replace(/,/g, '');

    //     var rk_keu_sub_rp = $('#rk_keu_sub_rp').val().replace(/,/g, '');
    //     var rf_sub = $('#rf_sub').val().replace(/,/g, '');

    //     var rk_keu_bj_rp = $('#rk_keu_bj_rp').val().replace(/,/g, '');
    //     var rf_bj = $('#rf_bj').val().replace(/,/g, '');


    //     var rk_keu_hibah_rp = $('#rk_keu_hibah_rp').val().replace(/,/g, '');
    //     var rf_hibah = $('#rf_hibah').val().replace(/,/g, '');

    //     var rk_keu_bansos_rp = $('#rk_keu_bansos_rp').val().replace(/,/g, '');
    //     var rf_bansos = $('#rf_bansos').val().replace(/,/g, '');

    //     var rk_keu_bm_tanah_rp = $('#rk_keu_bm_tanah_rp').val().replace(/,/g, '');
    //     var rf_bm_tanah = $('#rf_bm_tanah').val().replace(/,/g, '');

    //     var rk_keu_alat_mesin_rp = $('#rk_keu_alat_mesin_rp').val().replace(/,/g, '');
    //     var rf_alat_mesin = $('#rf_alat_mesin').val().replace(/,/g, '');

    //     var rk_keu_gedung_rp = $('#rk_keu_gedung_rp').val().replace(/,/g, '');
    //     var rf_gedung = $('#rf_gedung').val().replace(/,/g, '');

    //     var rk_keu_jalan_rp = $('#rk_keu_jalan_rp').val().replace(/,/g, '');
    //     var rf_jalan = $('#rf_jalan').val().replace(/,/g, '');

    //     var rk_keu_aset_rp = $('#rk_keu_aset_rp').val().replace(/,/g, '');
    //     var rf_aset = $('#rf_aset').val().replace(/,/g, '');

    //     var rk_keu_bagi_hasil_rp = $('#rk_keu_bagi_hasil_rp').val().replace(/,/g, '');
    //     var rf_bagi_hasil = $('#rf_bagi_hasil').val().replace(/,/g, '');

    //     var rk_keu_bantuan_keu_rp = $('#rk_keu_bantuan_keu_rp').val().replace(/,/g, '');
    //     var rf_bantuan_keu = $('#rf_bantuan_keu').val().replace(/,/g, '');

    //     if (realkeu != 0 && rf_op == 0) {
    //         Swal.fire({
    //             type: 'warning',
    //             title: 'Gagal',
    //             text: 'Real. Fisik (%) Belanja Operasi tidak Boleh 0',
    //             timer: 2000,
    //         })
    //     } else if (rk_keu_bm_rp != 0 && rf_bm == 0) {
    //         Swal.fire({
    //             type: 'warning',
    //             title: 'Gagal',
    //             text: 'Real. Fisik (%) Belanja Modal tidak Boleh 0',
    //             timer: 2000,
    //         })
    //     } else if (rk_keu_btt_rp != 0 && rf_btt == 0) {
    //         Swal.fire({
    //             type: 'warning',
    //             title: 'Gagal',
    //             text: 'Real. Fisik (%) Belanja Tidak Terduga tidak Boleh 0',
    //             timer: 2000,
    //         })
    //     } else if (rk_keu_bt_rp != 0 && rf_bt == 0) {
    //         Swal.fire({
    //             type: 'warning',
    //             title: 'Gagal',
    //             text: 'Real. Fisik (%) Belanja Transfer tidak Boleh 0',
    //             timer: 2000,
    //         })
    //     } else if (rk_keu_peg_rp != 0 && rf_peg == 0) {
    //         Swal.fire({
    //             type: 'warning',
    //             title: 'Gagal',
    //             text: 'Real. Fisik (%) Belanja Pegawai tidak Boleh 0',
    //             timer: 2000,
    //         })
    //     } else if (rk_keu_sub_rp != 0 && rf_sub == 0) {
    //         Swal.fire({
    //             type: 'warning',
    //             title: 'Gagal',
    //             text: 'Real. Fisik (%) Belanja Subsidi tidak Boleh 0',
    //             timer: 2000,
    //         })
    //     } else if (rk_keu_bj_rp != 0 && rf_bj == 0) {
    //         Swal.fire({
    //             type: 'warning',
    //             title: 'Gagal',
    //             text: 'Real. Fisik (%) Belanja Barang dan Jasa tidak Boleh 0',
    //             timer: 2000,
    //         })
    //     } else if (rk_keu_hibah_rp != 0 && rf_hibah == 0) {
    //         Swal.fire({
    //             type: 'warning',
    //             title: 'Gagal',
    //             text: 'Real. Fisik (%) Belanja Hibah tidak Boleh 0',
    //             timer: 2000,
    //         })
    //     } else if (rk_keu_bansos_rp != 0 && rf_bansos == 0) {
    //         Swal.fire({
    //             type: 'warning',
    //             title: 'Gagal',
    //             text: 'Real. Fisik (%) Belanja Bantuan Sosial tidak Boleh 0',
    //             timer: 2000,
    //         })
    //     } else if (rk_keu_bm_tanah_rp != 0 && rf_bm_tanah == 0) {
    //         Swal.fire({
    //             type: 'warning',
    //             title: 'Gagal',
    //             text: 'Real. Fisik (%) Belanja Modal Tanah  tidak Boleh 0',
    //             timer: 2000,
    //         })
    //     } else if (rk_keu_alat_mesin_rp != 0 && rf_alat_mesin == 0) {
    //         Swal.fire({
    //             type: 'warning',
    //             title: 'Gagal',
    //             text: 'Real. Fisik (%) Belanja Modal Peralatan dan Mesin   tidak Boleh 0',
    //             timer: 2000,
    //         })
    //     } else if (rk_keu_gedung_rp != 0 && rf_gedung == 0) {
    //         Swal.fire({
    //             type: 'warning',
    //             title: 'Gagal',
    //             text: 'Real. Fisik (%) Belanja Modal Gedung dan Bangunan    tidak Boleh 0',
    //             timer: 2000,
    //         })
    //     } else if (rk_keu_jalan_rp != 0 && rf_jalan == 0) {
    //         Swal.fire({
    //             type: 'warning',
    //             title: 'Gagal',
    //             text: 'Real. Fisik (%) Belanja Modal Jalan, Jaringan, dan Irigasi   tidak Boleh 0',
    //             timer: 2000,
    //         })
    //     } else if (rk_keu_aset_rp != 0 && rf_aset == 0) {
    //         Swal.fire({
    //             type: 'warning',
    //             title: 'Gagal',
    //             text: 'Real. Fisik (%) Belanja Modal Aset Tetap Lainnya    tidak Boleh 0',
    //             timer: 2000,
    //         })
    //     } else if (rk_keu_bagi_hasil_rp != 0 && rf_bagi_hasil == 0) {
    //         Swal.fire.fire({
    //             type: 'warning',
    //             title: 'Gagal',
    //             text: 'Real. Fisik (%) Belanja Bagi Hasil     tidak Boleh 0',
    //             timer: 2000,
    //         })
    //     } else if (rk_keu_bantuan_keu_rp != 0 && rf_bantuan_keu == 0) {
    //         Swal.fire.fire({
    //             type: 'warning',
    //             title: 'Gagal',
    //             text: 'Real. Fisik (%) Belanja Bantuan Keuangan tidak Boleh 0',
    //             timer: 2000,
    //         })
    //     } else {
    //         $.ajax({
    //             type: "POST",
    //             "url": BASE_URL + "/apbd/update-apbd",

    //             data: postData,
    //             dataType: "JSON",
    //             success: function () {
    //                 Swal.fire.fire({
    //                     type: 'success',
    //                     title: 'Simpan',
    //                     text: 'Berhasil Simpan Data',
    //                     timer: 2000,
    //                 })
    //                 $('#ModalApbd').modal('hide');
    //                 show_apbd(id_bln, unit)
    //                 // grafik_apbd()
    //             },
    //             error: function () {

    //                 Swal.fire({
    //                     type: 'warning',
    //                     title: 'Gagal',
    //                     text: 'Gagal Simpan Data',
    //                     timer: 2000,
    //                 })
    //                 show_apbd(id_bln, unit)
    //                 // grafik_apbd()
    //             },
    //         })
    //     }
    //     return false;
    // });



});

$('#FormApbd').on('submit', function (e) {
    e.preventDefault();
    var postData = new FormData($("#FormApbd")[0]);
    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF
    postData.append('_token', csrfToken); // Sertakan token CSRF di FormData
    $.ajax({
        type: "POST",
        url: BASE_URL + "/apbd/update-apbd",
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
                getData(id_unit_apbd, bln);
                $('#modalApbd').modal('hide');
            }
        },
    });
    return false;
});
