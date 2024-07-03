<template>
  <div class="contact-us" id="contact-us">
    <div class="contact-us__container">
      <div class="contact-us__content">
        <div class="contact-us__content-title">
          <h2>Связаться с нами</h2>
        </div>
        <div class="contact-us__content-group">
          <form id="contact-us" class="contact-us__form" action="" method="post">
            <div class="contact-us__form-item">
              <label for="">Ваше имя</label>
              <input type="text" placeholder="Имя" required>
            </div>
            <div class="contact-us__form-item">
              <label for="">Ваш Email</label>
              <input type="text" placeholder="name@gmail.com" required>
            </div>
            <div class="contact-us__form-item">
              <label for="">Сообщение</label>
              <textarea placeholder="Хочу сообщить вам..." required form="contact-us" rows="4" cols="20"></textarea>
            </div>
            <div class="contact-us__form-item">
              <button type="submit">
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