<template>
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-12 col-md-6 col-xl-6 form-col">
            <div class="form-wrapper">
                <form action="#" :class="{'has-error': hasError, 'incorrect-password': incorrectPassword}">
                    <div class="title-form">Назначение нового пароля</div>
                    <div class="form-group">
                        <div class="subtitle-form">Ввведите, пожалуйста, новый пароль:</div>
                        <div class="error-msg">Пароли должны совпадать</div>
                    </div>
                    <div class="form-group password">
                        <label for="inputPassword">Новый пароль:</label>
                        <input type="password" class="form-control" id="inputPassword" aria-describedby="emailHelp"
                               placeholder="Новый пароль:"
                               v-model="password"
                               name="password">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"
                             @mousedown.prevent="showPassword"
                             @mouseup.prevent="hidePassword"
                             @touchstart.prevent="showPassword"
                             @touchend.prevent="hidePassword" v-if="showIconPassword" data-target="#inputPassword">
                            <mask id="mask0" mask-type="alpha" maskUnits="userSpaceOnUse" x="4" y="7" width="22" height="16">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15 7.5C10 7.5 5.73 10.61 4 15C5.73 19.39 10 22.5 15 22.5C20 22.5 24.27 19.39 26 15C24.27 10.61 20 7.5 15 7.5ZM15 20C12.24 20 10 17.76 10 15C10 12.24 12.24 10 15 10C17.76 10 20 12.24 20 15C20 17.76 17.76 20 15 20ZM15 12C13.34 12 12 13.34 12 15C12 16.66 13.34 18 15 18C16.66 18 18 16.66 18 15C18 13.34 16.66 12 15 12Z" fill="white"/>
                            </mask>
                            <g mask="url(#mask0)">
                                <rect x="2" y="2" width="26" height="26" fill="#D8D8D8"/>
                            </g>
                        </svg>
                    </div>
                    <small class="incorrect-password-msg">Пароль должен содержать не менее 6 латинских символов, цифр, букв и знаков препинания</small>
                    <div class="form-group password">
                        <label for="inputPasswordRepeate">Подтвердите пароль:</label>
                        <input type="password" class="form-control" id="inputPasswordRepeate" aria-describedby="emailHelp"
                               placeholder="Подтвердите пароль:"
                               v-model="passwordRepeate"
                               name="repeate">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"
                             @mousedown.prevent="showPasswordRepeate"
                             @mouseup.prevent="hidePasswordRepeate"
                             @touchstart.prevent="showPasswordRepeate"
                             @touchend.prevent="hidePasswordRepeate" v-if="showIconPasswordRepeate" data-target="#inputPasswordRepeate">
                            <mask id="mask0" mask-type="alpha" maskUnits="userSpaceOnUse" x="4" y="7" width="22" height="16">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15 7.5C10 7.5 5.73 10.61 4 15C5.73 19.39 10 22.5 15 22.5C20 22.5 24.27 19.39 26 15C24.27 10.61 20 7.5 15 7.5ZM15 20C12.24 20 10 17.76 10 15C10 12.24 12.24 10 15 10C17.76 10 20 12.24 20 15C20 17.76 17.76 20 15 20ZM15 12C13.34 12 12 13.34 12 15C12 16.66 13.34 18 15 18C16.66 18 18 16.66 18 15C18 13.34 16.66 12 15 12Z" fill="white"/>
                            </mask>
                            <g mask="url(#mask0)">
                                <rect x="2" y="2" width="26" height="26" fill="#D8D8D8"/>
                            </g>
                        </svg>
                    </div>
                    <div class="form-group d-flex flex-row btn-form-group">
                        <button @click.prevent="newPassword">подтвердить</button>
                        <button class="cancel" @click.prevent="clearAll">Отмена</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="position-fixed notification" style="z-index: 5; right: 0; bottom: 0;">
            <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000" data-autohide="false">
                <div class="toast-body">
                    <div class="text-toast">Пароль успешно изменен</div>
                    <div class="form-group d-flex flex-row btn-form-group">
                        <button @click.prevent="redirectToLogin">ок</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "TheRepairPasswordNew",
    data() {
        return {
            password: '',
            passwordRepeate: '',
            showIconPassword: false,
            showIconPasswordRepeate: false,
            hasError: false,
            incorrectPassword: false,
        };
    },
    methods: {
        showPassword() {
            document.querySelector('input[name=password]').setAttribute('type', 'text');
        },
        hidePassword() {
            document.querySelector('input[name=password]').setAttribute('type', 'password');
        },
        showPasswordRepeate() {
            document.querySelector('input[name=repeate]').setAttribute('type', 'text');
        },
        hidePasswordRepeate() {
            document.querySelector('input[name=repeate]').setAttribute('type', 'password');
        },
        newPassword() {
            $('.toast').toast('show');
            const regExp = new RegExp('^(?=.*[A-Za-z])(?=.*\\d)[A-Za-z\\d]{6,}$');
            if(this.password.search(regExp) === -1) {
                this.incorrectPassword = true;
            } else if(this.password !== this.passwordRepeate) {
                this.hasError = true;
                this.incorrectPassword = false;
            } else {
                this.hasError = false;
                this.incorrectPassword = false;
                axios.post('/api/login/repair-password/new-password', {
                    'password': this.password,
                    'email': this.resetPasswordEmail
                }).then(() => {
                    $('.toast').toast('show');
                })
            }
        },
        clearAll() {
            this.password = '';
            this.passwordRepeate = '';
        },
        redirectToLogin() {
            $('.toast').toast('hide');
            this.$router.push('/login');
        }
    },
    watch: {
        password() {
            this.showIconPassword = this.password.length > 0;
        },
        passwordRepeate() {
            this.showIconPasswordRepeate = this.passwordRepeate.length > 0;
        },
    },
    computed: {
        ...mapGetters(['resetPasswordEmail']),
    }
}
</script>

<style scoped>
.form-wrapper {
    padding: 23px 129px;
    background: #FFFFFF;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    border-radius: 6px;
}
.title-form {
    font-family: 'Roboto', sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 24px;
    line-height: 60px;
    text-align: center;
    color: #606060;
    margin-bottom: 40px;
}
.form-group {
    margin-bottom: 10px;
}
.notification {
    top: 10px;
    right: 40vw;
    left: 40vw;
    height: 100px;
}
.notification button {
    display: block;
    background: #1875F0;
    border: 2px solid #F5F5F5;
    box-sizing: border-box;
    border-radius: 4px;
    padding: 15px 40px;
    font-family: 'Roboto', sans-serif;
    font-style: normal;
    font-weight: 900;
    font-size: 12px;
    text-align: center;
    text-transform: uppercase;
    color: #FFFFFF;
}
.password {
    position: relative;
}
.password svg {
    position: absolute;
    bottom: 5px;
    right: 10px;
    cursor: pointer;
}
.form-group label {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 30px;
    color: #666666;
    margin-bottom: 10px;
}
.form-group input {
    background: #FFFFFF;
    border: 2px solid #F5F5F5;
    box-sizing: border-box;
    border-radius: 4px;
    outline: none;
    font-family: Roboto;
    font-style: normal;
    font-weight: bold;
    font-size: 14px;
    line-height: 60px;
    color: #808080;
    padding: 20px 25px;
}
.form-group input:focus {
    outline: none;
    border: 2px solid #F5F5F5;
    box-shadow: none;
}
form button {
    display: block;
    background: #1875F0;
    border: 2px solid #F5F5F5;
    box-sizing: border-box;
    border-radius: 4px;
    padding: 15px 40px;
    font-family: 'Roboto', sans-serif;
    font-style: normal;
    font-weight: 900;
    font-size: 12px;
    text-align: center;
    text-transform: uppercase;
    color: #FFFFFF;
}
.reset-password a {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 30px;
    color: #1875F0;
}
.subtitle-form {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 30px;
    text-align: center;
    color: #666666;

}
.btn-form-group {
    justify-content: space-around;
    margin-top: 20px;
}
.cancel {
    font-style: normal;
    font-weight: 900;
    font-size: 12px;
    text-align: center;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #B3B3B3;
    padding: 15px 40px;
    background: #FFFFFF;
    border: 2px solid #F5F5F5;
    box-sizing: border-box;
    border-radius: 4px;
    display: block;
}
.error-msg {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    text-align: center;
    color: #FF0000;
    margin-bottom: 10px;
    display: none;
}
.has-error label, .incorrect-password label[for=inputPassword] {
    color: #FF0000;
}
.incorrect-password .incorrect-password-msg {
    display: block;
}
.incorrect-password-msg {
    display: none;
}
.has-error .error-msg {
    display: block;
}
.has-error .subtitle-form {
    display: none;
}
@media screen and (max-width: 1023.99px) {
    .form-wrapper {
        padding: 23px;
    }
}
@media screen and (min-width: 1900px) {
    .form-col {
        max-width: 30%;
        flex: 0 0 30%;
    }
}
</style>
