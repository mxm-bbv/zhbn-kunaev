<template>
  <article class="news-list__item">
    <div class="news-list__item-thumb">
      <img :srcset="`${thumb} 1x, ${thumb} 2x`" alt="thumbnail">
    </div>
    <div class="news-list__item-info">
      <div>
        <span>Опубликовано {{ date }}</span>
        <h3 v-text="title"></h3>
      </div>
      <p v-text="description"></p>
      <a href="javascript:void(0)" @click="$router.push({ name: 'articles-slug', params: { slug } })">
        <span class="icon"></span>Читать далее ...
      </a>
    </div>
  </article>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';

const props = defineProps({
  thumb: String,
  date: String,
  title: String,
  description: String,
  slug: String
});
definePageMeta({
  colorMode: 'light',
})

</script>