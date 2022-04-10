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
    additionalExtensions: {
      extend(config, ctx) {
        if (ctx.isDev) {
          config.devtool = ctx.isClient ? 'source-map' : 'inline-source-map'
        }
      }
    }
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
  ],
  buildModules: [
    // ...
  ],
  css: [
    '@/assets/css/tailwind.css',
  ],
  plugins: [{ src: '~/plugins/prism' }]
})
