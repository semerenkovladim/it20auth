<template>
<div class="content">
    <form action="#">
        <ul class="list-settings">
            <li>
                <ul class="settings">
                    <li class="title">Вход в аккаунт</li>
                    <li class="flex justify-content-between align-items-center settings-item">
                        <div class="title-list">Пароль:</div>
                        <div class="subaction">Последнее изменение: 4 апреля</div>
                        <div class="tooltip-icon">
                            <svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0" mask-type="alpha" maskUnits="userSpaceOnUse" x="11" y="8" width="9" height="13">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8809 19.2166L16.4153 14.7695L11.8809 10.3223L13.2768 8.95622L19.2172 14.7695L13.2768 20.5827L11.8809 19.2166Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask0)">
                                    <rect x="2.38672" y="2.41634" width="25.7414" height="25.1907" fill="#D8D8D8"/>
                                </g>
                            </svg>
                        </div>
                    </li>
                    <li class="flex justify-content-between align-items-center settings-item">
                        <div class="title-list">Двухэтапная аутентификация</div>
                        <div class="subaction">
                            <label>
                                <span class="checkbox checkbox-active" @click="toogleCheckbox">Включена</span>
                                <input type="checkbox" hidden>
                            </label>
                        </div>
                        <div class="tooltip-icon">
                            <svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg" @click="openModal('twoFactor')">
                                <mask id="mask1" mask-type="alpha" maskUnits="userSpaceOnUse" x="5" y="4" width="21" height="21">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.268 20.4864H16.2481V18.5486H14.268V20.4864ZM15.258 4.98442C9.79287 4.98442 5.35742 9.32497 5.35742 14.6731C5.35742 20.0213 9.79287 24.3619 15.258 24.3619C20.7231 24.3619 25.1585 20.0213 25.1585 14.6731C25.1585 9.32497 20.7231 4.98442 15.258 4.98442ZM15.2577 22.4241C10.8915 22.4241 7.33724 18.9459 7.33724 14.6731C7.33724 10.4004 10.8915 6.92216 15.2577 6.92216C19.6238 6.92216 23.1781 10.4004 23.1781 14.6731C23.1781 18.9459 19.6238 22.4241 15.2577 22.4241ZM15.2578 8.85991C13.0698 8.85991 11.2976 10.5942 11.2976 12.7354H13.2777C13.2777 11.6696 14.1687 10.7977 15.2578 10.7977C16.3469 10.7977 17.2379 11.6696 17.2379 12.7354C17.2379 14.6731 14.2677 14.4309 14.2677 17.5798H16.2479C16.2479 15.3998 19.218 15.1576 19.218 12.7354C19.218 10.5942 17.4458 8.85991 15.2578 8.85991Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask1)">
                                    <rect x="2.38672" y="2.0778" width="25.7414" height="25.1907" fill="#D8D8D8"/>
                                </g>
                            </svg>
                            <!-- Modal -->
                            <div class="modal fade" id="twoFactor" data-bs-keyboard="false" tabindex="-1" aria-labelledby="twoFactorLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Двухэтапная аутентификация</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <mask id="mask2" mask-type="alpha" maskUnits="userSpaceOnUse" x="8" y="8" width="14" height="14">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22 9.41L20.59 8L15 13.59L9.41 8L8 9.41L13.59 15L8 20.59L9.41 22L15 16.41L20.59 22L22 20.59L16.41 15L22 9.41Z" fill="white"/>
                                                    </mask>
                                                    <g mask="url(#mask2)">
                                                        <rect x="2" y="2" width="26" height="26" fill="#D8D8D8"/>
                                                    </g>
                                                </svg>

                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            После включения данной функции, каждый раз при авторизации на Ваш электронный адрес будет отправляться
                                            код подтверждения, с помощью которого Вы сможете подтверждать вход в систему.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="flex justify-content-between align-items-center settings-item">
                        <div class="title-list">Резервный пароль</div>
                        <div class="subaction">
                            <label>
                                <span class="checkbox checkbox-active" @click="toogleCheckbox">Включена</span>
                                <input type="checkbox" hidden>
                            </label>
                        </div>
                        <div class="tooltip-icon">
                            <svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg" @click="openModal('reservPassword')">
                                <mask id="mask1" mask-type="alpha" maskUnits="userSpaceOnUse" x="5" y="4" width="21" height="21">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.268 20.4864H16.2481V18.5486H14.268V20.4864ZM15.258 4.98442C9.79287 4.98442 5.35742 9.32497 5.35742 14.6731C5.35742 20.0213 9.79287 24.3619 15.258 24.3619C20.7231 24.3619 25.1585 20.0213 25.1585 14.6731C25.1585 9.32497 20.7231 4.98442 15.258 4.98442ZM15.2577 22.4241C10.8915 22.4241 7.33724 18.9459 7.33724 14.6731C7.33724 10.4004 10.8915 6.92216 15.2577 6.92216C19.6238 6.92216 23.1781 10.4004 23.1781 14.6731C23.1781 18.9459 19.6238 22.4241 15.2577 22.4241ZM15.2578 8.85991C13.0698 8.85991 11.2976 10.5942 11.2976 12.7354H13.2777C13.2777 11.6696 14.1687 10.7977 15.2578 10.7977C16.3469 10.7977 17.2379 11.6696 17.2379 12.7354C17.2379 14.6731 14.2677 14.4309 14.2677 17.5798H16.2479C16.2479 15.3998 19.218 15.1576 19.218 12.7354C19.218 10.5942 17.4458 8.85991 15.2578 8.85991Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask1)">
                                    <rect x="2.38672" y="2.0778" width="25.7414" height="25.1907" fill="#D8D8D8"/>
                                </g>
                            </svg>
                            <!-- Modal -->
                            <div class="modal fade" id="reservPassword" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reservPasswordLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reservPasswordLabel">Двухэтапная аутентификация</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <mask id="mask2" mask-type="alpha" maskUnits="userSpaceOnUse" x="8" y="8" width="14" height="14">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22 9.41L20.59 8L15 13.59L9.41 8L8 9.41L13.59 15L8 20.59L9.41 22L15 16.41L20.59 22L22 20.59L16.41 15L22 9.41Z" fill="white"/>
                                                    </mask>
                                                    <g mask="url(#mask2)">
                                                        <rect x="2" y="2" width="26" height="26" fill="#D8D8D8"/>
                                                    </g>
                                                </svg>

                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            После включения данной функции, каждый раз при авторизации на Ваш электронный адрес будет отправляться
                                            код подтверждения, с помощью которого Вы сможете подтверждать вход в систему.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="flex justify-content-between align-items-center settings-item">
                        <div class="title-list">Резервный пароль</div>
                        <div class="subaction">
                            anna_ko@gmail.com
                        </div>
                        <div class="tooltip-icon">
                            <svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg" @click="openModal('reservEmail')">
                                <mask id="mask0" mask-type="alpha" maskUnits="userSpaceOnUse" x="11" y="8" width="9" height="13">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8809 19.2166L16.4153 14.7695L11.8809 10.3223L13.2768 8.95622L19.2172 14.7695L13.2768 20.5827L11.8809 19.2166Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask0)">
                                    <rect x="2.38672" y="2.41634" width="25.7414" height="25.1907" fill="#D8D8D8"/>
                                </g>
                            </svg>
                            <!-- Modal -->
                            <div class="modal fade" id="reservEmail" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reservEmailLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reservEmailLabel">Двухэтапная аутентификация</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <mask id="mask2" mask-type="alpha" maskUnits="userSpaceOnUse" x="8" y="8" width="14" height="14">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22 9.41L20.59 8L15 13.59L9.41 8L8 9.41L13.59 15L8 20.59L9.41 22L15 16.41L20.59 22L22 20.59L16.41 15L22 9.41Z" fill="white"/>
                                                    </mask>
                                                    <g mask="url(#mask2)">
                                                        <rect x="2" y="2" width="26" height="26" fill="#D8D8D8"/>
                                                    </g>
                                                </svg>

                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            После включения данной функции, каждый раз при авторизации на Ваш электронный адрес будет отправляться
                                            код подтверждения, с помощью которого Вы сможете подтверждать вход в систему.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <ul class="settings">
                    <li class="title">Дополнительные функции</li>
                    <li class="flex justify-content-between align-items-center settings-item">
                        <div class="title-list">Уведомления о подозрительных входах</div>
                        <div class="subaction">
                            <label>
                                <span class="checkbox checkbox-active" @click="toogleCheckbox">Включена</span>
                                <input type="checkbox" hidden>
                            </label>
                        </div>
                        <div class="tooltip-icon">
                            <svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg" @click="openModal('reservPassword')">
                                <mask id="mask1" mask-type="alpha" maskUnits="userSpaceOnUse" x="5" y="4" width="21" height="21">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.268 20.4864H16.2481V18.5486H14.268V20.4864ZM15.258 4.98442C9.79287 4.98442 5.35742 9.32497 5.35742 14.6731C5.35742 20.0213 9.79287 24.3619 15.258 24.3619C20.7231 24.3619 25.1585 20.0213 25.1585 14.6731C25.1585 9.32497 20.7231 4.98442 15.258 4.98442ZM15.2577 22.4241C10.8915 22.4241 7.33724 18.9459 7.33724 14.6731C7.33724 10.4004 10.8915 6.92216 15.2577 6.92216C19.6238 6.92216 23.1781 10.4004 23.1781 14.6731C23.1781 18.9459 19.6238 22.4241 15.2577 22.4241ZM15.2578 8.85991C13.0698 8.85991 11.2976 10.5942 11.2976 12.7354H13.2777C13.2777 11.6696 14.1687 10.7977 15.2578 10.7977C16.3469 10.7977 17.2379 11.6696 17.2379 12.7354C17.2379 14.6731 14.2677 14.4309 14.2677 17.5798H16.2479C16.2479 15.3998 19.218 15.1576 19.218 12.7354C19.218 10.5942 17.4458 8.85991 15.2578 8.85991Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask1)">
                                    <rect x="2.38672" y="2.0778" width="25.7414" height="25.1907" fill="#D8D8D8"/>
                                </g>
                            </svg>
                            <!-- Modal -->
                            <div class="modal fade" id="reservPassword" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reservPasswordLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reservPasswordLabel">Двухэтапная аутентификация</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <mask id="mask2" mask-type="alpha" maskUnits="userSpaceOnUse" x="8" y="8" width="14" height="14">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22 9.41L20.59 8L15 13.59L9.41 8L8 9.41L13.59 15L8 20.59L9.41 22L15 16.41L20.59 22L22 20.59L16.41 15L22 9.41Z" fill="white"/>
                                                    </mask>
                                                    <g mask="url(#mask2)">
                                                        <rect x="2" y="2" width="26" height="26" fill="#D8D8D8"/>
                                                    </g>
                                                </svg>

                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            После включения данной функции, каждый раз при авторизации на Ваш электронный адрес будет отправляться
                                            код подтверждения, с помощью которого Вы сможете подтверждать вход в систему.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="flex justify-content-between align-items-center settings-item">
                        <div class="title-list">Кодовое слово при назначении пароля</div>
                        <div class="subaction">
                            <label>
                                <span class="checkbox checkbox-active" @click="toogleCheckbox">Включена</span>
                                <input type="checkbox" hidden>
                            </label>
                        </div>
                        <div class="tooltip-icon">
                            <svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg" @click="openModal('reservPassword')">
                                <mask id="mask1" mask-type="alpha" maskUnits="userSpaceOnUse" x="5" y="4" width="21" height="21">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.268 20.4864H16.2481V18.5486H14.268V20.4864ZM15.258 4.98442C9.79287 4.98442 5.35742 9.32497 5.35742 14.6731C5.35742 20.0213 9.79287 24.3619 15.258 24.3619C20.7231 24.3619 25.1585 20.0213 25.1585 14.6731C25.1585 9.32497 20.7231 4.98442 15.258 4.98442ZM15.2577 22.4241C10.8915 22.4241 7.33724 18.9459 7.33724 14.6731C7.33724 10.4004 10.8915 6.92216 15.2577 6.92216C19.6238 6.92216 23.1781 10.4004 23.1781 14.6731C23.1781 18.9459 19.6238 22.4241 15.2577 22.4241ZM15.2578 8.85991C13.0698 8.85991 11.2976 10.5942 11.2976 12.7354H13.2777C13.2777 11.6696 14.1687 10.7977 15.2578 10.7977C16.3469 10.7977 17.2379 11.6696 17.2379 12.7354C17.2379 14.6731 14.2677 14.4309 14.2677 17.5798H16.2479C16.2479 15.3998 19.218 15.1576 19.218 12.7354C19.218 10.5942 17.4458 8.85991 15.2578 8.85991Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask1)">
                                    <rect x="2.38672" y="2.0778" width="25.7414" height="25.1907" fill="#D8D8D8"/>
                                </g>
                            </svg>
                            <!-- Modal -->
                            <div class="modal fade" id="reservPassword" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reservPasswordLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reservPasswordLabel">Двухэтапная аутентификация</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <mask id="mask2" mask-type="alpha" maskUnits="userSpaceOnUse" x="8" y="8" width="14" height="14">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22 9.41L20.59 8L15 13.59L9.41 8L8 9.41L13.59 15L8 20.59L9.41 22L15 16.41L20.59 22L22 20.59L16.41 15L22 9.41Z" fill="white"/>
                                                    </mask>
                                                    <g mask="url(#mask2)">
                                                        <rect x="2" y="2" width="26" height="26" fill="#D8D8D8"/>
                                                    </g>
                                                </svg>

                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            После включения данной функции, каждый раз при авторизации на Ваш электронный адрес будет отправляться
                                            код подтверждения, с помощью которого Вы сможете подтверждать вход в систему.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="form-group d-flex flex-row btn-form-group">
            <button @click.prevent="save">Сохранить</button>
            <button class="cancel" @click.prevent="clearAll">Отмена</button>
        </div>
    </form>
</div>
</template>

<script>
export default {
    name: "AccountLogin",
    data() {
        return {

        }
    },
    methods: {
        toogleCheckbox(event) {
            if(event.target.classList.contains('checkbox-active')) {
                event.target.innerText = 'Выключено'
            } else {
                event.target.innerText = 'Включено'
            }
            event.target.classList.toggle('checkbox-active');
        },
        openModal(id) {
            var myModal = new bootstrap.Modal(document.getElementById(id), {
                keyboard: false
            })
            myModal.show();
        }
    }
}
</script>

<style scoped>
.content {
    background: #FFFFFF;
    box-shadow: 0px 5px 30px rgba(0, 0, 0, 0.07);
    border-radius: 6px;
    margin-top: 13px;
    padding: 0 8px;
    box-sizing: border-box;
    margin-bottom: 146px;
}
.list-settings > li {
    background: #FFFFFF;
    box-shadow: 0px 5px 30px rgba(0, 0, 0, 0.07);
    border-radius: 6px;
    box-sizing: border-box;
    margin-bottom: 6px;
    padding: 25px 6px 0px 6px;
}
.list-settings > li:last-child {
    margin-bottom: 0;
}
.settings > .title {
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    color: #666666;
    text-align: left;
    padding-bottom: 0;
    padding-left: 40px;
}
.settings-item {
    padding: 15px 0;
    border-bottom: 2px solid #F0F0F0;
    cursor: pointer;
}
.settings-item:last-child {
    border-bottom: 0;
}
.title-list {
    font-style: normal;
    font-weight: 300;
    font-size: 13px;
    color: #666666;
    flex: 20% 0 0;
    padding-left: 40px;
}
.subaction {
    font-style: normal;
    font-weight: 300;
    font-size: 13px;
    color: #666666;
    flex: 20% 0 0;
}
.checkbox {
    border-radius: 100px;
    display: block;
    font-style: normal;
    font-weight: 900;
    font-size: 12px;
    letter-spacing: 1px;
    background: #666666;
    color: #FFFFFF;
    position: relative;
    padding: 10px 22px 10px 32px;
    transition: all .5s ease-in-out;
}
.checkbox:before {
    content: '';
    display: block;
    width: 20px;
    height: 20px;
    border-radius: 100%;
    background: #FFFFFF;
    position: absolute;
    left: 8%;
    top: 9px;
    transition: all .5s ease-in-out;
}
.checkbox-active {
    padding: 10px 32px 10px 22px;
    background: #1875F0;
}
.checkbox-active:before {
    left: 75%;
}
.btn-form-group {
    justify-content: center;
    padding-top: 24px;
    padding-bottom: 14px;
}
.btn-form-group button {
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
    margin: 0 5px;
}
.btn-form-group > .cancel {
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
</style>
