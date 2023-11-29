
<script>
import {ErrorMessage, Field, Form, useForm} from "vee-validate";
import * as yup from 'yup';
import InputComponent from '../../common/form_style_1/InputComponent.vue';
import SelectBoxComponent from '../../common/form_style_1/SelectBoxComponent.vue';
import {dataAction} from '../services/dataActions.js';

import { ProductDetailValidator } from "../product_detail.validate.js";
export default {
    name: 'CreateProductDetailComponent',
    components: {
        Form, Field, ErrorMessage,
        InputComponent,
        SelectBoxComponent,

    },
    data() {
        return {
            objData: {
                product_id : '',
                rows: [
                    {
                        size_id: null,
                        color_id: null,
                        brand_id: null,
                        quantity: null,
                        disp: 1,
                        deleted: false
                    }
                ]
            },
            threshold: 99999,
            display: '1',
            listStatus: [
                { id: 1, label: 'Hiển thị' },
                { id: 0, label: 'Vô hiệu hóa' },
            ]
        }
    },
    created() {
        if (this.productDetails) {
            this.objData.rows = this.productDetails;
        }
    },
    methods: {
        onSubmit(dataInputs) {

            dataInputs.product_id = this.productId;
            if (dataInputs.rows.length > 0) {
                dataInputs.rows = dataInputs.rows.filter(row => {
                    return !(row.size_id === this.threshold || row.color_id === this.threshold || row.brand_id === this.threshold);
                });
            }

            dataAction.saveData(dataInputs).then(res => {
                if (res.data.status == 'success') {
                    location.reload();
                }
            });

        },
        addRow() {
            const newRow = {
                size_id: null,
                color_id: null,
                brand_id: null,
                quantity: null,
                disp: 1,
                deleted: false
            };

            this.objData.rows.push(newRow);
        },
        removeRow(indexRow) {
            this.ignoreValidate(indexRow);
            this.objData.rows[indexRow].deleted = true;
        },
        ignoreValidate(indexRow) {
            this.objData.rows[indexRow].size_id = this.threshold;
            this.objData.rows[indexRow].color_id = this.threshold;
            this.objData.rows[indexRow].brand_id = this.threshold;
            this.objData.rows[indexRow].quantity = this.threshold;
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
        },
        productId: {
            type: Number,
            default : null
        },
        productDetails: {
            type: Number,
            default : null
        },

    },
    computed: {

        schema() {
            let rules = ProductDetailValidator(this);
            return yup.object().shape(rules);
        },
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
                                <Form @submit="onSubmit" :initial-values="this.objData" :validation-schema="schema">
                                <div id="myTabContent" class="tab-content">
                                    <div class="product-tab-list tab-pane fade active in wrap_row">
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
                                                    Trạng thái
                                                </div>

                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" v-for="(item, rowIndex) in this.objData.rows" :key="item.rowIndex" v-show="!item.deleted">
                                                <div class="review-content-section flex-container">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                        <select-box-component :required="true" :name="`rows[${rowIndex}].size_id`" :data="this.productDetails[rowIndex].size_id">
                                                            <option value=""></option>
                                                            <option v-for="(value, key) in this.sizes" :key="key" :value="key">
                                                                {{ value }}
                                                            </option>
                                                        </select-box-component>
                                                    </div>

                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                        <select-box-component :required="true" :name="`rows[${rowIndex}].color_id`" :data="this.productDetails[rowIndex].color_id">
                                                            <option value=""></option>
                                                            <option v-for="(value, key) in this.colors" :key="key" :value="key">
                                                                {{ value }}
                                                            </option>
                                                        </select-box-component>
                                                    </div>

                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                        <select-box-component :required="true" :name="`rows[${rowIndex}].brand_id`" :data="this.productDetails[rowIndex].brand_id">
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
                                                            :name="`rows[${rowIndex}].quantity`"
                                                            :required="true"
                                                            placeholder=""
                                                            :data="this.productDetails[rowIndex].quantity"
                                                        />
                                                    </div>

                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                        <select-box-component :required="true" id="disp" :name="`rows[${rowIndex}].disp`" :data="this.display">
                                                            <option v-for="item in this.listStatus" :key="item.id" :value="item.id">
                                                                {{ item.label }}
                                                            </option>
                                                        </select-box-component>
                                                    </div>

                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                        <div class="group-item">
                                                            <button class="btn btn-danger" @click="removeRow(rowIndex)">Delete</button>
                                                        </div>
                                                    </div>



                                                </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
                                                    <button type="button" class="btn btn-ctl-bt waves-effect waves-light">Quay lại</button>
                                                    <button type="submit" class="btn btn-ctl-bt waves-effect waves-light m-r-10">Save</button>
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
