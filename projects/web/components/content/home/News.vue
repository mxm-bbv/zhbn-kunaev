<template>
  <section class="news" id="news">
    <div class="news__container">
      <div class="news__content">
        <div class="news__content-header">
          <h2>Новости</h2>
          <a href="javascript:void(0)" @click="$router.push({name: 'articles'})"><span class="icon"></span>Все новости</a>
        </div>
        <div class="news__content-list">
          <NewsItem
              v-for="article in articles.data.articles"
              :key="`article_${article.id}`"
              :thumb="article.thumb"
              :date="article.published_date"
              :title="article.title"
              :description="article.description"
              :slug="article.slug"
          />
        </div>
      </div>
    </div>
  </section>
</template>
<script setup lang="ts">
import NewsItem from "~/pages/articles/item.vue";

const config = useRuntimeConfig();

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