<template>
    <div class="item">
        <div class="item__header">
            <div class="info">Задание №1 09.02.2022</div>
            <div class="status blue">Выполняется</div>
        </div>
        <div class="body">
            Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1 Задание №1
        </div>
        <div class="links">
            <a href="#">hgfhg</a>
            <a href="#">gjfghj</a>
            <a href="#">jhkghjkghkj</a>
        </div>
        <div class="volume">
            Количество данных для разметки (кадров, клипов видео и т.п.) в этом задании: 120
        </div>
        <div class="amount">
            <div class="time">Оценочная длительность: 3 часа</div>
            <div class="cost">Стоимость: 300 руб.</div>
            <div class="buttons">
                <a href="#" class="take">Принять</a>
                <button class="inspection">На проверку</button>
                <button class="refuse">Отказаться</button>
                <a href="task/1" class="open">Открыть</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TaskItem",
        props: {
            items: Object,
        }
    }
</script>

<style scoped lang="scss">
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
                margin-left: 2rem;
                margin-right: 2rem;
            }
        }
    }
</style>