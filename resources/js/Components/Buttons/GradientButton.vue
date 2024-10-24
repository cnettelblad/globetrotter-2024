<template>
    <button class="button green">
        <slot />
    </button>
</template>

<style lang="postcss" scoped>
.button {
    @apply text-white uppercase focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-xs px-5 py-2.5 inline-flex items-center;
}
.button.green {
    @apply bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-green-200;
}
.button:disabled,
.button:disabled:hover {
    @apply bg-gray-300 bg-none cursor-not-allowed;
}
</style>
