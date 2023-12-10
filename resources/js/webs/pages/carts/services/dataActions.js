import axios from 'axios';

export const dataAction = {
    updateCart(cartData) {
        return axios.post('/api-v1/webs/carts/update-cart', cartData)
        .catch(function (error) {
            console.log(error.response);
        });
    },

    // Lấy đầy đủ dữ liệu ở db dựa vào dữ liệu lưu trũ ở LocalStorage (trường hợp khách hàng chưa login)
    getCartByLocalStorage(data) {
        return axios.post('/api-v1/webs/carts/get-cart-by-local-storage', data)
        .catch(function (error) {
            console.log(error.response);
        });
    },

    getFullInfoCartApi(data) {
        return axios.post('/api-v1/webs/carts/get-full-info-cart-api', data)
        .catch(function (error) {
            console.log(error.response);
        });
    }

}
