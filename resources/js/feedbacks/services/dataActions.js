import axios from 'axios';

export const dataAction = {
    saveData(data) {
        return axios.post('/api-v1/backend/feedbacks/setting', data)
        .catch(function (error) {
            console.log(error.response);
        });
    },

}
