<template>
    <div class="users_management__paginator" v-if="data.last_page">
        <nav aria-label="Page navigation">
            <ul class="paginator">
                <li class="paginator_item paginator__prev"
                    @click="prevPage"></li>
                <li class="paginator_item"
                    v-for="page in data.last_page"
                    :key="page"
                    :class="data.current_page === page ? 'paginator__current_page':''"
                    @click="toPage(page)">{{ page }}
                </li>
                <li class="paginator_item paginator__next"
                    @click="nextPage"></li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    name: "Paginator",
    props: ['data'],
    data() {
        return {
            page: 1
        }
    },
    methods: {
        emitPage() {
            this.$emit('toPage', {page: this.page})
        },
        prevPage() {
            if (this.data.current_page > 1) {
                this.page -= 1
                // console.log('prevPage', this.current_page, this.page)
            } else {
                return
            }
            this.emitPage()
        },
        toPage(page) {
            this.page = page
                // console.log('toPage', page)
            this.emitPage()
        },
        nextPage() {
            if (this.data.last_page > this.data.current_page) {
                this.page += 1
                // console.log('nextPage')
            } else {
                return
            }
            this.emitPage()
        }
    }
}
</script>

<style lang="scss">
@import "resources/sass/variables";

.users_management__paginator {
    background: #FFFFFF;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    border-radius: 6px;
    width: 100%;

    nav {
        width: 100%;
        margin: 0;
    }

    .paginator {
        display: flex;
        height: 60px;
    }

    .paginator_item {
        flex: 1 1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 14px;
        color: $darkColor;
        width: 100%;
        max-width: 68px;
        cursor: pointer;
        border-right: 2px solid #F5F5F5;

        &:last-child {
            border-right: none;
        }

        &:hover {
            background-color: #FAFAFA;
        }

    }

    .paginator__prev {
        background: url("../../../../resources/images/icons/arow-left.png") no-repeat center / 36px 30px;
    }

    .paginator__next {
        background: url("../../../../resources/images/icons/arrow-rigth.png") no-repeat center / 36px 30px;
    }

    .paginator__current_page {
        background: #FAFAFA;
    }
}


</style>
