<template>
    <div class="img_loader">
        <label class="img_loader__label">
            <input type="file"
                   multiple
                   accept="image/*"
                   name="image"
                   ref="file"
                   @change="handleSelects">
            <span class="img_loader__img-wrapper">
                    <img :src="img" class="preview" alt="">
                </span>

        </label>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "ImageLoader",
    props: ['imageProp'],
    data() {
        return {
            image: '',
            img: ''
        }
    },
    methods: {
        ...mapActions([
            'getUMMessage'
        ]),
        handleSelects(e) {
            this.image = '';
            let file = e.target.files;

            if (!file[0].type.match("image.*")) {
                this.getUMMessage({data: 'Файл не является изображением!', status: false})
                return;
            }
            if (this.$refs.file.files[0].size > 2097152) {
                this.getUMMessage({data: {error: {message: ['Превышен размер файла!']}}, status: false})
                return;
            }
            let reader = new FileReader();
            reader.onload = (e) => this.image = e.target.result;
            reader.readAsDataURL(file[0]);
            // this.img = this.$refs.file.files[0];
        }
    },
    computed: {
        changeImageProp() {
            return this.imageProp
        },
        getImg() {
            return this.image
        }
    },
    watch: {
        changeImageProp() {
            this.img = this.imageProp
        },
        getImg() {
            this.$emit('imageSelected', {src: this.image, status: true})
        }
    }
}
</script>

<style lang="scss">
.img_loader {
    width: 100%;
    padding-top: 100%;
    position: relative;
    height: 0;
}

.img_loader__label {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    border-radius: 50%;
    background: #ccc;
    border: 0.5px solid #666666;

    input {
        display: none;
        width: 100%;
    }

    &:hover {
        &:after {
            content: '';
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("../../../images/icons/ic_camera_alt.png") no-repeat center / 30%, darken(rgba(76, 75, 75, 0.6), 15%);
        }
    }
}

.img_loader__img-wrapper {
    width: 100%;
    height: 100%;
    flex: 1 1 100%;

    img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
}

</style>
