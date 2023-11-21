import axios from 'axios';

export const dataAction = {
    saveData(data) {
        return axios.post('/api/backend/categories', data)
        .catch(function (error) {
            console.log(error.response);
        });
    },

}
