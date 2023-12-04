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
        sizes: {
            type: Object,
            default: null
        },
    },
    created() {
        console.log(this.sizes);

    },
    mounted() {

    },
    methods: {
        processSetSize(sizeId) {
           this.store.setSize(sizeId);
           let index = sizeId - 1;
           $(".shop__sidebar__size label").removeClass("active");
           $(".shop__sidebar__size label:eq("+ index +")").addClass('active');
        },

    }
}
</script>
<template>
    <div class="card">
        <div class="card-heading">
            <a data-toggle="collapse" data-target="#collapseFour">Kích cỡ</a>
        </div>
        <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
            <div class="card-body">
                <div class="shop__sidebar__size">
                    <label :for="`size_${key}`" v-for="(item, key) in this.sizes" :key="key" @click.stop="processSetSize(key)"> {{  item  }} </label>
                    <input type="radio" :id="`size_${key}`" name="size" class="d-none">
                </div>
            </div>
        </div>
    </div>
</template>
