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
            <li>
                <ul class="settings">
                    <li class="title">История посещений</li>
                    <li class="date-title settings-item">26 апреля 2020 года</li>
                    <li class="settings-item">
                        <div class="flex justify-content-between align-items-center">
                            <div class="title-list">Включена двухэтапная аутентификация</div>
                            <div class="subaction">Краматорск, Донецкая область, Украина – 26 апреля 10:52</div>
                        </div>
                        <div class="flex justify-content-between align-items-center">
                            <div class="title-list">Включена двухэтапная аутентификация</div>
                            <div class="subaction">Краматорск, Донецкая область, Украина – 26 апреля 10:52</div>
                        </div>
                    </li>
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
    flex: 60% 0 0;
}
.date-title {
    font-style: normal;
    font-weight: normal;
    font-size: 13px;
    color: #666666;
    padding-left: 40px;
}
</style>
