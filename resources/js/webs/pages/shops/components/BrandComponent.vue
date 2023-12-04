
<script>
import {Field, ErrorMessage} from 'vee-validate';
import { useShopStore } from '../stores/filterShopStore';

export default {
    setup() {
        const store = useShopStore();

        return {
            store,
        };

    },
    components: {
        Field,
        ErrorMessage
    },
    mounted() {

    },
    props: {
        brands: {
            type: Object,
            default: null
        }
    },
    methods: {
        processSetBrand(sizeId) {
           this.store.setBrand(sizeId);
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
            <a data-toggle="collapse" data-target="#collapseTwo">Thương hiệu</a>
        </div>
        <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
            <div class="card-body">
                <div class="shop__sidebar__brand">
                    <ul>
                        <li v-for="item in brands" :key="item.id" @click.stop="processSetBrand(item.id)">
                            <a href="#">{{  item.name }}</a>
                            </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
