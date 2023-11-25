
<script>
import {ErrorMessage, Field, Form, useForm} from "vee-validate";
import * as yup from 'yup';
import InputComponent from '../../common/Form/InputComponent.vue';
import SelectBoxComponent from '../../common/Form/SelectBoxComponent.vue';
import YesNoComponent from '../../common/Form/YesNoComponent.vue';
import {dataAction} from '../services/dataActions.js';
import moment from 'moment'

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

        },

    },
    props: {
        categories: {
            type: Object,
            default : null
        }
    },
    computed: {

    }
}

</script>

<template>

    <div class="single-product-tab-area mg-b-30">
            <!-- Single pro tab review Start-->

            <div class="product-status mg-b-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <h4>Products List</h4>
                            <div class="add-product">
                                <a href="product-edit.html">Thêm danh mục</a>
                            </div>
                            <table>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên danh mục</th>
                                    <th>Status</th>
                                    <th>Cấp độ</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th>
                                    <th></th>
                                </tr>
                                <tr v-for="(item, key) in this.categories" :key="key">
                                    <td>{{  item.id }}</td>
                                    <td>{{  item.category_name }}</td>
                                    <td>
                                        <button class="pd-setting" v-if="item.disp == 1">Active</button>
                                        <button class="ds-setting" v-if="item.disp == 0">Disabled</button>
                                    </td>
                                    <td>{{ item.level }}</td>
                                    <td>{{ item.created_at }}</td>
                                    <td>{{item.updated_at }}</td>

                                    <td>
                                        <a data-toggle="tooltip" title="Edit" class="pd-setting-ed btn" href="manage/categories/item.id/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a data-toggle="tooltip" title="Trash" class="pd-setting-ed btn"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            </table>
                            <div class="custom-pagination">
								<ul class="pagination">
									<li class="page-item"><a class="page-link" href="#">Previous</a></li>
									<li class="page-item"><a class="page-link" href="#">1</a></li>
									<li class="page-item"><a class="page-link" href="#">2</a></li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<li class="page-item"><a class="page-link" href="#">Next</a></li>
								</ul>
                            </div>
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
