import {useStorage} from "@vueuse/core";
import {useRouter, useState} from "#app";
import {computed} from "@vue/reactivity";

export const useLoggedIn = () => {

  return {
    user: computed(() => {

      debugger
      const stateUser = useState('loggedInUser')

      if (stateUser.value !== undefined) {
        return stateUser
      }

      const localStorageUser =  useStorage('loggedInUser', null)

      if (localStorageUser.value) {
        return localStorageUser
      }

      const router = useRouter()

      router.push('/')
    })
  }
}
