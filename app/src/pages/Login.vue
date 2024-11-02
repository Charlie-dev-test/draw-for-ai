<template>
    <div class="login-form">
        <div class="login-form__wrap">
            <form action="x" @submit="handleSubmit($event)">
                <div align="left" class="dx-fieldset-header">Авторизация</div>
                <div class="wrap">
                    <div class="labels">
                        <p>Логин:</p>
                        <p>Пароль:</p>
                    </div>
                    <div class="inputs">
                        <div class="dx-fieldset">
                            <DxTextBox
                                    v-model="form.username"
                            >
                                <DxValidator>
                                    <DxRequiredRule message="Логин обязателен"/>
                                    <DxStringLengthRule
                                            :min="3"
                                            :max="255"
                                            message="Логин должен быть от 3 до 255 символов"
                                    />
                                </DxValidator>
                            </DxTextBox>
                        </div>
                        <div class="dx-fieldset">
                            <DxTextBox
                                    v-model="form.password"
                                    mode="password"
                            >
                                <DxValidator>
                                    <DxRequiredRule message="Пароль обязателен"/>
                                    <DxStringLengthRule
                                            :min="6"
                                            :max="255"
                                            message="Пароль от 6 до 255 символов"
                                    />
                                    <DxPatternRule
                                            :pattern="passwordPattern"
                                            message="Пароль должен содержать спецсимволы, латинские строчные и заглавные буквы, цифры"
                                    />
                                </DxValidator>
                            </DxTextBox>
                        </div>
                    </div>
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
                                Войти
                            </div>
                        </template>
                    </DxButton>
                </div>
            </form>
            <div class="register">
                <router-link to="/register" class="register-link">
                    Регистрация
                </router-link>
            </div>
        </div>
    </div>
</template>
<script>
import notify from 'devextreme/ui/notify';
import authService from "../services/auth.service";
import DxButton from 'devextreme-vue/button';
import DxTextBox from 'devextreme-vue/text-box';
import DxValidationSummary from 'devextreme-vue/validation-summary';
import {DxValidator,
    DxRequiredRule,
    DxStringLengthRule,
    DxPatternRule,
} from 'devextreme-vue/validator';
import offerServices from "../services/offer.service";
export default {
    components: {
        DxButton,
        DxTextBox,
        DxValidator,
        DxRequiredRule,
        DxStringLengthRule,
        DxPatternRule,
        DxValidationSummary
    },
    data() {
        const dataTemplate = {
            username: String(),
            password: String(),
        };
        return {
            // passwordPattern: /^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[!_@#$&*])(?=\S*?[0-9]).{8,})\S$/,
            passwordPattern: /^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$/,
            form: dataTemplate,
            errors: null
        }
    },
    methods: {
        async handleSubmit(e){
            e.preventDefault();
            let formData = new FormData();
            for (let key in this.form){
                formData.append(key, this.form[key]);
            }
            const {success, errors} = await authService.login(this.form);
            if(success){
                if(offerServices.compareTokens()){
                    if(authService.isChecked()){
                        this.$router.push({name: 'Dashboard'})
                    }else{
                        this.$router.push({name: 'Profile'})
                    }
                }else{
                    this.$router.push({name: 'UserAgreement'})
                }
            }else {
                this.errors = errors;
                let showError = '';
                if(this.errors.password[0] === 'Incorrect username or password.'){
                    showError = 'Неверная связка логин/пароль'
                }else {
                    showError = 'Что-то пошло не так! Обратитесь, пожалуйста, к администратору!';
                }
                notify({
                    message: showError,
                    position: {
                        my: 'center top',
                        at: 'center top',
                    },
                }, 'error', 1000);
            }
        },
    }
}
</script>
<style lang="scss" scoped>
    .login-form{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 80vh;
        &__wrap{
            border: 1px solid rgba(0,0,0,.1);
            border-radius: 7px;
            box-shadow: 0 0 10px -5px #000;
            padding: 20px;
        }
    }
    #button{
        margin-right: auto;
        margin-left: auto;
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
    .wrap{
        display: flex;
        .labels{
            padding-top: 35px;
            padding-bottom: 35px;
            font-size: 18px;
            text-align: end;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .inputs{
            width: 360px;
        }
    }
    .register{
        text-align: right;
        width: 90%;
        &-link{
            font-size: 18px;
        }
    }
</style>