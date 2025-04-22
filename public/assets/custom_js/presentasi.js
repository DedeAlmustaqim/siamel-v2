$(document).ready(function () {
    let barChartInstance = null; // Simpan instance chart

    $('#id_unit').on('change', function () {
        var unit = $(this).val();
        var bln = $('#bulan').val();
        getData(unit, bln);
        grafik_apdb();
        getGetppbj(bln, unit)
        show_pd(bln, unit)
        grafik_pendapatan();
        showDak(bln, unit);
    });


    $('#bulan').on('change', function () {
        var bln = $(this).val();
        var unit = $('#id_unit').val();
        if (unit != '') {
            Swal.fire({
                text: 'Menampilkan Data  ' + $('#bulan').find('option:selected').text(),
                title: '',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500,
            }).then(function () {
                getData(unit, bln);
                grafik_apdb();
                getGetppbj(bln, unit)
                show_pd(bln, unit)
                grafik_pendapatan();
                showDak(bln, unit);
            });
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

                resolve(response);

                // Konversi ke format rupiah


                $('#pg_bl_op_presentasi').html(response.pg_bl_op ? Rupiah(response.pg_bl_op) : 'Rp. 0');
                $('#rk_keu_op_rp_presentasi').html(response.rk_keu_op_rp ? Rupiah(response.rk_keu_op_rp) :
                    0);
                $('#rk_keu_op_per_presentasi').html(response.rk_keu_op_per ? response
                    .rk_keu_op_per : 0);
                $('#rf_op_presentasi').html(response.rf_op ? response.rf_op : 0);

                $('#pg_bl_bm_presentasi').html(response.pg_bl_bm ? Rupiah(response.pg_bl_bm) : 0);
                $('#rk_keu_bm_rp_presentasi').html(response.rk_keu_bm_rp ? Rupiah(response.rk_keu_bm_rp) :
                    0);
                $('#rk_keu_bm_per_presentasi').html(response.rk_keu_bm_per ? response
                    .rk_keu_bm_per : 0);
                $('#rf_bm_presentasi').html(response.rf_bm ? response.rf_bm : 0);

                $('#pg_btt_presentasi').html(response.pg_btt ? Rupiah(response.pg_btt) : 0);
                $('#rk_keu_btt_rp_presentasi').html(response.rk_keu_btt_rp ? Rupiah(response.rk_keu_btt_rp) : 0);
                $('#rk_keu_btt_per_presentasi').html(response.rk_keu_btt_per ? response
                    .rk_keu_btt_per : 0);
                $('#rf_btt_presentasi').html(response.rf_btt ? response.rf_btt : 0);

                $('#pg_bl_bt_presentasi').html(response.pg_bl_bt ? Rupiah(response.pg_bl_bt) : 0);
                $('#rk_keu_bt_rp_presentasi').html(response.rk_keu_bt_rp ? Rupiah(response.rk_keu_bt_rp) :
                    0);
                $('#rk_keu_bt_per_presentasi').html(response.rk_keu_bt_per ? response
                    .rk_keu_bt_per : 0);
                $('#rf_bt_presentasi').html(response.rf_bt ? response.rf_bt : 0);

                $('#pg_apbd_presentasi').html(response.pg_apbd ? Rupiah(response.pg_apbd) : 0);
                $('#real_apbd_presentasi').html(response.real_apbd ? Rupiah(response.real_apbd) : 0);
                $('#real_apbd_per_presentasi').html(response.real_apbd_per ? response
                    .real_apbd_per : 0);
                $('#real_apbd_fisik_presentasi').html(response.real_apbd_fisik ? response
                    .real_apbd_fisik : 0);

                if (response.status == 1) {
                    document.getElementById('status_apbd').innerHTML = '<span class="badge bg-success">Sudah Input</span>';
                } else {
                    document.getElementById('status_apbd').innerHTML = '<span class="badge bg-danger">Belum Input</span>';
                }




            },
            error: function (xhr, status, error) {
                reject(error);
            }
        });
    });


}
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

    const id_unit_apbd = $('#id_unit').val();

    $.ajax({
        url: BASE_URL + '/service/grafik/apbd-skpd/' + id_unit_apbd,
        type: 'GET',
        success: function (data) {
            const barChart = document.getElementById('barChartApbdPresentasi');

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

function getGetppbj(id_bln, unit) {
    $.ajax({
        url: BASE_URL + "/ppbj/get-ppbj/" + id_bln + "/" + unit,
        type: 'GET',
        async: true,
        dataType: 'json',
        success: function (data) {
            if (data.status_ppbj_50 == 0) {
                var stts_50 = '<span class="badge bg-danger">Belum Input</span>'
            } else {
                var stts_50 = '<span class="badge bg-success">Sudah Input</span>'
            }
            if (data.status_ppbj_200 == 0) {
                var stts_200 = '<span class="badge bg-danger>Belum Input</span>'
            } else {
                var stts_200 = '<span class="badge bg-success">Sudah Input</span>'
            }
            if (data.status_ppbj_200 == 0) {
                var stts_200 = '<span class="badge bg-danger>Belum Input</span>'
            } else {
                var stts_200 = '<span class="badge bg-success">Sudah Input</span>'
            }
            if (data.status_ppbj_25 == 0) {
                var stts_25 = '<span class="badge bg-danger>Belum Input</span>'
            } else {
                var stts_25 = '<span class="badge bg-success">Sudah Input</span>'
            }
            if (data.status_ppbj_25 == 0) {
                var stts_25 = '<span class="badge bg-danger>Belum Input</span>'
            } else {
                var stts_25 = '<span class="badge bg-success">Sudah Input</span>'
            }
            ppbj50 = `<td class="text-center">1</td>
                <td><b>PAKET NON STRATEGIS (>RP. 50 JT S/D Rp. 200 JT)</b><br>${stts_50} </td>
                <td class="text-center">${data.jml_pkt_50}</td>
                <td class="text-right">${Rupiah(data.jml_pg_50)}</td>
                <td class="text-center">${data.bp_pkt_50}</td>
                <td class="text-right">${Rupiah(data.bp_rp_50)}</td>
                <td class="text-center">
                    <button type="button" class="btn waves-effect waves-light  btn-sm btn-secondary" onClick="ModalPpbj50(this)"  data-bln="${data.id_bln}" data-unit="${data.id_unit}" data-nm_bln="${data.nm_bln}" title="Edit">Detail</button>
                </td>`;

            ppbj200 = `<td class="text-center">2</td>
                <td><b>PAKET NON STRATEGIS (>RP. 200 JT S/D Rp. 2,5 M)</b><br>${stts_200} </td>
                <td class="text-center">${data.jml_pkt_200}</td>
                <td class="text-right">${Rupiah(data.jml_pg_200)}</td>
                <td class="text-center">${data.bp_pkt_200}</td>
                <td class="text-right">${Rupiah(data.bp_rp_200)}</td>
                <td class="text-center">
                    <button type="button" class="btn waves-effect waves-light  btn-sm btn-secondary" onClick="ModalPpbj200(this)"  data-bln="${data.id_bln}" data-unit="${data.id_unit}" data-nm_bln="${data.nm_bln}" title="Edit">Detail</button>
                </td>`;

            ppbj25 = `<td class="text-center">3</td>
                <td><b>	PAKET NON STRATEGIS (>RP. 2,5 M S/D Rp. 5 M)</b><br>${stts_25} </td>
                <td class="text-center">${data.jml_pkt_25}</td>
                <td class="text-right">${Rupiah(data.jml_pg_25)}</td>
                <td class="text-center">${data.bp_pkt_25}</td>
                <td class="text-right">${Rupiah(data.bp_rp_25)}</td>
                <td class="text-center">
                    <button type="button" class="btn waves-effect waves-light  btn-sm btn-secondary" onClick="ModalPpbj25(this)"  data-bln="${data.id_bln}" data-unit="${data.id_unit}" data-nm_bln="${data.nm_bln}" title="Edit">Detail</button>
                </td>`;

            $('.show_ppbj_50').html(ppbj50);
            $('.show_ppbj_200').html(ppbj200);
            $('.show_ppbj_25').html(ppbj25);
        }

    });

}

function show_pd(id_bln, unit) {
    $.ajax({
        type: "GET",
        "url": BASE_URL + "/pendapatan/get-pendapatan/" + id_bln + '/' + unit,
        dataType: "JSON",

        success: function (data) {
            //Navigasi pendapatan
            //document.getElementById("BulanApbd").innerHTML = 'Data Bulan : '+data.nm_bln;

            //Tabel Pendapatan
            if (data.pad_target) {
                document.getElementById("pad_target_detail").innerHTML = Rupiah(data.pad_target);
            } else {
                document.getElementById("pad_target_detail").innerHTML = '';
            }
            if (data.pad_real) {
                document.getElementById("pad_real_detail").innerHTML = Rupiah(data.pad_real);
            } else {
                document.getElementById("pad_real_detail").innerHTML = '';
            }
            if (data.pad_real_per) {
                document.getElementById("pad_real_per_detail").innerHTML = data.pad_real_per;
            } else {
                document.getElementById("pad_real_per_detail").innerHTML = '';
            }
            if (data.tp_target) {
                document.getElementById("tp_target_detail").innerHTML = Rupiah(data.tp_target);
            } else {
                document.getElementById("tp_target_detail").innerHTML = '';
            }
            if (data.tp_keu) {
                document.getElementById("tp_keu_detail").innerHTML = Rupiah(data.tp_keu);
            } else {
                document.getElementById("tp_keu_detail").innerHTML = '';
            }
            if (data.tp_per) {
                document.getElementById("tp_per_detail").innerHTML = data.tp_per;
            } else {
                document.getElementById("tp_per_detail").innerHTML = '';
            }
            if (data.tad_target) {
                document.getElementById("tad_target_detail").innerHTML = Rupiah(data.tad_target);
            } else {
                document.getElementById("tad_target_detail").innerHTML = '';
            }
            if (data.tad_keu) {
                document.getElementById("tad_keu_detail").innerHTML = Rupiah(data.tad_keu);
            } else {
                document.getElementById("tad_keu_detail").innerHTML = '';
            }
            if (data.tad_per) {
                document.getElementById("tad_per_detail").innerHTML = data.tad_per;
            } else {
                document.getElementById("tad_per_detail").innerHTML = '';
            }
            if (data.pad_sah_target) {
                document.getElementById("pad_sah_target_detail").innerHTML = Rupiah(data.pad_sah_target);
            } else {
                document.getElementById("pad_sah_target_detail").innerHTML = '';
            }
            if (data.pad_sah_keu) {
                document.getElementById("pad_sah_keu_detail").innerHTML = Rupiah(data.pad_sah_keu);
            } else {
                document.getElementById("pad_sah_keu_detail").innerHTML = '';
            }
            if (data.pad_sah_per) {
                document.getElementById("pad_sah_per_detail").innerHTML = data.pad_sah_per;
            } else {
                document.getElementById("pad_sah_per_detail").innerHTML = '';
            }
            if (data.target_total) {
                document.getElementById("target_total_detail").innerHTML = Rupiah(data.target_total);
            } else {
                document.getElementById("target_total_detail").innerHTML = '';
            }
            if (data.keu_total) {
                document.getElementById("keu_total_detail").innerHTML = Rupiah(data.keu_total);
            } else {
                document.getElementById("keu_total_detail").innerHTML = '';
            }
            if (data.keu_per_total) {
                document.getElementById("keu_per_total_detail").innerHTML = data.keu_per_total;
            } else {
                document.getElementById("keu_per_total_detail").innerHTML = '';
            }
            //Pie Chart APBD
            if (data.status_pd == 1) {
                document.getElementById('status_pd').innerHTML = '<span class="badge bg-success">Sudah Input</span>';
            } else {
                document.getElementById('status_pd').innerHTML = '<span class="badge bg-danger">Belum Input</span>';
            }
        },

    })
}
let barChartInstancePD = null; // Simpan instance chart
function grafik_pendapatan() {
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

    const id_unit_apbd = $('#id_unit').val();

    $.ajax({
        url: BASE_URL + '/service/grafik/pendapatan-skpd/' + id_unit_apbd,
        type: 'GET',
        success: function (data) {
            const barChart = document.getElementById('barChartPendapatan');

            if (barChart) {
                // **Hancurkan chart lama sebelum membuat yang baru**
                if (barChartInstancePD) {
                    barChartInstancePD.destroy();
                }

                // **Buat chart baru**
                barChartInstancePD = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: data.map(item => {
                            const month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            return month[item['id_bln'] - 1];
                        }),
                        datasets: [

                            {
                                label: 'Realisasi Pendapatan (%)',
                                data: data.map(item => item['pad_real_per']),
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

function showDak(id_bln, unit) {
    $('#show_dak_fisik').html('');
    $('#show_dak_non_fisik').html('');

    $.ajax({
        type: "get",
        "url": BASE_URL + "/dak/get-dak-fisik/" + id_bln + '/' + unit,
        dataType: "JSON",

        success: function (data) {
            if (data.length > 0) {
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
                        '<button type="button" class="btn waves-effect waves-light  btn-sm btn-secondary" onClick="ModalDakFisik(this)" data-id="' + data[i].id_dak_fisik + '" data-bln="' + data[i].id_bln + '"  data-unit="' + data[i].id_unit + '"  title="Edit">Mekanisme</button>&nbsp' +
                        '</td>' +
                        '</tr>';
                }
                $('#show_dak_fisik').html('<tr class="bg-light"><td colspan="16" class="text-white"><h5>DANA ALOKASI KHUSUS ( DAK ) FISIK REGULER</h5></td></tr>' + html);
            }
        },

    })
    $.ajax({
        type: "get",
        "url": BASE_URL + "/dak/get-dak-non-fisik/" + id_bln + '/' + unit,
        dataType: "JSON",

        success: function (data) {

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
                    '<button type="button" class="btn waves-effect waves-light  btn-sm btn-secondary" onClick="ModalDakNonFisik(this)" data-id="' + data[i].id_dak_non_fisik + '" data-bln="' + data[i].id_bln + '"  data-unit="' + data[i].id_unit + '"  title="Edit">Mekanisme</button>&nbsp' +
                    '</td>' +
                    '</tr>';
                $('#show_dak_non_fisik').html('<tr class="bg-light"><td colspan="16" class="text-white"><h5>DANA ALOKASI KHUSUS ( DAK ) NON FISIK </h5></td></tr>' + html);
            }
        },

    })
}
