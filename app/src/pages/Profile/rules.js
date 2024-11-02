export const dataTemplate = {
    username: '',
    surname: '',
    patronymic: '',
    citizenship: '',
    dateOfBirth: null,
    dob: '',
    phone: '',
    passport_series: '',
    passport_number: '',
    passport_date: null,
    pass_date: '',
    passport_origin: '',
    address_reg: '',
    address_loc: '',
    inn: '',
    snils: '',
    bank_card: '',
    bank_account: '',
    bank_name: '',
    bank_bik: '',
    bank_corr: '',
};

export const mockData = {
    username: 'Test',
    surname: 'Testov',
    patronymic: 'Testovich',
    citizenship: 'Russia',
    dateOfBirth: new Date(1990, 5, 22),
    dob: '',
    phone: '+7 (999) 999-9999',
    passport_series: '1234',
    passport_number: '123456',
    passport_date: new Date(2010, 8, 25),
    pass_date: '',
    passport_origin: 'Паспорт был выдан',
    address_reg: 'Зарегистрирован',
    address_loc: 'Проживаю',
    inn: '123456789012',
    snils: '123-123-123 12',
    bank_card: '12345678901234',
    bank_account: '12345678901234567890',
    bank_name: 'СберБанк',
    bank_bik: '123456789',
    bank_corr: '12345678901234567890',
};

export const nameLayout = {
    maxLength: '255',
};

export const namePattern = /^[^0-9]+$/;

export const surnameLayout = {
    maxLength: '255'
};

export const surnamePattern = /^[^0-9]+$/;

export const patronymicLayout = {
    maxLength: '255'
};

export const patronymicPattern = /^[^0-9]+$/;

export const DateOfBirthMaxDate = new Date().setFullYear(new Date().getFullYear() - 18);

export const citizenshipLayout = {
    maxLength: '255',
};

export const citizenshipPattern = /^[^0-9]+$/;

export const phoneLayout = {
    mask: '+7 (000) 000-0000',
    maskRules: {
        X: /[02-9]/,
    },
    useMaskedValue: true,
    maskInvalidMessage: 'Формат +7 (999) 999-9999',
};

export const seriesPattern = /^[0-9]{4}$/;

export const numberPattern = /^[0-9]{6}$/;

export const textAreaLayout = {
    maxLength: "1000",
};

export const innPattern = /^[0-9]{12}$/;

export const snilsLayout = {
    mask: '000-000-000 00',
    maskRules: {
        X: /[0-9]/,
    },
    useMaskedValue: true,
    maskInvalidMessage: 'Формат 000-000-000 00',
};

export const bankCardPattern = /^[0-9]{13,19}$/;

export const bankAccountPattern = /^[0-9]{20}$/;

export const bankNameLayout = {
    maxLength: '255',
};

export const bankBikPattern = /^[0-9]{9}$/;

export const bankCorPattern = /^[0-9]{20}$/;