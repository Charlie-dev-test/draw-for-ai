<template>
    <div class="wrap">
        <div class="no-data" v-if="empty">
            Данные по этому заданию для вас недоступны
        </div>
        <div class="item" v-if="!empty">
            <div class="item__header">
                <div class="info">Задание №{{task.id}} {{task.date}}</div>
                <div v-bind:class="['status', status[task.status].color]">{{status[task.status].text}}</div>
            </div>
            <div class="body" v-html="task.title">

            </div>
            <div class="links">
                <a download="" target="_blank" v-for="(doc, index) in task.files" :href="`${adminPath}data/storage/${doc.path}/${doc.name}`" :key="index">{{doc.name}}</a>
            </div>
            <div class="volume">
                Количество данных для разметки (кадров, клипов видео и т.п.) в этом задании: {{task.num}}
            </div>
            <div class="amount">
                <div class="time">Оценочная длительность: {{task.duration}}</div>
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
                            @click="toInspection(task.id)"
                    >На проверку</a>
                    <a
                            class="refuse"
                            v-if="task.status === 2"
                            @click.prevent="refuseTask(task.id)"
                    >Отказаться</a>
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
        name: "Tasks",
        data() {
            return {
                status: statusTemplate,
                empty: true,
                task: null,
                adminPath: process.env.VUE_APP_API_ADMIN,
            }
        },
        async mounted() {
            // console.log(this.$route.params);
            this.getTask();
        },
    methods: {
        async getTask(){
            const id = this.$route.params;
            const {success, data, errors} = await taskService.getTask(id);
            if(success){
                if(data === null){
                    this.empty = true;
                }else{
                    this.empty = false;
                    this.task = data;
                }
            }else {
                this.errors = errors;
            }
        },
        async takeTask(id){
            const {success, errors} = await taskService.takeTask({taskId: id});
            if(success){
                this.getTask();
            }else {
                this.errors = errors;
            }
        },
        async toInspection(id){
            const {success, errors} = await taskService.taskInspection({taskId: id});
            if(success){
                this.getTask();
            }else {
                this.errors = errors;
            }
        },
        async refuseTask(id){
            const {success, errors} = await taskService.taskRefuse({taskId: id});
            if(success){
                this.getTask();
            }else {
                this.errors = errors;
            }
        }
    }
    }
</script>

<style scoped lang="scss">
    .no-data{
        text-align: center;
        padding-top: 20px;
        padding-bottom: 10px;
        font-style: italic;
        color: #fff;
        background-color: #0f6674;
    }
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
            a{
                width: fit-content;
            }
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