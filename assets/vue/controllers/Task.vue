<script setup>

defineProps({
    task: Array,
})

</script>

<template>
    <label>
        <input type="checkbox" v-model="task.completed" @change="$emit('updateCompleted')">
        {{ task.title }}
    </label>
</template>

<style scoped>

</style>