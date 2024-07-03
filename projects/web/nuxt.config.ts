export default defineNuxtConfig({
    css: ['@/assets/css/style.css'],

    app: {
        head: {
            charset: 'UTF-8',
            viewport: 'width=device-width, initial-scale=1.0',
            title: 'ZHBN',
            link: [
                {rel: 'preconnect', href: 'https://fonts.googleapis.com'},
                {rel: 'preconnect', href: 'https://fonts.gstatic.com', crossorigin: ""},
                {rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap'}
            ]
        }
    },

    modules: ['nuxt-swiper', '@nuxt/image', '@nuxt-alt/proxy', "@nuxt/ui"],

    swiper: {
        prefix: 'Swiper',
        modules: ['pagination']
    },

    colorMode: {
        preference: 'light'
    },

    runtimeConfig: {
        public: {
            apiHost: 'https://api.zhbn.local/api/v1/'
        }
    },

    $production: {},

    $development: {
        devtools: {
            enabled: true,
            timeline: {
                enabled: true
            }
        },

        devServer: {
            port: 80,
            host: 'zhbn.local'
        },
    }
});