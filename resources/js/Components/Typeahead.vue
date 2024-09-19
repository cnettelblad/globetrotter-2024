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

const filteredContestants = () => {
    return props.contestants?.filter((contestant) => {
        return (
            contestant.nickname?.toLowerCase().includes(model.value.toLowerCase()) ||
            contestant.username?.toLowerCase().includes(model.value.toLowerCase()) ||
            contestant.discord_id?.toString().toLowerCase().includes(model.value.toLowerCase())
        );
    });
};

const search = ref<string>('');

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
    <div>
        <input
            type="text"
            ref="input"
            v-model="search"
            @input="handleInput"
            placeholder="Search contestants..."
        />
        <ul v-if="filteredContestants">
            <li v-for="contestant in filteredContestants()" :key="contestant.id">
                {{ contestant.nickname || contestant.username || contestant.discord_id }}
            </li>
        </ul>
    </div>
</template>
