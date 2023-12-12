

<script>
import {Form, Field, ErrorMessage} from "vee-validate";
import {checkoutValidator} from "../checkout.validator.js";
import InputComponent from '../../../../common/form_style_2/InputComponent.vue';
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
            initData: {
                province: '',
                district: '',
                ward: '',
                provinceLabel: '',
                districtLabel: '',
                wardLabel: '',
                address: '',

            },
             
            // list_provinces: [
            //     { value: '01', label: 'Tỉnh 1' },
            //     { value: '02', label: 'Tỉnh 2' },
            // ],
            selectedProvince: null,
            selectedDistrict: null,
            selectedWard: null,
            list_provinces: [],
            list_districts: [],
            list_wards: []
        }
    },
    props: {

        account: {
            type: String,
            default: ''
        },

    },
    created() {
        this.getProvinces();
        
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
        handleStreet(val) {
            console.log(val);
            this.initData.streetLabel = val;
            this.referAddress();
        }, 
        referAddress(streetName = '') {
            const pos1 = streetName;
            const pos2 = this.wardLabel ? (', ' + this.wardLabel) : ''; 
            const pos3 = this.districtLabel ? (', ' + this.districtLabel) : '';
            const pos4 = this.provinceLabel ? (', ' + this.provinceLabel) : '';
            return pos1 + pos2 + pos3 + pos4;
        }
        
    },
    watch: {
        // tuantv add 2023/12/05
        selectedProvince: function (obj, oldValue) {
            if(obj) {
                let provinceId = obj.value;
                this.provinceLabel = obj.label;
                this.initData.address = this.referAddress();
                
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
                this.initData.address = this.referAddress();

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
                this.initData.address = this.referAddress();
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
        v-slot="{ values, setFieldValue }"
        :validation-schema="schema"> 
    <h6 class="coupon__code">
        <span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
    </h6>
    <h6 class="checkout__title">Chi tiết đơn hàng</h6>
    <div class="row">
        <div class="col-lg-6">
            <input-component title="Tên khách hàng"
                name="customer_name"
                placeholder=""
            />
        </div>
    </div>

    <div class="">
        <p>Tỉnh/Thành phố<span>*</span></p>
        <v-select :options="list_provinces" 
                v-model="selectedProvince" 
                class="location"
            >
            <template v-slot:no-options>Chưa có dữ liệu</template>
        </v-select>
    </div>

    <div class="">
        <p>Quận/Huyện<span>*</span></p>
        <v-select :options="list_districts" v-model="selectedDistrict" class="location">
            <template v-slot:no-options>Chưa có dữ liệu</template>
        </v-select>
    </div>

    <div class="">
        <p>Phường/Xã<span>*</span></p>
        <v-select :options="list_wards" v-model="selectedWard" class="location">
            <template v-slot:no-options>Chưa có dữ liệu</template>
        </v-select>
    </div>

    <div class="checkout__input">
        <input-component title="Số nhà, tên đường"
            name="apartment_street_name"
            :data="this.initData.apartment_street_name"
            @change="(val) => {
                //setFieldValue('apartment_street_name', val);
                this.referAddress(val);
                // handleStreet(val).then(res => {
                //     //setFieldValue('apartment_street_name', val);
                // }); 
            }"
        />
    </div>

    <div class="checkout__input">
        <input-component title="Địa chỉ"
            name="address"
            :data="this.initData.address"
        />
    </div>
   
    <div class="checkout__input">
        <p>Country/State<span>*</span></p>
        <input type="text">
    </div>
    <div class="checkout__input">
        <p>Postcode / ZIP<span>*</span></p>
        <input type="text">
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="checkout__input">
                <p>Phone<span>*</span></p>
                <input type="text">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="checkout__input">
                <p>Email<span>*</span></p>
                <input type="text">
            </div>
        </div>
    </div>
    <div class="checkout__input__checkbox">
        <label for="acc">
            Chấp nhận tạo tài khoản
            <input type="checkbox" id="acc">
            <span class="checkmark"></span>
        </label>
        <p>Create an account by entering the information below. If you are a returning customer
        please login at the top of the page</p>
    </div>
    <div class="checkout__input">
        <p>Mật khẩu tài khoản<span>*</span></p>
        <input type="text">
    </div>
    <div class="checkout__input__checkbox">
        <label for="diff-acc">
            Lưu ý về đơn đặt hàng của bạn, ví dụ: thông báo đặc biệt về giao hàng
            <input type="checkbox" id="diff-acc">
            <span class="checkmark"></span>
        </label>
    </div>
    <div class="checkout__input">
        <p>Ghi chú đặt hàng<span></span></p>
        <input type="text"
        placeholder="Notes about your order, e.g. special notes for delivery.">
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