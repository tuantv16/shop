import * as yup from "yup";
// import {Utility} from "../../commons/utility.js";
// import {    
//     MSG_INPUT_REQUIRED,
//     MSG_MAXLENGTH,
//     MSG_TYPE_ERROR,
//     MSG_UNIQUE_FIELD
// } from "../../constants/common-messages.js";

export const checkoutValidator = (ctx) => {
    const rules = {
        customer_name: yup.string().nullable(),    
        //.max(20, Utility.formatMessage(MSG_MAXLENGTH, {length: 20}))
        province: yup.string().required('Không được để trống'),
        district: yup.string().required('Không được để trống'),      
        ward: yup.string().required('Không được để trống'),
        address: yup.string().required('Không được để trống'),
    }
   
    return rules;
}
