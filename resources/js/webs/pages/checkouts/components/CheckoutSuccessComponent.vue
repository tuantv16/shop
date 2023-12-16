
<script>

import { urlBase } from '../../../../common/config/main.js';

export default {

}
</script>
<template>
     <section class="confirmation-section">
        <!-- Icon hoàn tất thành công -->
        <div class="icon">
            <i class="fa fa-check-circle" aria-hidden="true"></i>
        </div>
        <h4>Xác Nhận Thanh Toán Thành Công</h4>
        <ul>
            <li>Mã Đơn Hàng: DHSHOP00040</li>
            <li>Tên Khách Hàng: Nguyễn Văn A</li>
            <li>Tổng Số Tiền: $750.99</li>
        </ul>
        <p>Cảm ơn bạn đã mua sắm với chúng tôi. Thông tin chi tiết về đơn hàng đã được gửi đến email của bạn.</p>
        <div>
            <button class="site-btn">TRỞ VỀ TRANG CHỦ</button>
            <button class="site-btn">TIẾP TỤC MUA SẮM</button>
        </div>
    </section>
</template>

<style>
/* Style cho section xác nhận */
.confirmation-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    min-height: 400px; /* Điều chỉnh chiều cao tùy ý */
}

.confirmation-section h4 {
    font-size: 2em; /* Điều chỉnh kích cỡ chữ */
    margin-bottom: 20px; /* Khoảng cách giữa các phần tử */
    color: #5cb85c; /* Màu sắc cho tiêu đề */
}

.confirmation-section ul {
    list-style: none; /* Bỏ bullet points của list */
    padding: 0; /* Bỏ padding của list */
}

.confirmation-section li {
    font-size: 1.2em; /* Điều chỉnh kích cỡ chữ */
    margin-bottom: 10px; /* Khoảng cách giữa các dòng */
}

.confirmation-section .icon {
    color: #5cb85c; /* Màu sắc cho icon */
    font-size: 3em; /* Điều chỉnh kích cỡ icon */
    margin-bottom: 20px; /* Khoảng cách giữa icon và chữ */
}

/* Style cho các nút */
.confirmation-section .site-btn {
    margin: 10px;
    padding: 10px 30px;
    font-size: 1.2em;
    border: none;
    background-color: #111111;
    color: white;
    cursor: pointer;
}

.confirmation-section .site-btn:hover {
    background-color: #4cae4c;
}
</style>
