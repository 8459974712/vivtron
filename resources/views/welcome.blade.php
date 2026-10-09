<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vivtron EVCS</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">
    <style>
        :root {
    --blue: #0b3b73;
    --blue-dark: #082d59;
    --green: #36b34a;
    --ink: #122033;
    --muted: #667085;
    --line: #e6eaf0;
    --soft: #f5f8fb;
}

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Figtree, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    color: var(--ink);
    background: linear-gradient(180deg, #f7fbff 0%, #ffffff 46%, #f7fbff 100%);
}

a {
    color: inherit;
    text-decoration: none;
}

.shell {
    max-width: 980px;
    margin: 0 auto;
    padding: 0 22px;
}

.topbar {
    background: rgba(255, 255, 255, .94);
    border-bottom: 1px solid var(--line);
    position: sticky;
    top: 0;
    z-index: 10;
    backdrop-filter: blur(10px);
}

.nav {
    min-height: 86px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
}

.brand {
    display: flex;
    align-items: center;
    gap: 14px;
    font-weight: 800;
    letter-spacing: .12em;
    color: var(--blue);
}

.brand img {
    width: 86px;
    height: auto;
    display: block;
}

.actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 118px;
    height: 44px;
    padding: 0 20px;
    border-radius: 8px;
    font-weight: 800;
    border: 1px solid transparent;
    box-shadow: 0 8px 18px rgba(11, 59, 115, .12);
    transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 12px 24px rgba(11, 59, 115, .18);
}

.btn-blue {
    background: var(--blue);
    color: #fff;
}

.btn-blue:hover {
    background: var(--blue-dark);
}

.btn-green {
    background: var(--green);
    color: #fff;
}

.btn-green:hover {
    background: #2e9e40;
}

.hero {
    padding: 20px 0 20px;
}

.hero-grid {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    min-height: 75vh;
}

.hero-grid > div {
    width: 100%;
    max-width: 820px;
}

.eyebrow {
    margin: 0 0 16px;
    font-size: 13px;
    font-weight: 800;
    letter-spacing: .18em;
    color: var(--green);
    text-transform: uppercase;
}

h1 {
    margin: 0 auto;
    max-width: 760px;
    font-size: clamp(42px, 6vw, 72px);
    line-height: 1;
    color: var(--blue);
    font-weight: 800;
}

.lead {
    margin: 24px auto 0;
    max-width: 700px;
    font-size: 21px;
    line-height: 1.7;
    color: #445166;
}

.hero-actions {
    margin-top: 36px;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.hero-actions .btn {
    min-width: 180px;
    height: 52px;
}

.strip {
    border-top: 1px solid var(--line);
    background: #fff;
    padding: 28px 0 56px;
}

.summary {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
}

.summary-item {
    border: 1px solid var(--line);
    border-radius: 8px;
    padding: 20px;
    background: #fff;
}

.summary-item b {
    display: block;
    color: var(--blue);
    font-size: 18px;
    margin-bottom: 6px;
}

.summary-item p {
    margin: 0;
    color: var(--muted);
    line-height: 1.5;
    font-size: 14px;
}

@media (max-width: 900px) {
    .hero {
        padding: 60px 0;
    }

    .hero-grid {
        min-height: auto;
    }

    h1 {
        font-size: clamp(36px, 8vw, 54px);
    }

    .lead {
        font-size: 18px;
    }

    .summary {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 640px) {
    .nav {
        align-items: flex-start;
        flex-direction: column;
        padding: 14px 0;
    }

    .brand img {
        width: 74px;
    }

    .actions,
    .hero-actions {
        width: 100%;
    }

    .actions .btn,
    .hero-actions .btn {
        flex: 1;
        min-width: 0;
    }

    .hero-actions {
        flex-direction: column;
    }

    .hero-actions .btn {
        width: 100%;
    }

    .summary {
        grid-template-columns: 1fr;
    }

    .lead {
        font-size: 17px;
    }
}
    </style>
</head>
<body>
    @php
        $logoUrl = 'https://vivtronevcs.com/wp-content/uploads/2026/05/file_00000000d93c71fa8543361289614009-e1780049716431.png';
    @endphp

    <header class="topbar">
        <div class="shell nav">
            <a href="{{ url('/') }}" class="brand">
                <img src="{{ $logoUrl }}" alt="Vivtron EVCS">
                <span>VIVTRON EVCS</span>
            </a>
            <nav class="actions" aria-label="Account actions">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-blue">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-blue">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-green">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="shell hero-grid">
                <div>
                    <p class="eyebrow">Vivtron EVCS</p>
                    <h1>Welcome to your Vivtron member portal</h1>
                    <p class="lead">Access your dashboard, referrals, wallet, KYC, team details, income history, and account tools from one secure place.</p>
                    <div class="hero-actions">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-blue">Open Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-blue">Login to Account</a>
                            <a href="{{ route('register') }}" class="btn btn-green">Create Account</a>
                        @endauth
                    </div>
                </div>

                <!--<aside class="panel logo-card" aria-label="Portal features">-->
                <!--    <img src="{{ $logoUrl }}" alt="Vivtron EVCS Logo">-->
                <!--    <div class="feature-grid">-->
                <!--        <div class="feature"><span>Members</span><strong>Dashboard</strong></div>-->
                <!--        <div class="feature"><span>Network</span><strong>Referrals</strong></div>-->
                <!--        <div class="feature"><span>Account</span><strong>KYC</strong></div>-->
                <!--        <div class="feature"><span>Reports</span><strong>Income</strong></div>-->
                <!--    </div>-->
                <!--</aside>-->
            </div>
        </section>

        <section class="strip">
            <div class="shell summary">
                <div class="summary-item"><b>Secure Login</b><p>Members can access their account dashboard and tools after authentication.</p></div>
                <div class="summary-item"><b>Referral Tracking</b><p>View referral details and share your member referral link.</p></div>
                <div class="summary-item"><b>Wallet & Income</b><p>Track wallet balance, income history, withdrawals, and rewards.</p></div>
                <div class="summary-item"><b>KYC & Profile</b><p>Manage KYC, bank details, profile information, and account status.</p></div>
            </div>
        </section>
    </main>
</body>
</html>
