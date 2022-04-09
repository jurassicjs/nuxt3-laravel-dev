import {RuntimeConfig} from "@nuxt/schema";
import {useCookie, useFetch, useRuntimeConfig} from "#app";

const config: RuntimeConfig = useRuntimeConfig();
let csrfCookie = useCookie('XSRF-TOKEN')

export const registerUser = <TResponse>(requestBody: BodyInit) => {
  return async function registerUser<TResponse>(requestBody: BodyInit): Promise<TResponse> {
    return await useFetch(`${config.CUSTOM_API_URL}/register_user`, {
      server:false,
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-XSRF-TOKEN': csrfCookie.value,
        'XDEBUG_SESSION': 'PHPSTORM'
      },
      body:  requestBody
    })
      .then(data => data)
      .then((data) => data as TResponse);
  }
}
