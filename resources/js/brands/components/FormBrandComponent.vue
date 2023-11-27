
<script>
import {ErrorMessage, Field, Form, useForm} from "vee-validate";
import * as yup from 'yup';
import InputComponent from '../../common/form/InputComponent.vue';
import SelectBoxComponent from '../../common/form/SelectBoxComponent.vue';
import YesNoComponent from '../../common/form/YesNoComponent.vue';
import {dataAction} from '../services/dataActions.js';

export default {
    name: 'CreateCategoryComponent',
    components: {
        Form, Field, ErrorMessage,
        InputComponent,
        SelectBoxComponent,
        YesNoComponent

    },
    data() {
        return {
            objData: {
                id: '',
                name: '',
                disp : 1
            },
        }
    },
    props: {
        brands: {
            type: Object,
            default : null
        }
    },
    created() {
        if (this.brands.hasOwnProperty('id')) {
            this.objData = this.brands;
        }
      
    },
    methods: {

        onSubmit(dataInputs) {
            dataAction.saveData(dataInputs).then(res => {

            });
        },

    },
    computed: {
        schema() {
            let msg = 'Đây là trường bắt buộc';
            let obj = {
                name: yup.string().max(255).required(msg),
                disp: yup.string().max(1),

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
                                    <li class="active"><a href="#description"><i class="icon nalika-edit" aria-hidden="true"></i> Thêm nhãn hàng</a></li>
                                </ul>
                                <Form @submit="onSubmit" :initial-values="this.objData" id="createSettingInputClients" :validation-schema="schema" >
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <div class="product-tab-list tab-pane fade active in" id="description">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <input-component title="Tên nhãn hàng"
                                                        id="name"
                                                        :limit="255"
                                                        name="name"
                                                        :required="true"
                                                        placeholder=""
                                                        :data="this.objData.name"
                                                    />

                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <yes-no-component
                                                        title="Trạng thái"
                                                        :data="this.objData.disp"
                                                        :required="true"
                                                        name="disp"
                                                        id="disp"
                                                        labelFirst = "Kích hoạt"
                                                        labelSecond = "Vô hiệu hóa"
                                                    />

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
