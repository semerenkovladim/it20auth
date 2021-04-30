<template>
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-12 col-md-6 col-xl-6 form-col">
            <div class="form-wrapper">
                <form action="#" :class="{'has-error': hasError}">
                    <div class="title-form">Восстановление доступа</div>
                    <div class="form-group">
                        <div class="subtitle-form">Пожалуйста, укажите email, который Вы использовали для входа в систему.</div>
                        <div class="error-msg">Вы ввели неверный email</div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">E-mail:</label>
                        <input type="email" class="form-control" id="inputEmail"
                               aria-describedby="emailHelp"
                               placeholder="E-mail:"
                               name="email"
                               v-model="email">
                    </div>
                    <div class="reset-password">
                        <a href="/login/repair-password/secret-code">Установить новый пароль с помощью кодового слова</a>
                    </div>
                    <div class="form-group d-flex flex-row btn-form-group">
                        <button @click.prevent="validate">далее</button>
                        <button class="cancel" @click.prevent="clearAll">Отмена</button>
                    </div>
                    <vue-recaptcha
                        ref="recaptcha"
                        size="invisible"
                        sitekey="6LcyCr8aAAAAAPxdtYNSSsIwZz9eSzH766VjeoJw"
                        @verify="register"
                        @expired="onCaptchaExpired"
                    />
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import VueRecaptcha from 'vue-recaptcha'
import {mapActions} from "vuex"

export default {
    name: "TheRepairPassword",
    components: { VueRecaptcha },
    data() {
        return {
            email: '',
            hasError: false
        }
    },
    methods: {
        ...mapActions([
           'saveResetPasswordEmail',
        ]),
        clearAll() {
            this.email = '';
        },
        register (recaptchaToken) {
            console.log(recaptchaToken);
            axios.post('/api/login/repair-password', {
                email: this.email,
                recaptchaToken: recaptchaToken
            }).then(() => {
                this.saveResetPasswordEmail(this.email);
                this.$router.push('repair-password/code')
            }).catch(() => {
                this.hasError = true;
            })
        },
        validate () {
            if(this.email.length === 0) {
                this.$refs.recaptcha.reset();
            } else {
                this.$refs.recaptcha.execute()
            }
        },

        onCaptchaExpired () {
            this.$refs.recaptcha.reset()
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
.form-group label {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 30px;
    color: #666666;
    margin-bottom: 10px;
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
.has-error label {
    color: #FF0000;
}
.has-error .error-msg {
    display: block;
}
.has-error .subtitle-form {
    display: none;
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
