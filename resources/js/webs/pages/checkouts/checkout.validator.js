import * as yup from "yup";
// import {Utility} from "../../commons/utility.js";
// import {
//     MSG_INPUT_REQUIRED,
//     MSG_MAXLENGTH,
//     MSG_TYPE_ERROR,
//     MSG_UNIQUE_FIELD
// } from "../../constants/common-messages.js";



export const checkoutValidator = (ctx) => {
    const vietnameseRegex = /^[a-zA-Z0-9_.,\sÀÁẢÃẠĂẰẮẲẴẶÂẦẤẨẪẬĐÈÉẺẼẸÊỀẾỂỄỆÌÍỈĨỊÒÓỎÕỌÔỒỐỔỖỘƠỜỚỞỠỢÙÚỦŨỤƯỪỨỬỮỰỲÝỶỸỴ-]+$/u;
    const specialCharactersRegex = /[~!#$%^*()<>?{}]/;

    const itemNameRegex = /[!@#$%^&*()_+-=;'.,/><:"{\/?}0123456789]/;
    const rules = {
        customer_name: yup.string()
            .required('Tên khách hàng Không được để trống')
            .test(
                'no-special-characters',
                'Tên khách hàng chỉ được nhập chữ',
                (value) => {
                    return !itemNameRegex.test(value);
                }
            )
            .min(6, 'Vui lòng nhập ít nhất 6 ký tự')
            .max(25, 'Vui lòng nhập tối đa 25 ký tự'),
        //.max(20, Utility.formatMessage(MSG_MAXLENGTH, {length: 20}))
        province: yup.string().required('Tỉnh / Thành phố không được để trống'),
        district: yup.string().required('Quận / Huyện không được để trống'),
        ward: yup.string().required('Phường / Xã không được để trống'),

        apartment_street_name: yup.string().nullable()
           // .required('Số nhà / Tên đường không được để trống')
            .test(
                'no-special-characters',
                'Số nhà / Tên đường không được chứa ký tự đặc biệt',
                (value) => {
                return !specialCharactersRegex.test(value);
                }
            ),
        address: yup.string().required('Địa chỉ không được để trống')
            .test(
                'no-special-characters',
                'Địa chỉ không được chứa ký tự đặc biệt',
                (value) => {
                return !specialCharactersRegex.test(value);
                }
            )
            .max(255, 'Vui lòng nhập tối đa 255 ký tự'),
        phone: yup.string().required('Điện thoại không được để trống')
            .test("", "Ký tự nhập phải là các ký tự chữ số", (value) => {
                let re = /^[0-9]+$/;
                return !re.test(value) ? false : true;
            }),
        email: yup.string().nullable().email('Email định dạng không hợp lệ'),
        agree_account: yup.string().nullable(),
        memo:yup.string().nullable()
            .test(
                'no-special-characters',
                'Ghi chú đặt hàng không được chứa ký tự đặc biệt',
                (value) => {
                return !specialCharactersRegex.test(value);
                }
            ),
    }



    if (ctx.initData.agree_account === 1) {
        rules.account = yup.string().required('Tài khoản không được để trống')
        .test("", "Ký tự nhập phải là các ký tự chữ, dấu gạch nối và dấu gạch dưới.", (value) => {
            let re = /^[a-zA-Z0-9_-]+$/;
            return !re.test(value) ? false : true;
        });
        rules.password = yup.string().required('Password không được để trống')
            .test("", "Ký tự nhập phải là các ký tự chữ, dấu gạch nối và dấu gạch dưới.", (value) => {
                let re = /^[a-zA-Z0-9_-]+$/;
                return !re.test(value) ? false : true;
            }) ;
      }

    return rules;
}
