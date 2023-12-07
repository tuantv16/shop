<?php
    /*
        S
        1m55 - 1m59
        48kg - 54kg
        M
        1m60 - 1m65
        55kg - 61kg
        L
        1m66 - 1m72
        62kg - 68kg
        XL
        1m72 - 1m77
        69kg - 75kg
        2XL
        1m77 - 1m84
        76kg - 84kg
        3XL
        1m85 - 1m92
        85kg - 90kg
    */
    $sizes = [
        1 => 'S',
        2 => 'M',
        3 => 'L',
        4 => 'XL',
        5 => '2XL',
        6 => '3XL',
    ];

    /*
    c-1 : đen
    c-2: Xanh navi
    c-3: Vàng
    c-4: Ghi
    c-5: Nâu
    c-6: Hồng
    c-7: tím
    c-8: Đỏ
    c-9: Trắng
    */
    $colors = [
        1 => 'c-1',
        2 => 'c-2',
        3 => 'c-3',
        4 => 'c-4',
        5 => 'c-5',
        6 => 'c-6',
        7 => 'c-7',
        8 => 'c-8',
        9 => 'c-9'
    ];

    $colorNames = [
        1 => 'đen',
        2 => 'xanh navi',
        3 => 'vàng',
        4 => 'ghi',
        5 => 'nâu',
        6 => 'hồng',
        7 => 'tím',
        8 => 'đỏ',
        9 => 'trắng'
    ];

    $prices = [
        1 => '0 - 200.000đ',
        2 => '200.000đ - 500.000đ',
        3 => '500.000đ - 1.000.000đ',
        4 => '1.000.000đ - 2.000.000đ',
        5 => '2.000.000đ - 5.000.000đ',
        6 => '5.000.000đ+'
    ];

    // Thư mục lưu trữ hình ảnh
    $uploads = [
        'products' => 'product_images'
    ];


    return [
        'sizes' => $sizes,
        'colors' => $colors,
        'colorNames' => $colorNames,
        'prices' => $prices,
        'uploads' => $uploads
    ];
?>
