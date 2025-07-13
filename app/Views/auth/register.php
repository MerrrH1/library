<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        .register-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }

        .success-message {
            color: green;
            font-size: 0.9em;
            margin-top: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745; /* Green color for register button */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #218838;
        }

        .link-text {
            text-align: center;
            margin-top: 15px;
            font-size: 0.9em;
        }

        .link-text a {
            color: #007bff;
            text-decoration: none;
        }

        .link-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h2>Daftar Akun Baru</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="success-message"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="error-message"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if (isset($validation)): ?>
            <div class="error-message">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/register') ?>" method="post">
            <div class="form-group">
                <label for="name">Nama Lengkap:</label>
                <input type="text" name="name" id="name" value="<?= old('name') ?>" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="<?= old('username') ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>
            <button type="submit">Daftar</button>
        </form>
        <div class="link-text">
            Sudah punya akun? <a href="<?= base_url('login') ?>">Login di sini</a>
        </div>
    </div>
</body>

</html>