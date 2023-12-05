import axios from 'axios';
axios.defaults.withCredentials = true;

export const dataAction = {

    register(data) {
        return axios.post('/api/webs/register', data)
        .catch(function (error) {
            console.log(error.response);
        });
    },
    login(data) {
        //const token = localStorage.getItem('token_login');
        let token = $("#token_login").val();
        return axios.post('/api/webs/login', data, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        })
        .catch(function (error) {
            console.log(error.response);
        });
    },

}
