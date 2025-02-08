<template>
    <div class="mt-5">Hello {{ name }}!</div>
</template>

<script setup>
    defineProps({
        name: String
    });
</script>
