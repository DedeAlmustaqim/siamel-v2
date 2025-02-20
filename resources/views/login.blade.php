<!doctype html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="assets/" data-template="horizontal-menu-template-no-customizer" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ $title }}</title>

    <meta name="description" content="" />

    @php
        $styles = [
            // Icons
            'assets/vendor/fonts/remixicon/remixicon.css',
            'assets/vendor/fonts/flag-icons.css',

            // Menu waves for no-customizer fix
            'assets/vendor/libs/node-waves/node-waves.css',

            // Core CSS
            'assets/vendor/css/rtl/core.css',
            'assets/vendor/css/rtl/theme-default.css',
            'assets/css/demo.css',

            // Vendors CSS
            'assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css',
            'assets/vendor/libs/typeahead-js/typeahead.css',
            'assets/vendor/libs/@form-validation/form-validation.css',

            // Page CSS
            'assets/vendor/css/pages/page-auth.css',
        ];

        $scripts = [
            // Helpers & Config
            'assets/vendor/js/helpers.js',
            'assets/js/config.js',
        ];
    @endphp

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />

    @foreach ($styles as $style)
        <link rel="stylesheet" href="{{ asset($style) }}">
    @endforeach

    @foreach ($scripts as $script)
        <script src="{{ asset($script) }}"></script>
    @endforeach

</head>

<body>
    <!-- Content -->

    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0">
            <div class="authentication-inner py-6">
                <!-- Login -->
                <div class="card p-md-7 p-1">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <a href="index.html" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="{{ asset('assets/siamel.png') }}" alt class="h-25" width="200px" />
                            </span>
                        </a>
                    </div>
                    <!-- /Logo -->

                    <div class="card-body mt-1">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form id="formAuthentication" class="mb-5" action="{{ url('/') }}/login" method="post">
                            @csrf
                            <div class="form-floating form-floating-outline mb-5">
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Username" autofocus />
                                <label for="email">Username</label>
                            </div>
                            <div class="mb-5">
                                <div class="form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input type="password" id="password" class="form-control" name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" />
                                            <label for="password">Password</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer"><i
                                                class="ri-eye-off-line"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating form-floating-outline mb-5">
                                <select class="form-select" id="ta" name="ta">
                                    @for ($year = 2021; $year <= date('Y'); $year++)
                                        <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>
                                            {{ $year }}</option>
                                    @endfor
                                </select>
                                <label for="email">Username</label>
                            </div>
                            <div class="mb-5">
                                <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>&copy; Bidang Perencanaan, Pengendalian Dan Evaluasi Pembangunan Daerah Baplitbangda
                                Kab.
                                Bartim</span>

                        </p>
                    </div>
                </div>
                <!-- /Login -->
                <img alt="mask" src="assets/img/illustrations/auth-basic-login-mask-light.png"
                    class="authentication-image d-none d-lg-block"
                    data-app-light-img="illustrations/auth-basic-login-mask-light.png"
                    data-app-dark-img="illustrations/auth-basic-login-mask-dark.png" />
            </div>
        </div>
    </div>

    <!-- / Content -->

    @php
        $coreScripts = [
            'assets/vendor/libs/jquery/jquery.js',
            'assets/vendor/libs/popper/popper.js',
            'assets/vendor/js/bootstrap.js',
            'assets/vendor/libs/node-waves/node-waves.js',
            'assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
            'assets/vendor/libs/hammer/hammer.js',
            'assets/vendor/libs/i18n/i18n.js',
            'assets/vendor/libs/typeahead-js/typeahead.js',
            'assets/vendor/js/menu.js',
        ];

        $vendorScripts = [
            'assets/vendor/libs/@form-validation/popular.js',
            'assets/vendor/libs/@form-validation/bootstrap5.js',
            'assets/vendor/libs/@form-validation/auto-focus.js',
        ];

        $mainScripts = ['assets/js/main.js', 'assets/js/pages-auth.js'];
    @endphp

    <!-- Core JS -->
    @foreach ($coreScripts as $script)
        <script src="{{ asset($script) }}"></script>
    @endforeach

    <!-- Vendors JS -->
    @foreach ($vendorScripts as $script)
        <script src="{{ asset($script) }}"></script>
    @endforeach

    <!-- Main JS -->
    @foreach ($mainScripts as $script)
        <script src="{{ asset($script) }}"></script>
    @endforeach

</body>

</html>
