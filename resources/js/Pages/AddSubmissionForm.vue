<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Typeahead from '@/Components/Typeahead.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    contestant: '',
    month: '',
    submission: '',
    image: '',
});

const addSubmission = () => {
    form.put(route('submissions.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
        onError: () => {
        },
    });
};

const getContestants = () => {
    axios.get(route('contestants.index')).then((response) => {
        return response.data;
    });
}

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Add a submission</h2>

            <p class="mt-1 text-sm text-gray-600">
                Add a submission to the Globetrotter event.
            </p>
        </header>

        <form @submit.prevent="addSubmission" class="mt-6 space-y-6">
            <div>
                <InputLabel for="contestant" value="Contestant" />

                <Typeahead
                    id="contestant"
                    v-model="form.contestant"
                    :contestants="getContestants"
                    ref="contestantInput"
                    class="mt-1 block w-full"
                />

                <InputError :message="form.errors.contestant" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
