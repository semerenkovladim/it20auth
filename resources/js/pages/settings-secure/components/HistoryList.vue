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
                    <li class="settings-item" v-for="(item, name) in historyVisits" :key="name">
                        <div class="date-title">{{ dateToCPU(name) }}</div>
                        <ul>
                            <li class="action-list-wrapper flex justify-content-between align-items-center" v-for="action in item" :key="item.id">
                                <div class="title-list" v-if="action.type === 'login'">
                                    <div class="icon-type power-icon"></div>
                                    Вход в систему
                                </div>
                                <div class="title-list" v-else>
                                    <div class="icon-type laptop-icon"></div>
                                    Выход из системы
                                </div>
                                <div class="subaction">{{ getFullDataOfIp(action) }}</div>
                            </li>
                        </ul>
                    </li>
                </ul>
                <Paginator :data="paginationObj" @toPage="setPage"></Paginator>
<!--                <pagination :data="paginationObj" @pagination-change-page="retriveHistory"></pagination>-->
            </li>
        </ul>
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import Paginator from "../../../components/paginator/Paginator";

export default {
    name: "HistoryList",
    components: {Paginator},
    data() {
        return {
            historyVisits: [],
            paginationObj: {},
            currentPage: 1,
        };
    },
    created() {
        this.retriveHistory();
    },
    methods: {
        retriveHistory() {
            axios.get('/api/history-visits?' + this.currentPage, {
                headers: {
                    'Authorization': `Bearer ` + this.access_token
                }
            }).then((response) => {
                this.historyVisits = response.data.data.reduce((acc, value) => {
                    // Group initialization
                    if (!acc[value.date_history]) {
                        acc[value.date_history] = [];
                    }

                    // Grouping
                    acc[value.date_history].push(value);

                    return acc;
                }, {});
                this.paginationObj = response.data;
            });
        },
        setPage(data) {
            if(this.paginationObj.last_page >= data.page >= 1) {
                this.currentPage = data.page;
                this.retriveHistory()
            }
        },
        dateToCPU(date) {
            let dateArr = date.split('-');
            dateArr[1] = this.translateMonth(dateArr[1]);
            return dateArr.join(' ') + ' года';
        },
        dateToDateMonth(date) {
            let dateArr = date.split('-');
            return dateArr[0] + ' ' + this.translateMonth(dateArr[1]);
        },
        timeTotimeHour(time) {
            let timeArr = time.split(':');
            return timeArr[0] + ' ' + timeArr[1];
        },
        getFullDataOfIp(item) {
            return `${item.city}, ${item.state}, ${item.country ? item.country : ''} - ${this.dateToDateMonth(item.date_history)} ${this.timeTotimeHour(item.time_history)}`;
        },
        translateMonth(month) {
            const translate = {
                'January': 'Января',
                'February': 'Февраля',
                'March': 'Марта',
                'April': 'Апреля',
                'May': 'Мая',
                'June': 'Июня',
                'July': 'Июля',
                'August': 'Августа',
                'September': 'Сентября',
                'October': 'Октября',
                'November': 'Ноября',
                'December': 'Декабря',
            }

            if(translate.hasOwnProperty(month)) {
                return translate[month];
            }
            return month;
        }
    },
    computed: {
        ...mapGetters([
            'access_token',
        ]),
    }
}
</script>

<style scoped>
.flex {
    display: flex;
}
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
.settings-item, .history .settings-item {
    padding: 15px 0;
    border-bottom: 2px solid #F0F0F0;
}
.history .settings-item > ul {
    padding-top: 10px;
}
.history .settings-item {
    padding: 0;
}
.settings-item:last-child, .history .settings-item:last-child {
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
    padding-top: 10px;
    padding-bottom: 10px;
    border-bottom: 2px solid #F0F0F0;
}
.action-list-wrapper {
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

.arrow-left {
    background: url("../../../../images/icons/ic_arrow_back.svg") center no-repeat;
}
.arrow-right {
    background: url("../../../../images/icons/ic_arrow_forward.svg") center no-repeat;
}
.list-settings > .history {
    padding-bottom: 37px;
}
</style>
