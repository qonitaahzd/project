<?php
require_once 'Pembayaran.php';
require_once 'Cetak.php';

// Penggunaan Class Ewallet
class VirtualAccount extends Pembayaran implements Cetak {

    public function prosesPembayaran() {
        if ($this->validasi()) {
            return "Pembayaran VirtualAccount Rp {$this->jumlah} berhasil";
        }
        return "Jumlah tidak valid";
    }

    public function cetakStruk() {
        return "Struk VirtualAccount: Rp {$this->jumlah}";
    }
}
?>