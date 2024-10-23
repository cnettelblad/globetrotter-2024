<template>
    <table class="w-full text-sm text-left text-gray-500">
        <slot name="header" />
        <tbody>
            <slot />
        </tbody>
        <slot name="footer" />
    </table>
</template>
