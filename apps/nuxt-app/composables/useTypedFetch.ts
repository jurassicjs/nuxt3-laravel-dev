import {useCookie} from "#app";

let csrfCookie = useCookie('XSRF-TOKEN')
// export default function <TResponse>(url: string, config: RequestInit = {
//   method: 'POST',
//   headers: {
//     'Content-Type': 'application/json',
//     'X-XSRF-TOKEN': csrfCookie.value,
//     'XDEBUG_SESSION': 'PHPSTORM'
//   }}, body: BodyInit) {
// //
//   return function useTypedFetch(): Promise<TResponse> {
//
//     // Inside, we call the `fetch` function with
//     // a URL and config given:
//     return fetch(url, config)
//       // When got a response call a `json` method on it
//       .then((response) => response.json())
//       // and return the result data.
//       .then((data) => data as TResponse);
//
//     // We also can use some post-response
//     // data-transformations in the last `then` clause.
//   }
// }


export default function<TResponse>(body: BodyInit): Promise<TResponse> {

  // Inside, we call the `fetch` function with
  // a URL and config given:
  const url = 'string'

  const config: RequestInit = {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-XSRF-TOKEN': csrfCookie.value,
      'XDEBUG_SESSION': 'PHPSTORM',
    },
    body
  }


  return fetch(url, config)
    // When got a response call a `json` method on it
    .then((response) => response.json())
    // and return the result data.
    .then((data) => data as TResponse);

  // We also can use some post-response
  // data-transformations in the last `then` clause.
}
