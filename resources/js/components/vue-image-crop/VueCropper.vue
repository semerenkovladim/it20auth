<template>
    <div class="cropper-wrapper" @click="closeCropper($event)">
        <a class="btn" @click="toggleShow">set avatar</a>
        <my-upload @crop-success="cropSuccess"
                   @crop-upload-success="cropUploadSuccess"
                   @crop-upload-fail="cropUploadFail"
                   @update:modelValue="toggleShow"
                   :maxSize="maxSize"
                   :width="300"
                   :height="300"
                   :url="url"
                   :langType="'ru'"
                   :field="'file'"
                   img-format="png"></my-upload>
        <img :src="imgDataUrl" alt="image">
    </div>
</template>

<script>
/**
 *
 * langType - язык
 * url - апи роут для сохранения картинки
 * @update:modelValue - событие при нажатии кнопок закрытия компонента, вызывает всплытие события closeCropper, обрабатывать в родительском
 * @crop-upload-success - вызывает всплытие события uploadSuccess в случае успешного сохранения фото. Содержит готовый путь к файлу
 *
 *
 */
import myUpload from 'vue-image-crop-upload';

export default {
    name: "VueCropper",
    components: {
        'my-upload': myUpload
    },
    data() {
        return {
            url: '/api/image/upload/avatar',
            imgDataUrl: '',
            maxSize: 2048
        }
    },

    methods: {
        toggleShow() {
            this.$emit('closeCropper')
        },

        cropSuccess(imgDataUrl, field) {
            // console.log('-------- crop success --------');
            this.imgDataUrl = imgDataUrl;
        },

        cropUploadSuccess(jsonData, field) {
            this.$emit('uploadSuccess', jsonData)
        },

        cropUploadFail(status, field) {
            // console.log('-------- upload fail --------');
            // console.log(status);
            // console.log('field: ' + field);
        },
        closeCropper(event) {
            if (event.target.classList.contains('vue-image-crop-upload')) this.toggleShow()
        }
    }
}
</script>

<style lang="scss">
@import "resources/sass/variables";

.vue-image-crop-upload {
    padding-left: 15px;
    padding-right: 15px;
    display: flex;
    align-items: center;
    justify-content: center;

    .vicp-wrap {
        border-radius: $borderRad;
        box-shadow: $userManagementRowBoxShadow;
        width: 100%;
        max-width: 600px;
        height: fit-content;
        position: relative;

        .vicp-close {
            display: none;
        }

        * {
            transition: none;
        }

        .vicp-step1 .vicp-drop-area {
            border-radius: $borderRad;
            transition: 0.1s ease;
        }

        .vicp-step2 .vicp-crop {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-right: -15px;
            margin-left: -15px;

            .vicp-crop-left, .vicp-crop-right {
                flex: 1 1 50%;
                padding-left: 15px;
                padding-right: 15px;
                justify-content: center;

                > * {
                    margin: auto;
                }
            }

            .vicp-img-container {
                margin-bottom: 15px;
            }

            .vicp-preview {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                max-width: 240px;

                .vicp-preview-item {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    flex: 1 1 50%;
                    margin: 0 !important;
                    padding: 15px !important;
                }
            }
        }

        .vicp-step3 {
            .vicp-upload {
                display: flex;
                align-items: center;
                justify-content: center;

                .vicp-success {
                    line-height: 1.5;
                    height: fit-content;
                }
            }
        }

        .vicp-operate {
            position: static;
            display: flex;
            justify-content: space-evenly;
            padding-top: 15px;
            padding-bottom: 15px;
            max-width: 240px;
            margin: 0 auto;

            a {
                text-decoration: none;
                transition: 0.1s ease;
                color: #B2B2B2;
                border: 2px solid #F5F5F5;
                margin: 0;
                border-radius: 4px;
                float: none;
                position: static;
                line-height: 1;
                min-height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #FFFFFF;
                font-weight: 600;

                &:hover {
                    color: darken(#B2B2B2, 5%);
                    background: #FFFFFF;
                    border: 2px solid darken(#F5F5F5, 5%);
                }
            }

            .vicp-operate-btn {;
                color: #ffffff;
                border: none;
                background: $designColorOne;

                &:hover {
                    color: #ffffff;
                    border: none;
                    background: darken($designColorOne, 5%);
                }
            }
        }
    }
}

.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range {
    display: flex;
    align-items: center;
    margin: auto;

    input[type=range] {
        padding-top: 0;

        &::-webkit-slider-runnable-track {
            background-color: lighten($designColorOne, 25%);
        }

        &::-webkit-slider-thumb {
            background: lighten($designColorOne, 15%);
            cursor: pointer;
        }

        &:focus {
            &::-webkit-slider-runnable-track {
                background-color: lighten($designColorOne, 30%);
            }

            &::-webkit-slider-thumb {
                background: lighten($designColorOne, 20%);
                cursor: pointer;
            }
        }
    }
}
</style>
