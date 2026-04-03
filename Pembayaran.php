<?php
abstract class Pembayaran {
    protected $jumlah;

    public function __construct($jumlah) {
        $this->jumlah = $jumlah;
    }

    protected function validasi() {
        return $this->jumlah > 0;
    }

    protected function hitungDiskon() {
        return $this->jumlah * 0.10;
    }

    protected function hitungPajak($afterDiskon) {
        return $afterDiskon * 0.11;
    }

    abstract public function prosesPembayaran();
}
?>
