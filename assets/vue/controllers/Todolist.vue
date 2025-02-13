<script setup>
import {ref} from "vue";
import {logPlugin} from "@babel/preset-env/lib/debug";
    let tasks = ref([]);
    let text = ref('');
    let completedAreHidden = ref(false);
    const handleSubmit = function() {
        const today = new Date();

        const newTask = {
            title: text.value,
            completed: false,
            date:
                String(today.getDate()).padStart(2, '0') +
                String(today.getMonth() + 1).padStart(2, '0') +
                today.getFullYear()
        }

        tasks.value.push(newTask)
        text.value = "";
    }

    const handleCheck = function(task) {
        // todo: sort tasks by completed
        // tasks.value.sort((a, b) => (b.completed - a.completed));
    }

</script>

<template>
    <div class="container mx-auto w-2/3 py-5">
        <form action="" @submit.prevent="handleSubmit">
            <input class="border mb-3 mr-2" v-model="text" type="text" name="task" id="task">
            <button class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600" type="submit">Ajouter</button>
        </form>

        <p v-if="tasks.length === 0">Aucune tâche à afficher</p>

        <ul v-else>
            <li v-for="task in tasks" :key="task.title" :class="{'line-through': task.completed, hidden: task.completed && completedAreHidden }">
                <input type="checkbox" v-model="task.completed" @input="handleCheck(task)">
                {{ task.title }}
            </li>
        </ul>

        <button
            @click="completedAreHidden = !completedAreHidden"
            class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
        >
            {{ completedAreHidden ? 'Afficher' : 'Masquer' }} les tâches complétées
        </button>
    </div>
</template>
