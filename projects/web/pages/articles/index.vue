<template>
  <NuxtLayout>
    <template #title>
      Новости центра
    </template>

    <section class="news-list">
      <div class="news-list__container">
        <div class="news-list__content">
          <div class="news-list__content-list">
            <NewsItem
                v-for="article in articles.data.articles"
                :key="`article_${article.id}`"
                :thumb="article?.thumb || articles.media[0].url"
                :date="article.published_date"
                :title="article.title"
                :description="article.description"
                :slug="article.slug"
            />
          </div>
        </div>
      </div>
    </section>
  </NuxtLayout>
</template>

<script setup lang="ts">
import {ArticlesService} from "~/services/articles.service";
import NewsItem from "~/pages/articles/item.vue"

const articlesService = new ArticlesService();
const config = useRuntimeConfig();

definePageMeta({
  colorMode: 'light',
})

const articles = ref({
  data: {
    pagination: {
      next: null
    },
    articles: []
  }
});

async function fetchArticles(cursor = null) {
  try {
    articles.value = await $fetch(`${config.public.apiHost}articles`, {
      headers: {
        'Content-Type': 'application/json',
        'accept': 'application/json'
      },
      params: {cursor}
    });
  } catch (error) {
    console.error('Failed to fetch articles:', error);
  }
}

onMounted(() => {
  fetchArticles();
});
</script>