<?php require_once 'auth.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <script src="tailwind/tailwind.css"></script>
    <script src="jquery/jquery-3.6.0.min.js"></script>
    <script src="chart/chart.js"></script>
    <title>Finance Command — Software Dept.</title>
    <style>
        :root {
            --navy: #0d1117;
            --navy-2: #161b22;
            --navy-3: #1c2333;
            --border: #2a3444;
            --border-lo: #1e2a38;
            --blue: #2563eb;
            --blue-dim: #1e4fc2;
            --blue-glow: rgba(37, 99, 235, 0.15);
            --emerald: #10b981;
            --rose: #f43f5e;
            --amber: #f59e0b;
            --text-1: #f0f6fc;
            --text-2: #8b949e;
            --text-3: #484f58;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--navy);
            color: var(--text-1);
            min-height: 100vh;
            font-size: 14px;
            line-height: 1.5;
        }

        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            background: var(--navy);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 99px;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            flex-shrink: 0;
            background: var(--navy-2);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-logo {
            padding: 22px 18px 18px;
            border-bottom: 1px solid var(--border);
        }

        .logo-mark {
            font-family: 'Playfair Display', serif;
            font-size: 17px;
            font-weight: 600;
            color: var(--text-1);
        }

        .logo-sub {
            font-size: 10px;
            color: var(--text-3);
            margin-top: 2px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .sidebar-nav {
            padding: 10px 8px;
            flex: 1;
        }

        .nav-sec {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-3);
            padding: 10px 10px 5px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 8px 10px;
            border-radius: 6px;
            font-size: 13px;
            color: var(--text-2);
            cursor: pointer;
            transition: all 0.15s;
            margin-bottom: 1px;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
            text-decoration: none;
        }

        .nav-item:hover {
            background: var(--navy-3);
            color: var(--text-1);
        }

        .nav-item.active {
            background: var(--blue-glow);
            color: var(--blue);
            font-weight: 500;
        }

        .nav-item i {
            width: 15px;
            font-size: 12px;
        }

        .sidebar-footer {
            padding: 14px;
            border-top: 1px solid var(--border);
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 8px 10px;
            border-radius: 7px;
            background: var(--navy-3);
        }

        .user-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
            color: #fff;
            flex-shrink: 0;
        }

        .user-name {
            font-size: 12px;
            font-weight: 500;
        }

        .user-role {
            font-size: 10px;
            color: var(--text-3);
        }

        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .topbar {
            padding: 0 24px;
            height: 52px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--navy-2);
            flex-shrink: 0;
        }

        .topbar-title {
            font-size: 14px;
            font-weight: 600;
        }

        .content {
            padding: 22px 24px;
            flex: 1;
            overflow-y: auto;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 15px;
            border-radius: 6px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.15s;
            white-space: nowrap;
        }

        .btn-primary {
            background: var(--blue);
            color: #fff;
        }

        .btn-primary:hover {
            background: var(--blue-dim);
        }

        .btn-secondary {
            background: var(--navy-3);
            border-color: var(--border);
            color: var(--text-2);
        }

        .btn-secondary:hover {
            color: var(--text-1);
        }

        .btn-ghost {
            background: transparent;
            color: var(--text-2);
            border-color: var(--border);
        }

        .btn-ghost:hover {
            background: var(--navy-3);
            color: var(--text-1);
        }

        .btn-danger-soft {
            background: rgba(244, 63, 94, 0.08);
            border-color: rgba(244, 63, 94, 0.25);
            color: var(--rose);
        }

        .btn-danger-soft:hover {
            background: rgba(244, 63, 94, 0.14);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        .btn-xs {
            padding: 3px 8px;
            font-size: 11px;
            border-radius: 4px;
        }

        .card {
            background: var(--navy-2);
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
        }

        .card-head {
            padding: 14px 18px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-title {
            font-size: 13px;
            font-weight: 600;
        }

        .card-sub {
            font-size: 11px;
            color: var(--text-3);
            margin-top: 1px;
        }

        .card-body {
            padding: 18px;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: var(--navy-2);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 18px;
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
        }

        .stat-card.income::after {
            background: var(--emerald);
        }

        .stat-card.expense::after {
            background: var(--rose);
        }

        .stat-card.balance::after {
            background: var(--blue);
        }

        .stat-label {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.04em;
            color: var(--text-2);
            text-transform: uppercase;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .stat-value {
            font-family: 'DM Mono', monospace;
            font-size: 24px;
            font-weight: 500;
            letter-spacing: -0.5px;
            line-height: 1;
        }

        .stat-value.green {
            color: var(--emerald);
        }

        .stat-value.red {
            color: var(--rose);
        }

        .stat-value.blue {
            color: var(--blue);
        }

        .stat-delta {
            font-size: 11px;
            color: var(--text-3);
            margin-top: 5px;
        }

        .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            display: inline-block;
        }

        .dot-green {
            background: var(--emerald);
        }

        .dot-red {
            background: var(--rose);
        }

        .dot-blue {
            background: var(--blue);
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .field label {
            font-size: 11px;
            font-weight: 500;
            color: var(--text-2);
        }

        .input {
            background: var(--navy);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 9px 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: var(--text-1);
            width: 100%;
            transition: border-color 0.15s;
            outline: none;
            -webkit-appearance: none;
        }

        .input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px var(--blue-glow);
        }

        .input::placeholder {
            color: var(--text-3);
        }

        select.input option {
            background: var(--navy-2);
        }

        input[type="date"].input::-webkit-calendar-picker-indicator {
            filter: invert(0.4);
            cursor: pointer;
        }

        .toggle-group {
            display: flex;
            background: var(--navy);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 3px;
            gap: 2px;
        }

        .toggle-opt {
            flex: 1;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            color: var(--text-3);
            cursor: pointer;
            border: none;
            background: transparent;
            transition: all 0.15s;
            text-align: center;
        }

        .toggle-opt.active {
            background: var(--blue);
            color: #fff;
        }

        .tab-bar {
            display: flex;
            border-bottom: 1px solid var(--border);
            padding: 0 18px;
            background: var(--navy-2);
        }

        .tab {
            padding: 11px 16px;
            font-size: 12px;
            font-weight: 500;
            color: var(--text-3);
            cursor: pointer;
            border: none;
            background: transparent;
            border-bottom: 2px solid transparent;
            margin-bottom: -1px;
            transition: all 0.15s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .tab:hover {
            color: var(--text-2);
        }

        .tab.active {
            color: var(--text-1);
            border-bottom-color: var(--blue);
            font-weight: 600;
        }

        .tab-count {
            background: var(--navy-3);
            border-radius: 99px;
            padding: 1px 7px;
            font-size: 10px;
            color: var(--text-3);
        }

        .tab.active .tab-count {
            background: var(--blue-glow);
            color: var(--blue);
        }

        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            padding: 9px 15px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--text-3);
            background: var(--navy);
            border-bottom: 1px solid var(--border);
            text-align: left;
            white-space: nowrap;
            cursor: pointer;
            user-select: none;
        }

        thead th:hover {
            color: var(--text-2);
        }

        tbody tr {
            border-bottom: 1px solid var(--border-lo);
            transition: background 0.1s;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background: var(--navy-3);
        }

        tbody td {
            padding: 11px 15px;
            font-size: 13px;
            color: var(--text-1);
            vertical-align: middle;
        }

        .empty-row td {
            padding: 44px;
            text-align: center;
            color: var(--text-3);
            font-size: 13px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 9px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 500;
        }

        .badge-green {
            background: rgba(16, 185, 129, 0.1);
            color: var(--emerald);
        }

        .badge-red {
            background: rgba(244, 63, 94, 0.1);
            color: var(--rose);
        }

        .badge-blue {
            background: var(--blue-glow);
            color: var(--blue);
        }

        .badge-gray {
            background: var(--navy-3);
            color: var(--text-2);
        }

        .amount-pos {
            font-family: 'DM Mono', monospace;
            color: var(--emerald);
            font-weight: 500;
        }

        .amount-neg {
            font-family: 'DM Mono', monospace;
            color: var(--rose);
            font-weight: 500;
        }

        .person-name {
            font-size: 13px;
            font-weight: 500;
        }

        .person-desc {
            font-size: 11px;
            color: var(--text-3);
            margin-top: 1px;
        }

        .muted {
            color: var(--text-2);
            font-size: 12px;
        }

        .table-footer {
            display: grid;
            padding: 13px 18px;
            border-top: 1px solid var(--border);
            background: var(--navy);
            gap: 12px;
        }

        .tf-3 {
            grid-template-columns: 1fr 1fr 1fr;
        }

        .tf-2 {
            grid-template-columns: 1fr 1fr;
        }

        .tf-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--text-3);
            margin-bottom: 2px;
        }

        .tf-value {
            font-family: 'DM Mono', monospace;
            font-size: 15px;
            font-weight: 500;
        }

        .filter-row {
            padding: 12px 18px;
            border-bottom: 1px solid var(--border);
            display: flex;
            gap: 10px;
            align-items: flex-end;
            flex-wrap: wrap;
        }

        .fg {
            flex: 1;
            min-width: 130px;
        }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .form-stack {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .qr-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            padding: 18px;
            position: relative;
        }

        .qr-frame {
            border: 2px solid var(--border);
            border-radius: 7px;
            padding: 8px;
            background: #fff;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: border-color 0.2s;
        }

        .qr-frame:hover {
            border-color: var(--blue);
        }

        .qr-frame img {
            width: 160px;
            height: 160px;
            object-fit: contain;
            display: block;
        }

        .qr-hover {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.65);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: 0.2s;
            color: #fff;
            font-size: 12px;
            gap: 4px;
        }

        .qr-frame:hover .qr-hover {
            opacity: 1;
        }

        .blur-cover {
            filter: blur(12px);
            pointer-events: none;
            user-select: none;
        }

        .qr-lock {
            position: absolute;
            inset: 0;
            background: rgba(13, 17, 23, 0.95);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            z-index: 10;
            border-radius: 0 0 10px 10px;
            top: 52px;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.75);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 20px;
            backdrop-filter: blur(4px);
        }

        .modal-overlay.open {
            display: flex;
        }

        .modal-box {
            background: var(--navy-2);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 26px;
            width: 100%;
            max-width: 350px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.5);
        }

        .modal-title {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .modal-sub {
            font-size: 12px;
            color: var(--text-3);
            margin-bottom: 18px;
        }

        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--navy);
            padding: 20px;
        }

        .login-box {
            width: 100%;
            max-width: 370px;
            background: var(--navy-2);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 34px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.4);
        }

        .login-logo {
            font-family: 'Playfair Display', serif;
            font-size: 21px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .login-tagline {
            font-size: 12px;
            color: var(--text-3);
            margin-bottom: 26px;
        }

        .sys-feed {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            color: var(--text-3);
            padding: 10px 15px;
            height: 76px;
            overflow-y: auto;
            line-height: 1.7;
        }

        .f-blue {
            color: #6699cc;
        }

        .f-green {
            color: var(--emerald);
        }

        .f-red {
            color: var(--rose);
        }

        .ghost-mode tbody {
            filter: blur(5px);
            opacity: 0.2;
            transition: 0.4s;
        }

        .ghost-mode #financeChart {
            filter: blur(5px);
            opacity: 0.2;
            transition: 0.4s;
        }

        .hidden {
            display: none !important;
        }

        .w-full {
            width: 100%;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .content-gap {
            margin-bottom: 20px;
        }

        @media (max-width: 1000px) {
            .sidebar {
                display: none;
            }
        }

        @media (max-width: 760px) {
            .stat-grid {
                grid-template-columns: 1fr 1fr;
            }

            .form-grid-2 {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .stat-grid {
                grid-template-columns: 1fr;
            }

            .content {
                padding: 14px;
            }
        }
    </style>
</head>

<body>

    <?php if (!checkAuth()): ?>
        <div class="login-page">
            <div class="login-box">
                <div class="login-logo">Finance Command</div>
                <div class="login-tagline">Software Department · Secure Access</div>
                <form id="login-form" class="form-stack">
                    <div class="field">
                        <label>Operator ID</label>
                        <input type="text" id="login_user" class="input" placeholder="Enter your ID" required
                            autocomplete="off">
                    </div>
                    <div class="field">
                        <label>Password</label>
                        <input type="password" id="login_pass" class="input" placeholder="••••••••" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-full"
                        style="justify-content:center;padding:11px;margin-top:4px;">Sign In</button>
                    <p id="login-msg" style="font-size:12px;color:var(--rose);text-align:center;min-height:16px;"></p>
                </form>
            </div>
        </div>
        <script>
            $('#login-form').submit(function (e) {
                e.preventDefault();
                $.post('auth.php', { action: 'login', username: $('#login_user').val(), password: $('#login_pass').val() }, function (res) {
                    const r = JSON.parse(res);
                    if (r.status === 'success') location.reload();
                    else $('#login-msg').text(r.message);
                });
            });
        </script>

    <?php else: ?>
        <div class="layout">

            <!-- SIDEBAR -->
            <aside class="sidebar">
                <div class="sidebar-logo">
                    <div class="logo-mark">Finance Command</div>
                    <div class="logo-sub">Software Department</div>
                </div>
                <nav class="sidebar-nav">
                    <div class="nav-sec">Main</div>
                    <a class="nav-item active"><i class="fas fa-th-large"></i> Dashboard</a>
                    <a class="nav-item" onclick="scrollTo2('manifest')"><i class="fas fa-list"></i> Transactions</a>
                    <a class="nav-item" onclick="scrollTo2('add-entry')"><i class="fas fa-plus-circle"></i> New Entry</a>
                    <div class="nav-sec" style="margin-top:10px;">Tools</div>
                    <a class="nav-item" onclick="scrollTo2('qr-section')"><i class="fas fa-qrcode"></i> QR Asset</a>
                    <a class="nav-item" onclick="scrollTo2('passchange')"><i class="fas fa-key"></i> Password</a>
                    <a class="nav-item" onclick="$('body').toggleClass('ghost-mode')"><i class="fas fa-eye-slash"></i> Ghost
                        Mode</a>
                </nav>
                <div class="sidebar-footer">
                    <div class="user-chip">
                        <div class="user-avatar"><?php echo strtoupper(substr($_SESSION['user'], 0, 1)); ?></div>
                        <div>
                            <div class="user-name"><?php echo htmlspecialchars($_SESSION['user']); ?></div>
                            <div class="user-role">Operator · Active</div>
                        </div>
                    </div>
                    <a href="auth.php?logout=1" class="btn btn-danger-soft btn-sm w-full"
                        style="margin-top:10px;justify-content:center;text-decoration:none;"><i
                            class="fas fa-sign-out-alt"></i> Sign Out</a>
                </div>
            </aside>

            <!-- MAIN -->
            <div class="main">
                <div class="topbar">
                    <div class="topbar-title">Dashboard</div>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <span id="live-clock" style="font-size:11px;color:var(--text-3);"></span>
                        <button onclick="updateDashboard()" class="btn btn-ghost btn-sm"><i class="fas fa-sync-alt"></i>
                            Refresh</button>
                    </div>
                </div>

                <div class="content">

                    <!-- STAT CARDS -->
                    <div class="stat-grid content-gap">
                        <div class="stat-card income">
                            <div class="stat-label"><span class="dot dot-green"></span> Total Supply</div>
                            <div class="stat-value green" id="stat-income">Rs. 0.00</div>
                            <div class="stat-delta" id="stat-ic">— entries</div>
                        </div>
                        <div class="stat-card expense">
                            <div class="stat-label"><span class="dot dot-red"></span> Total Burn</div>
                            <div class="stat-value red" id="stat-expense">Rs. 0.00</div>
                            <div class="stat-delta" id="stat-ec">— entries</div>
                        </div>
                        <div class="stat-card balance">
                            <div class="stat-label"><span class="dot dot-blue"></span> Net Balance</div>
                            <div class="stat-value blue" id="stat-balance">Rs. 0.00</div>
                            <div class="stat-delta">Current standing</div>
                        </div>
                    </div>
                    <!-- TRANSACTIONS -->
                    <div class="card content-gap" id="manifest">
                        <div class="card-head">
                            <div>
                                <div class="card-title">Transactions</div>
                                <div class="card-sub">All financial log entries</div>
                            </div>
                        </div>

                        <div class="filter-row">
                            <div class="fg" style="flex:2;">
                                <div class="field">
                                    <label>Search</label>
                                    <input type="text" id="recon-search" class="input"
                                        placeholder="Search by personnel or designation...">
                                </div>
                            </div>
                            <div class="fg">
                                <div class="field">
                                    <label>From</label>
                                    <input type="date" id="filter-date-from" class="input">
                                </div>
                            </div>
                            <div class="fg">
                                <div class="field">
                                    <label>To</label>
                                    <input type="date" id="filter-date-to" class="input">
                                </div>
                            </div>
                            <div style="align-self:flex-end;">
                                <button onclick="clearDateFilter()" class="btn btn-ghost btn-sm">Clear</button>
                            </div>
                        </div>

                        <div class="tab-bar">
                            <button class="tab active" onclick="switchTab('all',this)">All <span class="tab-count"
                                    id="cnt-all">0</span></button>
                            <button class="tab" onclick="switchTab('income',this)">Income <span class="tab-count"
                                    id="cnt-income">0</span></button>
                            <button class="tab" onclick="switchTab('expense',this)">Expenses <span class="tab-count"
                                    id="cnt-expense">0</span></button>
                        </div>

                        <div id="tab-all" class="tab-panel active">
                            <div class="table-wrap">
                                <table>
                                    <thead>
                                        <tr>
                                            <th onclick="sortTable('all',0)">Contributor / Designation</th>
                                            <th onclick="sortTable('all',1)">Category</th>
                                            <th onclick="sortTable('all',2)">Type</th>
                                            <th class="text-right" onclick="sortTable('all',3)">Amount</th>
                                            <th onclick="sortTable('all',4)">Date</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="list-all"></tbody>
                                </table>
                            </div>
                            <div class="table-footer tf-3">
                                <div>
                                    <div class="tf-label">Supply</div>
                                    <div class="tf-value" id="foot-income" style="color:var(--emerald);">Rs. 0.00</div>
                                </div>
                                <div style="text-align:center;">
                                    <div class="tf-label">Burn</div>
                                    <div class="tf-value" id="foot-expense" style="color:var(--rose);">Rs. 0.00</div>
                                </div>
                                <div style="text-align:right;">
                                    <div class="tf-label">Net</div>
                                    <div class="tf-value" id="foot-balance">Rs. 0.00</div>
                                </div>
                            </div>
                        </div>

                        <div id="tab-income" class="tab-panel">
                            <div class="table-wrap">
                                <table>
                                    <thead>
                                        <tr>
                                            <th onclick="sortTable('income',0)">Contributor / Designation</th>
                                            <th onclick="sortTable('income',1)">Category</th>
                                            <th class="text-right" onclick="sortTable('income',2)">Amount</th>
                                            <th onclick="sortTable('income',3)">Date</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="list-income"></tbody>
                                </table>
                            </div>
                            <div class="table-footer tf-2">
                                <div>
                                    <div class="tf-label">Total Income</div>
                                    <div class="tf-value" id="inc-total" style="color:var(--emerald);">Rs. 0.00</div>
                                </div>
                                <div style="text-align:right;">
                                    <div class="tf-label">Entries</div>
                                    <div class="tf-value" id="inc-count" style="color:var(--text-2);">0</div>
                                </div>
                            </div>
                        </div>

                        <div id="tab-expense" class="tab-panel">
                            <div class="table-wrap">
                                <table>
                                    <thead>
                                        <tr>
                                            <th onclick="sortTable('expense',0)">Contributor / Designation</th>
                                            <th onclick="sortTable('expense',1)">Category</th>
                                            <th class="text-right" onclick="sortTable('expense',2)">Amount</th>
                                            <th onclick="sortTable('expense',3)">Date</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="list-expense"></tbody>
                                </table>
                            </div>
                            <div class="table-footer tf-2">
                                <div>
                                    <div class="tf-label">Total Expense</div>
                                    <div class="tf-value" id="exp-total" style="color:var(--rose);">Rs. 0.00</div>
                                </div>
                                <div style="text-align:right;">
                                    <div class="tf-label">Entries</div>
                                    <div class="tf-value" id="exp-count" style="color:var(--text-2);">0</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FORM + SIDEBAR CARDS -->
                    <div style="display:grid;grid-template-columns:1fr 300px;gap:16px;" class="content-gap" id="add-entry">

                        <!-- ENTRY FORM -->
                        <div class="card">
                            <div class="card-head">
                                <div>
                                    <div class="card-title" id="form-title">New Transaction</div>
                                    <div class="card-sub">Log a new financial entry</div>
                                </div>
                                <button id="cancel-edit" class="btn btn-ghost btn-sm hidden"
                                    onclick="resetForm()">Cancel</button>
                            </div>
                            <div class="card-body">
                                <form id="finance-form" class="form-stack">
                                    <input type="hidden" id="update_id">
                                    <div class="field">
                                        <label>Entry Mode</label>
                                        <div class="toggle-group">
                                            <button type="button" id="mode-individual"
                                                class="toggle-opt active">Individual</button>
                                            <button type="button" id="mode-contribution"
                                                class="toggle-opt">Contribution</button>
                                            <input type="hidden" id="entry_mode" value="individual">
                                        </div>
                                    </div>
                                    <div id="individual-fields">
                                        <div class="field">
                                            <label>Contributor</label>
                                            <select id="personnel" class="input">
                                                <option value="">Select operator...</option>
                                                <?php
                                                $stmt = $pdo->query("SELECT rank, username FROM tbl_team ORDER BY username ASC");
                                                while ($row = $stmt->fetch()) {
                                                    $v = htmlspecialchars($row['rank'] . ' ' . $row['username']);
                                                    $d = htmlspecialchars(strtoupper($row['rank'] . '-' . $row['username']));
                                                    echo "<option value='$v'>$d</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="contribution-fields" class="hidden">
                                        <div class="field">
                                            <label>Mission / Objective</label>
                                            <input type="text" id="other_topic" class="input"
                                                placeholder="Describe the mission objective">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label>Designation</label>
                                        <input type="text" id="title" class="input" placeholder="Entry title or description"
                                            required>
                                    </div>
                                    <div class="form-grid-2">
                                        <div class="field">
                                            <label>Category</label>
                                            <select id="topic" class="input">
                                                <option value="Misc">Miscellaneous</option>
                                                <option value="Others">Others</option>
                                                <option value="Promotion">Promotion</option>
                                                <option value="Mission">Mission</option>
                                                <option value="Logistics">Logistics</option>
                                                <option value="Equipment">Equipment</option>
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label>Type</label>
                                            <select id="type" class="input">
                                                <option value="income">Income (Supply)</option>
                                                <option value="expense">Expense (Burn)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label>Amount</label>
                                        <input type="number" id="amount" class="input" placeholder="0.00" step="0.01"
                                            required>
                                    </div>
                                    <button type="submit" id="submit-btn" class="btn btn-primary"
                                        style="justify-content:center;padding:11px;">
                                        <i class="fas fa-paper-plane"></i> Submit Entry
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- RIGHT COL -->
                        <div style="display:flex;flex-direction:column;gap:14px;">

                            <!-- CHART -->
                            <div class="card">
                                <div class="card-head">
                                    <div class="card-title">Breakdown</div>
                                </div>
                                <div style="padding:16px;display:flex;justify-content:center;">
                                    <canvas id="financeChart" style="max-width:170px;max-height:170px;"></canvas>
                                </div>
                            </div>

                            <!-- PASS CHANGE -->
                            <div class="card" id="passchange">
                                <div class="card-head">
                                    <div class="card-title">Change Password</div>
                                </div>
                                <div class="card-body">
                                    <form id="password-form" class="form-stack">
                                        <div class="field">
                                            <label>Current Password</label>
                                            <input type="password" id="curr_pass" class="input" placeholder="••••••••"
                                                required>
                                        </div>
                                        <div class="field">
                                            <label>New Password</label>
                                            <input type="password" id="new_pass" class="input" placeholder="••••••••"
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-secondary"
                                            style="justify-content:center;">Update Password</button>
                                        <p id="pass-msg" style="font-size:11px;text-align:center;min-height:14px;"></p>
                                    </form>
                                </div>
                            </div>

                            <!-- QR -->
                            <div class="card" id="qr-section" style="position:relative;">
                                <div class="card-head">
                                    <div class="card-title">QR Asset · Alpha-9</div>
                                    <span class="badge badge-gray" style="font-size:10px;">Secure</span>
                                </div>
                                <div class="qr-wrapper">
                                    <div class="qr-lock" id="qr-lock-overlay">
                                        <i class="fas fa-lock" style="font-size:26px;color:var(--text-3);"></i>
                                        <div
                                            style="font-size:11px;color:var(--text-3);letter-spacing:0.05em;text-transform:uppercase;">
                                            Protected</div>
                                        <button onclick="openSecurityModal('VIEW_QR')" class="btn btn-ghost btn-sm"><i
                                                class="fas fa-unlock"></i> Decrypt</button>
                                    </div>
                                    <div id="qr-content" class="blur-cover"
                                        style="display:flex;flex-direction:column;align-items:center;gap:10px;width:100%;">
                                        <div class="qr-frame" onclick="$('#qr-upload-input').click()">
                                            <img id="qr-display-image" src="uploads/secure_qr.jpeg"
                                                style="width:155px;height:155px;object-fit:contain;">
                                            <div class="qr-hover"><i class="fas fa-upload"
                                                    style="font-size:16px;"></i><span>Replace</span></div>
                                        </div>
                                        <div style="display:flex;gap:8px;">
                                            <button onclick="hideQR()" class="btn btn-ghost btn-xs"><i
                                                    class="fas fa-lock"></i> Lock</button>
                                            <button onclick="$('#qr-upload-input').click()" class="btn btn-ghost btn-xs"><i
                                                    class="fas fa-upload"></i> Update</button>
                                        </div>
                                        <div style="font-size:10px;color:var(--text-3);">REF: 00-QR-X9 · MD5: Verified</div>
                                    </div>
                                </div>
                                <input type="file" id="qr-upload-input" class="hidden" accept="image/*">
                            </div>

                        </div>
                    </div>


                    <!-- SYSTEM LOG -->
                    <div class="card">
                        <div class="card-head">
                            <div class="card-title">System Log</div>
                            <span class="badge badge-green" style="font-size:10px;"><span class="dot dot-green"
                                    style="width:6px;height:6px;margin-right:3px;"></span> Live</span>
                        </div>
                        <div id="system-feed" class="sys-feed"></div>
                    </div>

                </div>
            </div>
        </div>

        <!-- SECURITY MODAL -->
        <div class="modal-overlay" id="security-modal">
            <div class="modal-box">
                <div class="modal-title">Authorization Required</div>
                <div class="modal-sub">Enter master access code to continue</div>
                <div class="field" style="margin-bottom:14px;">
                    <input type="password" id="access-code" class="input" placeholder="Access code"
                        style="text-align:center;letter-spacing:0.2em;font-size:18px;">
                </div>
                <div style="display:flex;gap:8px;">
                    <button onclick="closeSecurityModal()" class="btn btn-ghost"
                        style="flex:1;justify-content:center;">Cancel</button>
                    <button onclick="verifyAndExecute()" class="btn btn-primary"
                        style="flex:1;justify-content:center;">Authorize</button>
                </div>
            </div>
        </div>

        <script>
            let myChart, pendingAction = null, pendingFile = null, allData = [];
            const MASTER_CODE = "1234";

            function updateClock() { const n = new Date(); document.getElementById('live-clock').textContent = n.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }) + '  ' + n.toTimeString().slice(0, 8); }
            updateClock(); setInterval(updateClock, 1000);

            function fmt(n) { return 'Rs. ' + parseFloat(n).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 }); }

            function sysLog(msg, cls) {
                const n = new Date(), ts = n.toTimeString().slice(0, 8), el = document.createElement('div');
                el.className = cls || ''; el.textContent = `[${ts}] ${msg}`;
                const f = document.getElementById('system-feed'); f.appendChild(el); f.scrollTop = f.scrollHeight;
            }

            function scrollTo2(id) { const el = document.getElementById(id); if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' }); }

            function switchTab(tab, btn) {
                document.querySelectorAll('.tab').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
                btn.classList.add('active');
                document.getElementById('tab-' + tab).classList.add('active');
            }

            function buildRow(item, mode) {
                const isInc = item.type === 'income';
                const d = JSON.stringify(item).replace(/"/g, '&quot;');
                const ds = item.created_at ? item.created_at.split(' ')[0] : '—';
                const amt = parseFloat(item.amount).toLocaleString('en-IN', { minimumFractionDigits: 2 });
                const ac = isInc ? 'amount-pos' : 'amount-neg', sign = isInc ? '+' : '−';
                const pc = `<td><div class="person-name">${item.personnel}</div><div class="person-desc">${item.title}</div></td>`;
                const cc = `<td class="muted">${item.topic}</td>`;
                const av = `<td class="text-right"><span class="${ac}">${sign} ${amt}</span></td>`;
                const dc = `<td class="muted">${ds}</td>`;
                const ac2 = `<td class="text-center" style="white-space:nowrap;"><button onclick="startEdit(${d})" class="btn btn-ghost btn-xs" style="margin-right:4px;"><i class="fas fa-pencil-alt"></i></button><button onclick="openSecurityModal('DELETE',${item.id})" class="btn btn-danger-soft btn-xs"><i class="fas fa-trash"></i></button></td>`;
                const tc = `<td><span class="badge ${isInc ? 'badge-green' : 'badge-red'}">${isInc ? 'Income' : 'Expense'}</span></td>`;
                if (mode === 'income' || mode === 'expense') return `<tr>${pc}${cc}${av}${dc}${ac2}</tr>`;
                return `<tr>${pc}${cc}${tc}${av}${dc}${ac2}</tr>`;
            }

            function applyFilters() {
                const q = $('#recon-search').val().toLowerCase();
                const from = $('#filter-date-from').val(), to = $('#filter-date-to').val();
                const filtered = allData.filter(item => {
                    if (q && !(item.personnel + ' ' + item.title).toLowerCase().includes(q)) return false;
                    const ds = item.created_at ? item.created_at.split(' ')[0] : '';
                    if (from && ds < from) return false;
                    if (to && ds > to) return false;
                    return true;
                });
                const inc = filtered.filter(i => i.type === 'income');
                const exp = filtered.filter(i => i.type === 'expense');
                const tI = inc.reduce((s, i) => s + parseFloat(i.amount), 0);
                const tE = exp.reduce((s, i) => s + parseFloat(i.amount), 0);
                const bal = tI - tE;
                const empty = `<tr class="empty-row"><td colspan="6" style="color:var(--text-3);padding:40px;text-align:center;">No entries found.</td></tr>`;
                $('#list-all').html(filtered.length ? filtered.map(i => buildRow(i, 'all')).join('') : empty);
                $('#list-income').html(inc.length ? inc.map(i => buildRow(i, 'income')).join('') : empty);
                $('#list-expense').html(exp.length ? exp.map(i => buildRow(i, 'expense')).join('') : empty);
                $('#cnt-all').text(filtered.length); $('#cnt-income').text(inc.length); $('#cnt-expense').text(exp.length);
                $('#stat-income').text(fmt(tI)); $('#stat-ic').text(inc.length + ' entries');
                $('#stat-expense').text(fmt(tE)); $('#stat-ec').text(exp.length + ' entries');
                $('#stat-balance').text(fmt(bal)).css('color', bal >= 0 ? 'var(--blue)' : 'var(--rose)');
                $('#foot-income').text(fmt(tI)); $('#foot-expense').text(fmt(tE));
                $('#foot-balance').text(fmt(bal)).css('color', bal >= 0 ? 'var(--emerald)' : 'var(--rose)');
                $('#inc-total').text(fmt(tI)); $('#inc-count').text(inc.length);
                $('#exp-total').text(fmt(tE)); $('#exp-count').text(exp.length);
                renderChart(tI, tE);
            }

            function clearDateFilter() { $('#filter-date-from').val(''); $('#filter-date-to').val(''); applyFilters(); }

            function updateDashboard() {
                $.get('api.php', function (data) {
                    allData = data.list || []; applyFilters();
                    sysLog('Data refreshed — ' + allData.length + ' entries.', 'f-green');
                }, 'json');
            }

            $('#recon-search').on('keyup', applyFilters);
            $('#filter-date-from,#filter-date-to').on('change', applyFilters);

            $('.toggle-opt').click(function () {
                $('.toggle-opt').removeClass('active'); $(this).addClass('active');
                const mode = $(this).attr('id') === 'mode-individual' ? 'individual' : 'contribution';
                $('#entry_mode').val(mode);
                if (mode === 'individual') { $('#individual-fields').show(); $('#contribution-fields').hide(); }
                else { $('#individual-fields').hide(); $('#contribution-fields').show(); }
            });

            $('#finance-form').submit(function (e) {
                e.preventDefault();
                let mode = $('#entry_mode').val(), personnel = $('#personnel').val(), other = $('#other_topic').val();
                if (mode === 'individual' && !personnel) { alert('Please select a contributor.'); return; }
                if (mode === 'contribution' && !other) { alert('Please enter a mission objective.'); return; }
                if (mode === 'contribution') personnel = '[CONTRIBUTION] ' + other;
                openSecurityModal('ADD', { update_id: $('#update_id').val(), entry_mode: mode, personnel, title: $('#title').val(), topic: $('#topic').val(), amount: $('#amount').val(), type: $('#type').val() });
            });

            $('#qr-upload-input').change(function (e) { if (e.target.files && e.target.files[0]) { pendingFile = e.target.files[0]; openSecurityModal('UPLOAD_QR', null); } });

            function openSecurityModal(type, data) { pendingAction = { type, data }; $('#security-modal').addClass('open'); setTimeout(() => $('#access-code').focus(), 100); $('#access-code').val(''); }
            function closeSecurityModal() { $('#security-modal').removeClass('open'); }

            function verifyAndExecute() {
                if ($('#access-code').val() !== MASTER_CODE) { $('#access-code').val('').focus(); alert('Access denied: incorrect code.'); return; }
                if (pendingAction.type === 'VIEW_QR') { $('#qr-lock-overlay').fadeOut(300); $('#qr-content').removeClass('blur-cover'); }
                else if (pendingAction.type === 'UPLOAD_QR') {
                    const fd = new FormData(); fd.append('qr_image', pendingFile); fd.append('action', 'upload_qr');
                    $.ajax({
                        url: 'api.php', type: 'POST', data: fd, processData: false, contentType: false, dataType: 'json', success(res) {
                            if (res.status === 'success') { $('#qr-display-image').attr('src', res.path + '?t=' + Date.now()); $('#qr-lock-overlay').hide(); $('#qr-content').removeClass('blur-cover'); sysLog('QR asset updated.', 'f-green'); }
                        }
                    });
                }
                else if (pendingAction.type === 'ADD') {
                    const d = { ...pendingAction.data }; d.action = d.update_id ? 'update' : 'add';
                    $.post('api.php', d, function () { updateDashboard(); resetForm(); sysLog((d.action === 'update' ? 'Updated' : 'Added') + ': ' + d.title, 'f-green'); }, 'json');
                }
                else if (pendingAction.type === 'DELETE') {
                    $.post('api.php', { action: 'delete', id: pendingAction.data }, function () { updateDashboard(); sysLog('Deleted entry ID ' + pendingAction.data + '.', 'f-red'); }, 'json');
                }
                closeSecurityModal();
            }

            function startEdit(item) {
                $('#form-title').text('Edit Transaction'); $('#update_id').val(item.id);
                $('#title').val(item.title); $('#topic').val(item.topic); $('#amount').val(item.amount); $('#type').val(item.type);
                if (item.personnel.startsWith('[CONTRIBUTION]')) { $('#mode-contribution').click(); $('#other_topic').val(item.personnel.replace('[CONTRIBUTION] ', '')); }
                else { $('#mode-individual').click(); $('#personnel').val(item.personnel); }
                $('#submit-btn').html('<i class="fas fa-check"></i> Update Entry'); $('#cancel-edit').removeClass('hidden'); scrollTo2('add-entry');
            }

            function resetForm() {
                $('#finance-form')[0].reset(); $('#update_id').val(''); $('#form-title').text('New Transaction');
                $('#submit-btn').html('<i class="fas fa-paper-plane"></i> Submit Entry'); $('#cancel-edit').addClass('hidden');
                $('#individual-fields').show(); $('#contribution-fields').hide();
                $('#mode-individual').addClass('active'); $('#mode-contribution').removeClass('active');
            }

            function hideQR() { $('#qr-lock-overlay').fadeIn(300); $('#qr-content').addClass('blur-cover'); }

            function renderChart(inc, exp) {
                const ctx = document.getElementById('financeChart').getContext('2d');
                if (myChart) myChart.destroy();
                myChart = new Chart(ctx, { type: 'doughnut', data: { labels: ['Income', 'Expense'], datasets: [{ data: [inc || 0.01, exp || 0.01], backgroundColor: ['rgba(16,185,129,0.75)', 'rgba(244,63,94,0.75)'], borderColor: ['#10b981', '#f43f5e'], borderWidth: 2, hoverOffset: 4 }] }, options: { responsive: true, cutout: '68%', plugins: { legend: { position: 'bottom', labels: { color: '#8b949e', font: { family: 'DM Sans', size: 11 }, padding: 12, usePointStyle: true, pointStyleWidth: 8 } } } } });
            }

            function sortTable(id, col) {
                const tbody = document.getElementById('list-' + id);
                const rows = Array.from(tbody.querySelectorAll('tr'));
                const asc = tbody.dataset.sortCol == col && tbody.dataset.sortDir !== 'asc';
                tbody.dataset.sortCol = col; tbody.dataset.sortDir = asc ? 'asc' : 'desc';
                rows.sort((a, b) => { const x = (a.querySelectorAll('td')[col] || {}).innerText || '', y = (b.querySelectorAll('td')[col] || {}).innerText || ''; return asc ? x.localeCompare(y, undefined, { numeric: true }) : y.localeCompare(x, undefined, { numeric: true }); });
                rows.forEach(r => tbody.appendChild(r));
            }

            $('#password-form').submit(function (e) {
                e.preventDefault();
                $.post('auth.php', { action: 'change_pass', curr_pass: $('#curr_pass').val(), new_pass: $('#new_pass').val() }, function (res) {
                    const r = JSON.parse(res); $('#pass-msg').text(r.message).css('color', r.status === 'success' ? 'var(--emerald)' : 'var(--rose)');
                    if (r.status === 'success') { $('#password-form')[0].reset(); sysLog('Password updated.', 'f-green'); }
                });
            });

            $('#access-code').keydown(e => { if (e.key === 'Enter') verifyAndExecute(); });

            $(document).ready(function () {
                sysLog('System initialized.', 'f-blue');
                sysLog('Encryption layer active.', 'f-green');
                updateDashboard();
                setInterval(updateDashboard, 30000);
            });
        </script>
    <?php endif; ?>
</body>

</html>