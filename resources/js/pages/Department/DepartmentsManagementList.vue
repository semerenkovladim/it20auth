<template>
<div class="container">
    <div class="row box-header">
        <nav aria-label="breadcrumb" class="col-12 bg-white">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="#">Управление</router-link></li>
                <li class="breadcrumb-item" aria-current="page">Отделы</li>
            </ol>
        </nav>
        <div class="container-title col-12 bg-white">Управление отделами</div>
    </div>
    <div class="row box-content">
        <div class="col-12 bg-white">
            <div class="row">
                <div class="col-3 rb">
                    <div class="btn-box">
                        <router-link to="#" class="btn-createDep">Добавить отдел</router-link>
                    </div>
                </div>
                <div class="col-2">
                    <div class="controls-box rb">
                        <div class="controls-item">
                            <input type="checkbox" name="checkAll" id="checkbox" class="checkbox" @change="checkAll" :checked="uncheck">
                            <label for="checkbox"></label>
                        </div>
                        <span class="controls-item create"/>
                        <span class="controls-item delete"/>
                    </div>
                </div>
                <div class="col-7 search-box">
                    <input type="text" placeholder="Поиск">
                </div>
            </div>
        </div>
    </div>
    <div class="row box-content">
        <div class="col-3 emptyArea-box rb"></div>
        <div class="col-9 departmentsTable-box">
            <div class="row">
                <table class="table">
                    <thead>
                    <tr class="cols-title">
                        <th scope="col"></th>
                        <th scope="col" class="col-depName">
                            <span>Название</span>
                            <span class="sortArrow" :class="{'sorted':arrowName}" @click="sortName"/>
                        </th>
                        <th scope="col" class="col-depLead">
                            <span>Руководитель</span>
                            <span class="sortArrow" :class="{'sorted':arrowLead}" @click="sortLead"/>

                        </th>
                        <th scope="col" class="col-workersCtr">
                            <span>Количество сотрудников</span>
                            <span class="sortArrow" :class="{'sorted':arrowCtr}" @click="sortCtr"/>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">
                            <div class="table-checkbox">
                                <input type="checkbox" name="checkAll" id="checkbox-1" class="checkbox" @change="uncheckAll" :checked="cheked">
                                <label for="checkbox-1"></label>
                            </div>
                        </th>
                        <td>Отдел Разработки проектов</td>
                        <td>Иванов Иван Иванович</td>
                        <td>16</td>
                    </tr>
                    <tr class="select">
                        <th scope="row">
                            <div class="table-checkbox">
                                <input type="checkbox" name="checkAll" id="checkbox-2" class="checkbox" @change="uncheckAll" :checked="cheked">
                                <label for="checkbox-2"></label>
                            </div>
                        </th>
                        <td>Отдел Документооборота</td>
                        <td>Иванов Иван Иванович</td>
                        <td>16</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row box-content">
        <div class="col-3"></div>
        <div class="col-9 box-pagination">
            <ul class="pagination">
                <li class="page-item gotoPrevPage">
                    <a class="page-link" href="#" aria-label="Previous">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16" aria-hidden="true">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link activePage" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">4</a>
                </li>
                <li class="page-item gotoNextPage">
                    <a class="page-link" href="#" aria-label="Next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16" aria-hidden="true">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "DepartmentsManagementList",
    data(){
        return {
            uncheck: false,
            cheked: false,
            arrowName: false,
            arrowLead: false,
            arrowCtr: false,
        }
    },
    methods: {
        checkAll() {
            this.uncheck = true;
            this.cheked = true;
        },
        uncheckAll() {
            if(this.cheked === true){
                this.uncheck = false
            }
        },
        sortName() {
            if(this.arrowLead === false || this.arrowCtr === false) {
                this.arrowLead = false;
                this.arrowCtr = false;
            }
            this.arrowName = !this.arrowName;
        },
        sortLead() {
            if(this.arrowName === false || this.arrowCtr === false) {
                this.arrowName = false;
                this.arrowCtr = false;
            }
            this.arrowLead = !this.arrowLead;
        },
        sortCtr() {
            if(this.arrowName === false || this.arrowLead === false) {
                this.arrowName = false;
                this.arrowLead = false;
            }
            this.arrowCtr = !this.arrowCtr;
        }
    }
}
</script>

<style scoped>
.rb {
    border-right: solid 2px #F5F5F5;
}
.container {
    background-color: #F5F5F5;
    padding: 7px 18px 10px 10px;
    font-family: 'Roboto', sans-serif;
}
.box-header {
    padding: 5px 0 7px 15px;
    filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));
    border-radius: 6px;
}
.box-content {
    padding: 0 0 0 15px;
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
    font-weight: bolder;
}
.breadcrumb-item + .breadcrumb-item::before,
.sortArrow {
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
.btn-box,
.controls-box,
.search-box,
.departmentsTable-box,
.emptyArea-box {
    background-color: #FFFFFF;
}
.btn-box {
    display: flex;
    justify-content: center;
    padding: 23px;
}
.btn-createDep {
    width: 208px;
    height: 48px;
    text-align: center;
    font-style: normal;
    font-weight: 900;
    font-size: 12px;
    text-transform: uppercase;
    padding: 15px;
    color: #FFFFFF;
    background-color: #1875F0;
}
.checkbox {
    display: none;
}
.checkbox+label::after {
    content: '';
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 2px solid #E6E6E6;
    border-radius: 4px;
    background-repeat: no-repeat;
    background-position: center center;
    background-size: 50% 50%;
    transition: .4s;
    margin-top: 5px;
    cursor: pointer;
}
.checkbox:checked+label::after {
    border-color: #0b76ef;
    background-color: #0b76ef;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3e%3c/svg%3e");
}
.controls-box {
    display: flex;
    height: 100%;
    padding: 31px 0 0 5px;
}
.controls-box>.create,
.controls-box>.delete {
    padding: 4px 10px;
    background: top center no-repeat;
    cursor: pointer;
}
.controls-box>.create {
    background-image: url("/resources/images/icons/edit_img.png");
    margin: 0 36px;
}
.controls-box>.delete {
    background-image: url("/resources/images/icons/delete_img.png");
}
.search-box {
    display: flex;
    color: #666666;
}
.search-box>input {
    width: 100%;
    border: none;
    background: url("/resources/images/icons/search_img.png") no-repeat right 30px center;
    outline:none;
    font-weight: bolder;
}
.search-box>input::placeholder {
    color: #CCCCCC;
}
.table th {
    border-top: none !important;
    border-bottom: none !important;
}
tr,
.emptyArea-box{
    border-top: solid 2px #F5F5F5;
    border-radius: 0 0 0 6px;
}
.departmentsTable-box {
    border-radius: 0 0 6px 0;
}
.table {
    margin-bottom: 0 !important;
    font-weight: bold;
    font-size: 12px;
    line-height: 30px;
    color: #999999;
}
.select,
.activePage{
    background-color: #FCFCFC !important;
}
.cols-title {
    font-weight: bold;
    font-size: 13px;
    color: #666666;
}
.table .checkbox {
    margin-top: 0;
}
.table-checkbox {
    padding-left: 8px;
}
.sortArrow {
    left: 15px;
    top: -3px;
    transform: rotate(135deg);
    transition: .4s;
    cursor: pointer;
}
.sorted {
    top: 3px !important;
    transform: rotate(-45deg) !important;
}
.page-link {
    padding: 25px 30px;
    background-color: #fff;
    border: 3px solid #f5f5f5;
    font-size: 14px;
    font-weight: bolder;
    color: #999999;
}
.box-pagination {
    padding: 0;
}
.gotoNextPage {
    flex-grow: 1;
    border-radius: 6px 0 6px 0;
}
.gotoPrevPage {
    border-radius: 0 6px 0 6px;
}
@media (max-width: 995px) {
    .btn-createDep {
        width: 116px;
        height: 67px;
        padding: 15px;
    }
}
</style>
