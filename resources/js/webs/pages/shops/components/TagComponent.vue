<script>
import {Field, ErrorMessage} from 'vee-validate';

export default {
    components: {
        Field,
        ErrorMessage
    },

    mounted() {

    }
}
</script>
<template>
    <div class="card">
        <div class="card-heading">
            <a data-toggle="collapse" data-target="#collapseSix">Tags</a>
        </div>
        <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
            <div class="card-body">
                <div class="shop__sidebar__tags">
                    <a href="#">Product</a>
                    <a href="#">Bags</a>
                    <a href="#">Shoes</a>
                    <a href="#">Fashio</a>
                    <a href="#">Clothing</a>
                    <a href="#">Hats</a>
                    <a href="#">Accessories</a>
                </div>
            </div>
        </div>
    </div>
</template>
