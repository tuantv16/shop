<script>
import {Field, ErrorMessage} from 'vee-validate';

export default {
    components: {
        Field,
        ErrorMessage
    },
    data() {
        return {
            value: '',
            option1 : 'いいえ',
            option2 : 'はい'
        }
    },
    created() {
        this.value = this.data
        if (this.labelFirst != false) {
            this.option1 = this.labelFirst;
        }

        if (this.labelSecond != false) {
            this.option2 = this.labelSecond;
        }

    },
    props: {
        title: {
            type: String,
            default: ''
        },
        tooltip: {
            type: String,
            default: ''
        },
        required: {
            type: Boolean,
            default: false
        },
        id: {
            type: String,
            default: ''
        },
        name: {
            type: String,
            default: ''
        },
        modelValue: {
            type: String,
            default: ''
        },
        data: {
            type: Number,
        },
        labelFirst: {
            type: String,
            default: ''
        },
        labelSecond: {
            type: String,
            default: ''
        }
    },
}
</script>

<template>

<!-- <div class="group-item">
            <p class="p-normal">Trạng thái<span></span></p>
            <div class="group-radio">
                <div class="form-check">
                    <input type="radio" name="disp" id="option1" value="1">
                    <label for="option1" class="form-check-label">Kích hoạt</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="disp" id="option2" value="0">
                    <label for="option2" class="form-check-label">Vô hiệu hóa</label>
                </div>
            </div>

        </div> -->

    <div class="group-item">
        <p class="p-normal" data-toggle="tooltip" :title="tooltip">
            {{ title }}
            <i v-if="tooltip" class="far fa-question-circle"></i>
            <span class="required ml-1" v-if="required">(*)</span>
        </p>
        <div class="group-radio">
            <div class="form-check">
                <Field v-slot="{ field, errors }" :name="name" type="radio" :value="1" :unchecked-value="value">
                    <input type="radio" :class="{ 'is-invalid': errors.length > 0}" :name="name" v-bind="field"
                           :id="name + '1'" :value="1"/>
                </Field>
                <label class="form-check-label" :for="name + '1'"> {{ option1 }} </label>
            </div>
            <div class="form-check">
                <Field v-slot="{ field, errors }" :name="name" type="radio" :value="0" :unchecked-value="value">
                    <input type="radio" :class="{ 'is-invalid': errors.length > 0}" :name="name" v-bind="field"
                           :id="name + '2'" :value="0"/>
                </Field>
                <label class="form-check-label" :for="name + '2'"> {{ option2 }} </label>
            </div>
        </div>
        <div class="message-error">
            <ErrorMessage :name="name"/>
        </div>
    </div>
</template>

<style scoped>

</style>
