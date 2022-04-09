import {useState} from "#app";
import {useStorage} from "@vueuse/core";

export default defineNuxtRouteMiddleware( async (to, from) => {

  const stateUser = await useState('loggedInUser')

  // stateUser.value = {name: 'rick', email: 'test@cool.com'}
  debugger

  if (stateUser.value == null) {
    debugger
    console.log('aaaaaaaaaaaaaaaaaaaa')
    alert('test 1')
    return '/login'
  }

  const localStorageUser = await useStorage('loggedInUser', null)

  if (localStorageUser.value === undefined) {
    setTimeout(() => {

    }, 10)
    return
  }

  // if (localStorageUser.value === null) {
  //   debugger
  //   console.log('aaaaaaaaaaaaaaaaaaaa')
  //   // alert('test 1')
  //   return '/login'
  // }

  debugger
  return
})
