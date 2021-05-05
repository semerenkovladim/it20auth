<template>
    <main class="departments_management">
        <div class="container-fluid departments_management__container">
            <div class="col">
                <div class="row departments_management__header">
                    <div class="col-12 breadcrumbs">
                        <nav>
                            <ul>
                                <li>
                                    <a href="#">Управление</a>
                                </li>
                                <li>
                                    <a href="#">Отделы</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-12 departments_management__header-title">
                        Управление отделами
                    </div>
                </div>
                <div class="row departments_management__content">
                    <div class="col-md-2">
                        <div class="row add_departments-btn">
                            <button type="button" @click="$router.push('/departments-create')">
                                Добавить отдел
                            </button>

                        </div>
                        <div class="empty_area"></div>
                    </div>
                    <div class="col-md-10 departments_list-box">
                        <div class="list_controls">
                            <div class="row">
                                <div class="col-sm-12 col-md-3 col-xl-2 list_control_btns">
                                    <div class="row">
                                        <div class="col-4 checkbox_section">
                                            <input type="checkbox" name="checkAll" id="checkbox" class="checkbox">
                                            <label for="checkbox"></label>
                                        </div>
                                        <div class="col-4">
                                            <div class="departments_list-edit"></div>
                                        </div>
                                        <div class="col-4">
                                            <div class="departments_list-delete"></div>
                                        </div>
                                    </div>
                                </div>
                                <form class="col-sm-12 col-md-9 col-xl-10 departments_list-search" method="get"
                                      action="#">
                                    <div class="row">
                                        <div class="col-10">
                                            <input type="text" placeholder="Поиск">
                                        </div>
                                        <div class="col-2 search-btn">

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="depList">
                            <div class="departments_list-header">
                                <ul class="row">
                                    <li class="col-1"></li>
                                    <li class="col-3">
                                        <span class="with_sort">Название</span>
                                    </li>
                                    <li class="col-4">
                                        <span class="with_sort">Руководитель</span>
                                    </li>
                                    <li class="col-4">
                                        <span class="with_sort">Количество сотрудников</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="departments_list-body">
                                <ul>
                                    <li class="departments_list-item">
                                        <ul class="row list-item_info">
                                            <li class="col-1 checkbox_section">
                                                <input type="checkbox" name="checkAll" id="checkbox_id1"
                                                       class="checkbox">
                                                <label for="checkbox_id1"></label>
                                            </li>
                                            <li class="col-3">Название отдела</li>
                                            <li class="col-4">Имя руководителя отдела</li>
                                            <li class="col-4">16</li>
                                        </ul>
                                    </li>
                                    <li class="departments_list-item">
                                        <ul class="row list-item_info">
                                            <li class="col-1 checkbox_section">
                                                <input type="checkbox" name="checkAll" id="checkbox_id1"
                                                       class="checkbox">
                                                <label for="checkbox_id1"></label>
                                            </li>
                                            <li class="col-3">Название отдела</li>
                                            <li class="col-4">Имя руководителя отдела</li>
                                            <li class="col-4">16</li>
                                        </ul>
                                    </li>
                                    <li class="departments_list-item">
                                        <ul class="row list-item_info">
                                            <li class="col-1 checkbox_section">
                                                <input type="checkbox" name="checkAll" id="checkbox_id2"
                                                       class="checkbox">
                                                <label for="checkbox_id2"></label>
                                            </li>
                                            <li class="col-3">Название отдела</li>
                                            <li class="col-4">Имя руководителя отдела</li>
                                            <li class="col-4">16</li>
                                        </ul>
                                    </li>
                                    <li class="departments_list-item">
                                        <ul class="row list-item_info">
                                            <li class="col-1 checkbox_section">
                                                <input type="checkbox" name="checkAll" id="checkbox_id3"
                                                       class="checkbox">
                                                <label for="checkbox_id3"></label>
                                            </li>
                                            <li class="col-3">Название отдела</li>
                                            <li class="col-4">Имя руководителя отдела</li>
                                            <li class="col-4">16</li>
                                        </ul>
                                    </li>
                                    <li class="departments_list-item">
                                        <ul class="row list-item_info">
                                            <li class="col-1 checkbox_section">
                                                <input type="checkbox" name="checkAll" id="checkbox_id4"
                                                       class="checkbox">
                                                <label for="checkbox_id4"></label>
                                            </li>
                                            <li class="col-3">Название отдела</li>
                                            <li class="col-4">Имя руководителя отдела</li>
                                            <li class="col-4">16</li>
                                        </ul>
                                    </li>
                                    <li class="departments_list-item">
                                        <ul class="row list-item_info">
                                            <li class="col-1 checkbox_section">
                                                <input type="checkbox" name="checkAll" id="checkbox_id5"
                                                       class="checkbox">
                                                <label for="checkbox_id5"></label>
                                            </li>
                                            <li class="col-3">Название отдела</li>
                                            <li class="col-4">Имя руководителя отдела</li>
                                            <li class="col-4">16</li>
                                        </ul>
                                    </li>
                                    <li class="departments_list-item">
                                        <ul class="row list-item_info">
                                            <li class="col-1 checkbox_section">
                                                <input type="checkbox" name="checkAll" id="checkbox_id6"
                                                       class="checkbox">
                                                <label for="checkbox_id6"></label>
                                            </li>
                                            <li class="col-3">Название отдела</li>
                                            <li class="col-4">Имя руководителя отдела</li>
                                            <li class="col-4">16</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10 box-pagination">
                        <ul class="row pagination">
                            <li class="page-item gotoPrevPage">
                                <a class="page-link" href="#" aria-label="Previous">
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
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    name: "DepartmentsManagementList",
    data() {
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
            if (this.cheked === true) {
                this.uncheck = false
            }
        },
        sortName() {
            if (this.arrowLead === false || this.arrowCtr === false) {
                this.arrowLead = false;
                this.arrowCtr = false;
            }
            this.arrowName = !this.arrowName;
        },
        sortLead() {
            if (this.arrowName === false || this.arrowCtr === false) {
                this.arrowName = false;
                this.arrowCtr = false;
            }
            this.arrowLead = !this.arrowLead;
        },
        sortCtr() {
            if (this.arrowName === false || this.arrowLead === false) {
                this.arrowName = false;
                this.arrowLead = false;
            }
            this.arrowCtr = !this.arrowCtr;
        }
    }
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";

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

.departments_management__content {
    margin-bottom: 4px;
    border-radius: 6px;
    box-shadow: $depBoxShadow;
    background: #FFFFFF;
}

.departments_list-box {
    border-left: $depBoxBorder;
}

.add_departments-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 88px;
    border-bottom: $depBoxBorder;

    button {
        font-style: normal;
        font-weight: 900;
        font-size: 12px;
        text-align: center;
        text-transform: uppercase;
        min-height: 50px;
        padding-right: 15px;
        padding-left: 15px;
        height: 47px;
        width: 208px;
        background: #1875F0;
        color: #FFFFFF;
        border-radius: 4px 4px 0 0;
    }
}

.list_control_btns {
    display: flex;
    align-items: center;
    border-right: $depBoxBorder;
}

.checkbox_section {
    display: flex;
    align-items: center;
    padding-left: 30px;

    .checkbox {
        display: none;

        & + label::after {
            content: '';
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #E6E6E6;
            border-radius: 4px;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 50% 50%;
            transition: .4s ease;
            margin-top: 5px;
            cursor: pointer;
        }

        &:checked + label::after {
            border-color: #0b76ef;
            background-color: #0b76ef;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3e%3c/svg%3e");
        }

    }
}

.list_controls {
    > .row {
        height: 88px;
        border-bottom: $depBoxBorder;
    }

    .departments_list-edit {
        width: 30px;
        height: 30px;
        margin-left: 10px;
        cursor: pointer;
        background: url("/images/edit_img.png") no-repeat center;
    }

    .departments_list-delete {
        width: 30px;
        height: 30px;
        cursor: pointer;
        background: url("/images/delete_img.png") no-repeat center;
    }
}

.departments_list-search {
    .row {
        align-items: center;
        height: 100%;
        padding: 0 40px;
    }

    input {
        color: #999999;
    }

    input::placeholder {
        color: #CCCCCC;
    }

    .search-btn {
        height: 100%;
        background: url("/images/search_img.png") no-repeat center;
        cursor: pointer;
    }
}

.departments_list-header {
    font-size: 13px;
    font-style: normal;
    font-weight: 600;
    line-height: 60px;
    color: #666666;

    > .row {
        border-bottom: $depBoxBorder;
    }

    .with_sort::after {
        content: '';
        display: inline-block;
        position: relative;
        height: 10px;
        width: 10px;
        top: -2px;
        left: 5px;
        transform: rotate(135deg);
        padding: 0;
        margin: 0 13px;
        border-style: solid;
        border-width: 2px 2px 0 0;
        color: #D8D8D8;
        cursor: pointer;
    }
}

.list-item_info {
    display: flex;
    align-items: center;
    font-style: normal;
    font-weight: 500;
    font-size: 13px;
    line-height: 30px;
    min-height: 55px;
    color: #999999;
    border-bottom: $depBoxBorder;
}

.pagination {
    .page-link {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 62px;
        width: 67px;
        background-color: #fff;
        border: 3px solid #f5f5f5;
        font-size: 14px;
        font-weight: bolder;
        color: #999999;
    }

    .box-pagination {
        padding: 0;
        height: 60px;
    }

    .gotoNextPage {
        flex-grow: 1;
        border: 3px solid #f5f5f5;
        border-radius: 6px 0 6px 0;
        background: #FFFFFF;

        .page-link {
            width: 67px;
            height: 56px;
            border: none;
            background: url("/images/arrow-rigth.png") no-repeat center;
        }
    }

    .gotoPrevPage {
        border-radius: 0 6px 0 6px;
        background: #FFFFFF;

        .page-link {
            width: 67px;
            height: 62px;
            background: url("/images/arow-left.png") no-repeat center;
        }
    }
}

//.departments_management__pagination {
//    background: #FFFFFF;
//    box-shadow: $depBoxShadow;
//    border-radius: 6px;
//
//    nav {
//        width: 100%;
//    }
//
//    .paginator {
//        display: flex;
//        height: 60px;
//    }
//
//    .paginator_item {
//        flex: 1 1;
//        display: flex;
//        align-items: center;
//        justify-content: center;
//        font-weight: bold;
//        font-size: 14px;
//        color: $darkColor;
//        width: 100%;
//        max-width: 68px;
//        cursor: pointer;
//        border-right: $depBoxBorder;
//
//        &:last-child {
//            border-right: none;
//        }
//
//        &:hover {
//            background-color: #FAFAFA;
//        }
//
//    }
//
//    .paginator__prev {
//        background: url("/images/arow-left.png") no-repeat center / 36px 30px;
//    }
//
//    .paginator__next {
//        background: url("/images/arrow-rigth.png") no-repeat center / 36px 30px;
//    }
//
//    .paginator__current_page {
//        background: #FAFAFA;
//    }
//}

/*.rb {*/
/*    border-right: solid 2px #F5F5F5;*/
/*}*/
/*.container {*/
/*    background-color: #F5F5F5;*/
/*    padding: 7px 18px 10px 10px;*/
/*    font-family: 'Roboto', sans-serif;*/
/*}*/
/*.box-header {*/
/*    padding: 5px 0 7px 15px;*/
/*    filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));*/
/*    border-radius: 6px;*/
/*}*/
/*.box-content {*/
/*    padding: 0 0 0 15px;*/
/*}*/

/*.breadcrumb{*/
/*    border-radius: 6px 6px 0 0;*/
/*}*/
/*.breadcrumb,*/
/*.breadcrumb a {*/
/*    padding-left: 0;*/
/*    background-color: #FFFFFF;*/
/*    color: #CCCCCC;*/
/*    font-size: 13px;*/
/*    font-weight: bolder;*/
/*}*/
/*.breadcrumb-item + .breadcrumb-item::before,*/
/*.sortArrow {*/
//border-style: solid;
//border-width: 2px 2px 0 0;
//content: '';
//display: inline-block;
//height: 8px;
//left: -5px;
//position: relative;
//top: 7px;
//transform: rotate(45deg);
//width: 8px;
//color: #D8D8D8;
//padding: 0;
/*}*/
/*.breadcrumb li {*/
/*    padding: 0 0 0 5px;*/
/*}*/
/*.breadcrumb li:first-child {*/
/*    padding: 0 5px 0 0;*/
/*}*/
/*.container-title {*/
/*    color: #808080;*/
/*    font-weight: 300;*/
/*    font-size: 36px;*/
/*    padding-left: 13px;*/
/*    border-radius: 0 0 6px 6px;*/
/*}*/
/*.btn-box,*/
/*.controls-box,*/
/*.search-box,*/
/*.departmentsTable-box,*/
/*.emptyArea-box {*/
/*    background-color: #FFFFFF;*/
/*}*/
/*.btn-box {*/
/*    display: flex;*/
/*    justify-content: center;*/
/*    padding: 23px;*/
/*}*/
/*.btn-createDep {*/
/*    width: 208px;*/
/*    height: 48px;*/
/*    text-align: center;*/
/*    font-style: normal;*/
/*    font-weight: 900;*/
/*    font-size: 12px;*/
/*    text-transform: uppercase;*/
/*    padding: 15px;*/
/*    color: #FFFFFF;*/
/*    background-color: #1875F0;*/
/*}*/
/*.checkbox {*/
/*    display: none;*/
/*}*/
/*.checkbox+label::after {*/
/*    content: '';*/
/*    display: inline-block;*/
/*    width: 20px;*/
/*    height: 20px;*/
/*    border: 2px solid #E6E6E6;*/
/*    border-radius: 4px;*/
/*    background-repeat: no-repeat;*/
/*    background-position: center center;*/
/*    background-size: 50% 50%;*/
/*    transition: .4s;*/
/*    margin-top: 5px;*/
/*    cursor: pointer;*/
/*}*/
/*.checkbox:checked+label::after {*/
/*    border-color: #0b76ef;*/
/*    background-color: #0b76ef;*/
/*    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3e%3c/svg%3e");*/
/*}*/
/*.controls-box {*/
/*    display: flex;*/
/*    height: 100%;*/
/*    padding: 31px 0 0 5px;*/
/*}*/
/*.controls-box>.create,*/
/*.controls-box>.delete {*/
/*    padding: 4px 10px;*/
/*    background: top center no-repeat;*/
/*    cursor: pointer;*/
/*}*/
/*.controls-box>.create {*/
/*    background-image: url("/resources/images/icons/edit_img.png");*/
/*    margin: 0 36px;*/
/*}*/
/*.controls-box>.delete {*/
/*    background-image: url("/resources/images/icons/delete_img.png");*/
/*}*/
/*.search-box {*/
/*    display: flex;*/
/*    color: #666666;*/
/*}*/
/*.search-box>input {*/
/*    width: 100%;*/
/*    border: none;*/
/*    background: url("/resources/images/icons/search_img.png") no-repeat right 30px center;*/
/*    outline:none;*/
/*    font-weight: bolder;*/
/*}*/
/*.search-box>input::placeholder {*/
/*    color: #CCCCCC;*/
/*}*/
/*.table th {*/
/*    border-top: none !important;*/
/*    border-bottom: none !important;*/
/*}*/
/*tr,*/
/*.emptyArea-box{*/
/*    border-top: solid 2px #F5F5F5;*/
/*    border-radius: 0 0 0 6px;*/
/*}*/
/*.departmentsTable-box {*/
/*    border-radius: 0 0 6px 0;*/
/*}*/
/*.table {*/
/*    margin-bottom: 0 !important;*/
/*    font-weight: bold;*/
/*    font-size: 12px;*/
/*    line-height: 30px;*/
/*    color: #999999;*/
/*}*/
/*.select,*/
/*.activePage{*/
/*    background-color: #FCFCFC !important;*/
/*}*/
/*.cols-title {*/
/*    font-weight: bold;*/
/*    font-size: 13px;*/
/*    color: #666666;*/
/*}*/
/*.table .checkbox {*/
/*    margin-top: 0;*/
/*}*/
/*.table-checkbox {*/
/*    padding-left: 8px;*/
/*}*/
/*.sortArrow {*/
/*    left: 15px;*/
/*    top: -3px;*/
/*    transform: rotate(135deg);*/
/*    transition: .4s;*/
/*    cursor: pointer;*/
/*}*/
/*.sorted {*/
/*    top: 3px !important;*/
/*    transform: rotate(-45deg) !important;*/
/*}*/
/*.page-link {*/
/*    padding: 25px 30px;*/
/*    background-color: #fff;*/
/*    border: 3px solid #f5f5f5;*/
/*    font-size: 14px;*/
/*    font-weight: bolder;*/
/*    color: #999999;*/
/*}*/
/*.box-pagination {*/
/*    padding: 0;*/
/*}*/
/*.gotoNextPage {*/
/*    flex-grow: 1;*/
/*    border-radius: 6px 0 6px 0;*/
/*}*/
/*.gotoPrevPage {*/
/*    border-radius: 0 6px 0 6px;*/
/*}*/
/*@media (max-width: 995px) {*/
/*    .btn-createDep {*/
/*        width: 116px;*/
/*        height: 67px;*/
/*        padding: 15px;*/
/*    }*/
/*}*/
</style>
