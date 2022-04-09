import {defineNuxtConfig} from 'nuxt3'
// @ts-ignore
import env from "dotenv";

const dotenv = env.config().parsed;
const apiUrl = dotenv.CUSTOM_API_URL;
const testURL = dotenv.TEST_URL;

// https://v3.nuxtjs.org/docs/directory-structure/nuxt.config
export default defineNuxtConfig({
  build: {
    postcss: {
      postcssOptions: require('./postcss.config.js'),
    },
  },
  publicRuntimeConfig: {
    CUSTOM_API_URL: apiUrl,
    TEST_URL: 'chedfjallkdsaf'
  },
  server: {
    host: '0.0.0.0',
    port: 3000
  },
  modules: [
    '@vueuse/nuxt',
  ],
  buildModules: [
    // ...
  ],
  css: [
    '@/assets/css/tailwind.css',
  ]
})
