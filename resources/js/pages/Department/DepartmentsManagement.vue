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
                        <departments-list/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9 box-pagination">
                        <ul class="row pagination">
                            <li class="page-item gotoPrevPage" @click.prevent="gotoPrevPage">
                                <button :disabled='getPrevPage === null' class="page-link"></button>
                            </li>
                            <li class="page-item"
                                v-for="(page, index) in pageList"
                                :key='index'
                                @click="gotoPage(page.url)">
                                <span class="page-link activePage">{{ page.label }}</span>
                            </li>
                            <li class="page-item gotoNextPage" @click.prevent="gotoNextPage">
                                <button :disabled='getNextPage === null' class="page-link"></button>
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
            pageList: [],
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
            this.fetchDepartments(this.nextPage)
        },

        gotoPrevPage() {
            this.prevPage = this.getPrevPage;
            this.fetchDepartments(this.prevPage);
        },

        gotoPage(url) {
          this.fetchDepartments(url)
        },

        pages() {
            let i = 1;
            let linksLength = this.getLastPage;

            for (i; i <= linksLength; i++) {
                this.pageList.push(this.getLinks[i])
            }
        },
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

    mounted() {
        this.pages()
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
