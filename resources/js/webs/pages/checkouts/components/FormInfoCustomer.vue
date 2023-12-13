

<script>
import {Form, Field, ErrorMessage} from "vee-validate";
import {checkoutValidator} from "../checkout.validator.js";
import InputComponent from '../../../../common/form_style_2/InputComponent.vue';
import TextareaComponent from '../../../../common/form_style_2/TextareaComponent.vue';
import YesNoComponent from '../../../../common/form_style_2/YesNoComponent.vue';

import * as yup from "yup";
// import { urlBase } from '../../../../common/config/main.js';
import {dataAction} from '../services/dataActions.js';
import {apiMixin} from '../../../../mixins/apiMixin.js';
import { useToast } from 'vue-toastification';
import vSelect from 'vue-select';

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

    return {
            toast
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
            checkboxAgreeAccount: false,
            apartment_street_name: ''
        }
    },
    props: {

        account: {
            type: String,
            default: ''
        },

    },
    created() {
        this.errors = [];
        this.getProvinces();

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
            console.log(dataInputs);
            debugger;
            dataAction.store(dataInputs).then((res) => {
                //window.location.href = BASE_URL + `admin/equipments`;
            }).catch((err) => {
                this.msgAlert(MSG_UPDATE_FAIL);
            })
        },
        getProvinces() {
            dataAction.getApiProvinces().then((res) => {
                let data = res.data.results;

                this.list_provinces = data.map(row => {
                    return { value: row.province_id, label: row.province_name };
                });

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


                }).catch((err) => {

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

                }).catch((err) => {

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

        toggleAgree: function() {
          // Trong hàm này, bạn có thể sử dụng giá trị của isChecked
          if (this.checkboxAgreeAccount) {
            this.initData.agree_account = 0;
          } else {
            this.initData.agree_account = 1;
          }
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



    },
    watch: {
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

        {{ errors }}
    <h6 class="coupon__code">
        <span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
    </h6>
    <h6 class="checkout__title">Chi tiết đơn hàng</h6>


    <div class="checkout_input">
        <input-component title="Tên khách hàng"
                name="customer_name"
                placeholder=""
                :required="true"
            />
    </div>

    <div class="item-location">
        <p>Tỉnh / Thành phố <span class="required-item-location">(*)</span></p>
        <Field v-slot="{ field, errors }" name="province">
            {{  errors }}
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
            :required="true"
        />
    </div>

    <div class="checkout_input">
        <input-component title="Email"
            name="email"
            :required="true"
        />
    </div>

    <div class="checkout__input">
        <textarea-component
            name="memo"
            title="Ghi chú đặt hàng"
            placeholder="Ghi chú về đơn đặt hàng của bạn, ví dụ: ghi chú đặc biệt để giao hàng."
        />
    </div>

    <div class="checkout__input__checkbox">
        <label for="acc">
            Đồng ý tạo tài khoản
            <input type="checkbox" id="acc" name="agree_account" v-model="checkboxAgreeAccount" @click="toggleAgree">
            <span class="checkmark"></span>
        </label>
        <p v-if="this.initData.agree_account" style="margin-bottom:0px">Tạo một tài khoản bằng cách nhập thông tin dưới đây. Nếu bạn là khách hàng cũ vui lòng đăng nhập ở đầu trang</p>
    </div>

    <div class="checkout__input" v-if="this.initData.agree_account">
        <input-component title="Tên tài khoản"
            name="account"
            :required="true"
        />
    </div>

    <div class="checkout__input" v-if="this.initData.agree_account">
        <input-component title="Mật khẩu tài khoản"
            name="password"
            type="password"
            :required="true"
        />
    </div>

    <input type="submit" class="btn btn-primary" value="submit"/>
    </Form>
</div>
</template>

<style>
    .location input {
        height: 40px !important;
    }
</style>
