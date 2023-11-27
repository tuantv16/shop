import axios from 'axios';

export const dataAction = {
    saveData(data) {
        return axios.post('/api/backend/products', data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .catch(function (error) {
            console.log(error.response);
        });
    },

    updateData(data, productId) {
        // return axios.put(`/api/backend/products/${productId}`, data, {
        //     headers: {
        //         'Content-Type': 'multipart/form-data'
        //     }
        // })
        // .catch(function (error) {
        //     console.log(error.response);
        // });

        return axios.post(`/api/backend/products/update-product`, data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .catch(function (error) {
            console.log(error.response);
        });
    },


}
