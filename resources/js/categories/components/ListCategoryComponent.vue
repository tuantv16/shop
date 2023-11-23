
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
                parent_id: 0,
                level : '',
                disp : 1
            },
        }
    },
    created() {
        console.log(this.categories)
    },
    methods: {

        onSubmit(dataInputs) {

            if (dataInputs.parent_id == 0) {
                dataInputs.level = 1;
            }

            dataAction.saveData(dataInputs).then(res => {
                 if (res.data.status == 'success') {
                    //window.location.href = '/manage/categories';
                    location.reload();
                 }
            });

        },
        
    },
    props: {
        categories: {
            type: Object,
            default : null
        }
    },
    computed: {
        schema() {
            let msg = 'Đây là trường bắt buộc';
            let obj = {
                category_name: yup.string().max(150).required(msg),
                parent_id: yup.string().nullable(),
                level: yup.string().nullable(),
                disp: yup.string().max(1),

            };

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
