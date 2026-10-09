<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Vivtron EVCS') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            :root {
                --vivtron-navy: #082f63;
                --vivtron-blue: #1268d8;
                --vivtron-green: #13a86b;
                --vivtron-teal: #04aeb2;
                --vivtron-surface: #f4f8fc;
            }

            * {
                scrollbar-width: thin;
                scrollbar-color: #9eb8d7 transparent;
            }

            body {
                background: var(--vivtron-surface);
                color: #18324f;
                overflow-x: hidden;
            }

            img {
                max-width: 100%;
            }

            .app-content {
                color: #18324f;
            }

            .app-content > .py-12,
            .app-content > .max-w-7xl,
            .app-content > .mx-auto {
                position: relative;
            }

            .app-content label {
                color: #294661;
                font-size: .82rem;
                font-weight: 700;
                letter-spacing: .01em;
            }

            .app-content input:not([type="file"]),
            .app-content select,
            .app-content textarea {
                border-color: #cbd9e8;
                border-radius: .7rem;
                background: #fbfdff;
                color: #173b60;
                box-shadow: 0 2px 8px rgba(13, 62, 108, .04);
                transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
            }

            .app-content input:not([type="file"]):focus,
            .app-content select:focus,
            .app-content textarea:focus {
                border-color: #2b83e8;
                background: #fff;
                box-shadow: 0 0 0 4px rgba(43, 131, 232, .12);
                outline: none;
            }

            .app-content input[type="file"] {
                width: 100%;
                border: 1px dashed #9bb9d8;
                border-radius: .75rem;
                background: #f7fbff;
                color: #47617b;
                font-size: .82rem;
                padding: .7rem;
            }

            .app-content table {
                overflow: hidden;
                border: 1px solid #dce8f3;
                border-radius: .9rem;
                border-collapse: separate;
                border-spacing: 0;
                box-shadow: 0 10px 28px rgba(13, 62, 108, .06);
            }

            .app-content table thead tr {
                background: linear-gradient(135deg, #eef7ff, #e8f6f3);
            }

            .app-content table th {
                color: #315570;
                font-size: .7rem;
                font-weight: 800;
                letter-spacing: .08em;
                text-transform: uppercase;
            }

            .app-content table td,
            .app-content table th {
                border-color: #e3edf5;
                padding: .9rem 1rem;
            }

            .app-content table tbody tr {
                background: #fff;
                transition: background .2s ease;
            }

            .app-content table tbody tr:hover {
                background: #f7fbff;
            }

            .app-content .bg-white.shadow,
            .app-content .bg-white.shadow-sm,
            .app-content .bg-white.shadow-lg {
                border: 1px solid #e1ebf4;
                box-shadow: 0 16px 36px rgba(13, 62, 108, .08);
            }

            .app-content button[type="submit"] {
                border-radius: .7rem;
                font-weight: 800;
                box-shadow: 0 8px 18px rgba(18, 104, 216, .18);
                transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
            }

            .app-content button[type="submit"]:hover {
                filter: brightness(1.04);
                box-shadow: 0 12px 24px rgba(18, 104, 216, .24);
                transform: translateY(-1px);
            }

            .app-shell {
                min-height: 100vh;
                background:
                    radial-gradient(circle at 80% -10%, rgba(29, 132, 226, .08), transparent 32rem),
                    var(--vivtron-surface);
            }

            .app-content {
                min-height: 100vh;
                margin-left: 18rem;
                padding-top: 5rem;
            }

            .app-shell > header {
                position: relative;
                z-index: 10;
                margin-left: 18rem;
                padding-top: 5rem;
            }

            body > nav,
            .app-shell > nav {
                position: fixed;
                inset: 0 0 auto 18rem;
                z-index: 40;
                background: rgba(255, 255, 255, .94);
                border-bottom: 1px solid #dce8f5;
                box-shadow: 0 8px 28px rgba(15, 55, 96, .06);
            }

            body > nav > div:first-child,
            .app-shell > nav > div:first-child {
                height: 5rem;
            }

            body > nav > div:first-child > button:first-child,
            .app-shell > nav > div:first-child > button:first-child {
                display: none;
            }

            body > nav > div:first-child > a,
            .app-shell > nav > div:first-child > a {
                left: 1.5rem;
                transform: none;
            }

            body > nav > div:first-child > a img,
            .app-shell > nav > div:first-child > a img {
                width: auto;
                height: 3.1rem;
                object-fit: contain;
            }

            @media (min-width: 1024px) {
                body > nav > div:first-child > a,
                .app-shell > nav > div:first-child > a {
                    display: none;
                }

                body > nav > div:first-child > div:last-child,
                .app-shell > nav > div:first-child > div:last-child {
                    margin-left: auto;
                }
            }

            body > nav > div[class*="w-72"],
            .app-shell > nav > div[class*="w-72"] {
                position: fixed;
                inset: 0 auto 0 0;
                width: 18rem;
                height: 100vh;
                padding: 0 .9rem;
                overflow-y: auto;
                color: #dcecff;
                background:
                    radial-gradient(circle at 20% 0%, rgba(40, 135, 239, .22), transparent 19rem),
                    linear-gradient(180deg, #082f63 0%, #052249 100%);
                border: 0;
                box-shadow: 12px 0 28px rgba(4, 34, 73, .14);
            }

            body > nav > div[class*="w-72"] > div:first-child,
            .app-shell > nav > div[class*="w-72"] > div:first-child {
                min-height: 5rem;
                padding: 1rem .65rem;
                border-color: rgba(255, 255, 255, .14);
            }

            body > nav > div[class*="w-72"] h2,
            .app-shell > nav > div[class*="w-72"] h2 {
                color: #fff;
                font-size: 1.1rem;
                letter-spacing: .04em;
            }

            body > nav > div[class*="w-72"] > ul,
            .app-shell > nav > div[class*="w-72"] > ul {
                padding: .85rem .65rem 1.25rem;
            }

            body > nav > div[class*="w-72"] > ul > li:not([class*="text-gray"]),
            .app-shell > nav > div[class*="w-72"] > ul > li:not([class*="text-gray"]) {
                position: relative;
            }

            body > nav > div[class*="w-72"] li a,
            body > nav > div[class*="w-72"] li form button,
            .app-shell > nav > div[class*="w-72"] li a,
            .app-shell > nav > div[class*="w-72"] li form button {
                display: flex;
                align-items: center;
                min-height: 2.8rem;
                margin: .22rem 0;
                padding: .72rem .9rem;
                color: #dbeafe;
                border: 1px solid transparent;
                border-radius: .75rem;
                font-size: .9rem;
                font-weight: 600;
                letter-spacing: .005em;
                text-decoration: none;
                transition: background .2s ease, color .2s ease, transform .2s ease, border-color .2s ease, box-shadow .2s ease;
            }

            body > nav > div[class*="w-72"] li a:hover,
            body > nav > div[class*="w-72"] li form button:hover,
            .app-shell > nav > div[class*="w-72"] li a:hover,
            .app-shell > nav > div[class*="w-72"] li form button:hover {
                color: #fff;
                background: rgba(58, 141, 241, .16);
                border-color: rgba(155, 208, 255, .2);
                box-shadow: 0 5px 14px rgba(0, 20, 60, .12);
                transform: translateX(2px);
            }

            body > nav > div[class*="w-72"] li.sidebar-section-label,
            .app-shell > nav > div[class*="w-72"] li.sidebar-section-label {
                margin: .45rem .35rem .65rem;
                padding: .4rem .55rem;
                color: #8fbee9;
                font-size: .64rem;
                font-weight: 800;
                letter-spacing: .16em;
                line-height: 1;
                text-transform: uppercase;
            }

            body > nav > div[class*="w-72"] li.sidebar-section-label::after,
            .app-shell > nav > div[class*="w-72"] li.sidebar-section-label::after {
                content: "";
                display: block;
                height: 1px;
                margin-top: .7rem;
                background: linear-gradient(90deg, rgba(143, 190, 233, .35), transparent);
            }

            body > nav > div[class*="w-72"] li a.sidebar-link-active,
            .app-shell > nav > div[class*="w-72"] li a.sidebar-link-active {
                position: relative;
                color: #fff !important;
                background: linear-gradient(135deg, #1878e8, #0b56bd) !important;
                border-color: rgba(155, 208, 255, .38) !important;
                box-shadow: 0 8px 18px rgba(0, 100, 222, .24);
                font-weight: 700;
                transform: translateX(2px);
            }

            body > nav > div[class*="w-72"] li a.sidebar-link-active::before,
            .app-shell > nav > div[class*="w-72"] li a.sidebar-link-active::before {
                content: "";
                position: absolute;
                left: -.85rem;
                top: .35rem;
                bottom: .35rem;
                width: .22rem;
                border-radius: 999px;
                background: #7dd3fc;
                box-shadow: 0 0 12px rgba(125, 211, 252, .85);
            }

            body > nav > div[class*="w-72"] li a.sidebar-link-active::after,
            .app-shell > nav > div[class*="w-72"] li a.sidebar-link-active::after {
                content: "";
                position: absolute;
                right: .75rem;
                width: .38rem;
                height: .38rem;
                border-radius: 999px;
                background: #dff7ff;
                box-shadow: 0 0 10px rgba(223, 247, 255, .9);
            }

            body > nav > div[class*="w-72"] li a.sidebar-link-active:hover,
            .app-shell > nav > div[class*="w-72"] li a.sidebar-link-active:hover {
                color: #fff !important;
                background: linear-gradient(135deg, #2385f3, #0d5fc9) !important;
            }

            body > nav > div[class*="w-72"] hr,
            .app-shell > nav > div[class*="w-72"] hr {
                border-color: rgba(255, 255, 255, .15);
            }

            body > nav > div[class*="w-72"] li[class*="text-gray"],
            .app-shell > nav > div[class*="w-72"] li[class*="text-gray"] {
                color: #86b5e8;
                letter-spacing: .08em;
                font-size: .68rem;
            }

            @media (min-width: 1024px) {
                body > nav > div[class*="w-72"],
                .app-shell > nav > div[class*="w-72"] {
                    display: block !important;
                }

                body > nav.sidebar-collapsed,
                .app-shell > nav.sidebar-collapsed {
                    left: 5.5rem;
                }

                .app-shell:has(> nav.sidebar-collapsed) .app-content {
                    margin-left: 5.5rem;
                }

                .app-shell:has(> nav.sidebar-collapsed) > header {
                    margin-left: 5.5rem;
                }

                body > nav.sidebar-collapsed > div[class*="w-72"],
                .app-shell > nav.sidebar-collapsed > div[class*="w-72"] {
                    width: 5.5rem;
                    padding-left: .65rem;
                    padding-right: .65rem;
                }

                body > nav.sidebar-collapsed .sidebar-brand,
                .app-shell > nav.sidebar-collapsed .sidebar-brand {
                    justify-content: center;
                }

                body > nav.sidebar-collapsed .sidebar-brand-label,
                .app-shell > nav.sidebar-collapsed .sidebar-brand-label,
                body > nav.sidebar-collapsed li[class*="text-gray"],
                .app-shell > nav.sidebar-collapsed li[class*="text-gray"],
                body > nav.sidebar-collapsed .sidebar-section-label,
                .app-shell > nav.sidebar-collapsed .sidebar-section-label {
                    display: none;
                }

                body > nav.sidebar-collapsed li a,
                body > nav.sidebar-collapsed li form button,
                .app-shell > nav.sidebar-collapsed li a,
                .app-shell > nav.sidebar-collapsed li form button {
                    width: 3.8rem;
                    justify-content: center;
                    overflow: hidden;
                    white-space: nowrap;
                    padding-left: .5rem;
                    padding-right: .5rem;
                    font-size: 0 !important;
                    letter-spacing: 0;
                    text-indent: 0;
                }

                body > nav.sidebar-collapsed li a::first-letter,
                body > nav.sidebar-collapsed li form button::first-letter,
                .app-shell > nav.sidebar-collapsed li a::first-letter,
                .app-shell > nav.sidebar-collapsed li form button::first-letter {
                    font-size: 1.15rem;
                }

                body > nav.sidebar-collapsed li a.sidebar-link-active::before,
                .app-shell > nav.sidebar-collapsed li a.sidebar-link-active::before {
                    left: .1rem;
                }

                body > nav.sidebar-collapsed li a.sidebar-link-active::after,
                .app-shell > nav.sidebar-collapsed li a.sidebar-link-active::after {
                    right: .28rem;
                    width: .3rem;
                    height: .3rem;
                }

                body > nav.sidebar-collapsed .sidebar-collapse,
                .app-shell > nav.sidebar-collapsed .sidebar-collapse {
                    display: block !important;
                }

                body > nav:not(.sidebar-collapsed) .sidebar-collapse,
                .app-shell > nav:not(.sidebar-collapsed) .sidebar-collapse {
                    display: block !important;
                }

                body > nav:not(.sidebar-collapsed) .sidebar-close,
                .app-shell > nav:not(.sidebar-collapsed) .sidebar-close {
                    display: none;
                }
            }

            @media (max-width: 1023px) {
                .sidebar-backdrop {
                    position: fixed;
                    inset: 0;
                    z-index: 45;
                    background: rgba(3, 22, 48, .48);
                    backdrop-filter: blur(2px);
                }

                .app-content {
                    margin-left: 0;
                    padding-top: 4.5rem;
                    min-width: 0;
                }

                .app-shell > header {
                    margin-left: 0;
                    padding-top: 4.5rem;
                }

                body > nav,
                .app-shell > nav {
                    inset: 0 0 auto 0;
                }

                body > nav > div:first-child > button:first-child,
                .app-shell > nav > div:first-child > button:first-child {
                    display: block;
                    color: var(--vivtron-navy);
                }

                body > nav > div:first-child > a,
                .app-shell > nav > div:first-child > a {
                    display: block;
                    left: 50%;
                    transform: translateX(-50%);
                }

                body > nav > div:first-child > div:last-child,
                .app-shell > nav > div:first-child > div:last-child {
                    margin-left: auto;
                }

                body > nav > div[class*="w-72"],
                .app-shell > nav > div[class*="w-72"] {
                    width: min(18rem, 86vw);
                    max-height: 100dvh;
                    padding-left: .7rem;
                    padding-right: .7rem;
                }

                .app-content > .py-12,
                .app-content > .max-w-7xl,
                .app-content > .mx-auto {
                    width: 100%;
                    max-width: 100%;
                    padding-left: .85rem;
                    padding-right: .85rem;
                }

                .app-content table {
                    display: block;
                    max-width: 100%;
                    overflow-x: auto;
                    white-space: nowrap;
                }

                .app-content form {
                    max-width: 100%;
                }

                .app-content .grid {
                    min-width: 0;
                }

                body > nav .sidebar-brand-label,
                .app-shell > nav .sidebar-brand-label,
                body > nav .sidebar-collapse,
                .app-shell > nav .sidebar-collapse {
                    display: none;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen app-shell">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="app-content">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
