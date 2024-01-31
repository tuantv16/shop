
<script>
import { ErrorMessage, Field, Form, useForm, useSetFieldValue } from "vee-validate";
import * as yup from 'yup';
import InputComponent from '../../common/form/InputComponent.vue';
import SelectBoxComponent from '../../common/form/SelectBoxComponent.vue';
import YesNoComponent from '../../common/form/YesNoComponent.vue';
import TextareaComponent from '../../common/form/TextareaComponent.vue';
import { dataAction } from '../services/dataActions.js';
import CKEditor from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
    name: 'UpdateProductComponent',
    components: {
        Form, Field, ErrorMessage,
        InputComponent,
        SelectBoxComponent,
        YesNoComponent,
        TextareaComponent,
        ckeditor: CKEditor.component

    },
    data() {
        return {
            editor: ClassicEditor,
            objData: {
                id: '',
                category_id: '',
                brand_id: '',
                category_id: '',
                description: '',
                price: '',
                image: '',
                disp: '',
            },
            imageFile: null,
            imagePreviewUrl: '',
            isShowImage: true,
            isImageDelete: false
        }
    },
    created() {
        this.objData = this.products;
        if (this.objData.url_image == '') {
            this.isShowImage = false;
        }

    },
    methods: {

        handleChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.imageFile = file; // Gắn file với objData để gửi lên server
                this.isShowImage = true;
                this.isImageDelete = false;
                this.objData.url_image = URL.createObjectURL(file); // preview image

            }

        },

        onSubmit(dataInputs) {


            let formData = new FormData();
            // Thêm các trường dữ liệu vào formData
            for (let key in dataInputs) {
                formData.append(key, dataInputs[key]);
            }

            formData.append('image', this.imageFile); // append dữ liệu this.imageFile vào item imâge
            formData.append('is_image_deleted', this.isImageDelete);
            formData.append('description', this.objData.description);
            dataAction.updateData(formData, this.products.id).then(res => {
                if (res.data.status == 'success') {
                    window.location.href = '/manage/products';
                }
            });
        },
        backList() {
            window.location.href = "/manage/products";
        },
        uploadImage() {
            $("#uploadImage").trigger("click");
        },
        deleteImage() {
            this.objData.url_image = null;
            this.isShowImage = false;
            this.isImageDelete = true;
        },
        updateDescription(val) {
            this.objData.description = val;
            // this.$refs.productForm.setFieldValue('description', val);
        }
    },
    props: {
        categories: {
            type: Object,
            default: null
        },
        brands: {
            type: Object,
            default: null
        },
        products: {
            type: Object,
            default: null
        }

    },
    computed: {
        schema() {
            let msg = 'Đây là trường bắt buộc';
            let obj = {
                product_name: yup.string().max(255).required(msg),
                category_id: yup.string().required(msg),
                brand_id: yup.string().required(msg),
                description: yup.string().nullable(),
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
                                <li class="active"><a href="#description-pro"><i class="icon nalika-edit"
                                            aria-hidden="true"></i> Khu vực thêm sản phẩm</a></li>
                            </ul>
                            <Form @submit="onSubmit" ref="productForm" :initial-values="this.objData"
                                :validation-schema="schema" v-slot="{ setFieldValue }">
                                <div id="myTabContent" class="tab-content custom-product-edit">
                                    <div class="product-tab-list tab-pane fade active in" id="description-product">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">
                                                    <input-component title="Tên sản phẩm" id="product_name" :limit="255"
                                                        name="product_name" :required="true" placeholder=""
                                                        :data="this.objData.product_name" />

                                                    <div class="group-item">
                                                        <p class="p-normal" data-toggle="tooltip" title="">Mã sản phẩm: {{ this.objData.product_code }} </p>
                                                    </div>

                                                    <select-box-component title="Danh mục sản phẩm" :required="true"
                                                        id="category_id" name="category_id"
                                                        :data="String(this.objData.category_id)">
                                                        <option value="0"></option>
                                                        <option v-for="item in this.categories" :key="item.id"
                                                            :value="item.id">
                                                            <span
                                                                v-if="item.level == 2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                            <span
                                                                v-if="item.level == 3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                            {{ item.category_name }}
                                                        </option>
                                                    </select-box-component>

                                                    <div class="group-item">
                                                        <label>Hình ảnh</label>
                                                        <div id="show_image" style="width:150px; margin-bottom:10px"
                                                            v-if="isShowImage">
                                                            <img :src="this.objData.url_image" width="150" />
                                                            <button type="button" class="btn-delete-image"
                                                                @click="deleteImage">X</button>
                                                        </div>


                                                        <div class="input-group input-normal">
                                                            <Field name="image" v-slot="{ field }">
                                                                <input type="file" @change="handleChange" :ref="field.ref"
                                                                    id="uploadImage" style="display: none" />
                                                                <button type="button" class="btn btn-upload py-3 px-5"
                                                                    @click="uploadImage">Upload</button>
                                                            </Field>
                                                        </div>
                                                    </div>


                                                    <!-- <textarea-component
                                                        title="Mô tả"
                                                        id="description-pro"
                                                        :limit="500"
                                                        name="description"
                                                        :data="this.objData.description"
                                                   /> -->

                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">

                                                    <select-box-component title="Thương hiệu" :required="true" id="brand_id"
                                                        name="brand_id" :data="String(this.objData.brand_id)">
                                                        <option value="0"></option>
                                                        <option v-for="item in this.brands" :key="item.id" :value="item.id">
                                                            {{ item.name }}
                                                        </option>
                                                    </select-box-component>

                                                    <input-component title="Giá tiền" id="price" :limit="30" name="price"
                                                        :required="true" placeholder="" :data="this.objData.price" />

                                                    <yes-no-component title="Trạng thái" :data="this.objData.disp"
                                                        :required="true" name="disp" id="disp" labelFirst="Kích hoạt"
                                                        labelSecond="Vô hiệu hóa" />

                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="group-item">
                                                    <p class="p-normal" data-toggle="tooltip" title="Mô tả">Mô tả</p>
                                                    <div class="input-group input-normal manager-editor">
                                                        <ckeditor :editor="editor" name="description"
                                                            v-model="this.objData.description" @change="updateDescription">
                                                        </ckeditor>
                                                        <div class="message-error">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mg-t-30 mg-b-30">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center custom-pro-edt-ds">
                                                    <button type="button" class="btn btn-ctl-bt waves-effect waves-light"
                                                        @click="backList()">Quay lại</button>
                                                    <button type="submit"
                                                        class="btn btn-ctl-bt waves-effect waves-light m-r-10">Save</button>
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
</div></template>

<style>/* CSS cho component ở đây */</style>
