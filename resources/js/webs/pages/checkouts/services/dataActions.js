import axios from 'axios';
// axios.defaults.withCredentials = true;  Bỏ dòng này vì không cần thông tin xác thực (tránh lỗi CORS)

export const dataAction = {

    getApiProvinces() {
        return axios.get('https://vapi.vnappmob.com/api/province')
        .catch(function (error) {
            console.log(error.response);
        });
    },

    getApiDistricts(province_id) {
        return axios.get(`https://vapi.vnappmob.com/api/province/district/${province_id}`)
        .catch(function (error) {
            console.log(error.response);
        });
    },

    getApiWards(district_id) {
        return axios.get(`https://vapi.vnappmob.com/api/province/ward/${district_id}`)
        .catch(function (error) {
            console.log(error.response);
        });
    },

    saveOrder(data) {
        return axios.post('/api-v1/webs/orders/save-order', data)
        .catch(function (error) {
            console.log(error.response);
        });
    }
}
