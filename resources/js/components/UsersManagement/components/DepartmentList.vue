<template>
    <ul class="row users_management__filter_list">
        <li class="col-12 users_management__filter_item"
            v-for="department in data"
            :key="department.id"
            :class="current === department.id ? 'filter-active':''"
            @click="getDepartmentId(department.id)">{{ department.name }}
        </li>
        <li class="col-12 users_management__filter_item"
            v-if="!data">Отделы не найдены
        </li>
    </ul>
</template>

<script>
export default {
    name: "DepartmentList",
    props: ['data'],
    data() {
        return {
            current: 1
        }
    },
    methods: {
        getDepartmentId(id) {
            if (this.current !== id) {
                this.current = id
                this.$emit('sendDepartmentId', {id: id})
            }
        }
    }
}
</script>

<style lang="scss">
@import "resources/sass/variables";


.users_management__filter_item {
    border-bottom: 2px solid #F5F5F5;
    min-height: 55px;
    align-items: center;
    display: flex;
    cursor: pointer;
    border-left: 2px solid transparent;
    font-weight: 600;
    font-size: 13px;
    color: $lightColor;

    * {
        transition: 0.2s ease;
    }

    &:first-child {
        border-top: 2px solid #F5F5F5;
    }


    &:hover {
        background: $userManagementFilterActiveBg;
        border-left: 2px solid $designColorOne;
        color: $darkColor;
    }
}

.filter-active {
    background: $userManagementFilterActiveBg;
    border-left: 2px solid $designColorOne;
    color: $darkColor;
}

</style>
