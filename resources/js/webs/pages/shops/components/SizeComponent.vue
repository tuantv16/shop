<script>
import {Field, ErrorMessage} from 'vee-validate';
import { useSizeStore } from '../stores/sizeStore';

export default {
    setup() {
        const store = useSizeStore();

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
            console.log('sizeId',sizeId);
           this.store.setSize(sizeId);
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
                    <label :for="`${item}`" v-for="(item, key) in this.sizes" :key="key" @click.stop="processSetSize(key)"> {{  item  }} </label>
                    <input type="radio" :id="`${item}`" name="size" class="d-none">
                </div>
            </div>
        </div>
    </div>
</template>
