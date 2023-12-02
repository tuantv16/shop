
<script>

    import BannerComponent from './BannerComponent.vue';
    import CanvasMenuComponent from './CanvasMenuComponent.vue';
    import HeroComponent from './HeroComponent.vue';
    import InstagramComponent from './InstagramComponent.vue';
    import LatestBlogHomeComponent from './LatestBlogHomeComponent.vue';
    import ProductHomeComponent from './ProductHomeComponent.vue';
    import CategoryHomeComponent from './CategoryHomeComponent.vue';
    // import HeaderComponent from '../../../common/components/HeaderComponent.vue';
    // import FooterComponent from '../../../common/components/FooterComponent.vue';

    export default {
        name: 'CreateCategoryComponent',
        components: {
            BannerComponent,
            CanvasMenuComponent,

            HeroComponent,
            InstagramComponent,
            LatestBlogHomeComponent,
            ProductHomeComponent,
            CategoryHomeComponent,

        },
        created() {
            alert(33333333);
        },
        mounted() {

        }
    }
</script>

<template>
    <!--
     <div id="preloder">
        <div class="loader"></div>
    </div>
    -->

    <!--
    <div class="offcanvas-menu-overlay"></div>
    <canvas-menu-component />
    -->

    <!--
    <header-component />
    -->

    <!-- Hero Section Begin -->
    <hero-component />
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <banner-component />
    <!-- Banner Section End -->

    <!-- Product Section Begin -->
    <product-home-component />
    <!-- Product Section End -->

    <!-- Categories Section Begin -->
    <category-home-component />

    <!-- Categories Section End -->

    <!-- Instagram Section Begin -->
    <instagram-component />
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->

    <latest-blog-home-component />
    <!-- Latest Blog Section End -->

    <footer-component />

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

</template>


