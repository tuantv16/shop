
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
                category_name: '',
                parent_id: 0,
                level : '',
                disp : 1
            },
        }
    },
    created() {

    },
    methods: {

        onSubmit(dataInputs) {

            if (dataInputs.parent_id == 0) {
                dataInputs.level = 1;
            }

            dataAction.saveData(dataInputs).then(res => {

                // console.log(res);
                // debugger;
                 if (res.data.status == 'success') {
                    //window.location.href = '/manage/categories';
                    location.reload();
                    //  this.msgSuccess('情報を追加しました。');
                    //  this.goToPageEdit(res.data.data.item_id, this.getFormId());
                 }
            });

        },
        setValueLevel(value) {
            if (value == 0) {
                this.objData.level = 1;
            }

            if (value > 0) {
                const selectedItem = this.cbCategory.find(item => item.id === value);
                this.objData.level = selectedItem.level + 1;
            }
        }
    },
    props: {
        cbCategory: {
            type: Object,
            default : null
        }
    },
    computed: {
        schema() {
            let msg = 'Đây là trường bắt buộc';
            let obj = {
                category_name: yup.string().max(150).required(msg),
                prefix: yup.string().max(30).required(msg),
                parent_id: yup.string().nullable(),
                level: yup.string().nullable(),
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
                                    <li class="active"><a href="#description"><i class="icon nalika-edit" aria-hidden="true"></i> Khu vực thêm danh mục</a></li>
                                </ul>
                                <Form @submit="onSubmit" :initial-values="this.objData" id="createSettingInputClients" :validation-schema="schema" >
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <div class="product-tab-list tab-pane fade active in" id="description">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <input-component title="Tên danh mục"
                                                        id="category_name"
                                                        :limit="255"
                                                        name="category_name"
                                                        :required="true"
                                                        placeholder=""
                                                    />

                                                    <input-component title="Tiền tố"
                                                        id="prefix"
                                                        :limit="30"
                                                        name="prefix"
                                                        :required="true"
                                                        placeholder=""
                                                    />

                                                    <select-box-component title="Thuộc danh mục" id="parent_id" name="parent_id" :data="this.objData.parent_id" @change="setValueLevel">
                                                        <option value="0"></option>
                                                        <option v-for="item in this.cbCategory" :key="item.id" :value="item.id">
                                                            <span v-if="item.level == 2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                            <span v-if="item.level == 3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                            {{ item.category_name }}
                                                        </option>
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
                                                        :data="this.objData.level"
                                                        placeholder=""
                                                        disabled=""
                                                        class="input-disabled"

                                                    />

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
