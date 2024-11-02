<template>
    <div>
        <div class="coords">
            X: {{coordX}} - Y: {{coordY}}
            <button @click="clear">Clear</button>
        </div>
        <div
                id="canvas"
                :style="styleObject"
                @mousemove="getMouseCoord($event)"
        ></div>
    </div>
</template>

<script>
    import * as d3 from "d3";

    export default {
        data(){
            return {
                styleObject: {
                    backgroundImage: `url('${process.env.VUE_APP_API_ADMIN}img/no.jpg')`,
                    backgroundRepeat: 'no-repeat',
                    backgroundSize: 'cover',
                    width: '670px',
                    height: '358px'
                },
                coordY: 0,
                coordX: 0,
                canvasWidth: '670px',
                canvasHeight: '358px',
                rect:[]
            }
        },
        mounted(){
            let count = 0;
            let width = this.canvasWidth;
            let height = this.canvasHeight;
            let svg = d3.select("#canvas")
                .append("svg")
                .attr("width", 670)
                .attr("height", 358)
                .style("fill", "transparent")
                .on("contextmenu", remove)
                .on("mousedown", mousedown)
                .on("click", select)
                .on("mousemove", justMove)
                .on("mouseup", mouseup);
            let horiz = svg.append("line")
                .style("stroke", "black")
                .style("stroke-width", ".3")
                .attr("class", "crosshair")
                .attr("id", "horiz")
                .attr("x1", 0)
                .attr("y1", 0)
                .attr("x2", width)
                .attr("y2", 0);
            let vert = svg.append("line")
                .style("stroke", "black")
                .style("stroke-width", ".3")
                .attr("class", "crosshair")
                .attr("id", "vert")
                .attr("x1", 0)
                .attr("y1", 0)
                .attr("x2", 0)
                .attr("y2", height);
            function remove(){
                event.preventDefault();
                if(event.target.tagName === 'rect'){
                    event.target.parentNode.removeChild(event.target);
                }
                svg.selectAll(".corners").remove();
            }
            function select(){
                if(event.target.tagName === 'rect'){
                    svg.selectAll(".corners").remove();
                    let current = d3.select(event.target);
                    current.style("stroke", "red");
                    svg.append("circle")
                        .attr("cx", current.attr("x"))
                        .attr("cy", current.attr("y"))
                        .attr("r", 5)
                        .attr("class", "corners")
                        .attr("id", "top-left")
                        .style("stroke", "steelblue")
                        .style("fill", "steelblue");
                    svg.append("circle")
                        .attr("cx", Number(current.attr("x"))+Number(current.attr("width")))
                        .attr("cy", Number(current.attr("y"))+Number(current.attr("height")))
                        .attr("r", 5)
                        .attr("class", "corners")
                        .attr("id", "bottom-right")
                        .style("stroke", "steelblue")
                        .style("fill", "steelblue");
                    svg.append("circle")
                        .attr("cx", current.attr("x"))
                        .attr("cy", Number(current.attr("y"))+Number(current.attr("height")))
                        .attr("r", 5)
                        .attr("class", "corners")
                        .attr("id", "bottom-left")
                        .style("stroke", "steelblue")
                        .style("fill", "steelblue");
                    svg.append("circle")
                        .attr("cx", Number(current.attr("x"))+Number(current.attr("width")))
                        .attr("cy", current.attr("y"))
                        .attr("r", 5)
                        .attr("class", "corners")
                        .attr("id", "top-right")
                        .style("stroke", "steelblue")
                        .style("fill", "steelblue");
                }
                if(event.target.tagName === "line" ){
                   svg.selectAll(".corners").remove();
                }
            }
            function mousedown() {
                svg.selectAll(".corners").remove();
                    svg.append("rect")
                        .attr("x", event.offsetX)
                        .attr("y", event.offsetY)
                        .attr("id", `rect-${count}`)
                        .style("stroke", "steelblue")
                        .style("stroke-width", "1")
                        .attr("height", 0)
                        .attr("width", 0);
                    svg.on("mousemove", mousemove);
            }
            function mousemove() {
                let rect = d3.select(`#rect-${count}`);
                rect.attr("width", Math.max(0, event.offsetX - +rect.attr("x")))
                    .attr("height", Math.max(0, event.offsetY - +rect.attr("y")));
                d3.select("#horiz")
                    .attr("y1", event.offsetY)
                    .attr("y2", event.offsetY);
                d3.select("#vert")
                    .attr("x1", event.offsetX)
                    .attr("x2", event.offsetX)
            }
            function mouseup() {
                svg.on("mousemove", null);
                let rect = d3.select(`#rect-${count}`);
                if(rect.attr("width") < 20 || rect.attr("height") < 20){
                    rect.remove();
                }
                count=count+1;
                svg.on("mousemove", justMove)
            }
            function justMove(){
                horiz.attr("y1", event.offsetY)
                .attr("y2", event.offsetY);
                vert.attr("x1", event.offsetX)
                .attr("x2", event.offsetX)
            }
        },
        methods:{
            getMouseCoord(e){
                this.coordX = e.offsetX;
                this.coordY = e.offsetY;
            },
            clear(){
                d3.select("svg")
                    .html("");
            }
        }
    }
</script>

<style lang="scss">
#canvas{
    cursor:crosshair;
}
    .coords{
        display: flex;
        flex-direction: column;
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