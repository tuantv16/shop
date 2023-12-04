import axios from 'axios';

export const dataAction = {

    register(data) {
        return axios.post('/api/webs/register', data)
        .catch(function (error) {
            console.log(error.response);
        });
    },
    login(data) {
        return axios.post('/api/webs/login', data)
        .catch(function (error) {
            console.log(error.response);
        });
    },

}
