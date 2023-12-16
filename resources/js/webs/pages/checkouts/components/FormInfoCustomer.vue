

<script>
import {Form, Field, ErrorMessage} from "vee-validate";
import {checkoutValidator} from "../checkout.validator.js";
import InputComponent from '../../../../common/form_style_2/InputComponent.vue';
import TextareaComponent from '../../../../common/form_style_2/TextareaComponent.vue';
import YesNoComponent from '../../../../common/form_style_2/YesNoComponent.vue';
import { urlBase } from '../../../../common/config/main.js';

import * as yup from "yup";
// import { urlBase } from '../../../../common/config/main.js';
import {dataAction} from '../services/dataActions.js';
import {apiMixin} from '../../../../mixins/apiMixin.js';
import { useToast } from 'vue-toastification';
import vSelect from 'vue-select';
import { useOrderStore } from '../stores/orderStore.js';

export default {
    mixins: [apiMixin],
    components: {
        Form,
        Field,
        ErrorMessage,
        InputComponent,
        TextareaComponent,
        YesNoComponent,
        vSelect
    },
    setup() {
        const toast = useToast();
        const orderStore = useOrderStore();
    return {
            toast,
            orderStore
        };

    },
    data() {
        return {
            errors: [],
            initData: {
                province: '',
                district: '',
                ward: '',
                provinceLabel: '',
                districtLabel: '',
                wardLabel: '',
                address: '',
                streetNameLabel: '',
                apartment_street_name : '',
                agree_account: false
            },
            selectedProvince: null,
            selectedDistrict: null,
            selectedWard: null,
            list_provinces: [],
            list_districts: [],
            list_wards: [],
            checkboxAgreeAccount: true,
            displayAccount: true,
            apartment_street_name: '',
            dataCarts: []
        }
    },
    props: {
        customerLogin: {
            type: Array,
            default: []
        },
        dataCartSession: {
            type: Array,
            default: []
        },
    },
    created() {

        this.errors = [];
        this.getProvinces();

        let infoCartCheckout = localStorage.getItem('infoCartCheckout');
        this.dataCarts = this.convertData(JSON.parse(infoCartCheckout));

        //Trường hợp đã login
        if(this.dataCartSession.length > 0) {
            this.dataCarts = this.convertData(this.dataCartSession);
        }

        this.$emit('data-carts', this.dataCarts);
        this.$emit('sub-total', this.cacSubTotal(this.dataCarts));

    },
    mounted() {
        this.errors = [];
    },
    computed: {
        schema() {
            let rules = checkoutValidator(this);
            return yup.object().shape(rules);
        },
    },
    methods: {
        onSubmit(dataInputs) {
            // console.log(dataInputs);
            // debugger;
            // lưu vào store để bên ProceedCheckoutComponent lấy dữ liệu
            // this.orderStore.setFormCustomers(dataInputs);

            let obj = {};
            obj.infoOrders = this.dataCarts;
            obj.infoCustomers = dataInputs;

            console.log(obj);
            debugger;
            dataAction.saveOrder(obj).then((res) => {
                //let data = res.data.results;
                if (res.data.status == 'success' && res.data.data != '') {
                    const orderCode = res.data.data;
                    window.location.href = `${urlBase}/checkout-success.html?code=${orderCode}`;
                }

            }).catch((err) => {
                this.toast.error('Đã có lỗi xảy ra');
                this.scrollToTop();
            })

        },
        getProvinces() {
            dataAction.getApiProvinces().then((res) => {
                let data = res.data.results;

                this.list_provinces = data.map(row => {
                    return { value: row.province_id, label: row.province_name };
                });


                // selected khi người dùng login
                if (this.customerLogin.city) {
                    this.selectedProvince = this.list_provinces.find(row => {
                        return row.value == this.customerLogin.city;
                    });
                }


            }).catch((err) => {

            })
        },
        getDistricts() {
            if (this.initData.province != '') {
                dataAction.getApiDistricts(this.initData.province).then((res) => {
                    let data = res.data.results;

                    this.list_districts = data.map(row => {
                        return { value: row.district_id, label: row.district_name };
                    });

                     // selected khi người dùng login
                    if (this.customerLogin.district) {
                        this.selectedDistrict = this.list_districts.find(row => {
                            return row.value == this.customerLogin.district;
                        });
                    }


                }).catch((err) => {
                    this.toast.error('Đã có lỗi xảy ra');
                    this.scrollToTop();
                })
            }
        },
        getWards() {
            if (this.initData.district != '') {

                dataAction.getApiWards(this.initData.district).then((res) => {

                    let data = res.data.results;
                    this.list_wards = data.map(row => {
                        return { value: row.ward_id, label: row.ward_name };
                    });

                      // selected khi người dùng login
                    if (this.customerLogin.ward) {
                        this.selectedWard = this.list_wards.find(row => {
                            return row.value == this.customerLogin.ward;
                        });
                    }

                }).catch((err) => {
                    this.toast.error('Đã có lỗi xảy ra');
                    this.scrollToTop();
                })
            }
        },
        handleStreet(e) {
            // this.initData.streetLabel = val;
             this.streetNameLabel = e.target.value;
             this.$refs.checkoutForm.setFieldValue('apartment_street_name', e.target.value);

             this.referAddress();
        },
        referAddress() {
            const pos1 = this.streetNameLabel ?? '';
            const pos2 = this.wardLabel ? (', ' + this.wardLabel) : '';
            const pos3 = this.districtLabel ? (', ' + this.districtLabel) : '';
            const pos4 = this.provinceLabel ? (', ' + this.provinceLabel) : '';
            let addressTxt = pos1 + pos2 + pos3 + pos4;

            if (addressTxt.substr(0,1) == ',') {
                addressTxt = addressTxt.replace(',','');
            }
            this.initData.address = addressTxt;
        },

        onInvalid(errors) {
            try {
                const el = document.querySelector(`[name=${Object.keys(errors.errors)[0]}]`)
                el.scrollIntoView({behavior: 'smooth'});
                el.focus();
            } catch (e) {
                console.log(errors)
            }

        },
        submitCustomerForm() {
            $("body #checkoutCustomerForm").trigger('click');
        },
        // convertData(carts) {
        //     return carts.map(row => {
        //         return {
        //             product_id : row.product_id,
        //             quantity : parseInt(row.quantity),
        //             color_id : parseInt(row.color_id),
        //             size_id : parseInt(row.size_id),
        //             price: parseInt(row.product_details.price),
        //             color_name: row.product_details.color_name,
        //             product_code: row.product_details.product_code,
        //             product_name: row.product_details.product_name,
        //             size_name: row.product_details.size_name,
        //             total_amount: parseInt(row.product_details.total_amount),
        //             total_amount_label: this.formatPrice(row.product_details.total_amount),
        //         }
        //     });
        // },
        convertData(carts) {
            const groupedCarts = {};

            carts.forEach(row => {
                const key = `${row.product_id}_${row.color_id}_${row.size_id}`;
                if (!groupedCarts[key]) {
                    // Nếu chưa có bản ghi với key này, tạo mới
                    groupedCarts[key] = {
                        product_id: row.product_id,
                        quantity: parseInt(row.quantity),
                        color_id: parseInt(row.color_id),
                        size_id: parseInt(row.size_id),
                        price: parseInt(row.product_details.price),
                        color_name: row.product_details.color_name,
                        product_code: row.product_details.product_code,
                        product_name: row.product_details.product_name,
                        size_name: row.product_details.size_name,
                        total_amount: parseInt(row.product_details.total_amount),
                        total_amount_label: this.formatPrice(row.product_details.total_amount),
                    };
                } else {
                    // Nếu đã có bản ghi, cập nhật số lượng và total_amount
                    groupedCarts[key].quantity += parseInt(row.quantity);
                    groupedCarts[key].total_amount += parseInt(row.product_details.total_amount);
                    groupedCarts[key].total_amount_label = this.formatPrice(groupedCarts[key].total_amount);
                }
            });

            return Object.values(groupedCarts);
        },

        cacSubTotal(data) {
            // tính tổng tiền luôn
            this.subTotal = data.reduce((initResult, item) => initResult + item.total_amount, 0);
            this.subTotal = this.formatPrice(this.subTotal);

            return this.subTotal;
        },
        formatPrice(value) {
            let val = (value/1).toFixed(0).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")+' đ';
        },

    },
    watch: {
        checkboxAgreeAccount(val) {
            this.initData.agree_account = val;
            this.$refs.checkoutForm.setFieldValue('agree_account', val);
            if(!val) {
                this.displayAccount = false
            } else {
                this.displayAccount = true
            }
        },
        // tuantv add 2023/12/05
        selectedProvince: function (obj, oldValue) {

            if(obj) {
                let provinceId = obj.value;
                this.provinceLabel = obj.label;
                this.referAddress();

                this.initData.province = provinceId;
                this.$nextTick(() => { // waiting load DOM
                    if (provinceId != null) {
                        this.$refs.checkoutForm.setFieldValue('province', provinceId);
                        this.getDistricts();
                    }
                });
            } else {
                this.initData.province = '';
                this.initData.provinceLabel = '';
                this.initData.district = '';
                this.initData.districtLabel = '';
                this.initData.ward = '';
                this.initData.wardLabel = '';
                this.initData.streetLabel = '';
                this.$refs.checkoutForm.setFieldValue('province', '');
                this.$refs.checkoutForm.setFieldValue('district', '');
                this.$refs.checkoutForm.setFieldValue('ward', '');
                this.initData.address = '';
            }

        },
        selectedDistrict: function (obj, oldValue) {
            if(obj) {
                let districtId = obj.value;
                this.districtLabel = obj.label;
                this.referAddress();

                this.initData.district = districtId;
                this.$nextTick(() => {
                    if (districtId != null) {
                        this.$refs.checkoutForm.setFieldValue('district', districtId);
                        this.getWards();
                    }
                });
            } else {
                this.$refs.checkoutForm.setFieldValue('district', '');
                this.$refs.checkoutForm.setFieldValue('ward', '');
                this.initData.district = '';
                this.initData.districtLabel = '';
                this.initData.ward = '';
                this.initData.wardLabel = '';
                this.initData.address = '';
            }
        },
        selectedWard: function (obj, oldValue) {
            if(obj) {
                let wardId = obj.value;
                this.wardLabel = obj.label;
                this.referAddress();
                this.initData.ward = wardId;

                this.$nextTick(() => {
                    if (wardId != null) {
                        this.$refs.checkoutForm.setFieldValue('ward', wardId);
                    }
                });
            } else {
                this.$refs.checkoutForm.setFieldValue('ward', '');
                this.initData.ward = '';
                this.initData.wardLabel = '';
                this.initData.address = '';
            }
        }
    }
}
</script>

<template>
<div class="col-lg-8 col-md-6">
    <Form
        :initial-values="initData"
        @submit="onSubmit"
        @invalid-submit="onInvalid"
        class="form-horizontal"
        ref="checkoutForm"
        v-slot="{ values, setFieldValue, errors }"
        :validation-schema="schema">

    <button type="submit" id="checkoutCustomerForm" style="display: none">Submit</button>

    <h6 class="coupon__code">
        <span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
    </h6>
    <h6 class="checkout__title">Chi tiết đơn hàng</h6>

    <div class="checkout_input">
        <input-component title="Tên khách hàng"
                name="customer_name"
                placeholder=""
                :data="this.customerLogin.customer_name ?? ''"
                :required="true"
            />
    </div>

    <div class="item-location">
        <p>Tỉnh / Thành phố <span class="required-item-location">(*)</span></p>
        <Field v-slot="{ field, errors }" name="province">
        <v-select :options="list_provinces"
                v-model="selectedProvince"
                class="location"
                :class="errors.length > 0 ? 'is-valid-select' : ''"
            >
            <template v-slot:no-options>Chưa có dữ liệu</template>
        </v-select>
        </Field>
        <ErrorMessage name="province" />
        <div class="message-error" v-if="errors.province">
            <span role="alert">{{  errors.province }}</span>
        </div>
    </div>

    <div class="item-location">
        <p>Quận / Huyện <span class="required-item-location">(*)</span></p>
        <Field v-slot="{ field, errors }" name="district">
            <v-select :options="list_districts" v-model="selectedDistrict" class="location" :class="errors.length > 0 ? 'is-invalid-select' : ''">
                <template v-slot:no-options>Chưa có dữ liệu</template>
            </v-select>
        </Field>
        <ErrorMessage name="district" />
        <div class="message-error" v-if="errors.district">
            <span role="alert">{{  errors.district }}</span>
        </div>
    </div>

    <div class="item-location">
        <p>Phường / Xã <span class="required-item-location">(*)</span></p>
        <Field v-slot="{ field, errors }" name="ward">
            <v-select :options="list_wards" v-model="selectedWard" class="location" :class="errors.length > 0  ? 'is-invalid-select' : ''">
                <template v-slot:no-options>Chưa có dữ liệu</template>
            </v-select>
        </Field>
        <ErrorMessage name="ward" />
        <div class="message-error" v-if="errors.ward">
            <span role="alert">{{  errors.ward }}</span>
        </div>
    </div>

    <div class="checkout__input">
        <p>Đường, số nhà <span>(*)</span></p>
        <input title="Số nhà, tên đường"
            name="apartment_street_name"
            v-model="apartment_street_name"
            @change="(event) => {
                handleStreet(event)
            }"
            class="form-control"
            :class="errors.apartment_street_name ? 'is-invalid-select' : ''"
            />
        <div class="message-error" v-if="errors.apartment_street_name">
            <span role="alert">{{  errors.apartment_street_name }}</span>
        </div>
    </div>

    <div class="checkout_input">
        <input-component title="Địa chỉ"
            name="address"
            :data="this.initData.address"
            :required="true"
        />
    </div>

    <div class="checkout_input">
        <input-component title="Điện thoại"
            name="phone"
            :data="this.customerLogin.phone ?? ''"
            :required="true"
        />
    </div>

    <div class="checkout_input">
        <input-component title="Email"
            name="email"
            :data="this.customerLogin.email ?? ''"
            :required="true"
        />
    </div>

    <div class="checkout__input">
        <textarea-component
            name="memo"
            title="Ghi chú đặt hàng"
            :data="this.customerLogin.memo ?? ''"
            placeholder="Ghi chú về đơn đặt hàng của bạn, ví dụ: ghi chú đặc biệt để giao hàng."
        />
    </div>

    <div id="agree-create-account" v-if="this.customerLogin.length == 0" >
        <div class="checkout__input__checkbox">
            <label for="acc">
                Đồng ý tạo tài khoản
                <input type="checkbox" id="acc" name="agree_account" v-model="checkboxAgreeAccount">
                <span class="checkmark"></span>
            </label>
            <p v-if="this.displayAccount" style="margin-bottom:0px">Tạo một tài khoản bằng cách nhập thông tin dưới đây. Nếu bạn là khách hàng cũ vui lòng đăng nhập ở đầu trang</p>
        </div>

        <div class="checkout__input" v-if="this.displayAccount">
            <input-component title="Tên tài khoản"
                name="account"
                :required="true"
            />
        </div>

        <div class="checkout__input" v-if="this.displayAccount">
            <input-component title="Mật khẩu tài khoản"
                name="password"
                type="password"
                :required="true"
            />
        </div>
    </div>


    </Form>
</div>
</template>

<style>
    .location input {
        height: 40px !important;
    }
</style>
