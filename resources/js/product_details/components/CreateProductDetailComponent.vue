
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
        YesNoComponent,
        TextareaComponent

    },
    data() {
        return {
            objData: {
                category_id: '',
                brand_id: '',
                category_id: '',
                description : '',
                price : '',
                image : '',
                disp : 1
            },
            imageFile: null
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

        }
    },
    props: {
        categories: {
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
                category_id: yup.string().required(msg),
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
                                <Form @submit="onSubmit" :initial-values="this.objData" :validation-schema="schema" >
                                <div id="myTabContent" class="tab-content">
                                    <div class="product-tab-list tab-pane fade active in" id="description-product">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <input-component title="Tên sản phẩm"
                                                        id="product_name"
                                                        :limit="255"
                                                        name="product_name"
                                                        :required="true"
                                                        placeholder=""
                                                    />

                                                    <select-box-component title="Danh mục sản phẩm" :required="true" id="category_id" name="category_id">
                                                        <option value="0"></option>
                                                        <option v-for="item in this.categories" :key="item.id" :value="item.id">
                                                            <span v-if="item.level == 2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                            <span v-if="item.level == 3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                            {{ item.category_name }}
                                                        </option>
                                                    </select-box-component>

                                     
                                                    <textarea-component
                                                        title="Mô tả"
                                                        id="description"
                                                        limit="500"
                                                        name="description"
                                                   />

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
