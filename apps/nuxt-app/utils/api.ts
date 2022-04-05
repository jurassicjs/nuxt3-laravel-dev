import {useAsyncData} from "nuxt3/app";
import {RuntimeConfig} from "@nuxt/schema";

const config: RuntimeConfig = useRuntimeConfig();

class api {
  static async get(route: string): Promise<any> {
    await useAsyncData('count', () => $fetch(`${config.API_BASE_URL}/${route}`), {server: false})
  }
}


export default api
