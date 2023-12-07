<?php 

if (!function_exists('format_vnd')) {
    /**
     * Format số thành định dạng tiền tệ Việt Nam Đồng.
     *
     * @param  mixed $number
     * @return string
     */
    function format_vnd($number) {
        return number_format($number, 0, ',', '.') . 'đ';
    }
}
