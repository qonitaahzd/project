<?php
require_once 'Pembayaran.php';
require_once 'Cetak.php';
class TransferBank extends Pembayaran implements Cetak {
    public function prosesPembayaran() {
        if ($this->validasi()) {
            $diskon = $this->hitungDiskon();
            $afterDiskon = $this->jumlah - $diskon;
            $pajak = $this->hitungPajak($afterDiskon);
            $total = $afterDiskon + $pajak;

            return "Transfer Bank: Rp " . number_format($this->jumlah) .
                " - Diskon: Rp " . number_format($diskon) .
                " + Pajak: Rp " . number_format($pajak) .
                " = Total: Rp " . number_format($total);
        }
        return "Jumlah tidak valid";
    }

    public function cetakStruk() {
        return "Struk Transfer Bank berhasil.";
    }
}
?>