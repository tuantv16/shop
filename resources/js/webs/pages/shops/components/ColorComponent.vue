

<script>
import {Field, ErrorMessage} from 'vee-validate';
import { useShopStore } from '../stores/filterShopStore';
export default {
    setup() {
        const store = useShopStore();

        return {
            store, // expose store to the template
        };

    },
    components: {
        Field,
        ErrorMessage
    },
    props: {
        colors: {
            type: Object,
            default: null
        },
    },
    mounted() {

    },
    methods: {
        processSetColor(key) {
            this.store.setColor(key);
        }
    }
}
</script>
<template>
<div class="card">
    <div class="card-heading">
        <a data-toggle="collapse" data-target="#collapseFive">Màu sắc</a>
    </div>
    <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
        <div class="card-body">
            <div class="shop__sidebar__color">
                <!--
                    c-1 : đen
                    c-2: Xanh navi
                    c-3: Vàng
                    c-4: Ghi
                    c-5: Nâu
                    c-6: Hồng
                    c-7: tím
                    c-8: Đỏ
                    c-9: Trắng
                 -->
                <label :for="`${item}`" v-for="(item, key) in this.colors" :key="key" :class="`${item}`" @click="processSetColor(key)">
                    <input type="radio" :id="`${item}`" name="color">
                </label>

            </div>
        </div>
    </div>
</div>
</template>
