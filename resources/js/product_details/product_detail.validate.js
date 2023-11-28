import * as yup from "yup";
// import {Utility} from "../../commons/utility.js";
// import {
//     MSG_INPUT_REQUIRED,
//     MSG_MAXLENGTH,
//     MSG_ONLY_HALF_SIZE,
//     MSG_NUMBER_TYPE

// } from "../../constants/common-messages.js";

yup.addMethod(yup.mixed, 'requiredALeast', function (messages) {

    return this.test('requiredALeast', messages, function (values) {
        // let count = 0;
        // if (values) {
        //     values.forEach((value, key) => {
        //         if (mode == 'update') {
        //             if ((value.value1 != '' || value.value2 != '' || value.value3 != '') && value.item  === '') {
        //                 count++;
        //             }
        //         } else {
        //             if (value.item  === '') {
        //                 count++;
        //             }
        //         }

        //     });
        //     return count > 0 ? false : true;
        // }

        return true;

    });
});

export const ProductDetailValidator = (ctx) => {
    let requiredMsg = 'Yêu cầu bắt buộc nhập';
    const rowSchema = yup.object().shape({
        size_id: yup.string().required(requiredMsg),
        color_id: yup.string().required(requiredMsg),
        brand_id: yup.string().required(requiredMsg),
        quantity: yup.number().required(requiredMsg),
        disp: yup.string().required(requiredMsg),
      });

    let obj = {
        rows: yup.array().of(rowSchema).min(1, '至少需要一行数据。')
        //rows: yup.mixed().requiredALeast('項目名が入力されていません。'),
    };

    return obj;
}
