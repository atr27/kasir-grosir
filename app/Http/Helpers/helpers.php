<?php

function format_rupiah ($angka) {
    return number_format($angka, 0, ',','.');
}

function terbilang ($angka){
    $angka = abs($angka);
    $baca = array('','satu','dua','tiga','empat','lima','enam','tujuh','delapan','sembilan','sepuluh','sebelas');
    $terbilang = '';

    if($angka < 12) {
        $terbilang = ''.$baca[$angka];
    } else if ($angka < 20) {
        $terbilang = terbilang($angka - 10).' belas';
    } else if ($angka < 100) {
        $terbilang = terbilang($angka/10).' puluh '.terbilang($angka%10);
    } elseif ($angka < 200) {
        $terbilang = 'seratus '.terbilang($angka-100);
    } else if ($angka < 1000) {
        $terbilang = terbilang($angka/100).' ratus '.terbilang($angka%100);
    } else if ($angka < 2000) {
        $terbilang = 'seribu '.terbilang($angka-1000);
    } else if ($angka < 1000000) {
        $terbilang = terbilang($angka/1000).' ribu '.terbilang($angka%1000);
    } else if ($angka < 1000000000) {
        $terbilang = terbilang($angka/1000000).' juta '.terbilang($angka%1000000);
    }

    return $terbilang;
}

function format_tanggal_indonesia ($tgl, $hari_sekarang = true) {
    $hari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
    $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

    //2024-05-02
    $tahun = substr($tgl, 0, 4);
    $bulan = $bulan[(int) substr($tgl, 5, 2)];
    $tanggal =substr($tgl, 8, 2);
    $text = '';

    if($hari_sekarang){
        $urutan_hari = date('w', mktime(0,0,0, substr($tgl, 5, 2), $tanggal, $tahun));
        $nama_hari = $hari[$urutan_hari];
        $text .= "$nama_hari, $tanggal $bulan $tahun";
    } else {
        $text .= "$tanggal $bulan $tahun";
    }

    return $text;
}

function tambahNolDepan($value, $threshold = 8) {
    $value = (string) $value;
    if (strlen($value) >= $threshold) {
        return $value;
    }
    return str_repeat('0', $threshold - strlen($value)) . $value;
}
