<script setup lang="ts">
import {ref} from "@vue/reactivity";
import {RuntimeConfig} from "@nuxt/schema";
import {useCookie, useFetch, useRuntimeConfig, useState,} from "#app";
import {IUser} from "~/types/IUser";
import Navbar from "~/components/layout/navbar.vue";
import {useStorage} from "@vueuse/core";

const config: RuntimeConfig = useRuntimeConfig();
const email = ref(null)
const password = ref(null)
const passwordConfirmation = ref(null)
const name = ref(null)
const csrfCookie = useCookie('XSRF-TOKEN')
const loggedInUser = () => useState<IUser | null>('loggedInUser', () => null)
const registerUrl = `${config.CUSTOM_API_URL}/auth/register`
const requestBody = JSON.stringify({
  name: name.value,
  email: email.value,
  password: password.value,
  password_confirmation: passwordConfirmation.value
})
const testState = useState('testState', () => 'initial value is set')

function postRegisterForm() {
  registerUser<IUser>().then(user => {
    useState('loggedInUser').value = user
    useStorage('loggedInUser', user)
  })
}

const {data: csrfResponse, error: csrfError} = await useFetch(
  `https://dev.jurassicjs.eu/api/v1/csrf-cookie`,
  {
    server: false,
    method: 'GET',
    mode: 'cors',
    headers: {'Content-Type': 'application/json'},
    credentials: 'include'
  }
)

function updateTestState() {
  testState.value = 'updated value is now set'
}

async function registerUser<TResponse>(): Promise<TResponse> {
  return await fetch(registerUrl, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-XSRF-TOKEN': csrfCookie.value,
      'XDEBUG_SESSION': 'PHPSTORM'
    },
    body: requestBody
  })
    .then(data => data.json())
    .then((data) => data as TResponse);
}

</script>

<template>
  <div>
    <navbar/>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="py-12 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
          <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Jurassic Js</h2>
          <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">Learn Nuxt 3 By
            Example</p>
          <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto"><a href="https://github.com/jurassicjs">Thanks for
            checking out this Jurassic Js / PhpSquad Project</a></p>
        </div>


        <div class="mt-10">
          <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
            <div class="relative">
              <dt>
                <a href="https://www.youtube.com/channel/UCFDF_U_uoKc6MhIZPZKo5CA" target="_blank">
                  <div class="absolute flex items-center justify-center h-12 w-12 rounded-md  text-white">
                    <!-- Heroicon name: outline/globe-alt -->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         class="h-12 w-12 flex-no-shrink fill-current"
                         viewBox="0 0 492 110" xmlns:v="https://vecta.io/nano">
                      <path
                        d="M154.3 17.5a19.6 19.6 0 0 0-13.8-13.8C128.4.4 79.7.4 79.7.4S31 .5 18.9 3.8A19.6 19.6 0 0 0 5.1 17.6C1.44 39.1.02 71.86 5.2 92.5A19.6 19.6 0 0 0 19 106.3c12.1 3.3 60.8 3.3 60.8 3.3s48.7 0 60.8-3.3a19.6 19.6 0 0 0 13.8-13.8c3.86-21.53 5.05-54.27-.1-75z"
                        fill="red"/>
                      <path fill="#fff" d="M64.2 78.4L104.6 55 64.2 31.6z"/>
                      <g fill="#282828">
                        <path
                          d="M227.9 99.7c-3.1-2.1-5.3-5.3-6.6-9.7s-1.9-10.2-1.9-17.5v-9.9c0-7.3.7-13.3 2.2-17.7 1.5-4.5 3.8-7.7 7-9.7s7.3-3.1 12.4-3.1c5 0 9.1 1 12.1 3.1s5.3 5.3 6.7 9.7 2.1 10.3 2.1 17.6v9.9c0 7.3-.7 13.1-2.1 17.5s-3.6 7.6-6.7 9.7c-3.1 2-7.3 3.1-12.5 3.1-5.4.1-9.6-1-12.7-3zM245.2 89c.9-2.2 1.3-5.9 1.3-10.9V56.8c0-4.9-.4-8.5-1.3-10.7-.9-2.3-2.4-3.4-4.5-3.4s-3.5 1.1-4.4 3.4-1.3 5.8-1.3 10.7v21.3c0 5 .4 8.7 1.2 10.9s2.3 3.3 4.5 3.3c2.1 0 3.6-1.1 4.5-3.3zm219.2-16.3v3.5l.4 9.9c.3 2.2.8 3.8 1.6 4.8s2.1 1.5 3.8 1.5c2.3 0 3.9-.9 4.7-2.7.9-1.8 1.3-4.8 1.4-8.9l13.3.8c.1.6.1 1.4.1 2.4 0 6.3-1.7 11-5.2 14.1s-8.3 4.7-14.6 4.7c-7.6 0-12.9-2.4-15.9-7.1s-4.6-12.1-4.6-22V61.6c.34-17 3.33-29.45 20.9-29.5 5.3 0 9.3 1 12.1 2.9s4.8 4.9 6 9 1.7 9.7 1.7 16.9v11.7h-25.7zm2-28.8c-.8 1-1.3 2.5-1.6 4.7s-.4 10-.4 10v4.9h11.2v-4.9c0 4.9-.1-7.7-.4-10s-.8-3.9-1.6-4.8-2-1.4-3.6-1.4c-1.7.1-2.9.6-3.6 1.5zM190.5 71.4L173 8.2h15.3s7.15 31.7 9.6 46.6h.4c2.78-15.82 9.8-46.6 9.8-46.6h15.3l-17.7 63.1v30.3h-15.1V71.4z"/>
                        <path id="A"
                              d="M311.5 33.4v68.3h-12l-1.3-8.4h-.3c-3.3 6.3-8.2 9.5-14.7 9.5-11.77-.03-13.08-10-13.2-18.4v-51h15.4v50.1c0 3 .3 5.2 1 6.5 1.42 2.78 5.1 2.07 7.1.7a8 8 0 0 0 2.7-3.1V33.4z"
                              fill="#282828"/>
                        <path
                          d="M353.3 20.6H338v81.1h-15V20.6h-15.3V8.2h45.5v12.4zm87.9 23.7c-.9-4.3-2.4-7.4-4.5-9.4-2.1-1.9-4.9-2.9-8.6-2.9a14.1 14.1 0 0 0-7.9 2.4c-2.5 1.6-4.3 3.7-5.7 6.3h-.1v-36h-14.8v96.9h12.7l1.6-6.5h.3a14 14 0 0 0 5.3 5.5c2.4 1.3 5 2 7.9 2 5.2 0 9-2.4 11.5-7.2 2.4-4.8 3.7-12.3 3.7-22.4V62.2c0-7.6-.5-13.6-1.4-17.9zm-14.1 27.9c0 5-.2 8.9-.6 11.7s-1.1 4.8-2.1 6-2.3 1.8-3.9 1.8c-3.1-.1-4.86-1.5-6.1-3.6V49.3c.5-1.9 1.4-3.4 2.7-4.6 2.2-2.47 5.96-2.5 7.7 0 .9 1.2 1.4 3.3 1.8 6.2.3 2.9.5 7 .5 12.4z"/>
                      </g>
                      <use xlink:href="#A" x="78.9"/>
                    </svg>
                  </div>
                </a>
                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Full Stack Jack YouTube Channel</p>
              </dt>
              <dd class="mt-2 ml-16 text-base text-gray-500">
                There you will find videos about nuxt and other full stack web dev topics
              </dd>
            </div>


            <nuxt-link to="/up-next">
            <div class="relative">
              <dt>
                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </div>
                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">up next</p>
              </dt>
              <dd class="mt-2 ml-16 text-base text-gray-500">
                middleware
              </dd>
            </div>
            </nuxt-link>

            <nuxt-link to="/state-examples">
            <div class="relative">
              <dt>
                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                  </svg>
                </div>
                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">State</p>
              </dt>
              <dd class="mt-2 ml-16 text-base text-gray-500">
                See some examples of different state types
              </dd>
            </div>
            </nuxt-link>

            <nuxt-link to="/your-next-big-project-is-waiting">
            <div class="relative">
              <dt>
                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                       stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                  </svg>
                </div>
                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">video requests</p>
              </dt>
              <dd class="mt-2 ml-16 text-base text-gray-500">
                Let me know what topics you'd like me to make videos for.
              </dd>
            </div>
            </nuxt-link>
          </dl>
        </div>
      </div>
    </div>

  </div>
</template>
