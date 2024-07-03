<template>
  <NuxtLayout>
    <Parts />
    <Hello />
    <Services />
    <Resources />
    <Faq />
    <Stats />
    <News />
    <ContactUs />
  </NuxtLayout>
</template>
<script setup lang="ts">
import ContactUs from "~/components/content/home/ContactUs.vue";
import Parts from "~/components/content/home/Parts.vue";
import Hello from "~/components/content/home/Hello.vue";
import Services from "~/components/content/home/Services/index.vue";
import Resources from "~/components/content/home/Resources.vue";
import Faq from "~/components/content/home/Faq.vue";
import Stats from "~/components/content/home/Stats.vue";
import News from "~/components/content/home/News.vue";

definePageMeta({
  colorMode: 'light',
})
</script>