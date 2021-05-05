<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="position-relative">
                        <span class="closeModal" @click="$emit('close')"></span>
                    </div>
                    <div class="modal-title">Список сотрудников</div>
                    <ul class="workers_list">
                        <li>
                            Петров Иван
                        </li>
                        <li>
                            Берёза Петр
                        </li>
                        <li>
                            Сидоров Сергей
                        </li>
                        <li>
                            Седой Алексей
                        </li>
                    </ul>
                    <div class="btns d-flex">
                        <button type="submit" class="btnSave">Сохранить</button>
                        <button type="reset" class="btnCancel" @click="$emit('close')">Отмена</button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    name: "DepartmentWorkersList"
}
</script>

<style lang="scss" scoped>
@import "resources/sass/variables";

.modal-mask {
    position: absolute;
    z-index: 9998;
    top: 100px;
    left: 270px;
    width: 100%;
    height: 100%;
    display: table;
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.modal-container {
    max-width: 445px;
    max-height: 473px;
    margin: 0px auto;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    overflow-y: auto;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
    font-family: Roboto, sans-serif;
    font-weight: bold;
}

.modal-header h3 {
    margin-top: 0;
    color: #42b983;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}

.modal-title {
    color: #666666;
    font-size: 18px;
    padding-bottom: 20px;
    margin-top: 50px;
}

.workers_list {
        list-style: none;
        color: #808080;
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
        padding: 0;

    &  li {
        display: flex;
        position: relative;
        justify-content: center;
        padding: 27px 5px;
        border-bottom: $depBoxBorder;
        min-height: 60px;

        &:last-child {
            border-bottom: none;
        }

        &::after {
            content: '';
            display: inline-block;
            position: absolute;
            right: 15px;
            height: 25px;
            width: 25px;
            background: url("/images/ic_clear.svg") no-repeat center;
            cursor: pointer;
        }
    }
}

.closeModal {
    display: inline-block;
    height: 25px;
    width: 25px;
    background: url("/images/ic_clear.svg");
    cursor: pointer;
}

.closeModal {
    position: absolute;
    top: 5px;
    right: 5px;
}

.btns {
    margin-top: 25px;
}

.btnSave,
.btnCancel {
    width: 120px;
    height: 50px;
    font-weight: bold;
    font-size: 12px;
    text-transform: uppercase;
    padding: 15px;
    border: none;
    border-radius: 3px;
}

.btnSave {
    color: #FFFFFF;
    background-color: #1875F0;
}

.btnCancel {
    margin-left: 5px;
    color: #B3B3B3;
    background-color: #FFFFFF;
    border: solid 2px #F5F5F5;
}

::-webkit-scrollbar {
    width: 4px;
}

::-webkit-scrollbar-thumb {
    background: #D8D8D8;
    border-radius: 10px;
}

@media (max-width: 460px) {
    .modal-container {
        max-width: 320px;
    }
    .btnSave {
        margin-left: 0px;
    }
}
</style>
