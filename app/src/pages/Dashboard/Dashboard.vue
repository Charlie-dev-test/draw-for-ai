<template>
    <div class="wrap">
       <div class="item" v-for="(task, index) in tasks" :key="index">
        <div class="item__header">
            <div class="info">Задание №{{task.id}} {{task.date}}</div>
            <div v-bind:class="['status', status[task.status].color]">{{status[task.status].text}}</div>
        </div>
        <div class="body" v-html="task.desc">

        </div>
        <div class="volume">
            Количество данных для разметки (кадров, клипов видео и т.п.) в этом задании: {{task.num}}
        </div>
        <div class="amount">
            <div class="time">Оценочная длительность: {{task.duration}} часа/ов.</div>
            <div class="cost">Стоимость: {{task.price}} руб.</div>
            <div class="buttons">
                <a
                        href="#"
                        class="take"
                        v-if="task.status === 1"
                        @click.prevent="takeTask(task.id)"
                >Принять</a>
                <a
                        class="inspection"
                        v-if="task.status === 2"
                        @click.prevent="toInspection(task.id)"
                >На проверку</a>
                <a
                        class="refuse"
                        v-if="task.status === 2"
                        @click.prevent="refuseTask(task.id)"
                >Отказаться</a>
                <a
                        :href="'dashboard\\'+task.id"
                        class="open"

                >Открыть</a>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
import taskService from "../../services/task.service";
    const statusTemplate = {
        1: {
            text: 'Доступна',
            color: 'lightgreen'
        },
        2: {
            text: 'Выполняется',
            color: 'blue'
        },
        3: {
            text: 'Проверяется',
            color: 'red'
        },
        4: {
            text: 'Оплачена',
            color: 'green'
        },
        5: {
            text: 'Ожидание',
            color: 'yellow'
        }
    };
    export default {
        name: "Dashboard",
        data() {
            return {
                status: statusTemplate,
                tasks: []
            }
        },
        async mounted() {
            const {success, data, errors} = await taskService.getTaskList();
            if(success){
                this.tasks = data;
            }else {
                this.errors = errors;
            }
        },
        methods: {
            async takeTask(id){
                const {success, data, errors} = await taskService.takeTask({taskId: id});
                if(success){
                    this.tasks = data;
                }else {
                    this.errors = errors;
                }
            },
            async toInspection(id){
                const {success, data, errors} = await taskService.taskInspection({taskId: id});
                if(success){
                    this.tasks = data;
                }else {
                    this.errors = errors;
                }
            },
            async refuseTask(id){
                const {success, data, errors} = await taskService.taskRefuse({taskId: id});
                if(success){
                    this.tasks = data;
                }else {
                    this.errors = errors;
                }
            }
        }
    }
</script>

<style scoped lang="scss">
.wrap{
    display: flex;
    flex-direction: column;
    font-size: 1rem;
    padding: 10px;
}
.item{
    background-color: rgba(191, 191, 191, 0.15);
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 7px;
    max-width: 1000px;
    min-width: 1000px;
    margin-left: auto;
    margin-right: auto;
    &__header{
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        .info{
            font-size: 1.1rem;
            font-weight: bold;
        }
        .status{
            margin-right: 10%;
            font-weight: bold;
            font-size: 1.1rem;
        }
        .lightgreen{
            color: #0f0;
        }
        .green{
            color: #090;
        }
        .blue{
            color: #00f;
        }
        .red{
            color: #f00;
        }
        .yellow{
            color: #0c5460;
        }
    }
    & .body{
        margin-bottom: 20px;
    }
    & .links{
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }
}
.amount{
    display: flex;
    align-items: center;
    .time{
        margin-right: 1rem;
    }
    .buttons{
        display: flex;
        a, button{
            margin-left: 1.5rem;
            margin-right: 1.5rem;
        }
    }
}
</style>