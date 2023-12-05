<script>

import {ErrorMessage, Field, Form} from "vee-validate";
import * as yup from 'yup';
import InputComponent from '../../../../common/form_style_2/InputComponent.vue';
import {dataAction} from '../services/dataActions.js';
import Cookies from 'js-cookie';

export default {
    components: {
        Form, Field, ErrorMessage,
        InputComponent

    },
    data() {
        return {
            objData: {
                account: '',
                password : '',
            },
        }
    },
    props: {

    },
    created() {


    },
    methods: {
        onSubmit(dataInputs) {
            dataAction.login(dataInputs).then(res => {
                if (res.data.status === 'success') {
                    //this.setCookieLogin(res.data.data.account);

                    $("body #account").val(res.data.data.account);
                    alert('Đăng nhập thành công');
                    window.location.href = "/";
                } else {
                    alert('Đăng nhập thất bại');
                    return false;
                }
            });

        },
        // setCookieLogin(value) {
        //     Cookies.set('account', value , { expires: 7 }); // cookie hết hạn sau 7 ngày

        // },
    },
    computed: {
        schema() {
            let msg = 'Đây là trường bắt buộc';
            let obj = {
                account: yup.string()
                    .min(6,'Tên tài khoản không được nhỏ hơn 6 ký tự')
                    .max(20, 'Tên tài khoản không được lớn hơn 50 ký tự')
                    .required(msg),
                password: yup.string()
                    .min(6,'Mật khẩu không được nhỏ hơn 6 ký tự')
                    .max(30, 'Mật khẩu không được lớn hơn 30 ký tự')
                    .required(msg)
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
                            <h6 class="checkout__title" style="text-align:center">Đăng nhập tài khoản</h6>
                            <div class="row" style="justify-content:center">
                                <div class="col-md-8">

                                    <input-component title="Tên tài khoản"
                                        id="account"
                                        :limit="20"
                                        name="account"
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

                                </div>
                            </div>


                            <div class="checkout__input btn_submit_customer">
                                <button type="submit" class="site-btn">Đăng nhập</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>

</template>
