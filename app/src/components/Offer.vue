<template>
    <div class="wrap">
        <h2 class="offer-header">ПОЛЬЗОВАТЕЛЬСКОЕ СОГЛАШЕНИЕ <br>(оферта)</h2>
        <h5 class="credentials">Российская Федерация, г. Санкт-Петербург<br>Дата размещения и вступления в силу - {{offerDate}}г.</h5>
        <div v-html="offer">
        </div>
    </div>
</template>
<script>
import offerServices from "../services/offer.service";
    export default {
        data() {
            return {
                offerToken:'',
                offer: '',
                offerDate: '',
                errors: null
            }
        },
        async mounted(){
            const {success, data, errors} = await offerServices.getActiveOffer();
            if(success){
                let str = data.date;
                this.offer = data.text;
                this.offerDate = str.substr(-22,10).split("-").reverse().join(".");
            }else {
                this.errors = errors;
            }
        }
    }
</script>
<style lang="scss">
    h2.offer-header{
        text-align: center;
        margin-bottom: 30px;
    }
    h5.credentials{
        margin-bottom: 20px;
    }
    ol.list{
        margin-top: 1rem;
        list-style-type: decimal;
        margin-left: .5rem;
        margin-bottom: 30px;
    }
    ol.list li{
        padding-left: .5rem;
        margin-bottom: .2rem;
    }
    h3.syllabus{
        margin-top: 20px;
        margin-left: 30px;
    }
    .cyrillic {
        list-style-type: none;
        margin: 0 0 0 5px;
        padding: 15px 0 5px 0;
    }
    .cyrillic li {
        position: relative;
        margin: 0 0 0 0;
        padding: 0 0 10px 0;
    }
    .cyrillic li:before {
        margin-right: 5px;
        width: 1em;
        text-align: right;
        display: inline-block;
        top: 0;
        left: -26px;
    }
    .cyrillic li:nth-child(1)::before { content: 'а)'; }
    .cyrillic li:nth-child(2)::before { content: 'б)'; }
    .cyrillic li:nth-child(3)::before { content: 'в)'; }
    .cyrillic li:nth-child(4)::before { content: 'г)'; }
    .cyrillic li:nth-child(5)::before { content: 'д)'; }
    .cyrillic li:nth-child(6)::before { content: 'е)'; }
    .cyrillic li:nth-child(7)::before { content: 'ё)'; }
    .cyrillic li:nth-child(8)::before { content: 'ж)'; }
    .cyrillic li:nth-child(9)::before { content: 'з)'; }
    .cyrillic li:nth-child(10)::before { content: 'и)'; }

    .numeric{
        list-style-type: decimal;
        margin: 0 0 0 35px;
        padding: 15px 0 25px 0;
    }
    .numeric li{
        line-height: 1.5;
        padding: 0 0 0 10px;
    }

    .multilevel{
        counter-reset: section;
        list-style-type: none;
        margin: 0 0 0 5px;
        padding: 5px 0 5px 0;
    }
    .multilevel li{
            margin: 0 0 0 0;
            padding: 0 0 .5rem 0;
    }

    .multilevel li::before{
        counter-increment: section;
        content: counters(section, ".") ". ";
        margin-right: 5px;
    }
    h4.right{
        text-align: right;
    }
    h3.center{
        text-align: center;
        font-weight: 600;
    }
    .latin {
        list-style-type: none;
        margin: 0 0 0 -15px;
        padding: 10px 0 5px 0;
    }
    .latin li {
        position: relative;
        margin: 0 0 0 0;
        padding: 0 0 10px 0;
    }
    .latin li::before {
        margin-right: 5px;
        width: 1em;
        text-align: right;
        display: inline-block;
        top: 0;
        left: -26px;
    }
    .latin li:nth-child(1)::before { content: 'a)'; }
    .latin li:nth-child(2)::before { content: 'b)'; }
    .latin li:nth-child(3)::before { content: 'c)'; }
    .latin li:nth-child(4)::before { content: 'd)'; }
    .latin li:nth-child(5)::before { content: 'e)'; }
    .latin li:nth-child(6)::before { content: 'f)'; }
    .latin li:nth-child(7)::before { content: 'g)'; }
    .latin li:nth-child(8)::before { content: 'h)'; }
    .latin li:nth-child(9)::before { content: 'i)'; }
    .latin li:nth-child(10)::before { content: 'j)'; }

</style>