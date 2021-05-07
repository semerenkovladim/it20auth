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
                    <div class="col-md-3 p-0">
                                <div class="add_departments-btn">
                                    <button type="button" @click="$router.push('/departments-create')">
                                        Добавить отдел
                                    </button>
                                </div>
                        <div class="empty_area"></div>
                    </div>
                    <div class="col-md-9 departments_list-box">
                        <div class="list_controls">
                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-xl-3 list_control_btns">
                                    <div class="wrapper">
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
                                </div>
                                <form class="col-sm-12 col-md-8 col-xl-9 departments_list-search" method="get"
                                      action="#">
                                    <div class="row">
                                        <div class="col-10 col-sm-8 col-md-10">
                                            <input type="text" placeholder="Поиск">
                                        </div>
                                        <div class="col-2 col-sm-4 col-md-2 search-btn">

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
                                        <span :class="[arrowName ? 'with_sort_active' : 'with_sort']" @click="sortName">Название</span>
                                    </li>
                                    <li class="col-4">
                                        <span :class="[arrowLead ? 'with_sort_active' : 'with_sort']" @click="sortLead">Руководитель</span>
                                    </li>
                                    <li class="col-4">
                                        <span :class="[arrowCtr ? 'with_sort_active' : 'with_sort']" @click="sortCtr">Количество сотрудников</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="departments_list-body">
                                <ul>
                                    <li class="departments_list-item" v-for="dep in getDepartments" :key="dep.id">
                                        <ul class="row list-item_info">
                                            <li class="col-1 checkbox_section">
                                                <input type="checkbox" name="checkAll" id="checkbox_id1"
                                                       class="checkbox">
                                                <label for="checkbox"></label>
                                            </li>
                                            <li class="col-3">{{ dep.title }}</li>
                                            <li class="col-4">Example</li>
                                            <li class="col-4">16</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9 box-pagination">
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
import {mapActions, mapGetters} from 'vuex'

export default {
    name: "DepartmentsManagementList",
    data() {
        return {
            departments: null,
            nextPage: null,
            prevPage: null,
            uncheck: false,
            cheked: false,
            arrowName: false,
            arrowLead: false,
            arrowCtr: false,
        }
    },
    methods: {
        ...mapActions(['fetchDepartments','delDepartment']),
        gotoNext() {
            this.nextPage = this.getNextPage;
            this.fetchAds(this.nextPage)
        },
        gotoPrev() {
            this.prevPage = this.getPrevPage;
            this.fetchAds(this.prevPage)
        },
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
        },
    },
    computed: {
        ...mapGetters(['getDepartments', 'getNextPage', 'getPrevPage'])
    },
    mounted() {
        this.fetchDepartments()
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
    cursor: pointer;
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

    .wrapper {
        width: 100%;
    }
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
        @extend %sortArrow;
    }

    .with_sort_active::after {
        @extend %sortArrow;
        top: 4px;
        transform: rotate(-45deg);
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

@media (max-width: 768px) {
    .list_control_btns {
        border-bottom: $depBoxBorder;
    }
}
</style>
