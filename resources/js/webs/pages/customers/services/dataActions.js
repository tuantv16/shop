import axios from 'axios';
axios.defaults.withCredentials = true;

export const dataAction = {

    register(data) {
        return axios.post('/api-v1/webs/register', data)
        .catch(function (error) {
            console.log(error.response);
        });
    },
    login(data) {
        //const token = localStorage.getItem('token_login');
        let token = $("#token_login").val();
        return axios.post('/api-v1/webs/login', data, {
            headers: {
                Authorization: `Bearer ${token}`
            },
            withCredentials: true
        })
        .catch(function (error) {
            console.log(error.response);
        });
    },

}
