import {fileURLToPath} from "node:url";

export default defineNuxtConfig({
  devtools: { enabled: true },
  alias: {
    'images': fileURLToPath(new URL('./assets/images', import.meta.url)),
    'style': fileURLToPath(new URL('./assets/style', import.meta.url)),
    'data': fileURLToPath(new URL('./assets/other/data', import.meta.url))
  },
  devServer: {
    port: 3000,
    host: 'zhbn.local'
  },
});