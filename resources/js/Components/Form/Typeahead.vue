<script setup lang="ts">
import { Contestant } from '@/types';
import { onMounted, ref } from 'vue';
import ContestantCard from '../Cards/ContestantCard.vue';
import { levenshtein } from '@/Utils/Levenshtein';

const model = defineModel<string>({ required: true });
const selectedContestant = ref<Contestant | null>(null);
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
    search.value = (event.target as HTMLInputElement).value;
};

const filteredContestants = (): Contestant[] => {
    if (!search.value) {
        return [];
    }

    // check if element is in focus
    if (document.activeElement !== input.value) {
        return [];
    }

    return props.contestants?.map((contestant) => {
        const searchValue = search.value.toLowerCase();

        const nickname = contestant.nickname?.toLowerCase();
        const username = contestant.username.toLowerCase();
        const discordId = contestant.discord_id.toString();

        const nicknameMatch = nickname?.includes(searchValue);
        const usernameMatch = username.includes(searchValue);
        const discordIdMatch = discordId.includes(searchValue);

        if (!nicknameMatch && !usernameMatch && !discordIdMatch) {
            return;
        }

        const nicknameDistance = nickname && nicknameMatch
            ? levenshtein(nickname, searchValue)
            : null;
        const usernameDistance = username && usernameMatch
            ? levenshtein(username, searchValue)
            : null;
        const discordIdDistance = discordId && discordIdMatch
            ? levenshtein(discordId, searchValue)
            : null;

        return {
            matches: {
                nickname: nicknameDistance,
                username: usernameDistance,
                discord_id: discordIdDistance,
            },
            contestant,
        }
    }).filter(Boolean).sort((a, b) => {
        if (!a || !b) {
            return 0;
        }

        let aValue = 0;
        let bValue = 0;

        if (a.matches.nickname) {
            aValue = a.matches.nickname;
        } else if (a.matches.username) {
            aValue = a.matches.username + 2;
        } else if (a.matches.discord_id) {
            aValue = a.matches.discord_id + 5;
        }

        if (b.matches.nickname) {
            bValue = b.matches.nickname;
        } else if (b.matches.username) {
            bValue = b.matches.username + 2;
        } else if (b.matches.discord_id) {
            bValue = b.matches.discord_id + 5;
        }

        if (aValue === bValue) {
            return 0;
        }

        return (aValue > bValue) ? 1 : -1;
    }).map((result) => result?.contestant).slice(0, 5) as Contestant[];
};

const handleSelection = (contestant: Contestant) => {
    model.value = contestant.id;
    selectedContestant.value = contestant;
    search.value = '';
};

const clearSelection = () => {
    model.value = '';
    selectedContestant.value = null;
    search.value = '';
};

const search = ref<string>('');

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
    <div v-if="selectedContestant">
        <ContestantCard :contestant="selectedContestant" class="w-64" />
        <button
            @click="clearSelection"
            class="mt-4 bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded"
        >
            Clear selection
        </button>
    </div>
    <div v-if="!selectedContestant">
        <input
            type="text"
            ref="input"
            v-model="search"
            @input="handleInput"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            :class="$attrs.class"
            :placeholder="$attrs.placeholder as string || 'Begin typing to search...'"
        />
        <ul v-if="filteredContestants" class="absolute overflow-hidden">
            <li
                v-for="contestant in filteredContestants()"
                :key="contestant.id"
                @click="handleSelection(contestant)"
                class="flex flex-row items-center gap-4 border-b border-gray-200 bg-white hover:bg-gray-50 cursor-pointer py-4 px-5"
            >
                <img
                    :src="contestant.avatar"
                    alt="Avatar"
                    class="h-8 w-8 rounded-full"
                />
                <div class="flex flex-col align-middle justify-center">
                    <div>
                        <span class="text-gray-900">
                            {{ contestant.nickname ?? contestant.username }}
                        </span>
                        <span v-if="contestant.nickname" class="text-gray-500">
                            ({{ contestant.username }})
                        </span>
                    </div>
                    <span class="text-gray-500">{{ contestant.discord_id }}</span>
                </div>
            </li>
        </ul>
    </div>
</template>
