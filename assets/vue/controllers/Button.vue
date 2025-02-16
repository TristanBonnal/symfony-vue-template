<script setup>
    defineProps({
        text: String,
    })

</script>

<template>
    <button
        class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
        @click="$emit('hide-completed')">  <!-- $emit est la syntaxe raccourcie de defineEmits(['hide-completed']) ... emit('hide-completed') -->
        {{ text }}
    </button>
</template>

<style scoped>

</style>