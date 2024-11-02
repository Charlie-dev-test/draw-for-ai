<template>
    <div class="wrap">
        <div class="tools">
            <div class="uploader">
                <div class="dx-fieldset">
                    <div class="dx-field">
                        <div class="dx-field">
                            <div class="dx-field-label">Выберите доступное задание:</div>
                            <div class="dx-field-value">
                                <DxSelectBox
                                        :data-source="products"
                                        display-expr="text"
                                        @value-changed="e => getTask(e.value.id)"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="canvas" v-if="info">
            <div class="panel">
                <div class="note">
                    *Правый клик - удалить выделение
                </div>
                <div class="palette">
                    <div v-for="(color, index) in colors"
                         :key="index"
                         :style="{backgroundColor: color}"
                         @click="chooseColor(color, $event.target)"
                         :class="{active: index===0}"
                    ></div>
                </div>
                <div class="column">
                    <div class="count">Обработано изображений: {{count}} из {{volume}}</div>
                    <ul class="task-links">
                        <li v-for="(img, index) in batchImages" :class="{active: img.isActive}" :key="index" @click.prevent="setImage(index)">
                            <p :class="{finished: img.processed}" >{{index+1}}</p>
                        </li>
                    </ul>
                    <div class="coords">X: {{coordX}} - Y: {{coordY}}</div>
                    <button class="buttons" @click="finishImage">Завершить с изображением</button>
                    <button class="buttons" @click="finishTask">Завершить задание</button>
                    <button class="buttons" @click="clearCanvas">Очистить изображение</button>

                </div>
            </div>
            <div class="picture"><Canvas
                        ref="canvas"
                        :img="img"
                        :batch="batch"
                        :write="write"
                        :color="color"
                        :clear="clear"
                        v-on:getList="getTask"
                        v-on:getCoord="setCoord"
                /></div>
        </div>
    </div>
</template>

<script>
    import DxSelectBox from 'devextreme-vue/select-box';
    import Canvas from "../../components/Canvas/Canvas";
    import batchService from "../../services/batch.service";
    import taskService from "../../services/task.service";
    export default {
        name: "Markup",
        components: {
            DxSelectBox,
            Canvas,
        },
        data(){
            return {
                products:[
                    {text: 'нет взятых в работу заданий'}
                ],
                batch: -1,
                batchImages:[],
                info: false,
                count: 0,
                volume: 0,
                coordY: 0,
                coordX: 0,
                img: '',
                write:false,
                clear: false,
                color: '#ffffff',
                colors: [
                    '#ffffff',
                    '#1c1c1c',
                    '#FF2400',
                    '#ffdc33',
                    '#1560bd',
                    '#76ff7a'
                ]
            }
        },
        computed: {

        },
        mounted(){
            this.getTaskList();
        },
        methods:{
            async getTask(id){
                if(id === undefined){
                    return false;
                }
                this.batch = id;
                this.count = 0;
                this.volume = 0;
                this.img = '';
                const {success, data, errors} = await batchService.getBatch(id);
                if(success){
                    if(data && data.length>0){
                        this.volume = data.length;
                        data.forEach((item) =>{
                            if(item.processed){
                                this.count = this.count+1;
                            }
                        });
                        // this.currentImage = data.image;
                        // this.currentBatch = e.id;
                        this.batchImages = data;
                        this.info = true;
                        // console.log(this.getUnprocessed());
                        this.img=this.batchImages[this.getUnprocessed()].img;
                        this.setImage(this.getUnprocessed());

                        // this.nextImage();
                    }else{
                        this.info = false;
                    }
                }else {
                    this.info = false;
                    console.log('error', errors)
                }
            },
            setImage(index){
                this.img=this.batchImages[index].img;
                this.batchImages.forEach((item) => {
                    item.isActive = false;
                });
                this.batchImages[index].isActive = true;
                // this.$refs.canvas.getImage(this.batchImages[index].img);
                // console.log(this.batchImages[index].img);
                // console.log(this.getUnprocessed());
            },
            getUnprocessed(){
                if (this.count === this.volume) return 0;
                return this.batchImages.indexOf(this.batchImages.find(el => el.processed === false));
            },
            clearCanvas(){
                this.clear = !this.clear;
            },
            finishImage(){
                this.write = !this.write;
            },
            setCoord({x, y}){
                this.coordX = x;
                this.coordY = y;
            },
            async finishTask(){
                const {success, data, errors} = await taskService.taskFinish({taskId: this.batch});
                if(success){
                    if(data){
                        this.batch = undefined;
                        this.count = 0;
                        this.volume = 0;
                        this.img = '';
                        this.info = false;
                        this.getTaskList();
                    }
                }else {
                    this.errors = errors;
                }
            },
            async getTaskList(){
                const {success, data, errors} = await batchService.getBatchList();
                if(success){
                    if (data.length === 0){
                        this.products = [{text: 'нет взятых в работу заданий'}]
                    }else {
                        data.forEach(function(item) {
                            item.text = 'Задание №' + item.id;
                        });
                        this.products = data;
                    }
                }else {
                    this.errors = errors;
                }
            },
            chooseColor(color, el){
                const list = el.parentNode.childNodes;
                list.forEach(function(item){
                    item.classList.remove('active')
                });
                el.classList.add('active');
                this.color = color;
            }
        }
    }
</script>

<style scoped lang="scss">
    .wrap{
        display: flex;
        flex-wrap: nowrap;
        .canvas{
            display: flex;
            flex-wrap: nowrap;
            flex-direction: row;
            margin-bottom: 20px;
            .panel{
                border: 1px solid #eaeaea;
                margin-right: 5px;
                .column{
                    width: 220px;
                }
            }
            .picture{
                overflow-x: auto;
                overflow-y: hidden;
                padding: 0;
                margin: 0;
            }
        }
    }

    .task-links{
        max-height: 250px;
        overflow-y: auto;
        display: block;
        li{
            display: block;
            padding-right: 10px;
            height: 1.5rem;
            line-height: 1.5;
            border: 1px solid transparent;
            cursor: pointer;
            &:hover{
                border: 1px solid black;
            }
            p{
                display: inline;
                width: 100%;
                white-space: nowrap;
                text-decoration: none;
            }
            p.finished:before{
                content: '✔';
                color: green;
                margin-right: 1rem;
                margin-left: 3px;
                text-decoration: none;
            }
            p::before{
                content: '🛠';
                color: blue;
                margin-right: 1rem;
                margin-left: 3px;
                text-decoration: none;
            }
        }
        li.active{
            border: 1px solid black;
        }
    }
    .buttons{
        width: 100%;
        cursor: pointer;
        margin-bottom: 10px;
    }
    .dx-fieldset{
        max-width: 600px;
        margin-right: auto;
        margin-left: auto;
    }
    .info{
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        margin-top: 20px;
    }
    .count{
        padding-top: 5px;
        padding-bottom: 5px;
        text-align: center;
        background-color: #aed0ea;
        font-weight: 500;
    }
    .coords{
        padding-left: 20%;
        padding-bottom: 5px;
        padding-top: 5px;
    }
    .palette{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-around;
        div{
            width: 31%;
            height: 30px;
            border: 2px solid #eae6ea;
            cursor: pointer;
            margin-bottom: 2px;
        }
        div.active{
            border: 2px solid #1DACD6;
        }
    }
    .white{
        background-color: white;
    }
    .black{
        background-color: #1c1c1c;
    }
    .red{
        background-color: #FF2400;
    }
    .yellow{
        background-color: #ffdc33;
    }
    .blue{
        background-color: #1560bd;
    }
    .green{
        background-color: #76ff7a;
    }
</style>