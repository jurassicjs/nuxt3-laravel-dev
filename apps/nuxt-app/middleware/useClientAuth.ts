import {useStorage} from "@vueuse/core";
import {useRouter, useState} from "#app";
import {IUser} from "~/types/IUser";


export default function () {
  const stateUser = useState('loggedInUser')

  if (stateUser.value) {
    return true
  }

  const localStorageUser = useStorage('loggedInUser', null)

  if (localStorageUser.value == null) {
    // const router = useRouter()
    // router.push('/login')
    return false
  }

  const user: IUser = JSON.parse(localStorageUser.value)

  useState<IUser>('loggedInUser', () => user).value = user

  stateUser.value = user

  return true
}
