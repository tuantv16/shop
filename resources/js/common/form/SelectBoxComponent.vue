<script>
import {ErrorMessage, Field} from "vee-validate";

export default {
    components: {
        Field,
        ErrorMessage
    },
    data() {
        return {
            value: '',
            listSelectBoxs: []
        }
    },
    props: {
        data: {
            type: String,
            default: ''
        },
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
        options: {
            type: Array,
            default: []
        },
        disabled: {
            type: Boolean,
            default: false
        }
    },
    emits: ['change'],
    watch: {
        value: function (val) {
            this.$emit('change', val)
        },
        data: function (val) { // case show screen edit
            this.value = val;
        }

    },
    created() {
        this.value = this.data
    }
}
</script>

<template>

    <div class="group-item" >
        <p class="p-normal" data-toggle="tooltip" :title="tooltip">
            {{ title }}
            <i v-if="tooltip" class="far fa-question-circle"></i>
            <span class="required ml-1" v-if="required">(*)</span>
        </p>
        <Field :name="name" v-model="value" v-slot="{ field, errors }">
            <select class="form-control pro-edt-select form-control-primary"
                :disabled="disabled"
                :class="{ 'is-invalid': errors.length > 0}"
                :id="id"
                :name="name"
                v-bind="field">
                <slot></slot>
            </select>
        </Field>
        <div class="message-error">
            <ErrorMessage :name="name"/>
        </div>
    </div>
</template>

<style scoped>

</style>
