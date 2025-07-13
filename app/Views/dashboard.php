<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Aplikasi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Body Styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f6; /* Light gray background */
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header Styling */
        .header {
            background-color: #2c3e50; /* Dark blue/gray */
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .header h1 {
            margin: 0;
            font-size: 1.8em;
            display: flex;
            align-items: center;
        }
        .header h1 i {
            margin-right: 10px;
            color: #1abc9c; /* Teal accent */
        }
        .header-nav a {
            background-color: #1abc9c; /* Teal */
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-left: 10px;
            display: inline-flex;
            align-items: center;
        }
        .header-nav a:hover {
            background-color: #16a085; /* Darker teal */
            transform: translateY(-2px);
        }
        .header-nav a i {
            margin-right: 8px;
        }
        .header-nav .logout-btn {
            background-color: #e74c3c; /* Red */
        }
        .header-nav .logout-btn:hover {
            background-color: #c0392b; /* Darker red */
        }

        /* Main Content Container */
        .container {
            flex-grow: 1;
            padding: 30px;
            max-width: 1200px; /* Wider container */
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        /* Welcome Message */
        .welcome-message {
            text-align: center;
            margin-bottom: 40px;
            padding: 20px;
            background-color: #ecf0f1; /* Light gray */
            border-radius: 8px;
            border-left: 5px solid #3498db; /* Blue accent */
        }
        .welcome-message h2 {
            margin-top: 0;
            color: #34495e; /* Darker text */
            font-size: 2em;
        }
        .welcome-message p {
            font-size: 1.1em;
            color: #555;
        }

        /* Card Layout */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* Responsive grid */
            gap: 25px;
            margin-bottom: 30px;
        }
        .info-card, .summary-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            padding: 25px;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Space out content vertically */
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .info-card:hover, .summary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .info-card h3, .summary-card h3 {
            margin-top: 0;
            margin-bottom: 15px;
            color: #2c3e50; /* Dark blue/gray */
            font-size: 1.4em;
            border-bottom: 2px solid #bdc3c7; /* Light border */
            padding-bottom: 10px;
            display: flex;
            align-items: center;
        }
        .info-card h3 i, .summary-card h3 i {
            margin-right: 10px;
            color: #3498db; /* Blue */
        }
        .summary-card h3 i {
            color: #f39c12; /* Orange */
        }
        .info-card p, .summary-card p {
            margin: 8px 0;
            line-height: 1.6;
            color: #555;
        }

        /* Specific Summary Card Styling */
        .summary-card {
            background-color: #ecf0f1; /* Lighter background for summaries */
        }
        .summary-card .duration-value {
            font-size: 2.2em;
            font-weight: 700;
            color: #27ae60; /* Green */
            display: block; /* Ensure it takes full width */
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .summary-card .status-message {
            font-size: 1.1em;
            font-weight: 500;
            color: #f39c12; /* Orange for 'belum checkout' */
        }
        .summary-card .duration-details {
            font-size: 0.9em;
            color: #7f8c8d; /* Gray for details */
            margin-top: 10px;
        }

        /* Features List */
        .info-card ul {
            list-style: none;
            padding: 0;
            margin-top: 15px;
        }
        .info-card ul li {
            margin-bottom: 10px;
        }
        .info-card ul li a {
            color: #3498db;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }
        .info-card ul li a:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        /* Footer Styling */
        .footer {
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            background-color: #34495e; /* Darker gray */
            color: #ecf0f1; /* Light text */
            font-size: 0.9em;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                padding: 15px;
            }
            .header h1 {
                margin-bottom: 15px;
                font-size: 1.6em;
            }
            .header-nav {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
            .header-nav a {
                width: 100%;
                text-align: center;
                justify-content: center;
            }
            .container {
                margin: 15px;
                padding: 20px;
            }
            .card-grid {
                grid-template-columns: 1fr; /* Stack cards on small screens */
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1><i class="fas fa-tachometer-alt"></i> Dashboard Aplikasi</h1>
        <div class="header-nav">
            <a href="<?= base_url('visits') ?>" class="visits-btn"><i class="fas fa-clock"></i> Log Kunjungan</a>
            <a href="<?= base_url('logout') ?>" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <div class="container">
        <div class="welcome-message">
            <h2>Selamat Datang, <strong><?= esc(session()->name ?? 'Pengguna') ?></strong>!</h2>
            <!-- <p>Ini adalah ringkasan aktivitas dan informasi penting Anda.</p> -->
        </div>

        <div class="card-grid">
            <div class="info-card">
                <h3><i class="fas fa-user-circle"></i> Informasi Akun</h3>
                <p><strong>Username:</strong> <?= esc($userUsername ?? '-') ?></p>
                <p><strong>Nama Lengkap:</strong> <?= esc(session()->get('name') ?? '-') ?></p>
            </div>

            <div class="summary-card">
                <h3><i class="fas fa-hourglass-half"></i> Durasi Kunjungan Hari Ini</h3>
                <p class="duration-details">Tanggal: <?= date('d-m-Y') ?></p>
                <?php if ($todayVisit && $todayVisit['time_in']): ?>
                    <?php if ($todayVisit['time_out']): ?>
                        <p class="duration-details">Dari: <?= esc($todayVisit['time_in']) ?> sampai: <?= esc($todayVisit['time_out']) ?></p>
                        <p>Total Durasi: <span class="duration-value"><?= esc($todayVisit['duration'] ?? '00:00:00') ?></span></p>
                    <?php else: ?>
                        <p class="duration-details">Anda sudah Check-in pada: **<?= esc($todayVisit['time_in']) ?>**</p>
                        <p class="status-message">Belum Check-out</p>
                        <p style="font-size: 0.9em; color: #7f8c8d;">Durasi aktif saat ini tidak dihitung sampai check-out.</p>
                    <?php endif; ?>
                <?php else: ?>
                    <p>Belum ada catatan kunjungan untuk hari ini.</p>
                <?php endif; ?>
            </div>

            <div class="summary-card">
                <h3><i class="fas fa-chart-line"></i> Total Durasi Kunjungan</h3>
                <p class="duration-details">Akumulasi dari semua riwayat check-out.</p>
                <p>Total Waktu: <span class="duration-value"><?= esc($formattedTotalOverallDuration) ?></span></p>
                <!-- <p style="font-size: 0.9em; color: #7f8c8d;">Ini mencakup semua kunjungan Anda yang telah selesai.</p> -->
            </div>

            <div class="info-card">
                <h3><i class="fas fa-th-large"></i> Fitur Aplikasi</h3>
                <ul>
                    <li><a href="#"><i class="fas fa-database"></i> Manajemen Data</a></li>
                    <li><a href="#"><i class="fas fa-user-cog"></i> Pengaturan Profil</a></li>
                    <li><a href="#"><i class="fas fa-chart-bar"></i> Laporan & Analitik</a></li>
                    <li><a href="#"><i class="fas fa-envelope"></i> Pesan</a></li>
                    <li><a href="#"><i class="fas fa-cogs"></i> Pengaturan Umum</a></li>
                </ul>
            </div>
        </div>
        </div>

    <div class="footer">
        <p>&copy; <?= date('Y') ?> Aplikasi Mervin Howard. Dibuat dengan CodeIgniter 4. Semua Hak Cipta Dilindungi.</p>
    </div>
</body>
</html>