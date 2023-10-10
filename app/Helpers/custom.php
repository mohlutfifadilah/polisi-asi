<?php
  function waktuLalu($timestamp)
        {
            $selisih = time() - $timestamp;
            if ($selisih < 60) {
                return $selisih . ' detik yang lalu';
            } elseif ($selisih < 3600) {
                return round($selisih / 60) . ' menit yang lalu';
            } elseif ($selisih < 86400) {
                return round($selisih / 3600) . ' jam yang lalu';
            } elseif ($selisih < 2592000) {
                // kurang dari 30 hari (sekitar 1 bulan)
                return round($selisih / 86400) . ' hari yang lalu';
            } elseif ($selisih < 31536000) {
                // kurang dari 365 hari (sekitar 1 tahun)
                return round($selisih / 2592000) . ' bulan yang lalu';
            } else {
                return round($selisih / 31536000) . ' tahun yang lalu';
            }
        }
?>
