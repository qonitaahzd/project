<?php
require_once 'Pembayaran.php';
require_once 'Cetak.php';

class COD extends Pembayaran implements Cetak {
    public function prosesPembayaran() {
        if ($this->validasi()) {
            $pajak = $this->jumlah * 0.11;
            $total = $this->jumlah + $pajak;

            return "COD: Rp " . number_format($this->jumlah) .
                " + Pajak: Rp " . number_format($pajak) .
                " = Total: Rp " . number_format($total);
        }
        return "Jumlah tidak valid";
    }

    public function cetakStruk() {
        return "Struk COD: Bayar di tempat.";
    }
}
?>