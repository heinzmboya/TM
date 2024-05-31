<script setup>
import { nextTick, onMounted, ref, useAttrs } from 'vue';

const attrs = useAttrs();
const props = defineProps({
    label: {
        default: '',
    },
    id: {
        default: null,
    },
    form: {
        default: null,
    },
    type: {
        default: 'text',
    },
    labelClass: {
        default: '',
    },
});

const model = defineModel();

const inputRef = ref(null);

onMounted(async () => {
    if ('autofocus' in attrs) {
        await nextTick();
        inputRef.value.focus();
    }
});

defineExpose({ focus: () => inputRef.value.focus() });
</script>

<template>
    <div>
        <label
            :class="labelClass"
            :for="id"
            class="block font-medium text-sm text-gray-700"
        >
            {{ label }}
        </label>

        <input
            :id
            required
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1"
            v-model="model"
            ref="inputRef"
            :type="type"
            v-bind="$attrs"
        />

        <InputError class="mt-2" :message="form?.errors?.[id]" />
    </div>
</template>
