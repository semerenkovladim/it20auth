<template>
    <div class="row users_management__row users_management__title">
        <breadcrumbs :links="links"></breadcrumbs>
        <div class="col-12 title">{{ text }}</div>
        <div class="col-12 placeholder_nav" v-if="placeholderNav">
            <nav>
                <ul>
                    <li class="placeholder_nav__item"
                        :class="item.active ? 'placeholder_nav__item-active':''"
                        v-for="item in placeholderNav"
                        :key="item.id">
                        {{ item.name }}
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
import Breadcrumbs from "../breadcrumbs/Breadcrumbs";

export default {
    name: "Placeholder",
    props: ['text', 'links', 'placeholderNav'],
    components: {
        'breadcrumbs': Breadcrumbs
    }
}
</script>

<style lang="scss">
@import "resources/sass/variables";

.users_management__title {
    min-height: 110px;
    justify-content: flex-start;
    align-items: center;
    margin-bottom: 15px;
    background: $userManagementRowBgColor;
    border-radius: $userManagementRowBorderRadius;
    box-shadow: $userManagementRowBoxShadow;

    .title {
        min-height: 90px;
        display: flex;
        align-items: center;
        font-style: normal;
        font-weight: 300;
        font-size: 36px;
        color: #808080;
        @media all and (max-width: $breakpoint) {
            font-size: 22px;
        }
    }
}

.placeholder_nav {
    padding-top: 15px;
    ul {
        display: flex;

    }
}

.placeholder_nav__item {
    min-height: 53px;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    border-top: 2px solid transparent;
    border-bottom: 2px solid transparent;
    max-width: 120px;
    text-align: center;
    font-weight: bold;
    font-size: 14px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.2s;
    padding: 0 9px;
    color: #B3B3B3;
}

.placeholder_nav__item-active, .placeholder_nav__item:hover {
    border-bottom: 2px solid $designColorOne;
    color: $designColorOne;
}
</style>
