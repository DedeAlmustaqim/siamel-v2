<!doctype html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ url('/') }}/assets/" data-template="horizontal-menu-template-no-customizer"
    data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/siamel.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/fonts/remixicon/remixicon.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/fonts/flag-icons.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/css/rtl/theme-default.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/swiper/swiper.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/sweetalert2/sweetalert2.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/css/pages/cards-statistics.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/css/pages/cards-analytics.css" />


    <!-- Helpers -->
    <script src="{{ url('/') }}/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ url('/') }}/assets/js/config.js"></script>
    <style>
        .readonly-bg {
            background-color: #e9ecef !important;
            /* Warna abu-abu */
            cursor: not-allowed;
            pointer-events: none;
            /* Mengubah cursor */
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">
            <!-- Navbar -->

            @include('partial/navbar')

            <!-- / Navbar -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Menu -->
                    @include('partial/menu')
                    <!-- / Menu -->

                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row g-6">
                            <!-- Gamification Card -->
                            @yield('content')
                        </div>
                    </div>
                    <!--/ Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                <div class="text-body mb-2 mb-md-0">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    , made with <span class="text-danger"><i class="tf-icons ri-heart-fill"></i></span>
                                    by
                                    <a href="https://pixinvent.com" target="_blank" class="footer-link">Pixinvent</a>
                                </div>
                                <div class="d-none d-lg-inline-block">
                                    <a href="https://themeforest.net/licenses/standard" class="footer-link me-4"
                                        target="_blank">License</a>
                                    <a href="https://1.envato.market/pixinvent_portfolio" target="_blank"
                                        class="footer-link me-4">More Themes</a>

                                    <a href="https://demos.pixinvent.com/materialize-html-admin-template/documentation/"
                                        target="_blank" class="footer-link me-4">Documentation</a>

                                    <a href="https://pixinvent.ticksy.com/" target="_blank"
                                        class="footer-link d-none d-sm-inline-block">Support</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!--/ Content wrapper -->
            </div>

            <!--/ Layout container -->
        </div>
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

    <!--/ Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ url('/') }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ url('/') }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="{{ url('/') }}/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    {{-- <!-- Vendors JS -->
    <script src="{{ url('/') }}/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/swiper/swiper.js"></script> --}}

    <!-- Main JS -->
    <script src="{{ url('/') }}/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ url('/') }}/assets/js/dashboards-analytics.js"></script>
    <script src="{{ url('/') }}/assets/custom_js/core.js"></script>
    <script src="{{ asset('assets/currency/jquery.formatCurrency-1.4.0.js') }}"></script>
    <script>
        var BASE_URL = '{{ url('/') }}';
        $('.rp').blur(function() {
            $('.rp').formatCurrency();
        });

        $('.decimal').keyup(function() {
            var position = this.selectionStart - 1;
            //remove all but number and .
            var fixed = this.value.replace(/[^0-9\.]/g, "");
            if (fixed.charAt(0) === ".")
                fixed = fixed.slice(1);
            var pos = fixed.indexOf(".") + 1;
            if (pos >= 0)
                fixed = fixed.substr(0, pos) + fixed.slice(pos).replace(".", "");
            if (this.value !== fixed) {
                this.value = fixed;
                this.selectionStart = position;
                this.selectionEnd = position;
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
