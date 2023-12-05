import axios from 'axios';

export const dataAction = {
    saveData(data) {
        if (data.id > 0) {
            return axios.put(`/api-v1/backend/brands/${data.id}`, data)
                .catch(function (error) {
                    console.log(error.response);
                });
        } else {
            return axios.post('/api-v1/backend/brands', data)
                .catch(function (error) {
                    console.log(error.response);
                });
        }

    },

}
