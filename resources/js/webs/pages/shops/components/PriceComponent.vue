

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
        prices: {
            type: Object,
            default: null
        },
    },
    mounted() {

    },
    methods: {
        processPriceRange(id) {
           this.store.setPriceRange(id);
        //    let index = sizeId - 1;
        //    $(".shop__sidebar__size label").removeClass("active");
        //    $(".shop__sidebar__size label:eq("+ index +")").addClass('active');
        },
    }
}
</script>
<template>
    <div class="card">
        <div class="card-heading">
            <a data-toggle="collapse" data-target="#collapseThree">Mức giá</a>
        </div>
        <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
            <div class="card-body">
                <div class="shop__sidebar__price">
                    <ul>
                        <li v-for="(item, key) in this.prices" :key="key" @click="processPriceRange(key)">
                            <a href="#">{{  item  }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
