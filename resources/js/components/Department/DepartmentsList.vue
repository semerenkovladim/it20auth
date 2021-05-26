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
                                <input type="checkbox" name="checkAll" id="checkAll" class="checkbox"
                                       v-model="allSelected" :checked="allSelected">
                                <label for="checkAll"
                                       @click='selectAll'
                                       :class="0 !== checkedDepartments.length ? 'middle_position':''"
                                ></label>
                            </div>
                            <div class="col-4">
                                <button class="departments_list-edit" :disabled="checkedDepartments.length !==1"
                                        @click="getEdit"></button>
                            </div>
                            <div class="col-4">
                                <button class="departments_list-delete" :disabled="checkedDepartments.length ===0"
                                        @click="isActiveConfirmModal=true"></button>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="col-sm-12 col-md-8 col-xl-9 departments_list-search" method="get"
                      @submit.prevent="sendSearchForm()"
                      action="#">
                    <div class="row">
                        <div class="col-10 col-sm-8 col-md-10">
                            <input type="text" v-model="search" placeholder="Поиск">
                        </div>
                        <button type="submit" class="col-2 col-sm-4 col-md-2 search-btn">
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="depList">
            <div class="departments_list-header">
                <ul class="row">
                    <li class="col-1"></li>
                    <li class="col-3">
                        <span :class="[arrowTitle ? 'with_sort_active' : 'with_sort']"
                              @click="sortTitle">Название</span>
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
            <div class="departments_list-body">
                <ul>
                    <li class="departments_list-item" v-for="(dep, id) in getDepartments" :key="id">
                        <ul class="row list-item_info">
                            <li class="col-1 checkbox_section">
                                <input type="checkbox"
                                       :value="dep.id"
                                       :id="id"
                                       v-model="checkedDepartments"
                                       class="checkbox"
                                       @change="checkedAllBox">
                                <label :for="id"></label>
                            </li>
                            <li class="col-3" @click="getEdit(dep.id)">{{ dep.title }}</li>
                            <li class="col-4" @click="getEdit(dep.id)">{{ dep.surname }} {{ dep.name }}</li>
                            <li class="col-4" @click="getEdit(dep.id)">{{ dep.count }}</li>
                        </ul>
                    </li>
                </ul>
                <div v-if="notFound===true" class="notFound">Ничего не найдено</div>
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
            allSelected: false,
            arrowTitle: false,
            arrowLead: false,
            arrowCtr: false,
            isActiveConfirmModal: false,
            checkedDepartments: [],
            orderData: {
                orderBy: "id",
                desc: true,
            },
            notFound: false
        }
    },

    methods: {
        ...mapActions(['fetchDepartments', 'delDepartment', 'setDepId', 'searchDepartment']),

        selectAll() {
            if (this.allSelected === true) {
                this.checkedDepartments = []
            } else {
                for (let item in this.getDepartments) {
                    this.checkedDepartments.push(this.getDepartments[item].id);
                }
            }
        },

        sortTitle() {
            this.arrowTitle = !this.arrowTitle;
            this.orderData.orderBy = 'title';

            if (this.arrowLead === false || this.arrowCtr === false) {
                this.arrowLead = false;
                this.arrowCtr = false;
            }

            this.setOrder('title')
        },

        sortLead() {
            this.orderData.orderBy = 'surname';

            if (this.arrowTitle === false || this.arrowCtr === false) {
                this.arrowTitle = false;
                this.arrowCtr = false;
            }

            this.arrowLead = !this.arrowLead;
            this.setOrder('surname')
        },

        sortCtr() {
            this.orderData.orderBy = 'count';
            if (this.arrowTitle === false || this.arrowLead === false) {
                this.arrowTitle = false;
                this.arrowLead = false;
            }

            this.arrowCtr = !this.arrowCtr;
            this.setOrder('count')
        },

        getEdit(id = this.checkedDepartments) {
            this.$store.commit('updateDepartmentId', id)
            this.$router.push({name: 'DepartmentEdit'})
        },

        async deleteDeps() {
            let arr = this.checkedDepartments;
            let i;
            for (i = 0; i < arr.length; i++) {
                await this.delDepartment(arr[i])
            }

            await this.fetchDepartments()

            this.checkedDepartments = []
            this.isActiveConfirmModal = false;
        },

        async setOrder(order) {

            if (this.orderData.orderBy === order) {
                this.orderData.desc = !this.orderData.desc
            } else {
                this.orderData.desc = false
            }

            await this.$store.commit('updateOrderBy', this.orderData.orderBy);
            await this.$store.commit('updateDesc', this.orderData.desc);
            await this.fetchDepartments();
        },

        checkedAllBox() {
            if (this.checkedDepartments.length < this.getDepartments.length) {
                this.allSelected = false
            }

            if (this.checkedDepartments.length === this.getDepartments.length) {
                this.allSelected = true
            }
        },

        async sendSearchForm() {
            await this.searchDepartment(this.search)
            this.notFound = this.getDepartments.length === 0;
        }
    },

    computed: {
        ...mapGetters(['getDepartments', 'getNextPage', 'getPrevPage', 'getDesc', 'getOrderBy']),

    },

    mutations: {
        ...
            mapMutations(['updateDepartmentId', 'updateDesc', 'updateOrderBy']),
    },

    mounted() {
        this.$store.commit('updateOrderBy', this.orderData.orderBy);
        this.$store.commit('updateDesc', this.orderData.desc);
        this.fetchDepartments()
    },

    watch: {
        disableButton() {
            if (this.checkedDepartments.length > 1) {
                this.disableEditButton = true;
            }
        },
    },
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

.depList {
    min-height: 894px;

    .departments_list-item {
        cursor: pointer;
    }

    &::-webkit-scrollbar {
        display: none;
    }

    @media (max-width: 958px) {
        & {
            min-height: auto;
            overflow-x: auto;
        }

        &::-webkit-scrollbar {
            height: 6px;
            cursor: pointer;
            background-color: lighten($designColorOne, 42%);
        }

        &::-webkit-scrollbar-button {
            display: none;
            width: 0;
            height: 0;
        }

        &::-webkit-scrollbar-track {
            background-color: transparent;
        }

        &::-webkit-scrollbar-track-piece {
            background-color: transparent;
        }

        &::-webkit-scrollbar-thumb {
            border-radius: 15px;
            background-color: lighten($designColorOne, 20%);
            cursor: pointer;

            &:hover {
                cursor: pointer;
                background-color: lighten($designColorOne, 10%);
            }
        }

        &::-webkit-scrollbar-corner {
            background-color: transparent;
        }
    }
}

.list_controls {
    > .row {
        height: 88px;
        border-bottom: $depBoxBorder;
    }

    button[disabled] {
        border: none;
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
        cursor: pointer;
        background: url("/images/search_img.png") no-repeat center;
    }
}

.notFound {
    display: flex;
    justify-content: center;
    font-size: 16px;
    margin-top: 20px;
    font-style: normal;
    font-weight: 600;
    line-height: 60px;
    color: #666666;
}

.departments_list-header {
    min-width: 550px;
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

.departments_list-body {
    min-width: 550px;
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

    .depList {
        width: auto;
    }
}
</style>
