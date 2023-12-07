
import Swal from 'sweetalert2';
export const apiMixin = {
  methods: {
    messageSuccess() {
        if (window.successData && window.successData === true) {
            delete window.successData;
            //alert('Bạn đã lưu thông tin thành công !');
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: 'Bạn đã lưu thành công!',
              });
        }
    },


  },
};

