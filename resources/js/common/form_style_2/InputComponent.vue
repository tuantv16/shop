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
        }
    },
    props: {
        onkeypress: {
            type: Function,
            default: () => {
            }
        },
        title: {
            type: String,
            default: ''
        },
        step: {
            type: String,
            default: '1'
        },
        min: {
            type: String,
            default: '0'
        },
        max: {
            type: [String, Number],
            default: null
        },
        type: {
            type: String,
            default: 'text'
        },
        placeholder: {
            type: String,
            default: ''
        },
        limit: {
            type: Number,
            default: 0
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
        data: {
            type: String,
            default: ''
        },
        disabled: {
            type: Boolean,
            default: false
        },
        readonly: {
            type: Boolean,
            default: false
        },
    },
    created() {
        this.value = this.data
    },
    methods: {},
    emits: ['change'],
    watch: {
        value: function (val) {
            this.$emit('change', val)
        },
        data: function (val) {
            this.value = val
        }
    },

}
</script>

<template>

    <!-- <div class="checkout__input">
        <p>Tên tài khoản<span>*</span></p>
        <input type="text">
    </div> -->

    <div class="checkout__input">
        <p data-toggle="tooltip" :title="tooltip" v-if="title || tooltip || required || limit">
            {{ title }}
            <i v-if="tooltip" class="far fa-question-circle"></i>
            <span v-if="limit" class="count-character ml-1">[{{ (value) ? value?.length : '0' }} / {{ limit }} ký tự ] </span>
            <span class="required ml-1" v-if="required">(*)</span>
        </p>

        <Field v-slot="{field, errors}" :name="name" >
            <input
                v-if="type === 'number'"
                :onkeypress="onkeypress"
                :step="step"
                :min="min"
                :max="max"
                :type="type"
                :disabled="disabled"
                :readonly="readonly"
                :id="id"
                v-bind="field"
                :name="name"
                v-model="value"
                :class="{ 'is-invalid': errors.length > 0}"
                class="form-control input-type-2"
                :maxlength="Number(limit) === 0? '' : limit"
                :placeholder="placeholder"
            />
            <input
                v-if="type !== 'number'"
                :onkeypress="onkeypress"
                :step="step"
                :type="type"
                :disabled="disabled"
                :readonly="readonly"
                :id="id"
                v-bind="field"
                :name="name"
                v-model="value"
                :class="{ 'is-invalid': errors.length > 0}"
                class="form-control input-type-2"
                :maxlength="Number(limit) === 0? '' : limit"
                :placeholder="placeholder"
            />

        </Field>
        <div class="message-error">
            <ErrorMessage :name="name"/>
        </div>

    </div>
</template>

<style scoped>
</style>
