
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
        categories: {
            type: Object,
            default: null
        },
    },
    created() {

    },
    methods: {
        processSetCategory(id) {
           this.store.setCategory(id);
        },

    },
    mounted() {

    }
}
</script>
<template>
    <div class="container-category">
        <div class="card width"  >
        <div class="card-heading">
            <a data-toggle="collapse" data-target="#collapseOne">Danh mục</a>
        </div>
        <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
            <div class="card-body">
                <div class="shop__sidebar__categories">
                    <ul class="nice-scroll scrollbar" id="scrollbar2">
                        <li class="item" v-for="item in this.categories" :key="item.id">
                            <a href="#">{{ item.category_name }}</a>
                            <ul class="child" style="display:none">
                                <li v-for="row in item.child" :key="item.id"  @click="processSetCategory(row.id)">
                                    <a href="#"> {{ row.category_name  }} {{ "(" + row.total + ")"}}</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div></div>

</template>
