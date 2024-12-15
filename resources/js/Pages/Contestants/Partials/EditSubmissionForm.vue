<script setup lang="ts">
import InputError from "@/Components/Form/InputError.vue";
import InputLabel from "@/Components/Form/InputLabel.vue";
import { Contestant, Submission } from "@/types";
import { useForm } from "@inertiajs/vue3";
import Dropdown from "@/Components/Form/Dropdown.vue";
import ImageUpload from "@/Components/Form/ImageUpload.vue";
import CountryTypeahead from "@/Components/Form/CountryTypeahead.vue";
import GradientButton from "@/Components/Buttons/GradientButton.vue";
import Toast from "@/Components/Toast.vue";
import { toastStore } from "@/stores/toast";
import { computed } from "vue";

const props = defineProps<{
    submission: Submission;
}>();

const emit = defineEmits(["success"]);

const form = useForm({
    submission: props.submission.id,
    month: props.submission.month,
    destination: props.submission.destination?.id,
    image: null,
});

const updateSubmission = () => {
    console.log(form.data());
    form.post(
        route("submissions.update", {
            submission: form.submission,
            _method: "put",
        }),
        {
            preserveScroll: true,
            onSuccess: () => {
                toastStore.addToast("Submission updated", "success");
                emit("success");
            },
            onError: () => {
                console.log(form.errors);
            },
        }
    );
};
</script>

<template>
    <section>
        <form @submit.prevent="updateSubmission" class="mt-6 space-y-6">
            <div class="grid md:grid-cols-1 md:gap-6">
                <div>
                    <InputLabel
                        for="destination"
                        value="Destination"
                        required
                    />
                    <CountryTypeahead
                        v-model="form.destination"
                        :existing-destination="submission.destination"
                        class="w-full"
                    />
                    <InputError
                        :message="form.errors.destination"
                        class="mt-2"
                    />
                </div>
            </div>

            <div>
                <InputLabel for="image" value="Image" />
                <ImageUpload
                    v-model="form.image"
                    :existing-image="submission.image"
                    class="mt-1"
                />
                <InputError :message="form.errors.image" class="mt-2" />
            </div>

            <div class="flex items-center justify-end gap-4">
                <GradientButton :disabled="form.processing">
                    Save
                </GradientButton>

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
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
