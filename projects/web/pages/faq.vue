<template>
  <NuxtLayout>
    <template #title>
      FAQ
    </template>
    <FaqIndex />
  </NuxtLayout>
</template>

<script setup lang="ts">
import FaqIndex from "~/components/content/home/FAQ/index.vue";

definePageMeta({
  colorMode: 'light',
})
</script>