<!--<template>-->
<!--    <div class="cropper_wrapper"-->
<!--         v-if="img.status">-->
<!--        <div class="wrapper">-->
<!--            <cropper-->
<!--                stencil-component="circle-stencil"-->
<!--                class="cropper"-->
<!--                :src="imageProp.src"-->
<!--                ref="cropper"-->
<!--                :stencil-props="{-->
<!--		            aspectRatio: 1/1,-->
<!--		            movable: true,-->
<!--		            resizable: true-->
<!--	            }"-->
<!--            />-->
<!--            <button class="crop_btn"-->
<!--                    type="button"-->
<!--                    @click="crop">-->
<!--                Готово-->
<!--            </button>-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--import {CircleStencil, Cropper, Preview} from 'vue-advanced-cropper'-->
<!--import 'vue-advanced-cropper/dist/style.css';-->

<!--export default {-->
<!--    components: {-->
<!--        Cropper,-->
<!--        Preview,-->
<!--        CircleStencil-->
<!--    },-->
<!--    props: ['imageProp'],-->
<!--    data() {-->
<!--        return {-->
<!--            img: {},-->
<!--            coordinates: {-->
<!--                width: 0,-->
<!--                height: 0,-->
<!--                left: 0,-->
<!--                top: 0,-->
<!--            },-->
<!--            image: null-->
<!--        }-->
<!--    },-->
<!--    methods: {-->
<!--        async crop() {-->
<!--            const {coordinates, canvas} = this.$refs.cropper.getResult();-->
<!--            this.coordinates = coordinates;-->
<!--            this.image = canvas.toDataURL();-->
<!--            this.img.status = false-->
<!--            this.setImg()-->
<!--        },-->
<!--        setImg() {-->
<!--            this.$emit('cropImg', {avatar: this.image})-->
<!--        }-->
<!--    },-->
<!--    computed: {-->
<!--        propsImg() {-->
<!--            return this.imageProp-->
<!--        }-->
<!--    },-->
<!--    watch: {-->
<!--        propsImg() {-->
<!--            this.img = this.imageProp-->
<!--        }-->
<!--    }-->
<!--}-->
<!--</script>-->

<!--<style lang="scss">-->
<!--@import "resources/sass/variables";-->

<!--.cropper_wrapper {-->
<!--    z-index: 99;-->
<!--    position: fixed;-->
<!--    width: 100vw;-->
<!--    height: 100vh;-->
<!--    top: 0;-->
<!--    left: 0;-->
<!--    background: rgba(53, 53, 53, 0.61);-->
<!--    display: flex;-->
<!--    align-items: center;-->
<!--    justify-content: center;-->


<!--    .cropper {-->
<!--        position: relative;-->
<!--        top: 0;-->
<!--        left: 0;-->
<!--        border-radius: 5px;-->
<!--        overflow: hidden;-->

<!--        * {-->
<!--            transition: none !important;-->
<!--        }-->
<!--    }-->

<!--    .preview {-->
<!--        border-radius: 50%;-->
<!--        position: relative;-->
<!--        top: 0;-->
<!--        left: 0;-->
<!--    }-->

<!--    .wrapper {-->
<!--        display: flex;-->
<!--        justify-content: center;-->
<!--        align-items: center;-->
<!--        width: 35vw;-->
<!--        min-height: 320px;-->
<!--        min-width: 320px;-->
<!--        background: #262626;-->
<!--        padding: 10px;-->
<!--        border-radius: 5px;-->
<!--        flex-wrap: wrap;-->

<!--        .vue-advanced-cropper__background, .vue-advanced-cropper__foreground {-->
<!--            background: #262626;-->
<!--        }-->

<!--        .crop_btn {-->
<!--            width: 100%;-->
<!--            padding: 5px 15px;-->
<!--            color: #ffffff;-->
<!--            background: $designColorOne;-->
<!--        }-->
<!--    }-->
<!--}-->


<!--</style>-->
