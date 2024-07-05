<template>
  <div class="contact-us" id="contact-us">
    <div class="contact-us__container">
      <div class="contact-us__content">
        <div class="contact-us__content-title">
          <h2>Связаться с нами</h2>
        </div>
        <div class="contact-us__content-group">
          <form id="contact-us" class="contact-us__form">
            <div class="contact-us__form-item">
              <label for="name">Ваше имя</label>
              <input type="text" placeholder="Имя" id="name" v-model="form.name" required>
            </div>
            <div class="contact-us__form-item">
              <label for="email">Ваш Email</label>
              <input type="text" placeholder="name@gmail.com" id="email" v-model="form.email" required>
            </div>
            <div class="contact-us__form-item">
              <label for="message">Сообщение</label>
              <textarea placeholder="Хочу сообщить вам..." id="message" v-model="form.message" required
                        form="contact-us" rows="4" cols="20"></textarea>
            </div>
            <div class="contact-us__form-item">
              <button type="button" @click="sendRequest">
                <div class="icon"></div>
                Отправить
              </button>
            </div>
          </form>
          <div class="contact-us__contacts">
            <div class="contact-us__contacts-content">
              <span>Свяжитесь с нами, чтобы получить помощь или задать вопросы.</span>
              <div class="contact-us__contacts-first">
                <span>
                  <div class="icon"></div>Горячая линия: <a href="tel:150">150</a>
                </span>
                <span>
                  <div class="icon"></div>Колл-центр: <a href="tel:1307">1307</a>
                </span>
                <span>
                  <div class="icon"></div>Наш номер: <a href="tel:+77273916250">+7 727 391 6250</a>
                </span>
              </div>
              <span>Мы есть в социальных сетях</span>
              <div class="contact-us__contacts-second">
                <a href="">
                  <div class="icon"></div>
                </a>
                <a href="">
                  <div class="icon"></div>
                </a>
                <a href="">
                  <div class="icon"></div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
export default {
  data() {
    return {
      form: {
        name: "",
        email: "",
        message: ""
      },
      config: useRuntimeConfig()
    }
  },
  methods: {
    async sendRequest() {
      await $fetch(`${this.config.public.apiHost}requests`, {
        headers: {
          'Content-Type': 'application/json',
          'accept': 'application/json'
        },
        body: this.form,
        method: 'POST'
      });

      this.form = {
        name: '',
        email: '',
        message: ''
      }
    }
  }
}
</script>