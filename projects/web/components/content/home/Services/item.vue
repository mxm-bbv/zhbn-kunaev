<template>
  <article class="service">
    <div class="service__icon"></div>
    <h3 class="service__title">{{ title }}</h3>
    <UAccordion :items="items" class="w-full h-max">
      <template #default="{ item }">
        <UButton variant="ghost" class="service__link hover:bg-white px-0 py-0 border-0 focus:border-0">
          {{ item.label }}
          <i class="icon o--chevron-down"></i>
        </UButton>
      </template>
    </UAccordion>
  </article>
</template>

<script setup>
import {defineProps} from 'vue'

const props = defineProps({
  title: String,
  items: Array
})
</script>