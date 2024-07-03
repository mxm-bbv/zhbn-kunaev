<template>
  <div class="faq-page__group-item">
    <div class="icon"></div>
    <UAccordion :items="accordionItems">
      <template #default="{ item }">
        <div class="faq-page__group-text">
          <span>{{ item.question }}</span>
          <UButton variant="ghost" class="hover:bg-white px-0 py-0">
            <div class="icon"></div>
            Читать
          </UButton>
        </div>
      </template>
    </UAccordion>
  </div>
</template>

<script setup lang="ts">
const props = defineProps({
  question: String,
  content: String,
});

const accordionItems = [
  {
    question: props.question,
    content: props.content,
  },
];
</script>