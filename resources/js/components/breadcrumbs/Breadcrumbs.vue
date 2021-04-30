<template>
    <div class="col-12 breadcrumbs">
        <nav>
            <ul>
                <li class="breadcrumbs-item"
                    v-for="link in links"
                    :key="link.id">
                    <a :href="link.href">{{link.name}}</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    name: "Breadcrumbs",
    props:['links']
}
</script>

<style lang="scss">
@import "resources/sass/variables";

.breadcrumbs {
    font-weight: 500;
    font-size: 13px;

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
