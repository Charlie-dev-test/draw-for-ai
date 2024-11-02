<template>
        <div
                id="canvas"
                class="image"
                :style="styleObject"
                @mousemove="getMouseCoord($event)"
        ></div>
</template>

<script>
    import authService from "../../services/auth.service";
    import batchService from "../../services/batch.service";
    import {encode} from "base64-arraybuffer";
    import * as d3 from "d3";
    import { setCanvas, getRects, setRects } from "./draw.js"

    export default {
        props: {
            img: {
                type: String,
                required: true,
                default: ''
            },
            batch: {
                type: Number,
                required: true,
                default: -1
            },
            write:{
                type:Boolean,
            },
            color: {
                type: String,
                default: "#ffffff"
            },
            clear: {
               type: Boolean
            }
        },
        data() {
            const dataTemplate = {
                img: String(),
                batch: Number(),
                polygons: Array(),
            };
            return {
                formData: dataTemplate,
                styleObject: {
                    backgroundImage: `url('${process.env.VUE_APP_API_ADMIN}img/no.jpg')`,
                    backgroundRepeat: 'no-repeat',
                    backgroundSize: 'cover',
                    width: '0px',
                    height: '0px'
                },
                canvasWidth: 670,
                canvasHeight: 358,
                coordY: 0,
                coordX: 0,
            }
        },
        mounted() {
          this.nextImage();
        },
        watch: {
          img() {
              this.nextImage()
          },
          write() {
              this.writeData()
          },
          color(){
                  const list = getRects();
                  d3.select("#canvas").html("");
                  setCanvas(this.canvasWidth, this.canvasHeight, this.color);
                  setRects(list, this.color);
          },
          clear(){
                  d3.select("#canvas").html("");
                  setCanvas(this.canvasWidth, this.canvasHeight, this.color);
          }
        },
        methods:{
            async writeData(){
              this.formData.img = this.img;
              this.formData.batch = this.batch;
              this.formData.polygons = this.toYolo();
                const {success, data, errors} = await batchService.saveData(this.formData);
                if(success){
                    if (data){
                        this.$emit('getList', this.batch);
                        this.nextImage();
                    }
                }else{
                    console.log('error', errors)
                }
            },
            async nextImage(){
                if(this.img === '') return false;
                d3.select(".image").html("");
                const resp = await fetch(`${process.env.VUE_APP_API_BASEURL}batch/image`,{
                    method: "POST",

                    body: JSON.stringify({img:this.img, batch:this.batch}),
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${authService.getToken()}`
                    }
                });
                const chunk = await resp.arrayBuffer();
                const base64 = encode(chunk);
                let image = new Image();

                image.src = 'data:image/jpeg;base64,'+base64;
                image.onload = function() {
                    this.setStyles(image.width, image.height, image.src);
                    setCanvas(this.canvasWidth, this.canvasHeight, this.color);
                }.bind(this);
            },
            setStyles(w, h, path){
                this.canvasWidth = w;
                this.canvasHeight = h;
                this.styleObject.width = w+'px';
                this.styleObject.height = h+'px';
                this.styleObject.backgroundImage = `url('${path}')`;
            },
            getMouseCoord(e){
                this.$emit('getCoord', {x:e.offsetX, y:e.offsetY});
                this.coordX = e.offsetX;
                this.coordY = e.offsetY;
            },
            toYolo(){
                   const list = d3.selectAll('rect');
                   const w_img = this.canvasWidth;
                   const h_img = this.canvasHeight;
                   let poly = [];
                   list.each(function(){
                           let rect = {};
                           let xmin = d3.select(this).attr("x");
                           let ymin = d3.select(this).attr("y");
                           let w = d3.select(this).attr("width");
                           let h = d3.select(this).attr("height");
                           let xcenter = (xmin + w/2) / w_img;
                           let ycenter = (ymin + h/2) / h_img;
                           w = w / w_img;
                           h = h / h_img;
                           rect.xcenter = xcenter.toFixed(6);
                           rect.ycenter = ycenter.toFixed(6);
                           rect.w = w.toFixed(6);
                           rect.h = h.toFixed(6);
                           rect.label_index = 0;
                           poly.push(rect);
                   });
                   return poly;
            }
        },

    }
</script>

<style lang="scss">
    .image{
        cursor: crosshair;
        padding: 0;
        margin: 0;
    }
    svg{
        margin:0;
        padding: 0;
    }
    #top-left{
            cursor: nwse-resize;
    }
    #bottom-right{
            cursor: nwse-resize;
    }
    #top-right{
            cursor: ne-resize;
    }
    #bottom-left{
            cursor: ne-resize;
    }
</style>