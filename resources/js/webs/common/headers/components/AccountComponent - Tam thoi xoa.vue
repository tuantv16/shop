<script>

import { urlBase } from '../../../../common/config/main.js';

export default {
    components: {

    },
    data() {
        return {
            objData: {

            },
        }
    },
    props: {

    },
    created() {

    },
    methods: {

    }
}
</script>

<template>
      <div class="header__top__links">
            <a> Xin chào {{ $accountLogin }}</a>
            <a href="{{ asset('/logout.html')}}">Đăng xuất</a>
            <a href="{{ asset('/login.html')}}">Đăng nhập</a>
            <a href="{{ asset('/register.html')}}">Đăng ký</a>
            <a href="{{ asset('/faq.html') }}">FAQs</a>
        </div>
</template>

<
