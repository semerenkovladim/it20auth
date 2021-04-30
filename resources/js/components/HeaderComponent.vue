<template>
    <div class="flex_header">
        <div class="logo"><img src="../../images/icons/logo_foot2.svg" alt="logo"></div>
        <div class="accoun_flex">
            <p>Анна Кононенко</p>
            <div><img src="../../images/placeholder.png" alt=""></div>
            <div class="dropdown">
                <button class="btn drop dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="dropdownMenuButton">
                    <router-link to="/profile" class="dropdown-item">Мой профиль</router-link>
                    <div class="dropdown-divider"></div>
                    <router-link to="/foo" class="dropdown-item">Настройки безопасности</router-link>
                    <div class="dropdown-divider"></div>
                    <router-link to="/foo" class="dropdown-item">Выход из системы</router-link>
            </div>
            </div>
        </div>
    </div>
</template>
