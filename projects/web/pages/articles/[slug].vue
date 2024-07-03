<template>
  <NuxtLayout :if="article">
    <div class="news-list">
      <div class="news-list__container">
        <div class="news-list__content">
          <div class="news-list__content-top">
            <div class="news-list__card">
              <div class="news-list__card-slider">
                <Swiper class="news-list__swiper swiper-container"
                        :modules="[Pagination]"
                        :slides-per-view="1"
                        :slides-per-group="1"
                        :pagination="true"
                        :auto-height="true"
                        :effect="'creative'"
                        :creative-effect="{
                        prev: {
                          shadow: false,
                          translate: ['-20%', 0, -1],
                        },
                        next: {
                          translate: ['100%', 0, 0],
                        },
                      }">
                  <SwiperSlide class="swiper-slide" v-for="item in article.media" :key="item.name">
                    <img :srcset="`${item.url} 1x, ${item.url} 2x`" alt="thumbnail">
                  </SwiperSlide>
                </Swiper>
              </div>
              <div class="news-list__card-text">
                <div>
                  <span>Опубликовано {{ article.date }}</span>
                  <h3>{{ article.title }}</h3>
                </div>
                <p v-html="new showdown.Converter().makeHtml(article.description)"></p>
              </div>
            </div>
          </div>
<!--          <div class="news-list__content-bottom">-->
<!--            <button>Предыдующая новость</button>-->
<!--            <button>Следующая новость</button>-->
<!--          </div>-->
        </div>
      </div>
    </div>
  </NuxtLayout>
</template>

<script setup lang="ts">
import {Pagination} from "swiper/modules";
import showdown from 'showdown';

const route = useRoute();
const config = useRuntimeConfig();

definePageMeta({
  colorMode: 'light',
})

let article = ref({});

async function fetchArticle(slug) {
  try {
    const data = await $fetch(`${config.public.apiHost}articles/${slug}`, {
      headers: {
        'Content-Type': 'application/json',
        'accept': 'application/json'
      }
    });
    article.value = data.data.article;

  } catch (error) {
    console.error('Failed to fetch articles:', error);
  }
}

onMounted(() => {
  fetchArticle(route.params.slug);
});
</script>