<template>
    <div class="form">
        <div class="pending" v-if="isPending">
            Ваши данные проверяются администратором
        </div>
        <div class="long-title"><h3>Данные пользователя:</h3></div>
        <div id="form-container">
            <form action="" id="profile" @submit="handleSubmit($event)">
                <DxForm
                        :form-data="form"
                        @initialized="saveComponentInstance"
                        :show-validation-summary="true"
                        labelMode="floating"
                >
                    <template #fileTemplate>
                        <div class="files-container">
                            <div class="fileuploader-container">
                                <p class="cursive">Чтобы выбрать несколько файлов, используйте SHIFT или CTRL</p>
                                <p class="note">
                                    Разрешенные расширения файлов:
                                    <span>.jpg, .jpeg, .png</span>.
                                </p>
                                <p class="note">
                                    Максимальный размер файла:
                                    <span>4 MB</span>.
                                </p>
                                <DxFileUploader
                                        select-button-text="Select photo"
                                        label-text=""
                                        :accept="accept"
                                        :multiple="true"
                                        :max-file-size="4000000"
                                        :upload-mode="uploadMode"
                                        @value-changed="e => selectFile(e.value)"
                                        :allowed-file-extensions="['.jpg', '.jpeg', '.png']"
                                >
                                    <DxValidator>
                                        <DxRequiredRule message="Приложите сканы документов"/>
                                    </DxValidator>
                                </DxFileUploader>
                            </div>
                            <div class="files-text">
                                <p>Пожалуйста, загрузите следующие документы:</p>
                                <ol>
                                    <li>Скан страниц паспорта (страница с фото + прописка)</li>
                                    <li>Скан СНИЛС</li>
                                    <li>Скан ИНН</li>
                                    <li>Фото Пользователя с паспортом (с разворотом с фотографией)</li>
                                    <li>Справку о постановке на учет физического лица в качестве налогоплатильщика налога на профессиональный доход</li>
                                    <li>Чек из приложения «Мой налог» с общей суммой дохода, сформированный на дату заключения Пользовательского соглашения</li>
                                </ol>
                            </div>
                        </div>
                    </template>
                    <DxGroupItem
                            caption="Личные данные"
                            :col-span="1"
                            :col-count="2"
                    >
                        <DxSimpleItem
                                data-field="username"
                                :editor-options="nameEditorOptions"
                        >
                            <DxLabel text="Имя" />
                            <DxRequiredRule message="Пожалуйста, введите ваше имя"/>
                            <DxPatternRule
                                    :pattern="namePattern"
                                    message="Имя введено неверно"
                            />
                        </DxSimpleItem>
                        <DxSimpleItem
                                data-field="patronymic"
                                :editor-options="patronymicEditorOptions"
                        >
                            <DxLabel text="Отчество(при наличии)" />
                            <DxPatternRule
                                    :pattern="patronymicPattern"
                                    message="Отчество введено неверно"
                            />
                        </DxSimpleItem>
                        <DxSimpleItem
                                data-field="surname"
                                :editor-options="surnameEditorOptions"
                        >
                            <DxLabel text="Фамилия" />
                            <DxRequiredRule message="Пожалуйста, введите вашу фамилию"/>
                            <DxPatternRule
                                    :pattern="surnamePattern"
                                    message="Фамилия введена неверно"
                            />
                        </DxSimpleItem>
                        <DxSimpleItem
                                data-field="dateOfBirth"
                                editor-type="dxDateBox"
                        >
                            <DxRequiredRule message="Пожалуйста, укажите дату вашего рождения"/>
                            <DxRangeRule
                                    :max="maxDate"
                                    :min="new Date().setFullYear(new Date().getFullYear()-100)"
                                    message="Вам должно быть больше 18 лет"
                            />
                            <DxLabel text="Дата рождения" />
                        </DxSimpleItem>
                        <DxSimpleItem
                                data-field="citizenship"
                                :editor-options="citizenshipEditorOptions"
                        >
                            <DxLabel text="Гражданство" />
                            <DxRequiredRule message="Пожалуйста, укажите ваше гражданство"/>
                            <DxPatternRule
                                    :pattern="citizenshipPattern"
                                    message="Гражданство введено неверно"
                            />
                        </DxSimpleItem>
                        <DxSimpleItem
                                data-field="phone"
                                :editor-options="phoneEditorOption"
                        >
                            <DxLabel text="Номер мобильного телефона"/>
                            <DxRequiredRule message="Пожалуйста, укажите ваш телефон"/>
                        </DxSimpleItem>
                    </DxGroupItem>
                    <DxGroupItem
                            caption="Паспортные данные"
                            :col-span="1"
                            :col-count="3"
                    >
                        <DxSimpleItem
                                data-field="passport_series"
                                :col-span="1"
                        >
                            <DxLabel text="Серия паспорта"/>
                            <DxRequiredRule message="Пожалуйста, укажите серию паспорта"/>
                            <DxPatternRule
                                    :pattern="seriesPattern"
                                    message="Серия введена неверно"
                            />
                        </DxSimpleItem>
                        <DxSimpleItem
                                data-field="passport_number"
                                :col-span="1"
                        >
                            <DxLabel text="Номер паспорта"/>
                            <DxRequiredRule message="Пожалуйста, укажите номер паспорта"/>
                            <DxPatternRule
                                    :pattern="numberPattern"
                                    message="Номер паспорта введен неверно"
                            />
                        </DxSimpleItem>
                        <DxSimpleItem
                                data-field="passport_date"
                                editor-type="dxDateBox"
                                :col-span="1"
                        >
                            <DxRequiredRule message="Пожалуйста, укажите дату выдачи паспорта"/>
                            <DxRangeRule
                                    :max="new Date()"
                                    :min="new Date().setFullYear(new Date().getFullYear()-70)"
                                    message="Укажите верную дату выдачи паспорта"
                            />
                            <DxLabel text="Дата выдачи паспорта"/>
                        </DxSimpleItem>
                        <DxSimpleItem
                            data-field="passport_origin"
                            editor-type="dxTextArea"
                            :editor-options="textAreaEditorOptions"
                            :col-span="3"
                        >
                            <DxRequiredRule message="Пожалуйста, укажите кем был выдан паспорт"/>
                            <DxLabel text="Укажите кем был выдан паспорт"/>
                        </DxSimpleItem>

                        <DxSimpleItem
                                data-field="address_reg"
                                editor-type="dxTextArea"
                                :editor-options="textAreaEditorOptions"
                                :col-span="3"
                        >
                            <DxRequiredRule message="Пожалуйста, укажите ваш адрес регистрации"/>
                            <DxLabel text="Адрес регистрации"/>
                        </DxSimpleItem>
                        <DxSimpleItem
                                data-field="address_loc"
                                editor-type="dxTextArea"
                                :editor-options="textAreaEditorOptions"
                                :col-span="3"
                        >
                            <DxRequiredRule message="Пожалуйста, укажите ваш адрес фактического проживания"/>
                            <DxLabel text="Адрес фактического проживания"/>
                        </DxSimpleItem>
                        <DxSimpleItem
                                data-field="inn"
                        >
                            <DxLabel text="Номер ИНН" />
                            <DxRequiredRule message="Пожалуйста, укажите ваш ИНН"/>
                            <DxPatternRule
                                    :pattern="innPattern"
                                    message="ИНН введен неверно(12 цифр)"
                            />
                        </DxSimpleItem>
                        <DxSimpleItem
                                data-field="snils"
                                :editor-options="snilsEditorOption"
                        >
                            <DxRequiredRule message="Пожалуйста, укажите ваш СНИЛС"/>
                            <DxLabel text="Номер СНИЛС" />
                        </DxSimpleItem>
                    </DxGroupItem>
                    <DxGroupItem
                            :col-span="1"
                            :col-count="2"
                            caption="Банковские данные"
                        >
                        <DxSimpleItem
                                data-field="bank_card"
                        >
                            <DxRequiredRule message="Пожалуйста, укажите номер банковской карты"/>
                            <DxPatternRule
                                    :pattern="bankCardPattern"
                                    message="Номер карты введен неверно(от 13 до 19 цифр)"
                            />
                            <DxLabel text="Номер банковской карты(для перевода средств)"/>
                        </DxSimpleItem>
                        <DxSimpleItem
                                data-field="bank_account"
                        >
                            <DxRequiredRule message="Пожалуйста, укажите номер счета"/>
                            <DxPatternRule
                                    :pattern="bankAccountPattern"
                                    message="Номер счета введен неверно(20 цифр)"
                            />
                            <DxLabel text="Номер счета, привязанного к карте"/>
                        </DxSimpleItem>
                        <DxSimpleItem
                                data-field="bank_name"
                                :editor-options="bankNameEditorOptions"
                        >
                            <DxLabel text="Наименование банка"/>
                            <DxRequiredRule message="Пожалуйста, укажите наименование банка"/>
                        </DxSimpleItem>
                        <DxSimpleItem
                                data-field="bank_bik"
                        >
                            <DxRequiredRule message="Пожалуйста, укажите БИК"/>
                            <DxPatternRule
                                    :pattern="bankBikPattern"
                                    message="БИК введен неверно(9 цифр)"
                            />
                            <DxLabel text="БИК"/>
                        </DxSimpleItem>
                        <DxSimpleItem
                                data-field="bank_corr"
                        >
                            <DxRequiredRule message="Пожалуйста, укажите корреспонденский счет"/>
                            <DxPatternRule
                                    :pattern="bankCorPattern"
                                    message="Корреспонденский счет введен неверно(20 цифр)"
                            />
                            <DxLabel
                                    text="Корреспонденский счет"
                                    location="top"
                            />
                        </DxSimpleItem>
                    </DxGroupItem>
                    <DxGroupItem template="fileTemplate"/>

                </DxForm>

                <DxButton
                        id="button"
                        :use-submit-behavior="true"
                        template="buttonTemplate"
                >
                    <template #buttonTemplate>
                        <div class="button-template hovered dx-button-text">
                            Отправить
                        </div>
                    </template>
                </DxButton>
            </form>
        </div>
    </div>
</template>
<script>
    import notify from 'devextreme/ui/notify';
    import authService from "../../services/auth.service";
    import { DxFileUploader } from 'devextreme-vue/file-uploader';
    import 'devextreme-vue/text-area';
    import DxButton from 'devextreme-vue/button';
    import DxForm, {
        DxLabel,
        DxSimpleItem,
        DxGroupItem,
        DxPatternRule,
        DxRangeRule,
    } from 'devextreme-vue/form';

    import {
        DxValidator,
        DxRequiredRule,
    } from 'devextreme-vue/validator';
    import personalService from "../../services/personal.service";
    import {
        dataTemplate,
        nameLayout,
        namePattern,
        surnameLayout,
        surnamePattern,
        patronymicLayout,
        patronymicPattern,
        DateOfBirthMaxDate,
        citizenshipLayout,
        citizenshipPattern,
        phoneLayout,
        seriesPattern,
        numberPattern,
        textAreaLayout,
        innPattern,
        snilsLayout,
        bankCardPattern,
        bankAccountPattern,
        bankNameLayout,
        bankBikPattern,
        bankCorPattern,
        // mockData,
    } from "./rules";
    import offerServices from "../../services/offer.service";

    export default {
        components: {
            DxForm,
            DxLabel,
            DxSimpleItem,
            DxGroupItem,
            DxFileUploader,
            DxButton,
            DxValidator,
            DxRequiredRule,
            DxPatternRule,
            DxRangeRule,
        },

        data() {
            return {
                form: dataTemplate,
                nameEditorOptions: nameLayout,
                namePattern,
                surnameEditorOptions: surnameLayout,
                surnamePattern,
                patronymicEditorOptions: patronymicLayout,
                patronymicPattern,
                maxDate: DateOfBirthMaxDate,
                citizenshipEditorOptions: citizenshipLayout,
                citizenshipPattern,
                phoneEditorOption: phoneLayout,
                seriesPattern,
                numberPattern,
                textAreaEditorOptions: textAreaLayout,
                innPattern,
                snilsEditorOption: snilsLayout,
                bankCardPattern,
                bankAccountPattern,
                bankNameEditorOptions: bankNameLayout,
                bankBikPattern,
                bankCorPattern,
                multiple: true,
                accept: 'jpg, png, jpeg',
                uploadMode: 'useForm',
                error: null,
                files: [],
                formInstance: null,
                isPending: false,
            }
        },
        mounted() {
          this.isPending = authService.isPending();
          setInterval(this.checkOffer, 30000);
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
            saveComponentInstance: function(e){
                this.formInstance = e.component
            },
            selectFile(file) {
                this.files = file;
            },
            async handleSubmit(e) {
                e.preventDefault();
                if(this.formInstance.validate().isValid){
                    const options = {
                        year: 'numeric',
                        month: 'numeric',
                        day: 'numeric',
                        timezone: 'UTC'
                    };

                    this.form.dob = this.form.dateOfBirth.toLocaleString("ru", options).split(".").reverse().join("-");
                    this.form.pass_date = this.form.passport_date.toLocaleString("ru", options).split(".").reverse().join("-");
                    let formData = new FormData();
                    for (let i = 0; i < this.files.length; i++) {
                        formData.append("Files[]", this.files[i]);
                    }
                    for (let key in this.form){
                        formData.append(key, this.form[key]);
                    }
                    const {success, errors} = await personalService.setPersonal(formData);
                    if(success){
                        notify({
                            message: 'Вы успешно отправили данные!',
                            position: {
                                my: 'center top',
                                at: 'center top',
                            },
                        }, 'success', 1000);
                        authService.setStatus(1);
                        this.isPending = true;
                    }
                    else {
                        this.error = errors;
                        notify({
                            message: 'Что-то пошло не так! Обратитесь, пожалуйста, к администратору!',
                            position: {
                                my: 'center top',
                                at: 'center top',
                            },
                        }, 'error', 1000);
                    }
                }
            },
        },
    };
</script>
<style scoped lang="scss">
    .form{
        max-width: 900px;
        margin: 50px auto;
    }
    #form-container {
        margin: 10px 10px 30px;
    }

    .long-title h3 {
        font-weight: 200;
        font-size: 28px;
        text-align: center;
        margin-bottom: 20px;
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
    .files-container{
        display: flex;
        flex-direction: row;
        width: 100%;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .files-text{
        width: 50%;
        font-size: 16px;
        padding-top: 20px;
    }
    .fileuploader-container {
        padding-top: 20px;
        padding-bottom: 20px;
        max-width: 420px;
    }
    .note {
        font-size: 10pt;
        color: #484848;
    }

    .note > span {
        font-weight: 700;
    }
    ol {
        list-style-type: none;
        counter-reset: num;
        margin: 0 0 0 35px;
        padding: 15px 0 5px 0;
        font-size: 16px;
    }
    ol li {
        position: relative;
        margin: 0 0 0 0;
        padding: 0 0 10px 0;
    }
    ol li:before {
        content: counter(num) '.';
        counter-increment: num;
        display: inline-block;
        position: absolute;
        top: 0px;
        left: -26px;
        width: 20px;
        text-align: right;
    }
    .cursive{
        font-style: italic;
        margin-top: 10px;
        font-weight: bold;
        margin-bottom: .5rem;
    }
    .pending{
        text-align: center;
        font-style: italic;
        color: #fff;
        background-color: #0f6674;
    }
</style>
