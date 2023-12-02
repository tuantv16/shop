

<script>
import {Field, ErrorMessage} from 'vee-validate';

export default {
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
                        <li v-for="(item, key) in this.prices" :key="key"><a href="#">{{  item  }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
