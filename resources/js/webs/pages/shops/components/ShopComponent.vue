

<script>
import CategoryComponent from './CategoryComponent.vue';
import BrandComponent from './BrandComponent.vue';

import PriceComponent from './PriceComponent.vue';
import SizeComponent from './SizeComponent.vue';

import ColorComponent from './ColorComponent.vue';
import TagComponent from './TagComponent.vue';
import PaginationComponent from './PaginationComponent.vue';

import { useShopStore } from '../stores/filterShopStore';
import { watch } from 'vue';

import {dataAction} from '../services/dataActions.js';

import { urlBase } from '../../../../common/config/main.js';
import { ref } from 'vue';

export default {
    components: {
        CategoryComponent,
        BrandComponent,
        PriceComponent,
        SizeComponent,
        ColorComponent,
        TagComponent,
        PaginationComponent
    },
    data() {
        return {
            objData: {

            },
            searchKeyword: '',
        }
    },
    setup() {
    const shopStore = useShopStore();

    // const sizeId = shopStore.size_id;
    const dataProducts = ref([]); // Sử dụng ref để theo dõi giá trị dataProducts
    const currentPage = ref([]);
    const totalPage = ref([]);
    const totalRecords = ref([]);
    // call api query dữ liệu trả về dataProducts(kết quả search mới)
    const getProducts = (objUrl) => {
        let endpoint = `${urlBase}/api/webs/shop/get-list-products${objUrl.search}`;
        dataAction.getListProducts(endpoint).then(res => {
            if (res.data.status === 'success') {
                dataProducts.value = res.data.data; // Gán giá trị cho dataProducts.value

                // dành cho phân trang
                currentPage.value = res.data.data.currentPage;
                totalPage.value = res.data.data.totalPage;
                totalRecords.value = res.data.data.totalRecords;

            }
        });
    };

    watch([
        () => shopStore.category_id,
        () => shopStore.brand_id,
        () => shopStore.price_range,
        () => shopStore.size_id,
        () => shopStore.color_id,
        () => shopStore.sort_price,
        () => shopStore.keyword,
        () => shopStore.page
    ], ([
        newCategoryId,
        newBrandId,
        newPriceRange,
        newSizeId,
        newColorId,
        newSortPrice,
        newKeyword,
        newPage,

    ]) => {
        const currentUrl = new URL(window.location);
        currentUrl.searchParams.set('category_id', newCategoryId);
        currentUrl.searchParams.set('brand_id', newBrandId);
        currentUrl.searchParams.set('price_range', newPriceRange);
        currentUrl.searchParams.set('size_id', newSizeId);
        currentUrl.searchParams.set('color_id', newColorId);
        currentUrl.searchParams.set('sort_price', newSortPrice);
        currentUrl.searchParams.set('keyword', newKeyword);
        currentUrl.searchParams.set('page', newPage);
        window.history.pushState({}, '', currentUrl); //hình thành url mới đầy đủ param (dạng...?size_id=1&color_id=3)
        getProducts(currentUrl); // thực hiện query dữ liệu
    });

    return {
        shopStore,
        // sizeId: shopStore.size_id,
        // colorId: shopStore.color_id,
        dataProducts, // Trả về listProducts như một ref

        //dành cho phân trang
        currentPage,
        totalPage,
        totalRecords
    };
},

    mounted() {

    },
    props: {
        sizes: {
            type: Object,
            default: null
        },
        colors: {
            type: Object,
            default: null
        },
        prices: {
            type: Object,
            default: null
        },
        categories: {
            type: Object,
            default: null
        },
        brands: {
            type: Object,
            default: null
        },
        listProducts: {
            type: Object,
            default: null
        },

    },
    created() {
        // console.log(this.listProducts);
        // debugger;

    },
    methods: {
        // getProducts(url) {
        //     alert(111);
        //     dataAction.getListProducts(url).then(res => {
        //         console.log(url);
        //          if (res.data.status == 'success') {
        //             //location.reload();
        //             this.listProducts = res.data.data;
        //          }
        //     });
        // }

        handleSetSortPrice(e) {
            this.shopStore.setSortPrice(e.target.value);
        },
        handleSetKeyword() {
            const keyword = this.searchKeyword;
            this.shopStore.setKeyword(keyword);
        },
        handleSetPage(val) {
            this.shopStore.setPage(val);
        }
    }
}
</script>

<template>
    hihi {{ currentPage }}
    haha{{  totalPage }}

    hehe {{totalRecords  }}
    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="#">
                                <input type="text" name="keyword" v-model="searchKeyword"  placeholder="Search...">
                                <button type="button" @click="handleSetKeyword()"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">

                                <category-component :categories = categories />

                                <brand-component :brands = brands />

                                <price-component :prices = prices />

                                <size-component :sizes = sizes />

                                <color-component :colors = colors />

                                <tag-component />

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>Showing 1–12 of 126 results</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sắp xếp theo mức giá:</p>
                                    <select name="sort_price" @input="handleSetSortPrice($event)">
                                        <option value="asc">Thấp đến cao</option>
                                        <option value="desc">Cao đến thấp</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6" v-for="item in dataProducts.data ?? listProducts.data" :key="item.id">
                            <div class="product__item sale">
                                <div class="product__item__pic set-bg" :data-setbg="`/storage/product_images/${item.image}`"  :style="`background-image: url(/storage/product_images/${item.image});`">
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="frontend/img/icon/heart.png" alt=""></a></li>
                                        <li><a href="#"><img src="frontend/img/icon/compare.png" alt=""> <span>Compare</span></a>
                                        </li>
                                        <li><a href="#"><img src="frontend/img/icon/search.png" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{ item.product_name }}</h6>
                                    <a href="#" class="add-cart">+ Add To Cart</a>
                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>{{ item.price }}</h5>
                                    <div class="product__color__select">
                                        <label for="pc-4">
                                            <input type="radio" id="pc-4">
                                        </label>
                                        <label class="active black" for="pc-5">
                                            <input type="radio" id="pc-5">
                                        </label>
                                        <label class="grey" for="pc-6">
                                            <input type="radio" id="pc-6">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- phân trang -->
                    <pagination-component
                        :current-page = currentPage
                        :total-page = totalPage
                        :total-records = totalRecords
                        @handle-click-number-page = "handleSetPage"
                    />

                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
</template>
