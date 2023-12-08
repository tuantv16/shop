import axios from 'axios';

export const dataAction = {
    updateCart(cartData) {
        return axios.post('/api-v1/webs/carts/update-cart', cartData)
        .catch(function (error) {
            console.log(error.response);
        });
    },
}
