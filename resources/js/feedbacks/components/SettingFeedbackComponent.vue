
<script>
import {ErrorMessage, Field, Form, useForm, FieldArray, useFieldArray} from "vee-validate";
import * as yup from 'yup';
import InputComponent from '../../common/form_style_1/InputComponent.vue';
import SelectBoxComponent from '../../common/form_style_1/SelectBoxComponent.vue';
import {dataAction} from '../services/dataActions.js';

import { FeedbackValidator } from "../settings.validate.js";

import { urlBase } from '../../common/config/main.js';

const rowSchema = yup.object().shape({
  name: yup.string().required('Dữ liệu là bắt buộc').max(255, 'Dữ liệu không được dài quá 255 ký tự'),
  disp: yup.string().required('Trường hiển thị là bắt buộc'),
  // Thêm các quy tắc khác nếu có
});

const formSchema = yup.object().shape({
  rows: yup.array().of(rowSchema).required('Mảng câu trả lời không được để trống')
});

export default {
    name: 'SettingFeedbackComponent',
    components: {
        Form, Field, ErrorMessage,
        InputComponent,
        SelectBoxComponent,
        FieldArray
    },
    setup() {
        const { handleSubmit, initialValues } = useForm({
            initialValues: {
                rows: []
            },
        });

        const { fields, remove, push } = useFieldArray('rows');

        return {
            fields,
            remove,
            push,
            // addRow,
            initialValues,
            //handleSubmit
        };
    },
    data() {
        return {
            limitRow: 5,
            objData: {
                survey_id: '',
                rows: []
            },
            display: '1',
            detailCount: 1,
            statusButtonAdd: true,
            listStatus: [
                { id: 1, label: 'Hiển thị' },
                { id: 0, label: 'Vô hiệu hóa' },
            ],
            rowInit: {
                name: '',
                disp: 1
            }
        }
    },
    created() {
        if (this.feedbacks.length > 0) {
            this.objData.rows = this.feedbacks;
            this.detailCount = this.feedbacks.length;
        } else {
            this.objData.rows.push(this.rowInit);
        }
    },
    methods: {
        onSubmit(dataInputs) {

            dataInputs.survey_id = parseInt(this.surveyId);

            dataAction.saveData(dataInputs).then(res => {
                if (res.data.status == 'success') {
                    location.reload();
                }
            });

        },
        checkStatusBtnAdd(number) {
            this.statusButtonAdd = number < this.limitRow ? true : false;
        },
        addRow() {
            this.detailCount++;
            this.statusButtonAdd = this.detailCount == this.limitRow ? false : true;
            $("#btnAdd").trigger('click');
        },
        goToback() {
            window.location.href= `${urlBase}/manage/feedbacks`;
        }

    },
    props: {
        feedbacks: {
            type: Object,
            default : null
        },
        surveyId: {
            type: Number,
            default : null
        },
    },
    computed: {
        formSchema() {
            return formSchema;
        }

        // schema() {

        // }

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
                                    <li class="active"><a href="#description"><i class="icon nalika-edit" aria-hidden="true"></i> Thiết lập câu trả lời khảo sát</a></li>
                                </ul>

                                <Form @submit="onSubmit" :initial-values="this.objData" :validation-schema="formSchema">
                                <div id="myTabContent" class="tab-content">
                                    <div class="product-tab-list tab-pane fade active in wrap_row">
                                        <div class="row">

                                            <div>
                                                <div class="col-lg-5 col-md-2 col-sm-2 col-xs-6">
                                                    Câu trả lời khảo sát
                                                </div>

                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                    Trạng thái
                                                </div>

                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">

                                                </div>
                                            </div>
                                        </div>
                                        <FieldArray name="rows" v-slot="{ remove, push, fields }">
                                        <div class="row" v-for="(field, idx) in fields" :key="field.key">
                                                    <div class="col-lg-5 col-md-2 col-sm-2 col-xs-6">
                                                        <Field v-slot="{field, errors}" :name="`rows[${idx}].name`">
                                                            <input
                                                                type="text"
                                                                v-bind="field"
                                                                :name="`rows[${idx}].name`"
                                                                :class="{ 'is-invalid': errors.length > 0}"
                                                                class="form-control"
                                                                maxlength="20"
                                                                :required="true"
                                                            />
                                                        </Field>
                                                        <ErrorMessage :name="`rows[${idx}].name`" />
                                                    </div>

                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                        <Field
                                                            :name="`rows[${idx}].disp`"
                                                            v-slot="{ field, meta }">

                                                            <select
                                                                @blur="() => {
                                                                    touchedDetail = true;
                                                                }"
                                                                :name="`rows[${idx}].disp`"
                                                                v-bind="field"
                                                                class="form-control item"
                                                                :data="`rows[${idx}].disp`"
                                                                :required="true"
                                                                >
                                                                <option v-for="row in listStatus" :value="row.id">
                                                                    {{ row.label }}
                                                                </option>

                                                            </select>
                                                        </Field>
                                                        <ErrorMessage :name="`rows[idx].disp`" />

                                                    </div>

                                                    <input type="hidden" id="btnAdd" @click="() => {push(this.rowInit)}">


                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                                        <div class="group-item">
                                                            <button class="btn btn-danger"  @click="() => {
                                                                    detailCount--;
                                                                    remove(idx)
                                                                    checkStatusBtnAdd(detailCount);
                                                                }">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>


                                        </FieldArray>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="group-item">
                                                    <button class="btn btn-primary" @click="() => {
                                                        addRow()
                                                        // hàm khác nữa ....
                                                    }" v-if="statusButtonAdd" >Add</button>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
                                                    <button type="button" class="btn btn-ctl-bt waves-effect waves-light" @click="goToback()">Quay lại</button>
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
