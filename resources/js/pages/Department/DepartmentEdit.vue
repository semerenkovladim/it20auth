<template>
    <main class="row departments_management">
        <div class="container-fluid departments_management__container">
            <div class="col">
                <div class="row departments_management__header">
                    <div class="col-12 breadcrumbs">
                        <nav>
                            <ul>
                                <li>
                                    <span>Управление</span>
                                </li>
                                <li>
                                    <router-link :to="{name: 'DepartmentsManagement'}">Отделы</router-link>
                                </li>
                                <li>
                                    <span>Редактирование отдела</span>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-12 departments_management__header-title">
                        Редактирование отдела
                    </div>
                </div>
                <div class="row departments_create__container">
                    <div class="col-12 box-form">
                        <form @submit.prevent="" method="post">
                            <ul>
                                <li>
                                    <label for="name">Название:</label>
                                    <input type="text" id="name" v-model="title">
                                </li>
                                <li>
                                    <label for="lead">Руководитель:</label>
                                    <select type="text" id="lead" v-model="depHead">
                                        <option value="null"></option>
                                        <option v-for="lead in getLeads" :value="lead.id">
                                            {{ lead.name}} {{lead.surname}}
                                        </option>
                                    </select>
                                </li>
                                <li class="anchor_Modal">
                                    <label for="workersCtr">Количество сотрудников:</label>
                                    <input type="text" id="workersCtr" class="workersCtr" placeholder="16" readonly
                                           @click="showWorkers">
                                    <department-workers-list v-if="isActiveWorkersList"
                                                             @close="isActiveWorkersList = false"/>
                                </li>
                                <li class="form-btns">
                                    <button type="button" class="btnSave" @click="this.sendFormData">Сохранить</button>
                                    <button type="reset" class="btnCancel">Отмена</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import DepartmentWorkersList from "../../components/layouts/DepartmentWorkersList";
import {mapActions, mapGetters} from 'vuex';

export default {
    name: "DepartmentEdit",
    data() {
        return {
            depHead: null,
            isActiveWorkersList: false,
            title: null,
            head_department: null,
            formData: null,
        }
    },
    components: {
        DepartmentWorkersList,
    },
    methods: {
        showWorkers() {
            this.isActiveWorkersList = !this.isActiveWorkersList
        },
        ...mapActions(['fetchLeads', 'createNewDepartment', 'getResStatus']),
        async setFormData() {
            this.formData = {
                title: this.title,
                head_department: this.depHead
            }
        },
        async sendFormData() {
            await this.setFormData()
            await this.createNewDepartment(this.formData);
            console.log('state' + this.getResStatus)
            if(this.getResStatus === 200) {
                await this.$router.push({name: 'DepartmentsManagement'})
            }
        }
    },
    computed: {
        ...mapGetters(['getLeads']),
    },
    mounted() {
        this.fetchLeads()
    }

}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";

%sortArrow {
    content: '';
    display: inline-block;
    position: relative;
    height: 10px;
    width: 10px;
    top: -2px;
    left: 5px;
    transform: rotate(135deg);
    transition: 0.4s ease;
    padding: 0;
    margin: 0 13px;
    border-style: solid;
    border-width: 2px 2px 0 0;
    color: #D8D8D8;
}

* {
    font-family: $depManagementFF;
    transition: 0.4s ease;
    font-style: normal;
}

.departments_management {
    background-color: #fafafa;
    padding-top: 7px;
    min-height: 100vh;
}

.departments_management__header {
    align-items: center;
    min-height: 103px;
    margin-bottom: 10px;
    padding: 14px 7px;
    border-radius: 6px;
    box-shadow: $depBoxShadow;
    background-color: #FFFFFF;
}

.breadcrumbs {
    nav {
        margin-left: 0;
    }

    li {
        &::after {
            content: '';
            display: inline-block;
            position: relative;
            height: 10px;
            width: 10px;
            top: 1px;
            left: -5px;
            transform: rotate(45deg);
            padding: 0;
            margin: 0 13px;
            border-style: solid;
            border-width: 2px 2px 0 0;
            color: #D8D8D8;
        }

        &:last-child::after {
            display: none;
        }
    }
}

.departments_management__header-title {
    display: flex;
    align-items: center;
    min-height: 90px;
    font-weight: 300;
    font-size: 36px;
    color: #808080;
}

.box-form {
    margin-top: 53px;
    background: #FFFFFF;
}

form {
    font-family: 'Roboto', sans-serif;
    display: flex;
    font-size: 14px;
    padding: 30px 0 50px 0;

    ul {
        margin: 0 auto;
        list-style: none;
    }

    label {
        width: 100%;
        font-size: 14px;
        color: #666666;
        margin-bottom: 21px;
    }

    input,
    select {
        height: 60px;
        width: 377px;
        margin-bottom: 30px;
        padding: 0 15px;
        outline: none;
        background: #FFFFFF;
        border: 2px solid #F5F5F5;
        box-sizing: border-box;
        border-radius: 4px;
        line-height: 30px;
        color: #808080;
    }

    select {
        background: url("/images/arrow_down.svg") no-repeat center right 15px;
    }
}

.anchor_Modal {
    position: relative;
}

.workersCtr {
    padding-left: 25px;
    background: url("/images/eye.svg") no-repeat center right 15px;
    cursor: pointer;
}

.form-btns {
    display: flex;
}

.btnSave,
.btnCancel {
    width: 120px;
    height: 50px;
    font-size: 12px;
    text-transform: uppercase;
    padding: 15px;
    border: none;
    border-radius: 3px;
}

.btnSave {
    margin-left: 60px;
    color: #FFFFFF;
    background-color: #1875F0;
}

.btnCancel {
    margin-left: 5px;
    color: #B3B3B3;
    background-color: #FFFFFF;
    border: solid 2px #F5F5F5;
}

@media (max-width: 460px) {
    form {
        input,
        select {
            width: 90%;
        }
    }
    .btnSave {
        margin-left: 0px;
    }
}
</style>
