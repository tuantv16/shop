import axios from 'axios';

export const dataAction = {
    saveData(data) {
        return axios.post('/api-v1/backend/products', data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .catch(function (error) {
            console.log(error.response);
        });
    },

    updateData(data, productId) {

        return axios.post(`/api-v1/backend/products/update-product`, data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .catch(function (error) {
            console.log(error.response);
        });
    },


}
