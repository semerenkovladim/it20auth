<template>
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-12 col-md-6 col-xl-6 form-col">
            <div class="form-wrapper">
                <form action="#" :class="{'has-error': hasError}">
                    <div class="title-form">Авторизация</div>
                    <div class="form-group error-wrapper">
                        <div class="error-msg">Вы ввели неверный e-mail или пароль</div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">E-mail:</label>
                        <input type="email" class="form-control" id="inputEmail"
                               aria-describedby="emailHelp"
                               placeholder="E-mail:"
                               name="email"
                               v-model="email">
                    </div>
                    <div class="form-group password">
                        <label for="inputPassword">Пароль:</label>
                        <input type="password" class="form-control" id="inputPassword" aria-describedby="emailHelp"
                               placeholder="Пароль:"
                               v-model="password"
                               name="password">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"
                             @mousedown.prevent="showPassword"
                             @mouseup.prevent="hidePassword"
                             @touchstart.prevent="showPassword"
                             @touchend.prevent="hidePassword" v-if="showIconPassword">
                            <mask id="mask0" mask-type="alpha" maskUnits="userSpaceOnUse" x="4" y="7" width="22" height="16">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15 7.5C10 7.5 5.73 10.61 4 15C5.73 19.39 10 22.5 15 22.5C20 22.5 24.27 19.39 26 15C24.27 10.61 20 7.5 15 7.5ZM15 20C12.24 20 10 17.76 10 15C10 12.24 12.24 10 15 10C17.76 10 20 12.24 20 15C20 17.76 17.76 20 15 20ZM15 12C13.34 12 12 13.34 12 15C12 16.66 13.34 18 15 18C16.66 18 18 16.66 18 15C18 13.34 16.66 12 15 12Z" fill="white"/>
                            </mask>
                            <g mask="url(#mask0)">
                                <rect x="2" y="2" width="26" height="26" fill="#D8D8D8"/>
                            </g>
                        </svg>
                    </div>
                    <div class="form-group">
                        <div class="subtitle" v-if="!incorrectPassword">Воспользуйтесь одним из двух вариантов подтверждения:</div>
                        <div class="error-msg" v-if="incorrectPassword">Вы ввели неверный резервный пароль</div>
                        <div class="flex justify-content-between align-items-end">
                            <button class="give-code" @click.prevent="getEmailCode">ПОЛУЧИТЬ КОД</button>
                            <div :class="{'reserved-password': true, 'password': true, 'has-error': incorrectPassword}">
                                <label for="inputReservedPassword">Ввести резервный пароль:</label>
                                <input type="password" class="form-control" id="inputReservedPassword" aria-describedby="emailHelp"
                                       placeholder="Резервный пароль:"
                                       v-model="reservedPassword"
                                       name="reservedPassword">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"
                                     @mousedown.prevent="showReservedPassword"
                                     @mouseup.prevent="hideReservedPassword"
                                     @touchstart.prevent="showReservedPassword"
                                     @touchend.prevent="hideReservedPassword" v-if="showIconReservedPassword">
                                    <mask id="mask0" mask-type="alpha" maskUnits="userSpaceOnUse" x="4" y="7" width="22" height="16">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15 7.5C10 7.5 5.73 10.61 4 15C5.73 19.39 10 22.5 15 22.5C20 22.5 24.27 19.39 26 15C24.27 10.61 20 7.5 15 7.5ZM15 20C12.24 20 10 17.76 10 15C10 12.24 12.24 10 15 10C17.76 10 20 12.24 20 15C20 17.76 17.76 20 15 20ZM15 12C13.34 12 12 13.34 12 15C12 16.66 13.34 18 15 18C16.66 18 18 16.66 18 15C18 13.34 16.66 12 15 12Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0)">
                                        <rect x="2" y="2" width="26" height="26" fill="#D8D8D8"/>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="form-group flex btn-form-group">
                        <button @click.prevent="login">Войти</button>
                        <button class="cancel" @click.prevent="clearAll">Отмена</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "TheLoginTwoFactor",
    data() {
        return {
            email: '',
            password: '',
            reservedPassword: '',
            showIconPassword: true,
            showIconReservedPassword: false,
            hasError: false,
            incorrectPassword: false,
        };
    },
    methods: {
        ...mapActions([
            'saveUserFromServer',
            'saveAccessFromServer',
            'saveRefreshFromServer'
        ]),
        showPassword() {
            document.querySelector('input[name=password]').setAttribute('type', 'text');
        },
        hidePassword() {
            document.querySelector('input[name=password]').setAttribute('type', 'password');
        },
        showReservedPassword() {
            document.querySelector('input[name=reservedPassword]').setAttribute('type', 'text');
        },
        hideReservedPassword() {
            document.querySelector('input[name=reservedPassword]').setAttribute('type', 'password');
        },
        clearAll() {
            this.email = '';
            this.password = '';
            this.hasError = false;
            this.reservedPassword = '';
        },
        login() {
            const payload = {
                'password': this.password.trim(),
                'email': this.email.trim(),
                'reservedPassword': this.reservedPassword.trim(),
            }
            axios.post('/api/login/reserved-password', payload).then((response) => {
                this.hasError = false;
                this.saveUserFromServer(response.data.user);
                this.saveAccessFromServer(response.data.token);
                this.saveRefreshFromServer(response.data.refresh_token);
                this.$router.push('/home');
            }).catch((e) => {
                if(e.response.status === 403 || e.response.status === 422) {
                    this.hasError = false;
                    this.incorrectPassword = true;
                } else {
                    this.hasError = true;
                    this.incorrectPassword = false;
                }
            })
        },
        getEmailCode() {
            const payload = {
                'password': this.password.trim(),
                'email': this.email.trim(),
            }
            axios.post('/api/login/get-code', payload).then((response) => {
                this.hasError = false;
                this.$router.push({ name: 'login.code', params: { email: this.email, password: this.password } });
            }).catch((e) => {
                this.hasError = true;
            })
        }
    },
    created() {
        this.email = this.$route.params.email;
        this.password = this.$route.params.password;
        this.showIconPassword = true;
    },
    watch: {
        password() {
            this.showIconPassword = this.password.length > 0;
        }
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
.flex {
    display: flex;
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
    background: #1875F0;
    border: 2px solid #F5F5F5;
    box-sizing: border-box;
    border-radius: 4px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: nowrap;
    width: 170px;
    height: 50px;
    font-family: 'Roboto', sans-serif;
    font-style: normal;
    font-weight: 900;
    font-size: 12px;
    text-align: center;
    text-transform: uppercase;
    color: #FFFFFF;
}
.reset-password {
    text-align: center;
    margin-bottom: 20px;
}
.reset-password a {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 30px;
    color: #1875F0;
}
.error-msg {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    text-align: center;
    color: #FF0000;
    margin-bottom: 10px;
}
.has-error label {
    color: #FF0000;
}
.btn-form-group {
    justify-content: center;
    margin-top: 40px;
}
.btn-form-group button {
    margin: 0 13px;
}
.cancel {
    font-style: normal;
    font-weight: 900;
    font-size: 12px;
    text-align: center;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #B3B3B3;
    background: #FFFFFF;
    border: 2px solid #F5F5F5;
    box-sizing: border-box;
    border-radius: 4px;
    display: flex;
}
.give-code {
    font-style: normal;
    font-weight: 900;
    font-size: 12px;
    text-align: center;
    text-transform: uppercase;
    color: #B3B3B3;
    background: #FFFFFF;
    border: 2px solid #F5F5F5;
    box-sizing: border-box;
    border-radius: 4px;
}
.has-error .error-wrapper {
    display: block;
}
.has-error .cancel {
    display: flex;
}
.error-wrapper {
    display: none;
}
.reserved-password {
    flex: 60% 0 0;
}
.reserved-password input {
    width: 100%;
}
.subtitle {
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    text-align: center;
    color: #666666;
    margin: 20px 0;
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
