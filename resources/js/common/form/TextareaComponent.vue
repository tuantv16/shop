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
        title: {
            type: String,
            default: ''
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
        rows: {
            type: Number,
            default: 0
        }
    },
    created() {
        this.value = this.data ?? '';
    },
    emits: ['update:modelValue'],
    methods: {
        resize() {
            let element = document.getElementById(this.id);
            element.style.height = "18px";
            element.style.height = element.scrollHeight + "px";
        },
    },
    watch: {
        value: function (val) {
            this.$emit('update:modelValue', val)
        },
        data: function(val) {
            this.value = val ?? '';
        }
    }
}
</script>

<template>
    <div class="group-item">
        <p class="p-normal" v-if="title || tooltip || required || limit" data-toggle="tooltip" :title="tooltip">
            {{ title }}
            <i v-if="tooltip" class="far fa-question-circle" ></i>
            <span v-if="limit" class="count-character ml-1">[{{ (value) ? value.length : '0' }} / {{ limit }} ký tự ] </span>
            <span class="required ml-1" v-if="required">(*)</span>
        </p>
        <Field
            v-slot="{ field, errors }"
            :name="name">
            <textarea
                :disabled="disabled"
                :id="id"
                :name="name"
                :ref="id"
                v-bind="field"
                :placeholder="placeholder"
                wrap="hard"
                :rows="rows"
                v-model="value"
                :class="{ 'is-invalid': errors.length > 0}"
                class="form-control"
                :maxlength="Number(limit) === 0? '' : limit" />
        </Field>
        <ErrorMessage :name="name"/>
    </div>
</template>

<style scoped>
textarea {
    overflow: hidden;
    min-height: 100px;
}
</style>
