
<script>
import {ErrorMessage, Field, Form, useForm} from "vee-validate";
import * as yup from 'yup';
import InputComponent from '../../common/Form/InputComponent.vue';
import SelectBoxComponent from '../../common/Form/SelectBoxComponent.vue';
import YesNoComponent from '../../common/Form/YesNoComponent.vue';
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
                category_name: '',
                parent_id: '',
                level : '',
                disp : ''
            },
            categoryIds: [
                { id: 1, category_name: 'Đồ ngủ'},
                { id: 2, category_name: 'Đồ nam'},
                { id: 3, category_name: 'Đồ gia dụng'},
            ]
        }
    },
    created() {

    },
    methods: {

        onSubmit(dataInputs) {
            dataAction.saveData(dataInputs).then(res => {

                 if (res.status == 'success') {
                    window.location.href = '/manage/categories';
                    //  this.msgSuccess('情報を追加しました。');
                    //  this.goToPageEdit(res.data.data.item_id, this.getFormId());
                 }
            });

        },
    },
    computed: {
        schema() {
            let msg = 'Đây là trường bắt buộc';
            let obj = {
                category_name: yup.string().max(150).required(msg),
                parent_id: yup.string().nullable(),
                level: yup.string().required(msg),
                disp: yup.string().max(1),

            };

            // let ruleMaxLength = yup.string().nullable(true);
            // if (this.statusLimitCharacters) { // show item will check validate
            //     ruleMaxLength = yup.string().nullable(true).test('len', '5000以内で入力してください', val => val <= 5000);
            // }

            // let validateCustoms = {
            //    maxlength: ruleMaxLength
            // };

            //Object.assign(obj, validateCustoms);
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
                                    <li class="active"><a href="#description"><i class="icon nalika-edit" aria-hidden="true"></i> Khu vực thêm sản phẩm</a></li>
                                </ul>
                                <Form @submit="onSubmit" :initial-values="this.objData" id="createSettingInputClients" :validation-schema="schema" >
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <div class="product-tab-list tab-pane fade active in" id="description">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <input-component title="Tên danh mục"
                                                        id="category_name"
                                                        limit="5"
                                                        name="category_name"
                                                        :required="true"
                                                        placeholder=""
                                                    />

                                                    <select-box-component
                                                        title="Thuộc danh mục" id="parent_id" name="parent_id" data="">
                                                        <option value="0"></option>
                                                        <option v-for="item in categoryIds" :key="item.id" :value="item.id" >{{ item.category_name }}</option>
                                                    </select-box-component>

                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">

                                                    <input-component title="Cấp độ"
                                                        type="number"
                                                        id="level"
                                                        name="level"
                                                        :required="true"
                                                        placeholder=""
                                                    />

                                                    <yes-no-component
                                                        title="Trạng thái"
                                                        :data="this.objData.disp"
                                                        required="true"
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
