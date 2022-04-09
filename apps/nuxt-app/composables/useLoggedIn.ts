import {useStorage} from "@vueuse/core";
import {useRouter, useState} from "#app";
import {computed, unref} from "@vue/reactivity";
import {IUser} from "~/types/IUser";

export const useLoggedIn = () => {

  return {
    user: computed<IUser>(() => {

      const stateUser = useState('loggedInUser')

      if (stateUser.value) {
        return stateUser.value as IUser
      }

      const localStorageUser = useStorage('loggedInUser', null)

      const user: IUser = JSON.parse(localStorageUser.value)

      useState<IUser>('loggedInUser', () => user).value = user

      stateUser.value = user

      return user as IUser
    }),
    logout: function () {
      useState('loggedInUser').value = null;
      useStorage('loggedInUser', null).value = null
      const router = useRouter()
      router.push('/login')
    }
  }
}
