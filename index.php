<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pembayaran Interaktif</title>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<style>
body {
  font-family: 'Segoe UI', sans-serif;
  background: linear-gradient(to right, #f5efe6, #e8d8c3);
}

.container {
  max-width: 420px;
  margin: 40px auto;
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 15px 30px rgba(0,0,0,0.15);
  padding: 25px;
  animation: fadeIn 0.8s ease-in-out;
}

@keyframes fadeIn {
  from {opacity:0; transform: translateY(20px);}
  to {opacity:1; transform: translateY(0);}
}

h2 { text-align:center; color:#6b4f3b; }

label {
  font-weight:600;
  margin-top:10px;
  display:block;
}

input, select {
  width:100%;
  padding:10px;
  margin-top:5px;
  border-radius:8px;
  border:1px solid #ddd;
}

.btn {
  width:100%;
  padding:12px;
  background:#8b5e3c;
  color:white;
  border:none;
  border-radius:10px;
  cursor:pointer;
  margin-top:15px;
  transition:0.3s;
}

.btn:hover {
  background:#6b4f3b;
  transform:scale(1.03);
}

.result {
  margin-top:20px;
  padding:15px;
  background:#f0e6dc;
  border-radius:10px;
}
</style>
</head>

<body>

<div class="container">
<h2>Form Pembayaran</h2>

<form onsubmit="return hitungTotal(event)">

<label>Nama</label>
<input type="text" id="nama" required>

<label>Nominal Pembayaran (Rp)</label>
<input type="number" id="amount" placeholder="Contoh: 100000" required>

<label>Metode Pembayaran</label>
<select id="method" required>
  <option value="">-- Pilih Metode --</option>
  <option>Transfer Bank</option>
  <option>E-Wallet</option>
  <option>QRIS</option>
  <option>COD</option>
  <option>Virtual Account</option>
</select>

<button type="submit" class="btn">Proses Bayar</button>
<button type="button" class="btn" onclick="downloadPDF()">Download Struk PDF</button>

</form>

<div class="result" id="output" style="display:none;"></div>

</div>

<script>
let hasilText = "";

function hitungTotal(event){
  event.preventDefault();

  let nama = document.getElementById('nama').value;
  let amount = parseFloat(document.getElementById('amount').value);
  let method = document.getElementById('method').value;

  // validasi tambahan
  if(nama.length < 3){
    alert("Nama minimal 3 karakter!");
    return false;
  }

  let diskon = amount * 0.10;
  let afterDiskon = amount - diskon;
  let pajak = afterDiskon * 0.11;
  let total = afterDiskon + pajak;

  hasilText = `
Nama: ${nama}
Metode: ${method}
Harga: ${amount}
Diskon: ${diskon}
Pajak: ${pajak}
Total: ${total}
  `;

  document.getElementById('output').style.display='block';
  document.getElementById('output').innerHTML = `
  <b>${nama}</b><br>
  Metode: ${method}<br>
  Harga: Rp ${amount.toLocaleString()}<br>
  Diskon 10%: Rp ${diskon.toLocaleString()}<br>
  Pajak 11%: Rp ${pajak.toLocaleString()}<br>
  <hr>
  <b>Total: Rp ${total.toLocaleString()}</b>
  `;
}

async function downloadPDF(){
  if(!hasilText){
    alert("Isi & hitung dulu!");
    return;
  }

  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();

  doc.text("STRUK PEMBAYARAN", 20, 20);
  doc.text(hasilText, 20, 40);

  doc.save("struk.pdf");
}
</script>

</body>
</html>