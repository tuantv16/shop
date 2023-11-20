<script>
import {Field, ErrorMessage} from 'vee-validate';

export default {
    components: {
        Field,
        ErrorMessage
    },
    data() {
        return {
            value: -1,
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
            type: String,
            default: ''
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
            default: () => {
                return []
            }
        },
        data: {
            type: Number,
        }
    },
    emits: ['change'],
    created() {
        this.value = this.data
    },
}
</script>

<template>

    <div class="form-group">
        <label data-toggle="tooltip" :title="tooltip">
            {{ title }}
            <i v-if="tooltip" class="far fa-question-circle"></i>
            <span class="required ml-1" v-if="required">必須</span>
        </label>
        <div>
            <div v-for="(option, key) in options"
                 :key="key"
                 class="form-check  form-check-inline">
                <Field v-slot="{ field, handleChange, errors, value }"
                       :name="name"
                       type="radio"
                       :value="option.value"
                       :unchecked-value="option.value">
                    <input type="radio"
                            @change="(e) => {
                                $emit('change', value)
                            }"
                           :name="name"
                           v-bind="field"
                           :class="{ 'is-invalid': errors.length > 0}"
                           :checked="value == option.value"
                           :id="id + key"
                           :value="option.value"
                    />
                </Field>
                <label class="form-check-label pl-1" :for="id + key">{{ option.label }}</label>
            </div>
        </div>
        <div class="message-error">
            <ErrorMessage :name="name"/>
        </div>
    </div>
</template>

<style scoped>

</style>
