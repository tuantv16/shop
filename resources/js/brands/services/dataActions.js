import axios from 'axios';

export const dataAction = {
    saveData(data) {
        if (data.id > 0) {
            return axios.put(`/api/backend/brands/${data.id}`, data)
                .catch(function (error) {
                    console.log(error.response);
                });
        } else {
            return axios.post('/api/backend/brands', data)
                .catch(function (error) {
                    console.log(error.response);
                });
        }
      
    },

}
