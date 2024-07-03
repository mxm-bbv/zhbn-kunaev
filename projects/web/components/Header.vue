<template>
  <header class="header">
    <div class="header__container">
      <div class="header__content">
        <a href="javascript:void(0)" @click="$router.push({name: 'index'})" class="header__content-logo">
          <img src="@/assets/img/logo.png" alt="">
          <span>Помощь ЖБН</span>
        </a>
        <div class="header__content-buttons">
          <a href="#"><div class="icon"></div>Версия для слабовидящих</a>
          <a href="#">РУС</a>
        </div>
      </div>
    </div>
  </header>
</template>