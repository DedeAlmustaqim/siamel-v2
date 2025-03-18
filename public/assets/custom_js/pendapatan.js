
$(document).ready(function () {


    $('#id_unit_apbd').on('change', function () {
        var id_unit_apbd = $(this).val();
        var bln = $('#bulan_apbd').val();
        if (id_unit_apbd != '' && bln != '') {
            show_pd(bln, id_unit_apbd);
            grafik_pendapatan();
        }
    });


    $('#bulan_apbd').on('change', function () {
        var bln = $(this).val();
        var id_unit_apbd = $('#id_unit_apbd').val();
        if (id_unit_apbd != '' && bln != '') {
            show_pd(bln, id_unit_apbd);
            grafik_pendapatan();
        }
    });

})

let barChartInstance = null; // Simpan instance chart
function show_pd(id_bln, unit) {
    $.ajax({
        type: "GET",
        "url": BASE_URL + "/pendapatan/get-pendapatan/" + id_bln + '/' + unit,
        dataType: "JSON",

        success: function (data) {
            //Navigasi pendapatan
            //document.getElementById("BulanApbd").innerHTML = 'Data Bulan : '+data.nm_bln;
            document.getElementById('BtnNavigasiPd').innerHTML =
                '<button type="button" class="btn btn-sm btn-primary waves-effect waves-light" onClick="ModalPd(this)"  data-bln="' + data.id_bln + '" data-unit="' + data.id_unit + '"   title="Input Data"><i class="mdi mdi-square-edit-outline"></i> Edit</button>' +
                '&nbsp;<a href="' + BASE_URL + '/pendapatan/report-pendapatan/' + data.id_bln + '/' + data.id_unit + '" target="_blank" class="btn btn-sm btn-secondary waves-effect waves-light" ><i class="ri-printer-line"></i>&nbsp;Pendapatan</a>';
            //Tabel Pendapatan
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

    const id_unit_apbd = $('#id_unit_apbd').val();

    $.ajax({
        url: BASE_URL + '/service/grafik/pendapatan-skpd/' + id_unit_apbd,
        type: 'GET',
        success: function (data) {
            const barChart = document.getElementById('barChartPendapatan');

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


function ModalPd(elem) {
    var bln = $(elem).data("bln");
    var unit = $(elem).data("unit");

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
                    "url": BASE_URL + "/pendapatan/get-pendapatan/" + bln + '/' + unit,
                    //processData: false,
                    contentType: false,
                    dataType: "JSON",
                    async: true,
                    success: function (data) {
                        $('#ModalPd').modal('show');


                        $('#id_unit_pd').val(data['id_unit']);
                        $('#id_bln_pd').val(data['id_bln']);


                        $('#target_total').val(data['target_total']).formatCurrency();
                        $('#keu_total').val(data['keu_total']).formatCurrency();
                        $('#keu_per_total').val(data['keu_per_total']);

                        $('#pad_target').val(data['pad_target']).formatCurrency();
                        $('#pad_real').val(data['pad_real']).formatCurrency();
                        $('#pad_real_per').val(data['pad_real_per']);

                        $('#tp_target').val(data['tp_target']).formatCurrency();
                        $('#tp_keu').val(data['tp_keu']).formatCurrency();
                        $('#tp_per').val(data['tp_per']);

                        $('#tad_target').val(data['tad_target']).formatCurrency();
                        $('#tad_keu').val(data['tad_keu']).formatCurrency();
                        $('#tad_per').val(data['tad_per']);

                        $('#pad_sah_target').val(data['pad_sah_target']).formatCurrency();
                        $('#pad_sah_keu').val(data['pad_sah_keu']).formatCurrency();
                        $('#pad_sah_per').val(data['pad_sah_per']);


                    },

                })
                return false;
            }
        },
        error: function (xhr, status, error) {
            // Callback ketika terjadi error dalam request
            console.error("Error:", error);
        }
    });


}


$('#pad_target, #pad_real').keyup(function (e) {

    var pad_target = $('#pad_target').val().replace(/,/g, '');
    var pad_real = $('#pad_real').val().replace(/,/g, '');

    var pad_real_per = pad_real / pad_target * 100;
    var per = pad_real_per.toFixed(2)
    $('#pad_real_per').val(per);
});

$('#tp_target, #tp_keu').keyup(function (e) {

    var tp_target = $('#tp_target').val().replace(/,/g, '');
    var tp_keu = $('#tp_keu').val().replace(/,/g, '');

    var tp_per = tp_keu / tp_target * 100;
    var per = tp_per.toFixed(2)
    $('#tp_per').val(per);
});

$('#tad_target, #tad_keu').keyup(function (e) {

    var tad_target = $('#tad_target').val().replace(/,/g, '');
    var tad_keu = $('#tad_keu').val().replace(/,/g, '');

    var tad_per = tad_keu / tad_target * 100;
    var per = tad_per.toFixed(2)
    $('#tad_per').val(per);
});

$('#pad_sah_target, #pad_sah_keu').keyup(function (e) {

    var pad_sah_target = $('#pad_sah_target').val().replace(/,/g, '');
    var pad_sah_keu = $('#pad_sah_keu').val().replace(/,/g, '');

    var pad_sah_per = pad_sah_keu / pad_sah_target * 100;
    var per = pad_sah_per.toFixed(2)
    $('#pad_sah_per').val(per);
});


$('#pad_target, #tp_target, #tad_target, #pad_sah_target').keyup(function (e) {

    var sum = 0;
    $("input[class *= 'sumpd']").each(function () {
        sum += +$(this).val().replace(/,/g, '');
    });
    $("#target_total").val(sum).formatCurrency({});
});

$('#pad_real, #tp_keu, #tad_keu, #pad_sah_keu').keyup(function (e) {

    var sum = 0;
    $("input[class *= 'keu']").each(function () {
        sum += +$(this).val().replace(/,/g, '');
    });
    $("#keu_total").val(sum).formatCurrency({});
});


$('#pad_target, #pad_real, #tp_target, #tp_keu, #tad_target, #tad_keu, #pad_sah_target, #pad_sah_keu').keyup(function (e) {

    var target_total = $('#target_total').val().replace(/,/g, '');
    var keu_total = $('#keu_total').val().replace(/,/g, '');

    var keu_per_total = keu_total / target_total * 100;
    var per_pd = keu_per_total.toFixed(2)
    $('#keu_per_total').val(per_pd);
});

$('#FormPd').on('submit', function (e) {
    e.preventDefault();
    var postData = new FormData($("#FormPd")[0]);
    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF
    postData.append('_token', csrfToken); // Sertakan token CSRF di FormData
    $.ajax({
        type: "POST",
        url: BASE_URL + "/pendapatan/update",
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
                show_pd(bln, id_unit_apbd);
                $('#ModalPd').modal('hide');
                // grafik_apdb();
            }
        },
    });
    return false;
});