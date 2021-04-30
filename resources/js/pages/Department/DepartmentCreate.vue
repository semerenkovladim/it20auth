<template>
    <div class="container">
        <div class="row box-header">
            <nav aria-label="breadcrumb" class="col-12 bg-white">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <router-link to="#">Управление</router-link>
                    </li>
                    <li class="breadcrumb-item">
                        <router-link to="#">Отделы</router-link>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Отдел разработки проектов</li>
                </ol>
            </nav>
            <div class="container-title col-12 bg-white">Редактирование отдела</div>
        </div>
        <div class="box-form bg-white">
            <form action="#" method="post">
                <ul>
                    <li>
                        <label for="name">Название:</label>
                        <input type="text" id="name">
                    </li>
                    <li>
                        <label for="lead">Руководитель:</label>
                        <select type="text" id="lead">
                            <option value="1"></option>
                            <option value="2">Иванов Сергей Андреевич</option>
                            <option value="3">Петров Ивано Сергеевич</option>
                            <option value="4">Сергеев Петр Иванович</option>
                        </select>
                    </li>
                    <li>
                        <label for="workersCtr">Количество сотрудников:</label>
                        <input type="text" id="workersCtr" class="workersCtr" placeholder="16" readonly @click="showWorkers">
                    </li>
                    <li class="form-btns">
                        <button type="submit" class="btnSave">Сохранить</button>
                        <button type="reset" class="btnCancel">Отмена</button>
                    </li>
                </ul>
            </form>
        </div>
        <department-workers-list v-if="isActiveWorkersList" @close="isActiveWorkersList = false"/>
    </div>
</template>

<script>
import DepartmentWorkersList from "../../components/layouts/DepartmentWorkersList";
export default {
    name: "DepartmentCreate",
    data() {
        return {
            isActiveWorkersList: false,
        }
    },
    components:{
        DepartmentWorkersList,
    },
    methods: {
        showWorkers() {
            console.log(this.isActiveWorkersList)
            this.isActiveWorkersList = !this.isActiveWorkersList
        }
    }
}
</script>

<style scoped>
* {
    font-family: 'Roboto', sans-serif;
    font-weight: bold;
}
.container {
    background-color: #F5F5F5;
    padding: 7px 18px 10px 10px;
}
.box-header {
    padding: 5px 0 7px 15px;
    filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));
    border-radius: 6px;
}
.breadcrumb{
    border-radius: 6px 6px 0 0;
}
.breadcrumb,
.breadcrumb a {
    padding-left: 0;
    background-color: #FFFFFF;
    color: #CCCCCC;
    font-size: 13px;
}
.breadcrumb-item + .breadcrumb-item::before {
    border-style: solid;
    border-width: 2px 2px 0 0;
    content: '';
    display: inline-block;
    height: 8px;
    left: -5px;
    position: relative;
    top: 7px;
    transform: rotate(45deg);
    width: 8px;
    color: #D8D8D8;
    padding: 0;
}
.breadcrumb li {
    padding: 0 0 0 5px;
}
.breadcrumb li:first-child {
    padding: 0 5px 0 0;
}
.container-title {
    color: #808080;
    font-weight: 300;
    font-size: 36px;
    padding-left: 13px;
    border-radius: 0 0 6px 6px;
}
.box-form {
    margin-top: 53px;
}
form {
    font-family: 'Roboto', sans-serif;
    display: flex;
    font-size: 14px;
    padding: 30px 0 50px 0;
}
form ul {
    margin: 0 auto;
    list-style: none;
}
form label {
    width: 100%;
    font-size: 14px;
    color: #666666;
    margin-bottom: 21px;
}
form input,
form select{
    outline: none;
    background: #FFFFFF;
    border: 2px solid #F5F5F5;
    box-sizing: border-box;
    border-radius: 4px;
    line-height: 30px;
    color: #808080;
    height: 60px;
    width: 377px;
    margin-bottom: 30px;
}
.workersCtr {
    padding-left: 25px;
    background: url("/resources/images/icons/ic_remove_red_eye.svg") no-repeat top 50% right 25px;
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
    form input,
    form select {
        width: 90%;
    }
    .btnSave {
        margin-left: 0px;
    }
}
</style>
