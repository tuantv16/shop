import axios from 'axios';

export const dataAction = {
    getListProducts(endpoint) {
        return axios.get(endpoint)
        .catch(function (error) {
            console.log(error.response);
        });
    },


}
