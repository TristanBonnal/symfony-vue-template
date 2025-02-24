<script setup>
    import {computed, ref} from "vue";
    import Button from "./Button.vue";
    import Task from "./Task.vue";
    import axios from 'axios';

    const props = defineProps({
        taskList: Array,
    })

    let tasks = ref(JSON.parse(props.taskList));
    let text = ref('');
    let completedAreHidden = ref(false);
    let errorMessage = ref('');

    const handleSubmit = async function() {
        errorMessage.value = '';
        const newTask = {
            title: text.value,
            completed: false,
        }

        const response = await createTask(newTask);
        if (response instanceof Error) {
            errorMessage.value = response.response.data.description;
            return;
        }

        tasks.value.push(newTask)
        text.value = "";
        sortTasks();
    }

    const updateCompleted = function() {
        sortTasks();
    }

    const sortTasks = function() {
        tasks.value.sort((a, b) => a.completed - b.completed);
    }

    async function createTask(newTask) {
        try {
            const response = await axios.post('/api/tasks', newTask);
            newTask.id = response.data.id;
            return response;
        } catch (error) {
            return error;
        }
    }

    let notCompletedTasksCount = computed(() => tasks.value.filter(task => !task.completed).length);
    sortTasks();

</script>

<template>
    <div class="container mx-auto w-2/3 py-5">
        <div class="text-white bg-red-800 w-fit py-2 px-4 rounded-md mb-2" v-if="errorMessage.length > 0">{{errorMessage}}</div>
        <form action="" @submit.prevent="handleSubmit">
            <input class="border mb-3 mr-2" v-model="text" type="text" name="task" id="task">
            <Button text="Ajouter" :disabled="text.length === 0" type="submit" />   <!-- text est une prop, alors que disabled et type sont des attributs passés implicitement à l'élément de premier niveau du composant Button -->
        </form>

        <p v-if="tasks.length === 0">Aucune tâche à afficher</p>

        <ul v-else>
            <li v-for="task in tasks" :key="task.id" :class="{'line-through': task.completed, hidden: task.completed && completedAreHidden }">
                <Task v-bind="{ task }" @updateCompleted="updateCompleted" />
                <!-- v-bind="{ tasks }" est équivalent à :task="task"" -->
            </li>
        </ul>

        <Button
            :text="(completedAreHidden ? 'Afficher' : 'Masquer') + 'les tâches complétées'"
            :handleClick="() => completedAreHidden = !completedAreHidden"
        ></Button>

        <p>Il reste {{ notCompletedTasksCount }} tâches à faire</p>
    </div>
</template>
