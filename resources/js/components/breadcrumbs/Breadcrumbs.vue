<template>
    <div class="col-12 breadcrumbs">
        <nav>
            <ul>
                <li class="breadcrumbs-item"
                    v-for="link in links"
                    :key="link.id">
                    <router-link :to="link.href">{{ link.name }}</router-link>
                </li>
                <li class="breadcrumbs-item" v-if="$route.path !=='/users-management'">
                    <router-link v-if="UM_SETTINGS_STATUS.personalDataStatus" to="#">Персональные данные</router-link>
                    <router-link v-if="UM_SETTINGS_STATUS.personalAccessStatus" to="#">Доступы</router-link>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import {mapGetters, mapActions} from "vuex";

export default {
    name: "Breadcrumbs",
    props: ['links'],
    methods:{
      ...mapActions([
          'changeUMPersonalDataStatus'
      ])
    },
    computed: {
        ...mapGetters([
            'UM_SETTINGS_STATUS'
        ])
    },
    created(){
        // this.changeUMPersonalDataStatus(false)
    }
}
</script>

<style lang="scss">
@import "resources/sass/variables";

.breadcrumbs {
    font-weight: 500;
    font-size: 13px;

    nav {
        margin-left: 0;
    }

    ul {
        display: flex;
        flex-wrap: wrap;
    }

    * {
        color: $lightColor;
    }

    .breadcrumbs-item {
        display: flex;
        align-items: center;

        a {
            display: flex;
            align-items: center;
            font-weight: 500;

            &:after {
                content: '';
                background: url("../../../images/icons/breadcrumbs_arrow_left.png") no-repeat center / contain;
                display: block;
                width: 30px;
                height: 30px;
            }
        }

        &:last-child {
            a {
                &:after {
                    content: none;
                    display: none;
                }
            }
        }
    }
}
</style>
