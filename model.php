<?php

class Model_Employee {
    public $nama;
    public $jabatan;
    public $usia;
}

class Model_Office {
    public $namaKantor;
    public $alamat;
    public $kota;
    public $telepon;
}

// Relasi disimpan sebagai "nomor urut" employee & office di list masing-masing
class Model_OfficeEmployee {
    public $employeeIndex;
    public $officeIndex;
}
?>
