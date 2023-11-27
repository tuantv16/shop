
<script>
import {ErrorMessage, Field, Form, useForm} from "vee-validate";
import * as yup from 'yup';
import InputComponent from '../../common/form_style_1/InputComponent.vue';
import SelectBoxComponent from '../../common/form_style_1/SelectBoxComponent.vue';
import {dataAction} from '../services/dataActions.js';

export default {
    name: 'CreateProductDetailComponent',
    components: {
        Form, Field, ErrorMessage,
        InputComponent,
        SelectBoxComponent,

    },
    data() {
        return {
            // objData: {
            //     category_id: '',
            //     brand_id: '',
            //     category_id: '',
            //     description : '',
            //     price : '',
            //     image : '',
            //     disp : 1
            // },
            
            rows: []
        }
    },
    created() {

     
    },
    methods: {
        onSubmit(dataInputs) {
            // console.log(formData);
            // debugger;
            dataAction.saveData(dataInputs).then(res => {


                 if (res.data.status == 'success') {
                    //window.location.href = '/manage/categories';
                    location.reload();

                 }
            });

        },
        addRow() {
            this.rows.push({
                size_id: null,
                color_id: null,
                brand_id: null,
                quantity: null,
                disp: 1
            });
        }
    },
    props: {
        sizes: {
            type: Object,
            default : null
        },
        colors: {
            type: Object,
            default : null
        },
        brands: {
            type: Object,
            default : null
        }

    },
    computed: {
        schema() {
            let msg = 'Đây là trường bắt buộc';
            let obj = {
                product_name: yup.string().max(255).required(msg),
                color_id: yup.string().required(msg),
                brand_id: yup.string().required(msg),
                description: yup.string().nullable().max(500),
                price: yup.string().nullable().required(msg),
                image: yup.string().nullable(),
                disp: yup.string().max(1).required(msg),

            };

            return yup.object(obj);
        }
    }
}

</script>

<template>

    <div class="single-product-tab-area mg-b-30">
            <!-- Single pro tab review Start-->
            <div class="single-pro-review-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="review-tab-pro-inner">
                                <ul id="myTab3" class="tab-review-design">
                                    <li class="active"><a href="#description"><i class="icon nalika-edit" aria-hidden="true"></i> Cài đặt thuộc tính</a></li>
                                </ul>
                                <button class="btn btn-primary" @click="addRow">Add</button>
                                <Form @submit="onSubmit" :initial-values="this.objData" :validation-schema="schema" >
                                <div id="myTabContent" class="tab-content">
                                    <div class="product-tab-list tab-pane fade active in" id="description-product">
                                        <div class="row">
                                            
                                            <div class="review-content-section flex-container">
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                    Kích cỡ
                                                </div>

                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                    Màu sắc
                                                </div>

                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                    Thương hiệu
                                                </div>

                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                    Số lượng
                                                </div>

                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                    Hiển thị
                                                </div>

                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" v-for="(row, rowIndex) in rows" :key="rowIndex">                             
                                                <div class="review-content-section flex-container">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                        <select-box-component :required="true" id="size_id" name="size_id">
                                                            <option value=""></option>
                                                            <option v-for="(value, key) in this.sizes" :key="key" :value="key">
                                                                {{ value }}
                                                            </option>
                                                        </select-box-component>
                                                    </div>
                                                    
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                        <select-box-component :required="true" id="color_id" name="color_id">
                                                            <option value=""></option>
                                                            <option v-for="(value, key) in this.colors" :key="key" :value="key">
                                                                {{ value }}
                                                            </option>
                                                        </select-box-component>
                                                    </div>

                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                        <select-box-component :required="true" id="brand_id" name="brand_id">
                                                            <option value=""></option>
                                                            <option v-for="item in this.brands" :key="item.id" :value="item.id">
                                                                {{ item.name }}
                                                            </option>
                                                        </select-box-component>
                                                    </div>

                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                        <input-component 
                                                            type="number"
                                                            id="quantity"
                                                            :limit="255"
                                                            name="quantity"
                                                            :required="true"
                                                            placeholder=""
                                                        />
                                                    </div>

                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                        <select-box-component :required="true" id="disp" name="disp">
                                                            <option value="1">Hiển thị</option>
                                                            <option value="0">Vô hiệu hóa</option>
                                                        </select-box-component>
                                                    </div>

                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                        <div class="group-item">
                                                            <button class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </div>



                                                </div>
                                            
                                        </div>

                                    </div>


                                </div>
                                </Form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<style>
/* CSS cho component ở đây */
</style>
