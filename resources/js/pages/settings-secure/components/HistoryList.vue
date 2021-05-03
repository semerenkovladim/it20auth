<template>
    <div class="content">
        <ul class="list-settings">
            <li>
                <ul class="settings">
                    <li class="title">Вход в аккаунт</li>
                    <li class="flex justify-content-between align-items-center settings-item">
                        <div class="title-list">Включена двухэтапная аутентификация</div>
                        <div class="subaction">Краматорск, Донецкая область, Украина – 26 апреля 10:52</div>
                    </li>
                    <li class="flex justify-content-between align-items-center settings-item">
                        <div class="title-list">Добалвен резервный e-mail</div>
                        <div class="subaction">Краматорск, Донецкая область, Украина – 21 апреля 10:55</div>
                    </li>
                    <li class="flex justify-content-between align-items-center settings-item">
                        <div class="title-list">Изменен пароль</div>
                        <div class="subaction">Краматорск, Донецкая область, Украина – 16 апреля 11:06</div>
                    </li>
                </ul>
            </li>
            <li class="history">
                <ul class="settings">
                    <li class="title">История посещений</li>
                    <li class="date-title settings-item">21 апреля 2020 года</li>
                    <li class="settings-item action-list-wrapper">
                        <div class="flex justify-content-between align-items-center">
                            <div class="title-list">
                                <div class="icon-type power-icon"></div>
                                Выход из системы
                            </div>
                            <div class="subaction">Краматорск, Донецкая область, Украина – 26 апреля 10:52</div>
                        </div>
                        <div class="flex justify-content-between align-items-center">
                            <div class="title-list">
                                <div class="icon-type laptop-icon"></div>
                                Вход в систему
                            </div>
                            <div class="subaction">Краматорск, Донецкая область, Украина – 26 апреля 10:52</div>
                        </div>
                    </li>
                </ul>
                <ul class="pagination">
                    <li class="arrow arrow-left"></li>
                    <li class="active-page">1</li>
                    <li>2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                    <li class="arrow arrow-right"></li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "HistoryList"
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
.list-settings {
    padding-bottom: 11px;
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
}
.settings-item:last-child {
    border-bottom: 0;
}
.title-list {
    font-style: normal;
    font-weight: 300;
    font-size: 13px;
    color: #666666;
    flex: 25% 0 0;
    padding-left: 40px;
    display: flex;
    align-items: center;
}
.subaction {
    font-style: normal;
    font-weight: 300;
    font-size: 13px;
    color: #666666;
    flex: 60% 0 0;
}
.date-title {
    font-style: normal;
    font-weight: normal;
    font-size: 13px;
    color: #666666;
    padding-left: 40px;
}
.action-list-wrapper > div {
    margin-bottom: 25px;
}
.action-list-wrapper > div:last-child {
    margin-bottom: 0;
}
.icon-type {
    padding: 15px;
    margin-right: 25px;
}
.power-icon {
    background: url("../../../../images/icons/ic_power_settings_new.svg") center no-repeat;
}
.laptop-icon {
    background: url("../../../../images/icons/ic_laptop.svg") center no-repeat;
}
.pagination {
    display: flex;
    border-top: 1.5px solid #DADADA;
    background: #FFFFFF;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.05);
    border-radius: 6px;
}
.pagination li {
    padding: 17px 37px;
    border-right: 3px solid #DADADA;
    text-align: center;
    ont-style: normal;
    font-weight: bold;
    font-size: 14px;
    color: #999999;
    cursor: pointer;
}
.pagination li:first-child {
    padding: 17px 37px 17px 24px;
}
.pagination li:last-child {
    border-right: none;
}
.arrow-left {
    background: url("../../../../images/icons/ic_arrow_back.svg") center no-repeat;
}
.arrow-right {
    background: url("../../../../images/icons/ic_arrow_forward.svg") center no-repeat;
}
.active-page {
    background: #FAFAFA;
}
.list-settings > .history {
    padding-bottom: 37px;
}
</style>
