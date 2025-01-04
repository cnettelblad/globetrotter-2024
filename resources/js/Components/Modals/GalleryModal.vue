<script setup lang="ts">
import { onMounted, onUnmounted } from "vue";
import PhotoSwipeLightbox from "photoswipe/lightbox";
import "photoswipe/style.css";

type Image = {
    url: string;
    description: string;
};

const props = defineProps<{
    images: Image[];
}>();

const lightbox = new PhotoSwipeLightbox({
    children: "a",
    pswpModule: () => import("photoswipe"),
    padding: { top: 100, bottom: 100, left: 50, right: 50 },
});

lightbox.init();

lightbox.loadAndOpen(
    0,
    props.images.map((image) => {
        return {
            src: image.url,
            // width: 1200,
            // height: 1200,
            title: image.description,
        };
    })
);

const emit = defineEmits(["close"]);

const cancel = () => {
    emit("close");
};

const cancelOnEscape = (e: KeyboardEvent) => {
    if (e.key === "Escape") {
        cancel();
    }
};

onMounted(() => document.addEventListener("keydown", cancelOnEscape));
onUnmounted(() => document.removeEventListener("keydown", cancelOnEscape));
</script>
<template>
    <div></div>
</template>
