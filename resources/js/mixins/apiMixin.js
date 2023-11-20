import axios from 'axios';

export const apiMixin = {
  methods: {
    async fetchData(url) {
      try {
        const response = await axios.get(url);
        return response.data;
      } catch (error) {
        console.error('There was an error fetching the data:', error);
        throw error; // Hoặc xử lý lỗi theo nhu cầu của ứng dụng
      }
    },
    async postData(url, data) {
      try {
        const response = await axios.post(url, data);
        return response.data;
      } catch (error) {
        console.error('There was an error posting the data:', error);
        throw error; // Hoặc xử lý lỗi theo nhu cầu của ứng dụng
      }
    },
    async putData(url, data) {
      try {
        const response = await axios.put(url, data);
        return response.data;
      } catch (error) {
        console.error('There was an error updating the data:', error);
        throw error; // Hoặc xử lý lỗi theo nhu cầu của ứng dụng
      }
    },
    async deleteData(url) {
      try {
        const response = await axios.delete(url);
        return response.data;
      } catch (error) {
        console.error('There was an error deleting the data:', error);
        throw error; // Hoặc xử lý lỗi theo nhu cầu của ứng dụng
      }
    },
    // Bạn có thể thêm các phương thức HTTP khác như PATCH, OPTIONS, etc.
  },
};
