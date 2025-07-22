 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Log Kunjungan</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <style>
         body {
             font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
             margin: 0;
             padding: 0;
             background-color: #e9ecef;
             color: #333;
         }

         .header {
             background-color: #007bff;
             color: white;
             padding: 15px 30px;
             display: flex;
             justify-content: space-between;
             align-items: center;
             box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
         }

         .header h1 {
             margin: 0;
             font-size: 1.8em;
         }

         .header .home-btn,
         .header .logout-btn {
             background-color: #f8f9fa;
             color: #007bff;
             padding: 8px 15px;
             border: none;
             border-radius: 5px;
             text-decoration: none;
             font-weight: bold;
             transition: background-color 0.2s ease, color 0.2s ease;
             margin-left: 10px;
         }

         .header .logout-btn {
             background-color: #dc3545;
             color: white;
         }

         .header .home-btn:hover {
             background-color: #e2e6ea;
             color: #0056b3;
         }

         .header .logout-btn:hover {
             background-color: #c82333;
         }

         .container {
             max-width: 960px;
             margin: 30px auto;
             padding: 20px;
             background-color: #ffffff;
             border-radius: 8px;
             box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
         }

         h2 {
             color: #007bff;
             border-bottom: 2px solid #007bff;
             padding-bottom: 10px;
             margin-bottom: 25px;
             text-align: center;
         }

         .message-box {
             padding: 15px;
             margin-bottom: 20px;
             border-radius: 5px;
             font-weight: bold;
         }

         .message-box.success {
             background-color: #d4edda;
             color: #155724;
             border: 1px solid #c3e6cb;
         }

         .message-box.error {
             background-color: #f8d7da;
             color: #721c24;
             border: 1px solid #f5c6cb;
         }

         .current-status {
             text-align: center;
             margin-bottom: 30px;
             padding: 15px;
             border: 1px solid #007bff;
             border-radius: 8px;
             background-color: #e7f3ff;
             color: #0056b3;
         }

         .current-status p {
             margin: 0;
             font-size: 1.1em;
         }

         table {
             width: 100%;
             border-collapse: collapse;
             margin-top: 20px;
         }

         th,
         td {
             border: 1px solid #dee2e6;
             padding: 12px;
             text-align: left;
         }

         th {
             background-color: #f8f9fa;
             font-weight: 600;
             color: #555;
         }

         tr:nth-child(even) {
             background-color: #f2f2f2;
         }

         tr:hover {
             background-color: #e9ecef;
         }

         .no-records {
             text-align: center;
             padding: 20px;
             color: #6c757d;
         }

         /* Responsif */
         @media (max-width: 768px) {
             .header {
                 flex-direction: column;
                 padding: 15px;
             }

             .header h1 {
                 margin-bottom: 10px;
                 font-size: 1.5em;
             }

             .container {
                 margin: 15px;
                 padding: 15px;
             }

             .action-buttons {
                 flex-direction: column;
                 gap: 10px;
             }

             table,
             thead,
             tbody,
             th,
             td,
             tr {
                 display: block;
             }

             thead tr {
                 position: absolute;
                 top: -9999px;
                 left: -9999px;
             }

             tr {
                 border: 1px solid #ccc;
                 margin-bottom: 10px;
                 border-radius: 8px;
             }

             td {
                 border: none;
                 border-bottom: 1px solid #eee;
                 position: relative;
                 padding-left: 50%;
                 text-align: right;
             }

             td:before {
                 position: absolute;
                 top: 6px;
                 left: 6px;
                 width: 45%;
                 padding-right: 10px;
                 white-space: nowrap;
                 text-align: left;
                 font-weight: bold;
             }

             td:nth-of-type(1):before {
                 content: "ID Kunjungan";
             }

             td:nth-of-type(2):before {
                 content: "Tanggal";
             }

             td:nth-of-type(3):before {
                 content: "Waktu Masuk";
             }

             td:nth-of-type(4):before {
                 content: "Waktu Keluar";
             }
         }

         .action-buttons {
             display: flex;
             justify-content: center;
             gap: 20px;
             margin-bottom: 30px;
             padding-bottom: 20px;
             border-bottom: 1px solid #eee;
             flex-wrap: wrap;
             /* Allow wrapping on smaller screens */
         }

         .action-buttons .form-group-time {
             display: flex;
             flex-direction: column;
             align-items: center;
             gap: 10px;
             /* Space between input and button */
         }

         .action-buttons .form-group-time label {
             font-weight: bold;
             color: #555;
             margin-bottom: 5px;
         }

         .action-buttons .form-group-time input[type="text"] {
             padding: 10px 15px;
             border: 1px solid #ced4da;
             border-radius: 6px;
             font-size: 1em;
             width: 150px;
             /* Lebar input time */
             text-align: center;
         }

         .action-buttons button {
             padding: 12px 25px;
             font-size: 1.1em;
             font-weight: bold;
             border: none;
             border-radius: 6px;
             cursor: pointer;
             transition: background-color 0.2s ease, transform 0.1s ease;
         }

         .action-buttons button.check-in {
             background-color: #28a745;
             color: white;
         }

         .action-buttons button.check-in:hover {
             background-color: #218838;
             transform: translateY(-2px);
         }

         .action-buttons button.check-out {
             background-color: #ffc107;
             color: #333;
         }

         .action-buttons button.check-out:hover {
             background-color: #e0a800;
             transform: translateY(-2px);
         }

         .action-buttons button:disabled {
             background-color: #cccccc;
             cursor: not-allowed;
             opacity: 0.7;
         }

         .current-status {
             /* Existing CSS */
             text-align: center;
             margin-bottom: 30px;
             padding: 15px;
             border: 1px solid #007bff;
             border-radius: 8px;
             background-color: #e7f3ff;
             color: #0056b3;
         }

         .current-status p {
             /* Existing CSS */
             margin: 0;
             font-size: 1.1em;
         }
     </style>
 </head>

 <body>
     <div class="header">
         <h1><i class="fas fa-clock"></i> Log Kunjungan Anda</h1>
         <div>
             <a href="<?= base_url('') ?>" class="home-btn"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
             <a href="<?= base_url('logout') ?>" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
         </div>
     </div>

     <div class="container">
         <h2>Selamat Datang, <?= esc($userName ?? 'Pengguna') ?>!</h2>

         <?php if (session()->getFlashdata('success')): ?>
             <div class="message-box success"><?= session()->getFlashdata('success') ?></div>
         <?php endif; ?>
         <?php if (session()->getFlashdata('error')): ?>
             <div class="message-box error"><?= session()->getFlashdata('error') ?></div>
         <?php endif; ?>
         <?php if (isset($validation)): ?>
             <div class="message-box error">
                 <?= $validation->listErrors() ?>
             </div>
         <?php endif; ?>

         <div class="current-status">
             <?php if ($todayVisit): ?>
                 <p>Status Kunjungan Hari Ini (<?= date('d-m-Y') ?>):</p>
                 <p>Check-in: <strong><?= esc($todayVisit['time_in'] ?? '-') ?></strong></p>
                 <?php if ($todayVisit['time_out']): ?>
                     <p>Check-out: <strong><?= esc($todayVisit['time_out']) ?></strong></p>
                     <p>Durasi: <strong><?= esc($todayVisit['duration'] ?? '00:00:00') ?></strong></p>
                 <?php else: ?>
                     <p>Check-out: <strong style="color: orange;">Belum Checkout</strong></p>
                 <?php endif; ?>
             <?php else: ?>
                 <p>Belum ada catatan kunjungan untuk hari ini (<?= date('d-m-Y') ?>).</p>
             <?php endif; ?>
         </div>

         <div class="action-buttons">
             <form action="<?= base_url('visits/checkin') ?>" method="post" class="form-group-time">
                 <label for="time_in_picker">Waktu Check-in:</label>
                 <input type="text" id="time_in_picker" name="time_in" value="<?= old('time_in', date('H:i:s')) ?>" placeholder="HH:MM" required>
                 <button type="submit" class="check-in" <?= $todayVisit && $todayVisit['time_in'] ? 'disabled' : '' ?>>
                     <i class="fas fa-sign-in-alt"></i> Check-in
                 </button>
             </form>

             <form action="<?= base_url('visits/checkout') ?>" method="post" class="form-group-time">
                 <label for="time_out_picker">Waktu Check-out:</label>
                 <input type="text" id="time_out_picker" name="time_out" value="<?= old('time_out', date('H:i:s')) ?>" placeholder="HH:MM" required>
                 <button type="submit" class="check-out" <?= !$todayVisit || $todayVisit['time_out'] ? 'disabled' : '' ?>>
                     <i class="fas fa-sign-out-alt"></i> Check-out
                 </button>
             </form>
         </div>

         <h3>Riwayat Kunjungan</h3>
         <?php if (!empty($userVisits)): ?>
             <table>
                 <thead>
                     <tr>
                         <th>No. </th>
                         <th>Tanggal</th>
                         <th>Waktu Masuk</th>
                         <th>Waktu Keluar</th>
                         <th>Durasi</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php
                        $i = 0;
                        foreach ($userVisits as $visit): ?>
                         <tr>
                             <td><?= ++$i ?></td>
                             <td><?= esc(date('d M Y', strtotime($visit['visit_date']))) ?></td>
                             <td><?= esc($visit['time_in'] ?? '-') ?></td>
                             <td><?= esc($visit['time_out'] ?? 'Belum Checkout') ?></td>
                             <td><?= esc($visit['duration'] ?? '-') ?></td>
                         </tr>
                     <?php endforeach; ?>
                 </tbody>
             </table>
         <?php else: ?>
             <p class="no-records">Belum ada riwayat kunjungan.</p>
         <?php endif; ?>
     </div>

     <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
     <script>
         document.addEventListener('DOMContentLoaded', function() {
             // Initialize Flatpickr for time_in
             flatpickr("#time_in_picker", {
                 enableTime: true,
                 noCalendar: true,
                 dateFormat: "H:i:s", // Format jam dan menit
                 time_24hr: true, // Format 24 jam
                 defaultHour: new Date().getHours(),
                 defaultMinute: new Date().getMinutes(),
                 defaultSecond: new Date().getSeconds()
             });

             // Initialize Flatpickr for time_out
             flatpickr("#time_out_picker", {
                 enableTime: true,
                 noCalendar: true,
                 dateFormat: "H:i:s", // Format jam dan menit
                 time_24hr: true, // Format 24 jam
                 defaultHour: new Date().getHours(),
                 defaultMinute: new Date().getMinutes(),
                 defaultSecond: new Date().getSeconds()
             });
         });
     </script>
 </body>

 </html>