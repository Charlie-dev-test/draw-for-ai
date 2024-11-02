<template>
    <div class="offer">
        <div class="center">
            <Offer/>
            <form v-if="showForm" action="" @submit="handleSubmit($event)">
                <div class="dx-fieldset">
                    <DxCheckBox
                            id="readed"
                            :value="false"
                            text="Я внимательно прочитал и понял все условия Пользовательского соглашения и Политики конфиденциальности"
                    >
                        <DxValidator>
                            <DxCompareRule
                                    :comparison-target="checkComparison"
                                    message="Вы должны прочитать Соглашение"
                            />
                        </DxValidator>
                    </DxCheckBox>
                </div>
                <div class="dx-fieldset">
                    <DxCheckBox
                            id="check"
                            :value="false"
                            text="Я принимаю условия Пользовательского соглашения и Политики конфиденциальности"
                    >
                        <DxValidator>
                            <DxCompareRule
                                    :comparison-target="checkComparison"
                                    message="Вы должны принять условия"
                            />
                        </DxValidator>
                    </DxCheckBox>
                </div>
                <div class="dx-fieldset">
                    <DxValidationSummary/>
                    <DxButton
                            id="button"
                            :use-submit-behavior="true"
                            template="buttonTemplate"
                    >
                        <template #buttonTemplate>
                            <div class="button-template hovered dx-button-text">
                                Принять
                            </div>
                        </template>
                    </DxButton>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import Offer from '../components/Offer';
import authService from "../services/auth.service";
import offerServices from "../services/offer.service";
import DxButton from 'devextreme-vue/button';
import DxCheckBox from 'devextreme-vue/check-box';
import DxValidationSummary from 'devextreme-vue/validation-summary';
import {DxValidator, DxCompareRule} from 'devextreme-vue/validator';
import notify from 'devextreme/ui/notify';
import personalService from "../services/personal.service";
export default {
    name: 'OfferAccept',
    components: {
        Offer,
        DxCheckBox,
        DxButton,
        DxValidationSummary,
        DxValidator,
        DxCompareRule
    },
    data() {
        return {
            showForm: false,
            errors: null
        }
    },
    mounted() {
      if(authService.isLoggedIn()){
          this.showForm = true;
          setInterval(this.checkOffer, 30000);
      }
    },
    methods: {
        async checkOffer(){
            if(authService.isLoggedIn()){
                await personalService.getStatus();
                if(!offerServices.compareTokens()){
                    authService.logout()
                }
            }
        },
        async handleSubmit(e){
            e.preventDefault();
            let formData = new FormData();
            formData.append('offer_token', offerServices.getToken());
            const {success, errors} = await offerServices.setNewOffer(formData);
            if(success){
                if(authService.isChecked()){
                    this.$router.push({name: 'Account'})
                }else{
                    this.$router.push({name: 'Profile'})
                }
            } else {
                this.errors = errors;
                notify({
                    message: 'Что-то пошло не так, обратитесь к администратору',
                    position: {
                        my: 'center top',
                        at: 'center top',
                    },
                }, 'error', 1000);
            }
        },
        checkComparison() {
            return true;
        }
    },
}
</script>
<style lang="scss" scoped>
    .offer{
        display: flex;
        flex-wrap: nowrap;
        justify-content: center;
        margin-top: 50px;
        @media screen and (max-width: 600px){
            flex-direction: column;
            align-items: center;
        }
        .left{
            img{
                width: 150px;
                margin-right: 20px;
                margin-left: 10px;
            }
        }
        .center{
            width: 1200px;
            padding: 20px;
            @media screen and (max-width: 600px){
                width: initial;
            }
        }
    }
    .dx-button-mode-contained{
        border-radius: 0;
        width: 120px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        background-color: #2579bf;
        border: 2px solid #000;
        margin-top: 20px;
        &:active{
            color: #fff;
            background-color: #2579bf;
            border: 2px solid #000;
        }
        &:hover{
            color: #fff;
            background-color: #2579bf;
            border: 2px solid #000;
        }
        &.dx-state-focused{
            color: #fff;
            background-color: #2579bf;
            border: 2px solid #000;
        }
    }
</style>