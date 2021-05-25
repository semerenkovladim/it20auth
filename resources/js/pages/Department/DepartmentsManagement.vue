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
                                    <span>Отделы</span>
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
                            <button type="button" @click="$router.push({name: 'DepartmentCreate'})">
                                Добавить отдел
                            </button>
                        </div>
                        <div class="empty_area"></div>
                    </div>
                    <div class="col-md-9 departments_list-box">
                        <departments-list
                            ref="departmentsList"
                            @sortParams="sortParams"
                            :pag-list="pageList"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9 box-pagination">
                        <ul class="row pagination">
                            <li class="page-item gotoPrevPage" @click.prevent="gotoPrevPage">
                                <a href="#" class="page-link" aria-label="Previous">
                                </a>
                            </li>
                            <li class="page-item"
                                v-for="(page, index) in getLastPage"
                                :key='index'
                                :class='getCurrentPage'>
                                <span class="page-link activePage">{{ page}}</span>
                            </li>
                            <li class="page-item gotoNextPage" @click.prevent="gotoNextPage">
                                <a href="#" class="page-link" aria-label="Next">
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
import DepartmentsList from "../../components/Department/DepartmentsList";
import DepartmentConfirmModal from "../../components/layouts/DepartmentConfirmModal";
import {mapGetters, mapActions} from 'vuex';

export default {
    name: "DepartmentsManagementsList",
    data() {
        return {
            nextPage: null,
            prevPage: null,
            order: 'id',
            desc: true,
            pageList:[],
        }
    },

    components: {
        DepartmentsList,
        DepartmentConfirmModal
    },
    methods: {
        ...mapActions(['fetchDepartments']),
        gotoNextPage() {
            this.nextPage = this.getNextPage;
            this.fetchDepartments(this.order, this.desc, this.nextPage)
            this.pageList = this.getDepartments;
            this.$refs.departmentsList.getDepartmentsList(this.pageList);
        },
        gotoPrevPage() {
            this.prevPage = this.getPrevPage;
            this.fetchDepartments(this.order, this.desc, this.prevPage);
            this.pageList = this.getDepartments;
            this.$refs.departmentsList.getDepartmentsList(this.pageList);
        },
        sortParams(data) {
            this.order = data.order
            this.desc = data.desc
            this.nextPage = data.nextPage
            this.prevPage = data.prevPage
        }
    },
    computed: {
        ...mapGetters([
            'getPrevPage',
            'getNextPage',
            'getCurrentPage',
            'getLastPage',
            'getLinks',
            'getDepartments',
        ]),
    },
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
</style>
