<script setup>
import {computed, ref} from "vue";
import Button from "./Button.vue";
import Task from "./Task.vue";

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
        sortTasks();
    }

    const sortTasks = function() {
        tasks.value.sort((a, b) => a.completed - b.completed);
    }

    let notCompletedTasksCount = computed(() => tasks.value.filter(task => !task.completed).length);

</script>

<template>
    <div class="container mx-auto w-2/3 py-5">
        <form action="" @submit.prevent="handleSubmit">
            <input class="border mb-3 mr-2" v-model="text" type="text" name="task" id="task">
            <Button text="Ajouter" :disabled="text.length === 0" type="submit" />   <!-- text est une prop, alors que disabled et type sont des attributs passés implicitement à l'élément de premier niveau du composant Button -->
        </form>

        <p v-if="tasks.length === 0">Aucune tâche à afficher</p>

        <ul v-else>
            <Task v-bind="{ tasks, completedAreHidden }" @sortTasks="sortTasks" />
            <!-- v-bind="{ tasks, completedAreHidden }" est équivalent à :tasks="tasks" :completedAreHidden="completedAreHidden" -->
        </ul>

        <Button
            :text="(completedAreHidden ? 'Afficher' : 'Masquer') + 'les tâches complétées'"
            @hide-completed="completedAreHidden = !completedAreHidden"
        ></Button>

        <p>Il reste {{ notCompletedTasksCount }} tâches à faire</p>
    </div>
</template>
