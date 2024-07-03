<script setup lang="ts">
definePageMeta({
  colorMode: 'light',
})
</script>

<template>
  <NuxtLayout>
    <template #title>
      Руководство и Сотрудники
    </template>
    <div class="staff">
      <div class="staff__container">
        <div class="staff__content">
          <div class="staff__content-guideline">
            <h3>Руководство</h3>
            <ul>
              <li>
                <div>
                  <div class="icon"></div>
                  <span>Алпысбаева Раушан Куандыковна</span>
                </div>
                <p>Директор КГУ «Центр оказания социальной помощи жертвам бытового насилия» ГУ «Управление координации занятости и социальных программ Алматинской области»</p>
              </li>
            </ul>
          </div>
          <div class="staff__content-employees">
            <h3>Сотрудники</h3>
            <ul>
              <li>
                <div>
                  <div class="icon"></div>
                  <span>Кадырова Арна Уразаковна</span>
                </div>
                <p>Специалист по социальной работе</p>
              </li>
              <li>
                <div>
                  <div class="icon"></div>
                  <span>Шалқар Мадина Ролланқызы</span>
                </div>
                <p>Консультант по социальной работе</p>
              </li>
              <li>
                <div>
                  <div class="icon"></div>
                  <span>Чебекова Жанар Нусупбаевна</span>
                </div>
                <p>Психолог</p>
              </li>
              <li>
                <div>
                  <div class="icon"></div>
                  <span>Копбаев Думан Зикиринович</span>
                </div>
                <p>Юрист</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </NuxtLayout>
</template>

<style scoped>

</style>