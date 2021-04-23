<template>
    <textarea
        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="textarea"
        :rows="rows"
    >
    </textarea>
</template>

<script>
export default {
    props: {
        modelValue: {
            default: null,
        },
        rows: {
            default: "3",
        },
    },

    emits: ["update:modelValue"],

    methods: {
        focus() {
            this.$refs.textarea.focus();
        },
    },
};
</script>
