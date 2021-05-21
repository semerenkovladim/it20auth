<template>
  <ul class="users_management__filter_list">
    <li class="col-12 users_management__filter_item"
        :class="current === 0 ? 'filter-active':''"
        @click="getDepartmentId(0)">Все пользователи
    </li>
    <li class="col-12 users_management__filter_item"
        v-for="department in ALL_DEPARTMENTS"
        :key="department.id"
        :class="current === department.id ? 'filter-active':''"
        @click="getDepartmentId(department.id)">{{ department.title }}
    </li>
    <li class="col-12 users_management__filter_item"
        v-if="!data">Отделы не найдены
    </li>
  </ul>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
  name: "DepartmentList",
  props: ['data', 'currentDep'],
  data() {
    return {
      current: 0
    }
  },
  methods: {
    getDepartmentId(id) {
      if (this.current !== id) {
        this.current = id
        this.$emit('sendDepartmentId', {id: id})
      }
    }
  },
  computed: {
    ...mapGetters(['ALL_DEPARTMENTS']),
    department() {
      return this.currentDep
    }
  },
  watch:{
    department(){
      this.current = this.currentDep
    }
  }
}
</script>

<style lang="scss">
@import "resources/sass/variables";
.users_management__filter_list {
    width: 100%;
    position: absolute;
}

.users_management__filter_item {
  border-bottom: 2px solid #F5F5F5;
  min-height: 55px;
  align-items: center;
  display: flex;
  cursor: pointer;
  font-weight: 600;
  font-size: 13px;
  color: $lightColor;
  position: relative;

  * {
    transition: 0.2s ease;
  }


  &:hover {
    background: $userManagementFilterActiveBg;
    color: $darkColor;

    &:before {
      content: '';
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      border-left: 2px solid $designColorOne;
    }
  }
}

.filter-active {
  background: $userManagementFilterActiveBg;
  color: $darkColor;

  &:before {
    content: '';
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    border-left: 2px solid $designColorOne;
    z-index: 2;
  }
}


</style>
