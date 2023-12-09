

<script>
import ProductRelatedComponent from './ProductRelatedComponent.vue';
import { urlBase } from '../../../../common/config/main.js';
import {dataAction} from '../services/dataActions.js';
import {apiMixin} from '../../../../mixins/apiMixin.js';
import { useToast } from 'vue-toastification';
export default {
    mixins: [apiMixin],
    components: {

        ProductRelatedComponent

    },
    setup() {
        const toast = useToast();

    return {
            toast
        };

    },
    data() {
        return {
            customerProducts: {
                product_id: '',
                size_id: '',
                color_id: '',
                quantity: 1
            },
            quantity : 1,
            statusCustomerLogin : false,
            isValidSize: false,
            isValidColor: false
        }
    },
    props: {
        infoProducts: {
            type: Object,
            default: null
        },
        sizes: {
            type: Object,
            default: null
        },
        colors: {
            type: Object,
            default: null
        },
        accountLogin: {
            type: String,
            default: ''
        },

    },
    created() {
        this.customerProducts.product_id = this.infoProducts.id;
        this.statusCustomerLogin = this.accountLogin != '' ? true : false;

    },
    methods: {
        handleSize(val) {
            this.customerProducts.size_id = val; // active

        },

        handleColor(val) {
            this.customerProducts.color_id = val; // active
        },

        handleQuantity(e) {
            this.customerProducts.quantity = e.target.value;
        },
        validateAttrProduct(rowProduct) {
            let valid = true;


            this.isValidSize = false;
            if(rowProduct.size_id == '') {
                this.isValidSize = true;
                valid = false;
            }

            this.isValidColor = false;
            if(rowProduct.color_id == '') {
                this.isValidColor = true;
                valid = false;
            }

            if (!valid) {
                this.toast.error('Thông tin chưa được nhập đẩy đủ');
            } else {
                // reset
                // this.customerProducts = {
                //     product_id: this.infoProducts.id ?? '',
                //     size_id: '',
                //     color_id: '',
                //     quantity: 1
                // },


                this.toast.success('Thêm vào giỏ hàng thành công');
            }

            return valid;

        },
        addCart() {

            //Khởi tạo giỏ hàng
            const infoCart = JSON.parse(localStorage.getItem('infoCart')) || [];

            const isValid = this.validateAttrProduct(this.customerProducts);
            if (isValid) {
                // Kiểm tra xem có bản ghi nào hay chưa
                const keyCart = infoCart.findIndex(item => {
                    return (
                        item.product_id === this.customerProducts.product_id &&
                        item.size_id === this.customerProducts.size_id &&
                        item.color_id === this.customerProducts.color_id
                    );
                });

                if (keyCart !== -1) {
                    // Nếu sản phẩm đã tồn tại trong giỏ hàng -> update tăng số lượng
                    infoCart[keyCart].quantity = parseInt(infoCart[keyCart].quantity) + parseInt(this.customerProducts.quantity);
                } else {
                    // Nếu sản phẩm không tồn tại trong giỏ hàng -> tạo mới bản ghi
                    infoCart.push(this.customerProducts);
                }


                if (!this.statusCustomerLogin) { // trường hợp chưa login (khách vãng lai) lưu thông tin hàng hóa vào localStorage
                    localStorage.setItem('infoCart', JSON.stringify(infoCart));
                }

                if (this.statusCustomerLogin) { // Trường hợp khách hàng đăng nhập tài khoản -> lưu thông tin hàng hóa vào Session
                    this.setProductToCart(infoCart);
                }

            }

        },
        setProductToCart(data) {
            let obj = {};
            obj.products = data;

            dataAction.addToCart(obj).then(res => {

                if (res.data.status === 'success') {

                } else {
                    alert('lưu thông tin thất bại');
                    return false;
                }
            });
        },

    },
    watch: {

    }
}
</script>

<template>
    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="./index.html">Trang chủ</a>
                            <a href="./shop.html">Cửa hàng</a>
                            <span>Chi tiết sản phẩm</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="frontend/img/shop-details/thumb-1.png" style="background-image: url('frontend/img/shop-details/thumb-1.png');">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="frontend/img/shop-details/thumb-2.png" style="background-image: url('frontend/img/shop-details/thumb-2.png');">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="frontend/img/shop-details/thumb-3.png" style="background-image: url('frontend/img/shop-details/thumb-3.png');">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="frontend/img/shop-details/thumb-4.png" style="background-image: url('frontend/img/shop-details/thumb-4.png');">
                                        <i class="fa fa-play"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="frontend/img/shop-details/product-big-2.png" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="frontend/img/shop-details/product-big-3.png" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="frontend/img/shop-details/product-big.png" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-4" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="frontend/img/shop-details/product-big-4.png" alt="">
                                    <a href="https://www.youtube.com/watch?v=8PJ3_p7VqHw&list=RD8PJ3_p7VqHw&start_radio=1" class="video-popup"><i class="fa fa-play"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{  this.infoProducts.product_name }}</h4>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span> - 5 Reviews</span>
                            </div>
                            <h3>{{  this.infoProducts.price }}<span>70.00</span></h3>

                            <div class="product__details__option">
                                <div class="product__details__option__size">
                                    <span>Kích cỡ:</span>
                                    <label :for="`${size}`" v-for="(size, key) in this.sizes" :key="key"
                                        :class="{ 'active': customerProducts.size_id === key }"  @click="handleSize(key)">  {{ size }}
                                        <input type="radio" :id="`${size}`">
                                    </label>
                                    <div class="error-attr"><span v-if="isValidSize">Vui lòng chọn kích cỡ</span></div>
                                </div>
                                <div class="product__details__option__color">
                                    <span>Màu sắc:</span>
                                    <label :for="`${color}`" v-for="(color, key) in this.colors" :key="key"
                                        :class="[color, { 'active': customerProducts.color_id === key }]" @click="handleColor(key)">
                                        <input type="radio" :id="`${color}`">
                                    </label>
                                    <div class="error-attr"><span v-if="isValidColor">Vui lòng chọn màu sắc</span></div>
                                </div>
                            </div>
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="number" min="0" max="5" v-model="quantity"  @change="handleQuantity">
                                    </div>
                                </div>
                                <a href="#" class="primary-btn" @click.prevent="addCart">Thêm vào giỏ hàng</a>
                            </div>
                            <div class="product__details__btns__option">
                                <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                                <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>
                            </div>
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="frontend/img/shop-details/details-payment.png" alt="">
                                <ul>
                                    <li><span>SKU:</span> 3812912</li>
                                    <li><span>Categories:</span> Clothes</li>
                                    <li><span>Tag:</span> Clothes, Skin, Body</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                    role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                    Previews(5)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                    information</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                            solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                            ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                        pharetras loremos.</p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                            a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                            $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                            worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                            a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                            $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                            worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-7" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                            solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                            ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                        pharetras loremos.</p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                            a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                            $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                            worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <product-related-component />

    <!-- Shop Details Section End -->
</template>
