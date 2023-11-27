
<script>
import {ErrorMessage, Field, Form, useForm} from "vee-validate";
import * as yup from 'yup';
import InputComponent from '../../common/form/InputComponent.vue';
import SelectBoxComponent from '../../common/form/SelectBoxComponent.vue';
import YesNoComponent from '../../common/form/YesNoComponent.vue';
import TextareaComponent from '../../common/form/TextareaComponent.vue';
import {dataAction} from '../services/dataActions.js';

export default {
    name: 'CreateProductComponent',
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

        handleChange(event) {
            const file = event.target.files[0];

            if (file) {
                this.imageFile = file; // Gắn file với objData để gửi lên server
                console.log('Tên tệp: ', file.name);

                console.log('Kích thước: ', file.size); // Lấy size của file

                // let url = window.URL.createObjectURL(file);
                // console.log('Đường dẫn: ', url); // Lấy đường dẫn tạm thời của file

                let extension = file.name.split('.').pop();
                console.log('Đuôi mở rộng: ', extension); // Lấy đuôi mở rộng của file

                // Các xử lý khác...
            }


            // if (event.target.files.length > 0) {
            //         const file = event.target.files[0];
            //         let url = URL.createObjectURL(file);
            //         console.log('Đường dẫn: ', url);
            //         // Các xử lý khác...
            //     } else {
            //         console.log('Không có file nào được chọn');
            //     }

        },

        onSubmit(dataInputs) {

            let formData = new FormData();

            // Thêm các trường dữ liệu vào formData
            for (let key in dataInputs) {
                formData.append(key, dataInputs[key]);
            }

            formData.append('image', this.imageFile); // append dữ liệu this.imageFile vào item imâge



            // console.log(formData);
            // debugger;
            dataAction.saveData(formData).then(res => {


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
                                    <li class="active"><a href="#description"><i class="icon nalika-edit" aria-hidden="true"></i> Khu vực thêm sản phẩm</a></li>
                                </ul>
                                <Form @submit="onSubmit" :initial-values="this.objData" :validation-schema="schema" >
                                <div id="myTabContent" class="tab-content custom-product-edit">
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

                                                    <!-- <input-component title="Ảnh"
                                                        id="image"
                                                        :limit="255"
                                                        name="image"
                                                        placeholder=""
                                                    /> -->

                                                    <!-- <Field name="file" v-slot="{ handleChange, handleBlur }">

                                                        <input type="file" @change="handleChange" @blur="handleBlur" />
                                                    </Field> -->
                                                    <Field name="image" v-slot="{ field }">
                                                        <input type="file" @change="handleChange" :ref="field.ref" />
                                                    </Field>


                                                    <textarea-component
                                                        title="Mô tả"
                                                        id="description"
                                                        limit="500"
                                                        name="description"
                                                   />

                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="review-content-section">

                                                    <select-box-component title="Thương hiệu" :required="true" id="brand_id" name="brand_id">
                                                        <option value="0"></option>
                                                        <option v-for="item in this.brands" :key="item.id" :value="item.id">
                                                            {{ item.name }}
                                                        </option>
                                                    </select-box-component>

                                                    <input-component title="Giá tiền"
                                                        id="price"
                                                        :limit="30"
                                                        name="price"
                                                        :required="true"
                                                        placeholder=""
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
