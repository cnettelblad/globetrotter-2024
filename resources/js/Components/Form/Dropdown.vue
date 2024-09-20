<script setup lang="ts">
import { onMounted, ref } from 'vue';

const model = defineModel<string>({ required: true });
const input = ref<HTMLInputElement | null>(null);

const props = defineProps<{
    allowEmpty?: boolean;
    options: { label: string; value: string }[] | string[] | number[];
}>();

onMounted(() => {
    if (input.value?.hasAttribute('autofocus')) {
        input.value?.focus();
    }
});

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
    <select v-model="model" ref="input" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        <option disabled value="" v-if="allowEmpty">Please select one</option>
        <option
            v-for="option in options"
            :value="typeof option === 'object' ? option.value : option"
        >
            {{ typeof option === 'object' ? option.label : option }}
        </option>
    </select>
</template>
