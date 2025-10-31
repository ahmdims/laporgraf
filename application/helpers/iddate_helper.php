<?php
if (!function_exists('IdDate')) {
    function IdDate($tanggal, $with_time = false)
    {
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        if (!$tanggal)
            return '';
        $date = date('Y-m-d H:i:s', strtotime($tanggal));
        $parts = explode(' ', $date);
        $tgl = explode('-', $parts[0]);
        $result = (int) $tgl[2] . ' ' . $bulan[(int) $tgl[1]] . ' ' . $tgl[0];
        if ($with_time && isset($parts[1])) {
            $result .= ' ' . substr($parts[1], 0, 5);
        }
        return $result;
    }
}
