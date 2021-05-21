<template>
    <div>
        <department-confirm-modal v-if="isActiveConfirmModal"
                                  @close="isActiveConfirmModal = false"
                                  @deleteDeps="deleteDeps"
                                  :checked-departments="checkedDepartments"
        />
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
                                <button class="departments_list-edit" :disabled="checkedDepartments.length !==1"
                                        @click="getEdit"></button>
                            </div>
                            <div class="col-4">
                                <button class="departments_list-delete" @click="isActiveConfirmModal=true"></button>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="col-sm-12 col-md-8 col-xl-9 departments_list-search" method="get"
                      action="#">
                    <div class="row">
                        <div class="col-10 col-sm-8 col-md-10">
                            <input type="text" v-model="search" placeholder="Поиск">
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
                        <span :class="[arrowName ? 'with_sort_active' : 'with_sort']" @click="sortTitle">Название</span>
                    </li>
                    <li class="col-4">
                        <span :class="[arrowLead ? 'with_sort_active' : 'with_sort']"
                              @click="sortLead">Руководитель</span>
                    </li>
                    <li class="col-4">
                        <span>Количество сотрудников</span>
                    </li>
                </ul>
            </div>
            <div class="departments_list-body" v-if="successfulSearch">
                <ul>
                    <li class="departments_list-item" v-for="(dep, id) in getSearch" :key="id">
                        <ul class="row list-item_info">
                            <li class="col-1 checkbox_section">
                                <input type="checkbox"
                                       :value="dep.id"
                                       :id="id"
                                       v-model="checkedDepartments"
                                       class="checkbox">
                                <label :for="id"></label>
                            </li>
                            <li class="col-3">{{ dep.title }}</li>
                            <li class="col-4">{{ dep.surname }} {{ dep.name }}</li>
                            <li class="col-4">{{ dep.count }}</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters, mapMutations} from "vuex";
import DepartmentConfirmModal from "../layouts/DepartmentConfirmModal";

export default {
    name: "DepartmentsList",
    components: {
        DepartmentConfirmModal,
    },

    props: ['pagList'],

    data() {
        return {
            search: '',
            order: "id",
            nextPage: null,
            prevPage: null,
            successfulSearch: true,
            disableEditButton: false,
            arrowName: false,
            arrowLead: false,
            arrowCtr: false,
            desc: true,
            isActiveConfirmModal: false,
            checkedDepartments: [],
            list: []
        }
    },

    methods: {
        ...mapActions(['fetchDepartments', 'delDepartment', 'setDepId']),

        checkAll() {
            this.uncheck = true;
            this.cheked = true;
        },

        uncheckAll() {
            if (this.cheked === true) {
                this.uncheck = false
            }
        },

        async sortTitle() {
            if (this.arrowLead === false || this.arrowCtr === false) {
                this.arrowLead = false;
                this.arrowCtr = false;
            }

            this.arrowName = !this.arrowName;

            this.desc = !this.desc

            await this.setOrder('title')

        },

        sortLead() {
            if (this.arrowName === false || this.arrowCtr === false) {
                this.arrowName = false;
                this.arrowCtr = false;
            }

            this.arrowLead = !this.arrowLead;

            this.setOrder('surname')
        },

        sortCtr() {
            if (this.arrowName === false || this.arrowLead === false) {
                this.arrowName = false;
                this.arrowLead = false;
            }

            this.arrowCtr = !this.arrowCtr;

            this.setOrder('count')
        },

        getEdit() {
            this.$store.commit('updateDepartmentId', this.checkedDepartments)
            this.$router.push({name: 'DepartmentEdit'})
        },

        async deleteDeps() {
            let arr = this.checkedDepartments;
            let i;
            for (i = 0; i < arr.length; i++) {
                await this.delDepartment(arr[i])
            }

            await this.formList()
            this.checkedDepartments = []
            this.isActiveConfirmModal = false;
        },

        getDepartmentsList(list = this.getDepartments) {
            this.list = this.getDepartments;
        },

        async formList() {
            if (this.desc === false) {
                await this.fetchDepartments( this.order, "false");
            }

            if (this.desc === true) {
                await this.fetchDepartments( this.order, "true");
            }

            await this.getDepartmentsList();
        },

        async setOrder(order) {
            if (this.order === order) {
                this.desc = !this.desc
            } else {
                this.desc = false
            }
            this.order = order
            await this.formList()
        },

    },

    computed: {
        ...mapGetters(['getDepartments', 'getNextPage', 'getPrevPage', 'getSortedList']),

        getSearch() {
            let searchStr = this.search;
            searchStr = searchStr.trim();
            searchStr = searchStr.toLowerCase();

            let searchByTitle = this.list.filter(item => item.title.toLowerCase().indexOf(searchStr) !== -1);
            let searchBySurname = this.list.filter(item => item.surname.toLowerCase().indexOf(searchStr) !== -1);
            let searchByName = this.list.filter(item => item.name.toLowerCase().indexOf(searchStr) !== -1);

            if (searchByName.length > 0) {

                return searchByName;
            }

            if (searchBySurname.length > 0) {

                return searchBySurname;
            }

            return searchByTitle
        },
    },

    mutations: {
        ...
            mapMutations(['updateDepartmentId']),
    },
    mounted() {
        this.setOrder()
    },

    watch: {
        disableButton() {
            if (this.checkedDepartments.length > 1) {
                this.disableEditButton = true;
            }
        },
        sortParams() {
            this.$emit('sortParams', {
                order: this.order,
                desc: this.desc,
                nextPage: this.getNextPage,
                prevPage: this.getPrevPage,
            })
        }
    },
    created() {

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
        display: block;
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

@media (max-width: 768px) {
    .list_control_btns {
        border-bottom: $depBoxBorder;
    }
}
</style>
