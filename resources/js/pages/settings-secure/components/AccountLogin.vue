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
                            <svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg" @click="openModal('mainPassword')">
                                <mask id="mask0" mask-type="alpha" maskUnits="userSpaceOnUse" x="11" y="8" width="9" height="13">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8809 19.2166L16.4153 14.7695L11.8809 10.3223L13.2768 8.95622L19.2172 14.7695L13.2768 20.5827L11.8809 19.2166Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask0)">
                                    <rect x="2.38672" y="2.41634" width="25.7414" height="25.1907" fill="#D8D8D8"/>
                                </g>
                            </svg>
                            <!-- Modal -->
                            <div class="modal fade" id="mainPassword" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mainPasswordLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mainPasswordLabel">Смена пароля</h5>
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
                                            Ввведите, пожалуйста, новый пароль для следующих авторизаций:
                                            <form action="#">
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
                                                        <mask id="mask10" mask-type="alpha" maskUnits="userSpaceOnUse" x="4" y="7" width="22" height="16">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15 7.5C10 7.5 5.73 10.61 4 15C5.73 19.39 10 22.5 15 22.5C20 22.5 24.27 19.39 26 15C24.27 10.61 20 7.5 15 7.5ZM15 20C12.24 20 10 17.76 10 15C10 12.24 12.24 10 15 10C17.76 10 20 12.24 20 15C20 17.76 17.76 20 15 20ZM15 12C13.34 12 12 13.34 12 15C12 16.66 13.34 18 15 18C16.66 18 18 16.66 18 15C18 13.34 16.66 12 15 12Z" fill="white"/>
                                                        </mask>
                                                        <g mask="url(#mask10)">
                                                            <rect x="2" y="2" width="26" height="26" fill="#D8D8D8"/>
                                                        </g>
                                                    </svg>
                                                </div>
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
                                                        <mask id="mask11" mask-type="alpha" maskUnits="userSpaceOnUse" x="4" y="7" width="22" height="16">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15 7.5C10 7.5 5.73 10.61 4 15C5.73 19.39 10 22.5 15 22.5C20 22.5 24.27 19.39 26 15C24.27 10.61 20 7.5 15 7.5ZM15 20C12.24 20 10 17.76 10 15C10 12.24 12.24 10 15 10C17.76 10 20 12.24 20 15C20 17.76 17.76 20 15 20ZM15 12C13.34 12 12 13.34 12 15C12 16.66 13.34 18 15 18C16.66 18 18 16.66 18 15C18 13.34 16.66 12 15 12Z" fill="white"/>
                                                        </mask>
                                                        <g mask="url(#mask11)">
                                                            <rect x="2" y="2" width="26" height="26" fill="#D8D8D8"/>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="form-group d-flex flex-row btn-form-group">
                                                    <button @click.prevent="saveReservedEmail">Сохранить</button>
                                                    <button class="cancel" @click.prevent="clearReservedEmail">Отмена</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="flex justify-content-between align-items-center settings-item">
                        <div class="title-list">Двухэтапная аутентификация</div>
                        <div class="subaction">
                            <label>
                                <span :class="{'checkbox': true, 'checkbox-active': twofactor}" @click="toogleCheckbox">{{ twofactor ? 'Включено' : 'Выключено' }}</span>
                                <input type="checkbox" v-model="twofactor" hidden>
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
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Двухэтапная аутентификация</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <mask id="mask12" mask-type="alpha" maskUnits="userSpaceOnUse" x="8" y="8" width="14" height="14">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22 9.41L20.59 8L15 13.59L9.41 8L8 9.41L13.59 15L8 20.59L9.41 22L15 16.41L20.59 22L22 20.59L16.41 15L22 9.41Z" fill="white"/>
                                                    </mask>
                                                    <g mask="url(#mask12)">
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
                                <span
                                    :class="{'checkbox': true, 'checkbox-active': reservedPassword}"
                                    @click="toogleCheckbox">{{ reservedPassword ? 'Включено' : 'Выключено' }}</span>
                                <input type="checkbox" v-model="reservedPassword" hidden>
                            </label>
                        </div>
                        <div class="tooltip-icon">
                            <svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg" @click="openModal('reservedPassword')">
                                <mask id="mask1" mask-type="alpha" maskUnits="userSpaceOnUse" x="5" y="4" width="21" height="21">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.268 20.4864H16.2481V18.5486H14.268V20.4864ZM15.258 4.98442C9.79287 4.98442 5.35742 9.32497 5.35742 14.6731C5.35742 20.0213 9.79287 24.3619 15.258 24.3619C20.7231 24.3619 25.1585 20.0213 25.1585 14.6731C25.1585 9.32497 20.7231 4.98442 15.258 4.98442ZM15.2577 22.4241C10.8915 22.4241 7.33724 18.9459 7.33724 14.6731C7.33724 10.4004 10.8915 6.92216 15.2577 6.92216C19.6238 6.92216 23.1781 10.4004 23.1781 14.6731C23.1781 18.9459 19.6238 22.4241 15.2577 22.4241ZM15.2578 8.85991C13.0698 8.85991 11.2976 10.5942 11.2976 12.7354H13.2777C13.2777 11.6696 14.1687 10.7977 15.2578 10.7977C16.3469 10.7977 17.2379 11.6696 17.2379 12.7354C17.2379 14.6731 14.2677 14.4309 14.2677 17.5798H16.2479C16.2479 15.3998 19.218 15.1576 19.218 12.7354C19.218 10.5942 17.4458 8.85991 15.2578 8.85991Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask1)">
                                    <rect x="2.38672" y="2.0778" width="25.7414" height="25.1907" fill="#D8D8D8"/>
                                </g>
                            </svg>
                            <!-- Modal -->
                            <div class="modal fade" id="reservedPassword" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reservedPasswordLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reservedPasswordLabel">Резервный пароль</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <mask id="mask13" mask-type="alpha" maskUnits="userSpaceOnUse" x="8" y="8" width="14" height="14">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22 9.41L20.59 8L15 13.59L9.41 8L8 9.41L13.59 15L8 20.59L9.41 22L15 16.41L20.59 22L22 20.59L16.41 15L22 9.41Z" fill="white"/>
                                                    </mask>
                                                    <g mask="url(#mask13)">
                                                        <rect x="2" y="2" width="26" height="26" fill="#D8D8D8"/>
                                                    </g>
                                                </svg>

                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            После включения данной функции на Ваш email будет отправлен резервный пароль, который Вы сможете использовать
                                            как один из способов подтверждения двухэтапной аутентификации.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="flex justify-content-between align-items-center settings-item">
                        <div class="title-list" @click="openModal('reservedEmail')">Резервный email</div>
                        <div class="subaction" @click="openModal('reservedEmail')">
                            {{ reservedEmail ? reservedEmail : 'Не заданно' }}
                        </div>
                        <div class="tooltip-icon">
                            <svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg" @click="openModal('reservedEmail')">
                                <mask id="mask3" mask-type="alpha" maskUnits="userSpaceOnUse" x="11" y="8" width="9" height="13">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8809 19.2166L16.4153 14.7695L11.8809 10.3223L13.2768 8.95622L19.2172 14.7695L13.2768 20.5827L11.8809 19.2166Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask3)">
                                    <rect x="2.38672" y="2.41634" width="25.7414" height="25.1907" fill="#D8D8D8"/>
                                </g>
                            </svg>
                            <!-- Modal -->
                            <div class="modal fade" id="reservedEmail" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reservedEmailLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reservedEmailLabel">Резервный email</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <mask id="mask4" mask-type="alpha" maskUnits="userSpaceOnUse" x="8" y="8" width="14" height="14">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22 9.41L20.59 8L15 13.59L9.41 8L8 9.41L13.59 15L8 20.59L9.41 22L15 16.41L20.59 22L22 20.59L16.41 15L22 9.41Z" fill="white"/>
                                                    </mask>
                                                    <g mask="url(#mask4)">
                                                        <rect x="2" y="2" width="26" height="26" fill="#D8D8D8"/>
                                                    </g>
                                                </svg>

                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Ввведите, пожалуйста, Ваш резервный email (он может быть использован
                                            как дополнительный адрес при восстановлении пароля и получения кодов подтверждения)
                                            <form action="#">
                                                <div class="form-group">
                                                    <label for="inputReservedEmail">Резервная почта:</label>
                                                    <input type="email" class="form-control" id="inputReservedEmail" aria-describedby="emailHelp"
                                                           placeholder="Резервный email:"
                                                           name="reservedEmail" v-model="reservedEmail">
                                                </div>
                                                <div class="form-group d-flex flex-row btn-form-group">
                                                    <button @click.prevent="saveReservedEmail" data-dismiss="modal">Сохранить</button>
                                                    <button class="cancel" @click.prevent="clearReservedEmail" data-dismiss="modal">Отмена</button>
                                                </div>
                                            </form>
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
                                <span
                                    :class="{'checkbox': true, 'checkbox-active': notification}"
                                    @click="toogleCheckbox">{{ notification ? 'Включено' : 'Выключено' }}</span>
                                <input type="checkbox" v-model="notification" hidden>
                            </label>
                        </div>
                        <div class="tooltip-icon">
                            <svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg" @click="openModal('dangerLoginAlert')">
                                <mask id="mask1" mask-type="alpha" maskUnits="userSpaceOnUse" x="5" y="4" width="21" height="21">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.268 20.4864H16.2481V18.5486H14.268V20.4864ZM15.258 4.98442C9.79287 4.98442 5.35742 9.32497 5.35742 14.6731C5.35742 20.0213 9.79287 24.3619 15.258 24.3619C20.7231 24.3619 25.1585 20.0213 25.1585 14.6731C25.1585 9.32497 20.7231 4.98442 15.258 4.98442ZM15.2577 22.4241C10.8915 22.4241 7.33724 18.9459 7.33724 14.6731C7.33724 10.4004 10.8915 6.92216 15.2577 6.92216C19.6238 6.92216 23.1781 10.4004 23.1781 14.6731C23.1781 18.9459 19.6238 22.4241 15.2577 22.4241ZM15.2578 8.85991C13.0698 8.85991 11.2976 10.5942 11.2976 12.7354H13.2777C13.2777 11.6696 14.1687 10.7977 15.2578 10.7977C16.3469 10.7977 17.2379 11.6696 17.2379 12.7354C17.2379 14.6731 14.2677 14.4309 14.2677 17.5798H16.2479C16.2479 15.3998 19.218 15.1576 19.218 12.7354C19.218 10.5942 17.4458 8.85991 15.2578 8.85991Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask1)">
                                    <rect x="2.38672" y="2.0778" width="25.7414" height="25.1907" fill="#D8D8D8"/>
                                </g>
                            </svg>
                            <!-- Modal -->
                            <div class="modal fade" id="dangerLoginAlert" data-bs-keyboard="false" tabindex="-1" aria-labelledby="dangerLoginAlertLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="dangerLoginAlertabel">Уведомления о подозрительных входах</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <mask id="mask5" mask-type="alpha" maskUnits="userSpaceOnUse" x="8" y="8" width="14" height="14">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22 9.41L20.59 8L15 13.59L9.41 8L8 9.41L13.59 15L8 20.59L9.41 22L15 16.41L20.59 22L22 20.59L16.41 15L22 9.41Z" fill="white"/>
                                                    </mask>
                                                    <g mask="url(#mask5)">
                                                        <rect x="2" y="2" width="26" height="26" fill="#D8D8D8"/>
                                                    </g>
                                                </svg>

                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            После включения данной функции, система автоматически будет отправлять письмо с
                                            предупреждением об опасности на Ваш адрес электронной почты.
                                            <div class="small-text">* Под подозрительным входом имеется в виду вход в систему из браузера, который обычно не используется или же из другого города/страны.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="flex justify-content-between align-items-center settings-item">
                        <div class="title-list" @click="openModal('reservedCode')">Кодовое слово при назначении пароля</div>
                        <div class="subaction">
                            <label>
                                <span
                                    :class="{'checkbox': true, 'checkbox-active': codeWord}"
                                    @click="toogleCheckbox">{{ codeWord ? 'Включено' : 'Выключено' }}</span>
                                <input type="checkbox" v-model="codeWord" hidden>
                            </label>
                        </div>
                        <div class="tooltip-icon">
                            <svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg" @click="openModal('reservedCode')">
                                <mask id="mask1" mask-type="alpha" maskUnits="userSpaceOnUse" x="5" y="4" width="21" height="21">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.268 20.4864H16.2481V18.5486H14.268V20.4864ZM15.258 4.98442C9.79287 4.98442 5.35742 9.32497 5.35742 14.6731C5.35742 20.0213 9.79287 24.3619 15.258 24.3619C20.7231 24.3619 25.1585 20.0213 25.1585 14.6731C25.1585 9.32497 20.7231 4.98442 15.258 4.98442ZM15.2577 22.4241C10.8915 22.4241 7.33724 18.9459 7.33724 14.6731C7.33724 10.4004 10.8915 6.92216 15.2577 6.92216C19.6238 6.92216 23.1781 10.4004 23.1781 14.6731C23.1781 18.9459 19.6238 22.4241 15.2577 22.4241ZM15.2578 8.85991C13.0698 8.85991 11.2976 10.5942 11.2976 12.7354H13.2777C13.2777 11.6696 14.1687 10.7977 15.2578 10.7977C16.3469 10.7977 17.2379 11.6696 17.2379 12.7354C17.2379 14.6731 14.2677 14.4309 14.2677 17.5798H16.2479C16.2479 15.3998 19.218 15.1576 19.218 12.7354C19.218 10.5942 17.4458 8.85991 15.2578 8.85991Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask1)">
                                    <rect x="2.38672" y="2.0778" width="25.7414" height="25.1907" fill="#D8D8D8"/>
                                </g>
                            </svg>
                            <!-- Modal -->
                            <div class="modal fade" id="reservedCode" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reservedCodeLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reservedCodeLabel">Кодовое слово при восстановлении пароля</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <mask id="mask6" mask-type="alpha" maskUnits="userSpaceOnUse" x="8" y="8" width="14" height="14">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22 9.41L20.59 8L15 13.59L9.41 8L8 9.41L13.59 15L8 20.59L9.41 22L15 16.41L20.59 22L22 20.59L16.41 15L22 9.41Z" fill="white"/>
                                                    </mask>
                                                    <g mask="url(#mask6)">
                                                        <rect x="2" y="2" width="26" height="26" fill="#D8D8D8"/>
                                                    </g>
                                                </svg>

                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="#">
                                                <div class="form-group">
                                                    <label for="inputSecretCode">Кодовое слово:</label>
                                                    <input type="email" class="form-control" id="inputSecretCode" aria-describedby="emailHelp"
                                                           placeholder="Кодовое слово:"
                                                           name="inputSecretCode" v-model="codeWordText">
                                                </div>
                                                <div class="form-group d-flex flex-row btn-form-group">
                                                    <button @click.prevent="saveSecretCode" data-dismiss="modal">Сохранить</button>
                                                    <button class="cancel" @click.prevent="clearSecretCode" data-dismiss="modal">Отмена</button>
                                                </div>
                                            </form>
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
    <!-- Modal -->
    <div class="modal fade" id="saveSettings" data-bs-keyboard="false" tabindex="-1" aria-labelledby="saveSettingsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="saveSettingsLabel">Изменение настроек безопасности</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask28" mask-type="alpha" maskUnits="userSpaceOnUse" x="8" y="8" width="14" height="14">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M22 9.41L20.59 8L15 13.59L9.41 8L8 9.41L13.59 15L8 20.59L9.41 22L15 16.41L20.59 22L22 20.59L16.41 15L22 9.41Z" fill="white"/>
                            </mask>
                            <g mask="url(#mask28)">
                                <rect x="2" y="2" width="26" height="26" fill="#D8D8D8"/>
                            </g>
                        </svg>

                    </button>
                </div>
                <div class="modal-body">
                    Ваши настройки успешно сохранены
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "AccountLogin",
    data() {
        return {
            showIconPassword: false,
            showIconPasswordRepeate: false,
            password: '',
            passwordRepeate: '',
            twofactor: false,
            reservedPassword: false,
            notification: false,
            codeWord: false,
            codeWordText: '',
            reservedEmail: '',
        }
    },
    methods: {
        ...mapActions([
            'saveUserFromServer',
        ]),
        toogleCheckbox(event) {
            event.target.classList.toggle('checkbox-active');
        },
        openModal(id) {
            var myModal = new bootstrap.Modal(document.getElementById(id), {
                keyboard: false
            })
            myModal.show();
        },
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
        save() {
            const data = {
                twoFactor: this.twofactor,
                reservedPassword: this.reservedPassword
            }
            axios.post('/api/settings', data, {
                headers: {
                    'Authorization': `Bearer ` + this.access_token
                }
            }).then((response) => {
                this.saveUserFromServer(response.data);
                this.openModal('saveSettings');
            });
        },
        clearAll() {
            this.twofactor = this.user.setting.useTwoStepAuth;
            this.reservedPassword = this.user.setting.useReservedPassword;
            this.notification = this.user.setting.suspiciousLoginNotifications;
            this.codeWord = this.user.setting.useCodeWord;
            this.codeWordText = this.user.backup_date.code_word;
        },
        clearSecretCode() {
            this.codeWordText = this.user.backup_date.code_word;
            this.codeWord = this.user.setting.useCodeWord;
            var myModal = new bootstrap.Modal(document.getElementById('reservedCode'), {
                keyboard: false
            })
            myModal.hide();
        },
        saveSecretCode() {
            const payload = {
                useCode: this.codeWord,
                codeWord: this.codeWordText
            }
            axios.post('/api/settings', payload, {
                headers: {
                    'Authorization': `Bearer ` + this.access_token
                }
            }).then((response) => {
                this.saveUserFromServer(response.data);
                this.openModal('saveSettings');
            })
        },
        saveReservedEmail() {
            const payload = {
                reservedEmail: this.reservedEmail,
            }
            axios.post('/api/settings', payload, {
                headers: {
                    'Authorization': `Bearer ` + this.access_token
                }
            }).then((response) => {
                this.saveUserFromServer(response.data);
                this.openModal('saveSettings');
            })
        },
        clearReservedEmail() {
            this.reservedEmail = this.user.backup_date.backup_email;
            var myModal = new bootstrap.Modal(document.getElementById('reservedCode'), {
                keyboard: false
            })
            myModal.hide();
        }
    },
    computed: {
        ...mapGetters([
            'access_token',
            'user'
        ]),
    },
    watch: {
        password() {
            this.showIconPassword = this.password.length > 0;
        },
        passwordRepeate() {
            this.showIconPasswordRepeate = this.passwordRepeate.length > 0;
        },
        codeWord() {
            if(this.codeWord === true) {
                var myModal = new bootstrap.Modal(document.getElementById('reservedCode'), {
                    keyboard: false
                })
                myModal.show();
            }
        }
    },
    created() {
        this.twofactor = this.user.setting.useTwoStepAuth;
        this.reservedPassword = this.user.setting.useReservedPassword;
        this.notification = this.user.setting.suspiciousLoginNotifications;
        this.codeWord = this.user.setting.useCodeWord;
        this.codeWordText = this.user.backup_date.code_word;
        this.reservedEmail = this.user.backup_date.backup_email;
    }
}
</script>

<style scoped>
.content {
    background: #FFFFFF;
    box-shadow: 0px 5px 30px rgba(0, 0, 0, 0.07);
    border-radius: 6px;
    margin-top: 13px;
    padding: 8px;
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
.flex {
    display: flex;
}
.list-settings > li:last-child {
    margin-bottom: 0;
}
.settings > li {
    padding: 15px 40px;
    border-bottom: 2px solid #F0F0F0;
    cursor: pointer;
}
.settings > .title {
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    color: #666666;
    text-align: left;
}
.settings-item {
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
    display: flex;
    width: 118px;
    height: 30px;
    align-items: center;
    font-style: normal;
    font-weight: 900;
    font-size: 12px;
    letter-spacing: 1px;
    background: #666666;
    color: #FFFFFF;
    position: relative;
    box-sizing: border-box;
    padding: 0 12px;
    justify-content: flex-end;
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
    left: 6px;
    transition: all .5s ease-in-out;
}
.checkbox-active {
    background: #1875F0;
    justify-content: flex-start;
    padding: 0 24px;
}
.checkbox-active:before {
    right: 6px;
    left: auto;
}
.btn-form-group {
    justify-content: center;
    padding-top: 24px;
    padding-bottom: 14px;
}
#reservedEmail .btn-form-group {
    justify-content: flex-start;
}
#reservedEmail .btn-form-group button {
    margin: 0;
    margin-right: 10px;
}
.btn-form-group button {
    display: flex;
    background: #1875F0;
    border: 2px solid #F5F5F5;
    box-sizing: border-box;
    border-radius: 4px;
    width: 120px;
    height: 50px;
    justify-content: center;
    align-items: center;
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
    background: #FFFFFF;
    border: 2px solid #F5F5F5;
    box-sizing: border-box;
    border-radius: 4px;
}
.modal-title {
    font-style: normal;
    font-weight: 500;
    font-size: 18px;
    color: #666666;
}
.modal-content {
    padding: 25px 10px 30px 40px;
    border-radius: 6px;
}
.modal-body {
    font-style: normal;
    font-weight: normal;
    font-size: 12px;
    color: #666666;
    padding: 20px 0 0 0;
}
.modal-header {
    padding: 0;
    border: none;
    position: relative;
}
.modal-header .close {
    position: absolute;
    top: -8px;
    right: 8px;
}
.modal-content {
    border: none;
}
.modal-backdrop {
    background-color: #C4C4C4;
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
.small-text {
    margin-top: 5px;
    font-style: normal;
    font-weight: normal;
    font-size: 10px;
    color: #666666;
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
</style>
