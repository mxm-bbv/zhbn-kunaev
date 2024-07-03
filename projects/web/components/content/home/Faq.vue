<template>
  <section class="faq" id="faq">
    <div class="faq__container">
      <div class="faq__content">
        <div class="faq__header">
          <h2 class="faq__title">FAQ</h2>
          <a href="javascript:void(0)" @click="$router.push({name: 'faq'})" class="faq__link">
            <span class="faq__link-icon"></span>
            Все FAQ
          </a>
        </div>
        <ul class="faq__list">
          <li class="faq__list-item">
             <a href="javascript:void(0)" @click="$router.push({name: 'faq'})" class="faq__question-link">
              <span class="faq__question-link-icon"></span>
              <span class="faq__question-link-text">Какие формы может принимать домашнее насилие?</span>
            </a>
          </li>
          <li class="faq__list-item">
             <a href="javascript:void(0)" @click="$router.push({name: 'faq'})" class="faq__question-link">
              <span class="faq__question-link-icon"></span>
              <span class="faq__question-link-text">Что делать, если вы в данной ситуации?</span>
            </a>
          </li>
          <li class="faq__list-item">
             <a href="javascript:void(0)" @click="$router.push({name: 'faq'})" class="faq__question-link">
              <span class="faq__question-link-icon"></span>
              <span class="faq__question-link-text">Какие формы может принимать домашнее насилие?</span>
            </a>
          </li>
          <li class="faq__list-item">
             <a href="javascript:void(0)" @click="$router.push({name: 'faq'})" class="faq__question-link">
              <span class="faq__question-link-icon"></span>
              <span class="faq__question-link-text">Что делать, если вы в данной ситуации?</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </section>
</template>