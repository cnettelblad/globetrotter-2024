<script setup lang="ts">
import FileInput from "@/Components/Form/FileInput.vue";
import InputError from "@/Components/Form/InputError.vue";
import InputLabel from "@/Components/Form/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    csv: null,
});

const importContestants = () => {
    form.post(route("contestants.csv"), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
        onError: () => {},
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Import Contestants
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Import contestants from a CSV file.
            </p>
        </header>

        <form @submit.prevent="importContestants" class="mt-6 space-y-6">
            <div>
                <InputLabel for="csv" value="File" />

                <FileInput v-model="form.csv" accept=".csv" />

                <p class="mt-1 text-sm text-gray-500" id="file_input_help">
                    Accepted file formats: <strong>.csv</strong>
                </p>

                <InputError :message="form.errors.csv" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">
                    Start import
                </PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600"
                    >
                        Import initiated
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
