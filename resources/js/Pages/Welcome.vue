<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import SubmissionCard from '@/Components/SubmissionCard.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';

interface Submission {
    id: string;
    discord_id: number;
    month: string;
    submission: string;
    image?: string;
    created_at: string;
    updated_at: string;
    nickname: string;
    username: string;
    avatar: string;
}

const props = defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
    contestants: array;
}>();

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}

function filteredContestants() {
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
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-gray-50">
        <div
            class="relative min-h-screen flex flex-col items-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-start lg:col-start-1">
                        <TextInput
                            v-model="search"
                            placeholder="Search by nickname, username, or Discord ID"
                            class="w-full"
                        />
                    </div>
                    <div class="flex lg:justify-center lg:col-start-2">
                        Wanderlust Globetrotter
                    </div>
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                            >
                                Admin
                            </Link>
                        </template>
                    </nav>
                </header>


                <main class="mt-6">
                    <div class="grid gap-6 grid-cols-2 lg:grid-cols-4">
                        <div v-for="contestant in filteredContestants()" :key="contestant.id">
                            <SubmissionCard
                                :nickname="contestant.nickname"
                                :username="contestant.username"
                                :avatar="contestant.avatar"
                                :submissions="contestant.submissions"
                            />
                        </div>
                    </div>
                </main>

                <footer class="py-16 text-center text-sm text-black">
                    Built with Laravel
                </footer>
            </div>
        </div>
    </div>
</template>
