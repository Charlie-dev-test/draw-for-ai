<template>
    <div class="register">
<!--        <div class="left">-->
<!--            <img src="@/assets/img/logo.jpg" alt="datamist-logo">-->
<!--        </div>-->
        <div class="center">
            <div class="form-wrap">
                <h1>Регистрация нового пользователя:</h1>
                <form action="" @submit="handleSubmit($event)">
                    <div class="main-form-wrap">
                        <div class="labels">
                            <p>Логин:</p>
                            <p>Пароль:</p>
                            <p>Подтвердите пароль:</p>
                            <p>Электронная почта:</p>
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
                            <div class="dx-fieldset">
                                <DxTextBox
                                        v-model="form.passwordConfirm"
                                        mode="password"
                                >
                                    <DxValidator>
                                        <DxRequiredRule message="Вы должны подвердить пароль"/>
                                        <DxCompareRule
                                                :comparison-target="passwordComparison"
                                                message="Пароли не совпадают"
                                        />
                                    </DxValidator>
                                </DxTextBox>
                            </div>
                            <div class="dx-fieldset">
                                <DxTextBox
                                        v-model="form.email"
                                >
                                    <DxValidator>
                                        <DxRequiredRule message="Нужно указать электронную почту"/>
                                        <DxEmailRule message="Email не корректен"/>
                                        <DxStringLengthRule
                                                :max="50"
                                                message="Email не длиннее 50 символов"
                                        />
                                    </DxValidator>
                                </DxTextBox>
                            </div>
                        </div>
                    </div>
                    <Offer/>
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
    </div>
</template>
<script>
import authService from "../services/auth.service";
import Offer from '../components/Offer'
import DxButton from 'devextreme-vue/button';
import DxTextBox from 'devextreme-vue/text-box';
import DxValidationSummary from 'devextreme-vue/validation-summary';
import DxCheckBox from 'devextreme-vue/check-box';
import notify from 'devextreme/ui/notify';
import {DxValidator,
    DxRequiredRule,
    DxCompareRule,
    DxEmailRule,
    DxStringLengthRule,
    DxPatternRule,
} from 'devextreme-vue/validator';


export default {
    name: 'Register',
    components: {
        Offer,
        DxButton,
        DxTextBox,
        DxValidator,
        DxRequiredRule,
        DxValidationSummary,
        DxCheckBox,
        DxCompareRule,
        DxEmailRule,
        DxStringLengthRule,
        DxPatternRule
    },
    data() {
        const dataTemplate = {
            username: String(),
            password: String(),
            passwordConfirm: String(),
            email: null,
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
            formData.delete('passwordConfirm');
            const {success, errors} = await authService.register(formData);
            if(success){
                    notify({
                        message: 'Вы успешно зарегистрировались!',
                        position: {
                            my: 'center top',
                            at: 'center top',
                        },
                    }, 'success', 3000);
                this.$router.push({name: 'Profile'})
            } else {
                this.errors = errors;
                let showError = '';
                Object.keys(this.errors).forEach(function(key) {
                    showError = showError + this[key][0]+' ';
                }, this.errors);
                notify({
                    message: showError,
                    position: {
                        my: 'center top',
                        at: 'center top',
                    },
                }, 'error', 5000);
            }
        },
        passwordComparison() {
            return this.form.password;
        },
        checkComparison() {
            return true;
        },
    }
}
</script>
<style lang="scss" scoped>
    .register{
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
    .main-form-wrap{
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
    }
    .inputs{
        width: 400px;
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