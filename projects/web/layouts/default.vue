<template>
  <div class="wrapper">
    <div :id="!isHomePage ? 'green' : ''">
      <Header/>
      <div v-if="!isHomePage" class="header-second">
        <div class="header-second__container">
          <div class="header-second__content">
            <div class="header-second__title">
              <h1><slot name="title" /></h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main">
      <slot />
    </div>
    <Footer/>
  </div>
</template>

<script setup lang="ts">
const route = useRoute()
const isHomePage = route.path === '/'
</script>