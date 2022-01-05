    let inputMixins = {
        data() {
            return {

            }
        },
        methods: {
            handleErrorShow(input, message) {
                input.inputClass = 'form__input--warning';
                input.remind = message;
            },
            handleSuccessShow(input) {
                input.inputClass = 'form__input--success';
                input.remind = '';
            },
            handleEmailCheck(input) {
                const re =
                    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (re.test(input.text)) {
                    this.handleSuccessShow(input);
                } else {
                    this.handleErrorShow(input, '格式不正確');
                }
            },

            handlePasswordCheck(input) {
                let regExp = /^[\d|a-zA-Z]+$/;
                if (regExp.test(input.text)) {
                    this.handleLengthCheck(input, 6, 12);
                } else {
                    this.handleErrorShow(input, `${input.name}只能為字母和數字`)
                }

            },
            handleLengthCheck(input, min, max) {
                if (input.text.length <= min) {
                    this.handleErrorShow(input, `${input.name}需大於 ${min} 個字`)
                } else if (input.text.length >= max) {
                    this.handleErrorShow(input, `${input.name}需小於 ${max} 個字`)
                } else {
                    this.handleSuccessShow(input);
                }
            },
            handlePasswordMatchCheck(input1, input2) {
                if (input1.text !== input2.text) {
                    this.handleErrorShow(input2, '密碼不一致')
                } else {
                    this.handlePasswordCheck(input2);
                    if (input2.remind === '') {
                        this.handleSuccessShow(input2);
                    }
                }
            },
            handleRequiredCheck() {
                let isAllCheck = true;
                this.inputList.forEach(input => {
                    if (input.text.trim() === '') {
                        this.handleErrorShow(input, `${input.name}不能空白`);
                        isAllCheck = false;
                    } else if (input.remind !== '' && input.remind !== '帳號或密碼錯誤') {
                        isAllCheck = false;
                    } else {
                        this.handleSuccessShow(input);
                    }
                });
                return isAllCheck;

            }

        }
    }