
<script>
import {ErrorMessage, Field, Form, useForm} from "vee-validate";
import InputComponent from '../../common/form/InputComponent.vue';
import PaginationComponent from '../../common/Pagination/PaginationComponent.vue';
import SelectBoxComponent from '../../common/form/SelectBoxComponent.vue';
import YesNoComponent from '../../common/form/YesNoComponent.vue';
import {
    URI
} from '../../common/config/main.js';
import moment from 'moment';

export default {
    name: 'ListSurveyComponent',
    components: {
        Form, Field, ErrorMessage,
        InputComponent,
        SelectBoxComponent,
        YesNoComponent,
        PaginationComponent

    },
    data() {
        return {
            objData: {
                topic: '',
                disp : '',
                page : 1,

            },
            totalPage: '',
            totalRecords: '',
        }
    },
    created() {
        this.objData.page = this.surveys.currentPage;
        this.totalPage = this.surveys.totalPage;
        this.totalRecords = this.surveys.totalRecords;

    },
    methods: {

        onSubmit(dataInputs) {

        },

        formatMyDate(dateString) {
            return moment(dateString).format('YYYY-MM-DD HH:mm:ss');
        }

    },
    props: {
        surveys: {
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
                            <h4>Danh sách khảo sát</h4>
                            <table>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên chủ đề</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th>
                                    <th></th>
                                </tr>
                                <tr v-for="(item, key) in this.surveys.data" :key="key">
                                    <td>{{  item.id }}</td>
                                    <td>{{  item.name }}</td>
                                    <td>
                                        <span class="pd-setting" v-if="item.disp == 1">Active</span>
                                        <button class="ds-setting" v-if="item.disp == 0">Disabled</button>
                                    </td>
                                    <td>{{ formatMyDate(item.created_at) }}</td>
                                    <td>{{ formatMyDate(item.updated_at) }}</td>

                                    <td>


                                        <a data-toggle="tooltip" title="Edit" class="pd-setting-ed btn" :href="`feedbacks/setting/${item.id}`">
                                            Setting
                                        </a>
                                        <a data-toggle="tooltip" title="Edit" class="pd-setting-ed btn" :href="`surveys/${item.id}/edit`"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a data-toggle="tooltip" title="Trash" class="pd-setting-ed btn"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            </table>

                            <pagination-component
                                :page = "this.surveys.currentPage"
                                :total-page = "this.surveys.totalPage"
                                :total-records = "this.surveys.totalRecords"
                            />

                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>


</template>
