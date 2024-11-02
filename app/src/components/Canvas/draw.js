import * as d3 from "d3";

export function setCanvas(width, height, color){
    let count = 0;
    const areaLimit = 20;
    const poinRadius = 5;
    let startX = 0;
    let startY = 0;
    let grabX = 0;
    let grabY = 0;
    let selected = null;
    let svg = d3.select("#canvas")
        .append("svg")
        .attr("width", width)
        .attr("height", height)
        .style("fill", "transparent")
        .on("contextmenu", remove)
        .on("mousedown", mousedown)
        .on("click", select)
        .on("mousemove", justMove)
        .on("mouseup", mouseup);
    let horiz = svg.append("line")
        .style("stroke", "red")
        .style("stroke-width", "2")
        .attr("class", "crosshair")
        .attr("id", "horiz")
        .attr("x1", 0)
        .attr("y1", 0)
        .attr("x2", width)
        .attr("y2", 0);
    let vert = svg.append("line")
        .style("stroke", "red")
        .style("stroke-width", "2")
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
            selected = current;
            svg.append("circle")
                .attr("cx", current.attr("x"))
                .attr("cy", current.attr("y"))
                .attr("r", poinRadius)
                .attr("class", "corners")
                .attr("id", "top-left")
                .call(d3.drag()
                    .on("drag", dragTL)
                )
                .style("stroke", "steelblue")
                .style("fill", "steelblue");
            svg.append("circle")
                .attr("cx", Number(current.attr("x"))+Number(current.attr("width")))
                .attr("cy", Number(current.attr("y"))+Number(current.attr("height")))
                .attr("r", poinRadius)
                .attr("class", "corners")
                .attr("id", "bottom-right")
                .call(d3.drag()
                    .on("drag", dragBR)
                )
                .style("stroke", "steelblue")
                .style("fill", "steelblue");
            svg.append("circle")
                .attr("cx", current.attr("x"))
                .attr("cy", Number(current.attr("y"))+Number(current.attr("height")))
                .attr("r", poinRadius)
                .attr("class", "corners")
                .attr("id", "bottom-left")
                .style("stroke", "steelblue")
                .style("fill", "steelblue")
                .call(d3.drag()
                    .on("drag", dragBL)
                );
            svg.append("circle")
                .attr("cx", Number(current.attr("x"))+Number(current.attr("width")))
                .attr("cy", current.attr("y"))
                .attr("r", poinRadius)
                .attr("class", "corners")
                .attr("id", "top-right")
                .call(d3.drag()
                    .on("drag", dragTR)
                )
                .style("stroke", "steelblue")
                .style("fill", "steelblue");
        }
        if(event.target.tagName === "line" ){
            svg.selectAll(".corners").remove();
        }
    }
    function mousedown() {
        svg.selectAll(".corners").remove();
        startX = event.offsetX;
        startY = event.offsetY;
        svg.append("rect")
            .attr("x", event.offsetX)
            .attr("y", event.offsetY)
            .attr("id", `rect-${count}`)
            .style("stroke", color)
            .style("stroke-width", "2")
            .attr("height", 0)
            .attr("width", 0)
            .call(d3.drag()
                .on("start", dragstarted)
                .on("drag", dragged)
                .on("end", dragended)
            );
        svg.on("mousemove", mousemove);
    }
    function mousemove() {
        let rect = d3.select(`#rect-${count}`);
        let x = event.offsetX - startX;
        let y = event.offsetY - startY;
        if(x < 0){
            rect.attr("x", event.offsetX).attr("width", Math.abs(x))
        }else{
            rect.attr("width", Math.max(0, event.offsetX - startX));
        }
        if(y < 0){
            rect.attr("y", event.offsetY).attr("height", Math.abs(y))
        }else{
            rect.attr("height", Math.max(0, event.offsetY - startY));
        }
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
        if(rect.attr("width") < areaLimit || rect.attr("height") < areaLimit){
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
    
    function dragstarted() {
        svg.selectAll(".corners").remove();
        let selected = d3.select(event.target);
        grabX = event.offsetX - selected.attr("x");
        grabY = event.offsetY - selected.attr("y");
    }
    
    function dragged(evt) {
        let grabbed = d3.select(this);
        grabbed.attr("x", evt.x - grabX)
            .attr("y", evt.y - grabY)
            .attr("cursor", "grabbing");
        justMove()
    }
    
    function dragended() {
        d3.select(this)
            .attr("cursor", "crosshair");
    }
    
    function dragBR(){
        let coordX = Math.max(areaLimit, event.offsetX - selected.attr("x"));
        let coordY = Math.max(areaLimit, event.offsetY - selected.attr("y"));
        if(coordX > areaLimit && coordY > areaLimit){
            d3.select(this).attr("cx", event.offsetX).attr("cy", event.offsetY);
            selected.attr("width", coordX)
                .attr("height", coordY);
            d3.select("#bottom-left").attr("cy", event.offsetY);
            d3.select("#top-right").attr("cx", event.offsetX);
        }
        justMove()
    }
    function dragBL(){
        let BR = d3.select("#bottom-right");
        let coordY = Math.max(areaLimit, event.offsetY - selected.attr("y"));
        let coordX = Math.max(areaLimit, BR.attr("cx") - event.offsetX);
        if(coordX > areaLimit && coordY > areaLimit){
            selected.attr("height", coordY)
                .attr("x", event.offsetX)
                .attr("width", coordX);
            d3.select(this).attr("cx", event.offsetX).attr("cy", event.offsetY);
            BR.attr("cy", event.offsetY );
            d3.select('#top-left').attr("cx", event.offsetX);
        }
        justMove()
    }
    function dragTL(){
        let BR = d3.select("#bottom-right");
        let coordX = Math.max(areaLimit, BR.attr("cx") - event.offsetX);
        let coordY = Math.max(areaLimit, BR.attr("cy") - event.offsetY);
        if(coordX > areaLimit && coordY > areaLimit){
            selected.attr("x", event.offsetX)
                .attr("y", event.offsetY)
                .attr("width", coordX)
                .attr("height", coordY);
            d3.select('#top-left').attr("cx", event.offsetX)
                .attr("cy", event.offsetY);
            d3.select("#top-right").attr("cy", event.offsetY);
            d3.select("#bottom-left").attr("cx", event.offsetX);
        }
        justMove()
    }
    function dragTR(){
        let BL = d3.select("#bottom-right");
        let TL = d3.select("#top-left");
        let coordY = Math.max(areaLimit, BL.attr("cy") - event.offsetY);
        let coordX = Math.max(areaLimit, event.offsetX - TL.attr("cx"));
        if(coordX > areaLimit && coordY > areaLimit){
            d3.select("#top-right").attr("cx", event.offsetX)
                .attr("cy", event.offsetY);
            selected.attr("y", event.offsetY)
                .attr("height", coordY)
                .attr("width", coordX);
            TL.attr("cy", event.offsetY);
            BL.attr("cx", event.offsetX);
        }
        justMove()
    }
}

export function getRects(){
    let rects = d3.selectAll("rect");
    let list = [];
    rects.each(function(){
        let item = {};
        let rect = d3.select(this);
        item.x = rect.attr("x");
        item.y = rect.attr("y");
        item.width = rect.attr("width");
        item.height = rect.attr("height");
        list.push(item);
    });
    return list;
}

export function setRects(list, color){
    
    list.forEach(function(item) {
        let grabX = 0;
        let grabY = 0;
        d3.select("svg").append("rect")
            .attr("x", item.x)
            .attr("y", item.y)
            .attr("width", item.width)
            .attr("height", item.height)
            .style("stroke", color)
            .style("stroke-width", "2")
            .call(d3.drag()
                .on("start", dragstarted)
                .on("drag", dragged)
                .on("end", dragended)
            );
        function dragstarted() {
            d3.selectAll(".corners").remove();
            let selected = d3.select(event.target);
            grabX = event.offsetX - selected.attr("x");
            grabY = event.offsetY - selected.attr("y");
        }
        function dragged(evt) {
            let grabbed = d3.select(this);
            grabbed.attr("x", evt.x - grabX)
                .attr("y", evt.y - grabY)
                .attr("cursor", "grabbing");
            justMove()
        }
        function dragended() {
            d3.select(this)
                .attr("cursor", "crosshair");
        }
        function justMove(){
            d3.select("#horiz").attr("y1", event.offsetY)
                .attr("y2", event.offsetY);
            d3.select("#vert").attr("x1", event.offsetX)
                .attr("x2", event.offsetX)
        }
    });
}