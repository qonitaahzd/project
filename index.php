<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Pembayaran</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f5efe6;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .card {
      background: #fff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      width: 350px;
    }

    h2 {
      text-align: center;
      color: #6b4f3b;
      margin-bottom: 20px;
    }

    label {
      font-size: 14px;
      color: #5a4634;
      display: block;
      margin-bottom: 6px;
    }

    input, select {
      width: 100%;
      padding: 10px;
      border-radius: 10px;
      border: 1px solid #d6c3b3;
      margin-bottom: 15px;
      outline: none;
      transition: 0.2s;
    }

    input:focus, select:focus {
      border-color: #a67c52;
      box-shadow: 0 0 5px rgba(166,124,82,0.4);
    }

    button {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 12px;
      background: #a67c52;
      color: white;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background: #8c6239;
    }

    .result {
      margin-top: 20px;
      padding: 15px;
      background: #f0e6dc;
      border-radius: 10px;
      display: none;
    }
  </style>
</head>
<body>

<div class="card">
  <h2>Pembayaran</h2>

  <form method="POST">
    <label>Pilih Metode</label>
    <select name="metode" required>
      <option value="">-- Pilih --</option>
      <option value="transfer">Transfer Bank</option>
      <option value="ewallet">E-Wallet</option>
      <option value="qris">QRIS</option>
    </select>

    <label>Jumlah (Rp)</label>
    <input type="number" name="jumlah" required>

    <button type="submit">Bayar Sekarang</button>
  </form>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'TransferBank.php';
    require_once 'Ewallet.php';
    require_once 'Qris.php';

    $jumlah = $_POST['jumlah'];
    $metode = $_POST['metode'];

    if ($metode == 'transfer') {
      $obj = new TransferBank($jumlah);
    } elseif ($metode == 'ewallet') {
      $obj = new Ewallet($jumlah);
    } else {
      $obj = new QRIS($jumlah);
    }

    echo "<div class='result' style='display:block;'>";
    echo $obj->prosesPembayaran();
    echo "<br>";
    echo $obj->cetakStruk();
    echo "</div>";
  }
  ?>
</div>

</body>
</html>