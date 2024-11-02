<template>
    <div class="wrap">
        <h5>Ранее загруженные файлы:</h5>
        <div class="img-links">
            <a href="" v-for="(img, index) in images" :key="index" @click="togglePopup($event, img)">{{img.realname}}</a>
        </div>
        <DxPopup
            id="popupImg"
            :visible.sync="isPopupVisible"
            :close-on-outside-click="false"
            content-template="popup-imgs"
            :show-title="true"
            :title="title"
        >
            <template #popup-imgs>
                <div class="img-container">
                    <img class="img" :src="path" :alt="alt">
                </div>
            </template>
        </DxPopup>
    </div>
</template>

<script>
    import { DxPopup} from 'devextreme-vue/popup';
    export default {
        name: "ImgList",
        props: {
          images: Array,
        },
        components: {
            DxPopup,
        },
        data() {
            return {
                isPopupVisible: false,
                path: '',
                alt: '',
                title: '',
            }
        },
        methods: {
            togglePopup(e, img){
                e.preventDefault();
                this.isPopupVisible = true;
                this.path = process.env.VUE_APP_API_ADMIN + 'data/storage/' + img.path + '/' + img.name;
                this.alt = img.realname;
                this.title = img.realname;
            }
        },
    }
</script>

<style lang="scss" scoped>
.img-links{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: flex-start;
    margin-top: 30px;
    margin-bottom: 30px;
    width: 100%;
    & a{
        display: block;
        padding-right: 1rem;
        padding-left: 1rem;
        margin: 1rem 1rem;
    }
}
.img-container{
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.img{
    height: 95%;
}
</style>