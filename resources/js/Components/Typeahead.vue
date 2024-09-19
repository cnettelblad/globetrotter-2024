<script setup lang="ts">
import { onMounted, ref } from 'vue';

// const model = defineModel<string>({ required: true });

const input = ref<HTMLInputElement | null>(null);

onMounted(() => {
    if (input.value?.hasAttribute('autofocus')) {
        input.value?.focus();
    }
});

defineProps<{
    contestants: array;
}>();

const handleInput = (event: Event) => {
    console.log(event);
    model.value = (event.target as HTMLInputElement).value;
};

const filteredContestants = () => {
    if (!props.contestants) return [];
    return props.contestants.filter((contestant) => {
        if (search.length === 0) return true;
        const lcSearch = search.value.toLowerCase();
        if (contestant.nickname && contestant.nickname.toLowerCase().includes(lcSearch)) return true;
        if (contestant.username && contestant.username.toLowerCase().includes(lcSearch)) return true;
        if (contestant.discord_id && contestant.discord_id.toString().includes(lcSearch)) return true;
    });
}

const search = ref('');

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
    <input
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        v-model="search"
        ref="input"
    />
    <li
        v-for="contestant in filteredContestants"
        :key="country.name"
        @click="selectCountry(country.name)"
    >
    {{ country.name }}
    </li>
</template>
