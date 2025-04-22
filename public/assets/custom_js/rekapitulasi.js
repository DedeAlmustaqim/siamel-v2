$(document).ready(function () {






    $('#bulan').on('change', function () {
        var bln = $(this).val();

        if (bln != '') {
            Swal.fire({
                text: 'Menampilkan Data  ' + $('#bulan').find('option:selected').text(),
                title: '',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500,
            }).then(function () {
                btnRekap(bln);
                getApbd(bln);
                getPendapatan(bln);
                grafik_apdb();
                grafik_pendapatan();
                getGetppbj(bln)
                showDak(bln)
            });
        }
    });



})

function btnRekap(bln) {
    var btn = `
    <a href="${BASE_URL}/rekapitulasi/report-apbd/${bln}" target="_blank" class="btn btn-primary waves-effect waves-light"><i class="ri-printer-line"></i>&nbsp; APBD</a>
    <a href="${BASE_URL}/rekapitulasi/report-pendapatan/${bln}" target="_blank" class="btn btn-primary waves-effect waves-light"><i class="ri-printer-line"></i>&nbsp; Pendapatan</a>
    <div class="btn-group">
        <button type="button" class="btn btn-primary waves-effect waves-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ri-printer-line"></i>&nbsp; PPBJ
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="${BASE_URL}/rekapitulasi/report-ppbj-50/${bln}" target="_blank">NON STRATEGIS (>RP. 50 JT S/D Rp. 200 JT)</a></li>
            <li><a class="dropdown-item" href="${BASE_URL}/rekapitulasi/report-ppbj-200/${bln}" target="_blank">STRATEGIS (>RP. 200 JT S/D Rp. 2,5 M)</a></li>
            <li><a class="dropdown-item" href="${BASE_URL}/rekapitulasi/report-ppbj-25/${bln}" target="_blank">STRATEGIS (>RP. 2,5 M S/D Rp. 5 M)</a></li>
        </ul>
    </div>
    <a href="${BASE_URL}/rekapitulasi/report-dak-fisik/${bln}" target="_blank" class="btn btn-primary waves-effect waves-light"><i class="ri-printer-line"></i>&nbsp; Dak Fisik</a>
    <a href="${BASE_URL}/rekapitulasi/report-dak-non-fisik/${bln} target="_blank" class="btn btn-primary waves-effect waves-light"><i class="ri-printer-line"></i>&nbsp; Dak Non Fisik</a>
    `;

    $('#btnRekap').html(btn);
}

function getApbd(bln) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            async: true,
            type: "get",
            url: BASE_URL + "/rekapitulasi/apbd/" + bln,


            success: function (response) {

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



    $.ajax({
        url: BASE_URL + '/rekapitulasi/grafik-apbd/',
        type: 'GET',
        success: function (data) {
            const barChart = document.getElementById('barChartApbdRekapitulasi');

            if (barChart) {
                // **Hancurkan chart lama sebelum membuat yang baru**
                if (barChartInstance) {
                    barChartInstance.destroy();
                }

                // **Buat chart baru**
                barChartInstance = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: data.map(item => item['nm_bln']),
                        datasets: [
                            {
                                label: 'Realisasi APBD (%)',
                                data: data.map(item => parseFloat(item['real_apbd_per'])),
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
                                data: data.map(item => parseFloat(item['real_apbd_fisik'])),
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

function getPendapatan(id_bln) {
    $.ajax({
        type: "GET",
        "url": BASE_URL + "/rekapitulasi/pendapatan/" + id_bln,
        dataType: "JSON",

        success: function (data) {

            document.getElementById("pad_target_detail").innerHTML = Rupiah(data.pad_target);
            document.getElementById("pad_real_detail").innerHTML = Rupiah(data.pad_real);
            document.getElementById("pad_real_per_detail").innerHTML = data.pad_real_per;
            document.getElementById("tp_target_detail").innerHTML = Rupiah(data.tp_target);
            document.getElementById("tp_keu_detail").innerHTML = Rupiah(data.tp_keu);
            document.getElementById("tp_per_detail").innerHTML = data.tp_per;
            document.getElementById("tad_target_detail").innerHTML = Rupiah(data.tad_target);
            document.getElementById("tad_keu_detail").innerHTML = Rupiah(data.tad_keu);
            document.getElementById("tad_per_detail").innerHTML = data.tad_per;
            document.getElementById("pad_sah_target_detail").innerHTML = Rupiah(data.pad_sah_target);
            document.getElementById("pad_sah_keu_detail").innerHTML = Rupiah(data.pad_sah_keu);
            document.getElementById("pad_sah_per_detail").innerHTML = data.pad_sah_per;
            document.getElementById("target_total_detail").innerHTML = Rupiah(data.target_total);
            document.getElementById("keu_total_detail").innerHTML = Rupiah(data.keu_total);
            document.getElementById("keu_per_total_detail").innerHTML = data.keu_per_total;
            //Pie Chart APBD

        },

    })
}
let barChartInstancePd = null; // Simpan instance chart
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



    $.ajax({
        url: BASE_URL + '/rekapitulasi/grafik-pd/',
        type: 'GET',
        success: function (data) {
            const barChart = document.getElementById('barChartPendapatan');

            if (barChart) {
                // **Hancurkan chart lama sebelum membuat yang baru**
                if (barChartInstancePd) {
                    barChartInstancePd.destroy();
                }

                // **Buat chart baru**
                barChartInstancePd = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: data.map(item => item['nm_bln']),
                        datasets: [

                            {
                                label: 'Realisasi Pendapatan (%)',
                                data: data.map(item => item['keu_per_total']),
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


function getGetppbj(id_bln) {
    $.ajax({
        url: BASE_URL + "/rekapitulasi/ppbj/" + id_bln,
        type: 'GET',
        async: true,
        dataType: 'json',
        success: function (data) {
            console.log(data)
            ppbj50 = `<td class="text-center">1</td>
                <td><b>PAKET NON STRATEGIS (>RP. 50 JT S/D Rp. 200 JT) </td>
                <td class="text-center">${data.total_jml_pkt_50}</td>
                <td class="text-right">${Rupiah(data.total_jml_pg_50)}</td>
                <td class="text-center">${data.total_bp_pkt_50}</td>
                <td class="text-right">${Rupiah(data.total_bp_rp_50)}</td>
                `;

            ppbj200 = `<td class="text-center">2</td>
                <td><b>PAKET STRATEGIS (>RP. 200 JT S/D Rp. 2,5 M) </td>
                <td class="text-center">${data.total_jml_pkt_200}</td>
                <td class="text-right">${Rupiah(data.total_jml_pg_200)}</td>
                <td class="text-center">${data.total_bp_pkt_200}</td>
                <td class="text-right">${Rupiah(data.total_bp_rp_200)}</td>
                `;

            ppbj25 = `<td class="text-center">3</td>
                <td><b>	PAKET STRATEGIS (>RP. 2,5 M S/D Rp. 5 M) </td>
                <td class="text-center">${data.total_jml_pkt_25}</td>
                <td class="text-right">${Rupiah(data.total_jml_pg_25)}</td>
                <td class="text-center">${data.total_bp_pkt_25}</td>
                <td class="text-right">${Rupiah(data.total_bp_rp_25)}</td>
                `;

            $('.show_ppbj_50').html(ppbj50);
            $('.show_ppbj_200').html(ppbj200);
            $('.show_ppbj_25').html(ppbj25);
        }

    });

}



function showDak(id_bln) {
    $.ajax({
        url: BASE_URL + "/rekapitulasi/dak/" + id_bln,
        type: 'GET',
        async: true,
        dataType: 'json',
        success: function (data) {
            console.log(data)
            dakFisik = `
                <td><b>DANA ALOKASI KHUSUS ( DAK ) FISIK REGULER</b> </td>
                <td class="text-right">${Rupiah(data.pagu_dak_fisik)}</td>
                <td class="text-right">${Rupiah(data.real_keu_dak_fisik)}</td>
                <td class="text-right">${(data.real_keu_dak_fisik / data.pagu_dak_fisik * 100).toFixed(2).replace('.', ',')}</td>
                <td class="text-right">${data.real_fik_dak_fisik}</td>
                `;
            dakNonFisik = `
                <td><b>DANA ALOKASI KHUSUS ( DAK ) NON FISIK</b> </td>
                <td class="text-right">${Rupiah(data.pagu_dak_non_fisik)}</td>
                <td class="text-right">${Rupiah(data.real_keu_dak_non_fisik)}</td>
                <td class="text-right">${(data.real_keu_dak_non_fisik / data.pagu_dak_non_fisik * 100).toFixed(2).replace('.', ',')}</td>
                <td class="text-right">${data.real_fik_dak_non_fisik}</td>
                `;



            $('.show_dak_fisik').html(dakFisik);
            $('.show_dak_non_fisik').html(dakNonFisik);

        }

    });
}
