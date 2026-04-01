<?php
require_once 'Pembayaran.php';
require_once 'Cetak.php';

// Penggunaan Class Qris
class Qris extends Pembayaran implements Cetak {

    public function prosesPembayaran() {
        if ($this->validasi()) {
            return "Pembayaran Qris Rp {$this->jumlah} berhasil";
        }
        return "Jumlah tidak valid";
    }

    public function cetakStruk() {
        return "Struk Qris: Rp {$this->jumlah}";
    }
}
?>