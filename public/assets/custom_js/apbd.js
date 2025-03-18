
$(document).ready(function () {
    let barChartInstance = null; // Simpan instance chart

    $('#id_unit_apbd').on('change', function () {
        var id_unit_apbd = $(this).val();
        var bln = $('#bulan_apbd').val();
        if (id_unit_apbd != '' && bln != '') {
            getData(id_unit_apbd, bln);
            grafik_apdb();
        }
    });


    $('#bulan_apbd').on('change', function () {
        var bln = $(this).val();
        var id_unit_apbd = $('#id_unit_apbd').val();
        if (id_unit_apbd != '' && bln != '') {
            getData(id_unit_apbd, bln);
            grafik_apdb();
        }
    });

    grafik_apdb()
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

                // Konversi ke format rupiah


                $('#pg_bl_op_detail').html(response.pg_bl_op ? Rupiah(response.pg_bl_op) : 'Rp. 0');
                $('#rk_keu_op_rp_detail').html(response.rk_keu_op_rp ? Rupiah(response.rk_keu_op_rp) :
                    0);
                $('#rk_keu_op_per_detail').html(response.rk_keu_op_per ? response
                    .rk_keu_op_per : 0);
                $('#rf_op_detail').html(response.rf_op ? response.rf_op : 0);

                $('#pg_bl_bm_detail').html(response.pg_bl_bm ? Rupiah(response.pg_bl_bm) : 0);
                $('#rk_keu_bm_rp_detail').html(response.rk_keu_bm_rp ? Rupiah(response.rk_keu_bm_rp) :
                    0);
                $('#rk_keu_bm_per_detail').html(response.rk_keu_bm_per ? response
                    .rk_keu_bm_per : 0);
                $('#rf_bm_detail').html(response.rf_bm ? response.rf_bm : 0);

                $('#pg_btt_detail').html(response.pg_btt ? Rupiah(response.pg_btt) : 0);
                $('#rk_keu_btt_rp_detail').html(response.rk_keu_btt_rp ? Rupiah(response.rk_keu_btt_rp) : 0);
                $('#rk_keu_btt_per_detail').html(response.rk_keu_btt_per ? response
                    .rk_keu_btt_per : 0);
                $('#rf_btt_detail').html(response.rf_btt ? response.rf_btt : 0);

                $('#pg_bl_bt_detail').html(response.pg_bl_bt ? Rupiah(response.pg_bl_bt) : 0);
                $('#rk_keu_bt_rp_detail').html(response.rk_keu_bt_rp ? Rupiah(response.rk_keu_bt_rp) :
                    0);
                $('#rk_keu_bt_per_detail').html(response.rk_keu_bt_per ? response
                    .rk_keu_bt_per : 0);
                $('#rf_bt_detail').html(response.rf_bt ? response.rf_bt : 0);

                $('#pg_apbd_detail').html(response.pg_apbd ? Rupiah(response.pg_apbd) : 0);
                $('#real_apbd_detail').html(response.real_apbd ? Rupiah(response.real_apbd) : 0);
                $('#real_apbd_per_detail').html(response.real_apbd_per ? response
                    .real_apbd_per : 0);
                $('#real_apbd_fisik_detail').html(response.real_apbd_fisik ? response
                    .real_apbd_fisik : 0);


                var btnApbd = `<button type="button" class="btn btn-sm btn-primary waves-effect waves-light" data-id="${response.id_apdb ?? 0}" data-bln="${bln}" onclick="modalEdit(this)">  Edit</button>
                        <a href="${BASE_URL}/apbd/report-form-i/${bln}/${id_unit}" target="_blank" class="btn btn-sm btn-secondary waves-effect waves-light"><i class="ri-printer-line"></i>&nbsp; Form I</a>
                        <a href="${BASE_URL}/apbd/report-form-ii/${bln}/${id_unit}" target="_blank" class="btn btn-sm btn-secondary waves-effect waves-light"><i class="ri-printer-line"></i>&nbsp; Form II</a>
                        `;



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
    var bln = $(elem).data('bln');

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
                if (id_apbd == 0) {
                    Swal.fire({
                        title: 'Gagal',
                        text: 'Data Tidak Ditemukan',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500

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
        },
        error: function (xhr, status, error) {
            // Callback ketika terjadi error dalam request
            console.error("Error:", error);
        }
    });






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
                grafik_apdb();
            }
        },
    });
    return false;
});

let barChartInstance = null; // Simpan instance chart
function grafik_apdb() {
    const purpleColor = '#836AF9',
        yellowColor = '#ffe800',
        cyanColor = '#28dac6',
        orangeColor = '#FF8132',
        orangeLightColor = '#ffcf5c',
        oceanBlueColor = '#299AFF',
        greyColor = '#4F5D70',
        greyLightColor = '#EDF1F4',
        blueColor = '#2B9AFF',
        blueLightColor = '#84D0FF';

    let cardColor, headingColor, labelColor, borderColor, legendColor;

    if (isDarkStyle) {
        cardColor = config.colors_dark.cardColor;
        headingColor = config.colors_dark.headingColor;
        labelColor = config.colors_dark.textMuted;
        legendColor = config.colors_dark.bodyColor;
        borderColor = config.colors_dark.borderColor;
    } else {
        cardColor = config.colors.cardColor;
        headingColor = config.colors.headingColor;
        labelColor = config.colors.textMuted;
        legendColor = config.colors.bodyColor;
        borderColor = config.colors.borderColor;
    }

    const id_unit_apbd = $('#id_unit_apbd').val();

    $.ajax({
        url: BASE_URL + '/service/grafik/apbd-skpd/' + id_unit_apbd,
        type: 'GET',
        success: function (data) {
            const barChart = document.getElementById('barChartApbd');

            if (barChart) {
                // **Hancurkan chart lama sebelum membuat yang baru**
                if (barChartInstance) {
                    barChartInstance.destroy();
                }

                // **Buat chart baru**
                barChartInstance = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: data.map(item => {
                            const month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            return month[item['id_bln'] - 1];
                        }),
                        datasets: [
                            {
                                label: 'Realisasi APBD (%)',
                                data: data.map(item => item['real_apbd_per']),
                                backgroundColor: oceanBlueColor,
                                borderColor: 'transparent',
                                maxBarThickness: 15,
                                borderRadius: {
                                    topRight: 15,
                                    topLeft: 15
                                }
                            },
                            {
                                label: 'Realisasi APBD Fisik',
                                data: data.map(item => item['real_apbd_fisik']),
                                backgroundColor: orangeLightColor,
                                borderColor: 'transparent',
                                maxBarThickness: 15,
                                borderRadius: {
                                    topRight: 15,
                                    topLeft: 15
                                }
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: {
                            duration: 500
                        },
                        plugins: {
                            tooltip: {
                                rtl: isRtl,
                                backgroundColor: cardColor,
                                titleColor: headingColor,
                                bodyColor: legendColor,
                                borderWidth: 1,
                                borderColor: borderColor
                            },
                            legend: {
                                display: true // Tampilkan legend agar lebih informatif
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    color: borderColor,
                                    drawBorder: false
                                },
                                ticks: {
                                    color: labelColor
                                }
                            },
                            y: {
                                min: 0,
                                max: 100,
                                grid: {
                                    color: borderColor,
                                    drawBorder: false
                                },
                                ticks: {
                                    stepSize: 10,
                                    color: labelColor
                                }
                            }
                        }
                    }
                });
            }
        }
    });
}
