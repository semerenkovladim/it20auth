<template>
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-12 col-md-6 col-xl-6 form-col">
            <div class="form-wrapper">
                <form action="#" :class="{'has-error': hasError}">
                    <div class="title-form">Восстановление доступа</div>
                    <div class="form-group">
                        <div class="subtitle-form">На ваш e-mail было отправлено уведомление с кодом подтверждения.</div>
                        <div class="error-msg">Вы ввели неверный код или срок его действия уже истек</div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Код подтверждения:</label>
                        <div class="row justify-content-between align-items-start">
                            <input type="text" class="form-control col-12 col-lg-7 mt-3" id="inputEmail"
                                   aria-describedby="emailHelp"
                                   placeholder="Код подтверждения:"
                                   name="code"
                                   v-model="code">
                            <div class="btn-resend col-12 col-lg-5">
                                <div class="text-resend" v-if="!hideTextBtn">Станет доступно через: {{ countSecond }} сек.</div>
                                <button :class="{cancel: true, 'active-btn': !disableButton}" @click.prevent="startTimer" :disabled="disableButton">Отправить повторно</button>
                            </div>
                        </div>

                    </div>
                    <div class="reset-password">
                        <a href="/login/repair-password/secret-code">Установить новый пароль с помощью кодового слова</a>
                    </div>
                    <div class="reset-password">
                        <a href="#">Отправить код на резервный e-mail</a>
                    </div>
                    <div class="form-group d-flex flex-row btn-form-group">
                        <button @click.prevent="newPassword">далее</button>
                        <button class="cancel" @click.prevent="clearAll">Отмена</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "TheRepairPasswordCode",
    data() {
        return {
            code: '',
            disableButton: true,
            countSecond: 60,
            presentCode: 'J9875FDS',
            hasError: false,
            hideTextBtn: false,
        };
    },
    mounted() {
        this.startTimer()
    },
    methods: {
        newPassword() {
            if(this.code !== this.presentCode) {
                this.hasError = true;
            } else {
                this.$router.push('/login/repair-password/new-password')
            }
        },
        startTimer() {
            this.countSecond = 60;
            const timer = setInterval(() => {
                if(this.countSecond > 0) {
                    this.countSecond--
                } else {
                    clearInterval(timer)
                    this.disableButton = false;
                    this.hideTextBtn = true;
                }
            }, 1000);
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
form button, .btn-resend .active-btn {
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
.reset-password {
    text-align: left;
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
.text-resend {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 10px;
    line-height: 30px;
    text-align: center;
    color: #666666;
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
.has-error label {
    color: #FF0000;
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
