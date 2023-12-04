<script>
import {ErrorMessage, Field, Form} from "vee-validate";
import * as yup from 'yup';
import InputComponent from '../../../../common/form_style_2/InputComponent.vue';
import {dataAction} from '../services/dataActions.js';
export default {
    components: {
        Form, Field, ErrorMessage,
        InputComponent

    },
    data() {
        return {
            objData: {
                account: '',
                customer_name: '',
                password : '',
                repassword : ''
            },
        }
    },
    props: {

    },
    created() {


    },
    methods: {
        onSubmit(dataInputs) {
            dataAction.register(dataInputs).then(res => {
                if (res.data.status == 'success') {
                    alert('Đăng ký thành công');
                    location.reload();
                }
            });

            },
    },
    computed: {
        schema() {
            let msg = 'Đây là trường bắt buộc';
            let obj = {
                account: yup.string()
                    .min(6,'Tên tài khoản không được nhỏ hơn 6 ký tự')
                    .max(20, 'Tên tài khoản không được lớn hơn 50 ký tự')
                    .required(msg),
                customer_name: yup.string()
                    .min(6,'Tên người dùng không được nhỏ hơn 6 ký tự')
                    .max(20, 'Tên người dùng không được lớn hơn 50 ký tự')
                    .required(msg),
                password: yup.string()
                    .min(6,'Mật khẩu không được nhỏ hơn 6 ký tự')
                    .max(30, 'Mật khẩu không được lớn hơn 30 ký tự')
                    .required(msg),
                repassword: yup.string()
                    .min(6,'Nhập lại mật khẩu không được nhỏ hơn 6 ký tự')
                    .max(30, 'Nhập lại mật khẩu không được lớn hơn 30 ký tự')
                    .oneOf([yup.ref('password'), null], 'Nhập lại mật khẩu phải khớp với mật khẩu trên')
                    .required(msg),
            };

            return yup.object(obj);
        }
    }
}
</script>


<template>
<section id="register_customer">
        <div class="container">
            <div class="checkout__form">
                <Form @submit="onSubmit" :initial-values="this.objData" :validation-schema="schema" >
                    <div class="row">
                        <div class="col-lg-12 col-md-12" style="margin-bottom:100px">
                            <h6 class="checkout__title" style="text-align:center">Đăng ký tài khoản</h6>
                            <div class="row" style="justify-content:center">
                                <div class="col-md-8">

                                    <input-component title="Tên tài khoản"
                                        id="account"
                                        :limit="20"
                                        name="account"
                                        :required="true"
                                        placeholder=""
                                    />

                                    <input-component title="Tên người dùng"
                                        id="customer_name"
                                        :limit="20"
                                        name="customer_name"
                                        :required="true"
                                        placeholder=""
                                    />

                                    <input-component title="Mật khẩu"
                                        type="password"
                                        id="password"
                                        :limit="30"
                                        name="password"
                                        :required="true"
                                        placeholder=""
                                    />

                                    <input-component title="Nhập lại mật khẩu"
                                        type="password"
                                        id="repassword"
                                        :limit="30"
                                        name="repassword"
                                        :required="true"
                                        placeholder=""
                                    />

                                </div>
                            </div>


                            <div class="checkout__input btn_submit_customer">
                                <button type="submit" class="site-btn">Đăng ký</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>

</template>
