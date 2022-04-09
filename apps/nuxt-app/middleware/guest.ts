import {useState} from "#app";
import {useStorage} from "@vueuse/core";

export default defineNuxtRouteMiddleware((to) => {

  const stateUser = useState('loggedInUser')

  if (stateUser.value !== undefined) {
    return '/login'
  }

  const localStorageUser = useStorage('loggedInUser', null)

  if (localStorageUser.value !== null) {
    return '/login'
  }

  return
})
