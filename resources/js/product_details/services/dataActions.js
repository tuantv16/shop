import axios from 'axios';

export const dataAction = {
    saveData(data) {
        return axios.post('/api/backend/product-details', data)
        .catch(function (error) {
            console.log(error.response);
        });
    },

}