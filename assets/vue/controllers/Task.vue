<script setup>
import {ref} from "vue";

defineProps({
    tasks: Array,
    completedAreHidden: Boolean,
})

</script>

<template>
    <li v-for="task in tasks" :key="task.title" :class="{'line-through': task.completed, hidden: task.completed && completedAreHidden }">
        <label>
            <input type="checkbox" v-model="task.completed" @change="$emit('sortTasks')">
            {{ task.title }}
        </label>
    </li>
</template>

<style scoped>

</style>