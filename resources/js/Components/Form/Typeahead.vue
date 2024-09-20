<script setup lang="ts">
import { Contestant } from '@/types';
import { onMounted, ref } from 'vue';

const model = defineModel<string>({ required: true });
const input = ref<HTMLInputElement | null>(null);

onMounted(() => {
    if (input.value?.hasAttribute('autofocus')) {
        input.value?.focus();
    }
});

const props = defineProps<{
    contestants: Contestant[];
}>();

const handleInput = (event: Event) => {
    model.value = (event.target as HTMLInputElement).value;
};

const filteredContestants = (): Contestant[] => {
    if (!model.value) {
        return [];
    }

    // check if element is in focus
    if (document.activeElement !== input.value) {
        return [];
    }

    return props.contestants?.filter((contestant) => {
        return (
            contestant.nickname?.toLowerCase().includes(model.value.toLowerCase()) ||
            contestant.username?.toLowerCase().includes(model.value.toLowerCase()) ||
            contestant.discord_id?.toString().toLowerCase().includes(model.value.toLowerCase())
        );
    });
};

const handleSelection = (event: Event) => {
    const selectedText = (event.target as HTMLLIElement).textContent || '';
    model.value = selectedText;
    search.value = selectedText;
};

const search = ref<string>('');

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
    <input
        type="text"
        ref="input"
        v-model="search"
        @input="handleInput"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        :class="$attrs.class"
        :placeholder="$attrs.placeholder as string || 'Begin typing to search...'"
    />
    <ul v-if="filteredContestants">
        <li v-for="contestant in filteredContestants()" :key="contestant.id" @click="handleSelection">
            {{ contestant.nickname || contestant.username || contestant.discord_id }}
        </li>
    </ul>
</template>
