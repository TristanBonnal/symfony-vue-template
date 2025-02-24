<script setup>
    defineProps({
        text: String,
        handleClick: Function
    })

</script>

<template>
    <button
        class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
        @click="handleClick"
    >
        {{ text }}
    </button>
</template>

<style scoped>
    button[disabled] {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>