<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import SubmissionCard from '@/Components/SubmissionCard.vue';

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

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
    submissions: Submission[];
    contestants: array;
}>();

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-gray-50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
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
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </header>


                <main class="mt-6">
                    <div class="grid gap-6 grid-cols-2 lg:grid-cols-4">
                        <div v-for="contestant in contestants" :key="contestant.id">
                            <SubmissionCard
                                :nickname="contestant.nickname"
                                :username="contestant.username"
                                :avatar="contestant.avatar"
                                :submissions="contestant.submissions"
                            />
                            <!-- <div class="rounded-lg bg-cyan-900 ring-1 ring-cyan-700 max-w-[300px] p-4">
                                <div class="flex flex-row gap-4 items-center">
                                    <img :src="contestant[0].avatar" alt="avatar" class="w-16 h-16 rounded-full" />
                                    <div class="flex flex-col">
                                        <h2 class="text-xl font-semibold text-white">{{ contestant[0].nickname }}</h2>
                                        <p class="text-white text-sm">{{ contestant[0].username }}</p>
                                    </div>
                                </div>

                                <button @click="contestant.expanded = !contestant.expanded" class="text-purple-200 hover:text-purple-400">
                                    {{ contestant.expanded ? '- Hide' : '+ Show' }} Submissions
                                </button>

                                <div v-if="contestant.expanded" class="mt-4">
                                    <ul>
                                        <li v-for="submission in contestant" :key="submission.id">{{ submission.submission }}</li>
                                    </ul>
                                </div>
                            </div> -->
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
