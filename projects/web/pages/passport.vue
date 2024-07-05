<template>
 <NuxtLayout>
   <template #title>
     Паспорт центра
   </template>
  <div class="passport">
    <div class="passport__container">
      <div class="passport__content">
        <div class="passport__content-title">
          <h3>Деятельность центра</h3>
        </div>
        <div class="passport__content-text">
          <p>КГУ «Центр социальной помощи жертвам бытового насилия», входящий в состав ГУ «Управление координации
            занятости и социальных программ Алматинской области», призван оказывать помощь тем, кто столкнулся с
            бытовым насилием, в соответствии со строгими стандартами специальных социальных услуг. Построенный в
            2008 году, наш Центр оборудован 35 койками, предоставляя конфиденциальное и абсолютно бесплатное
            пристанище для женщин, оказавшихся в трудной ситуации из-за насилия. Здесь они могут находиться до
            шести месяцев, обеспечены круглосуточным пребыванием и доступом к 8 видам специализированных услуг,
            включая психологическую, социальную и юридическую поддержку.<br><br>

            Наши помещения оснащены всем необходимым: комфортабельной мебелью, столовой, медицинским кабинетом и
            даже залом для обучения и тренингов. Каждый участник программы получает индивидуальный план работы,
            способствующий их ресоциализации и восстановлению социального статуса. Сотрудничая с
            квалифицированными специалистами – юристами, психологами, социальными работниками и педагогами – мы
            создаем безопасное пространство для переживания и восстановления.<br><br>

            Наша цель – обеспечить стационарную социально-психологическую адаптацию для всех, кто пострадал от
            домашнего насилия.</p>
        </div>
        <section class="passport__stats">
          <div class="passport__stats-content">
            <ul class="passport__stats-list">
              <li class="passport__stats-item">
                            <span class="passport__stats-value">
                                <div class="passport__icon"></div> <span>739.1 кв.м.</span>
                            </span>
                <span class="passport__stats-description">Общая площадь<br>центра</span>
              </li>
              <li class="passport__stats-item">
                <span class="passport__stats-value">
                    <div class="passport__icon"></div> <span>150 кв.м.</span>
                </span>
                <span class="passport__stats-description">Площадь<br>карантийного блока</span>
              </li>
            </ul>
            <ul class="passport__stats-list">
              <li class="passport__stats-item">
                <span class="passport__stats-value">
                    <div class="passport__icon"></div> <span>50</span>
                </span>
                <span class="passport__stats-description">Количество коек</span>
              </li>
              <li class="passport__stats-item">
                <span class="passport__stats-value">
                    <div class="passport__icon"></div> <span>23</span>
                </span>
                <span class="passport__stats-description">Количество кабинетов</span>
              </li>
              <li class="passport__stats-item">
                <span class="passport__stats-value">
                    <div class="passport__icon"></div> <span>34</span>
                </span>
                <span class="passport__stats-description">Количество сотрудников</span>
              </li>
            </ul>
          </div>
        </section>
      </div>
    </div>
  </div>
 </NuxtLayout>
</template>

<script setup lang="ts">
definePageMeta({
  colorMode: 'light',
})
</script>