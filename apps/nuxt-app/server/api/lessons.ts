let counter = 0
export default () => {
  const rowSize = 2
  const categories = [
    {title: 'Getting Started in Nuxt 3', message: 'setup a new Nuxt 3 project!', image: '/public/nuxt3.svg'},
    {title: 'Fast DDD in Laravel', message: 'Fast Domain Driven Development in Laravel', image: '/public/laravel.svg'},
    {title: 'Routing in Nuxt 3', message: 'learn Nuxt 3 routing from beginner to advanced!', image: '/public/nuxt3.svg'},
    {title: 'Templates in Nuxt 3', message: 'learn Nuxt 3 templates!', image: '/public/nuxt3.svg'},
    {title: 'Reativity Fundementals in Nuxt 3', message: 'learn Nuxt 3 Reativity!', image: '/public/nuxt3.svg'},
    {title: 'Composeables in Nuxt 3', message: 'learn Nuxt 3 composeables!', image: '/public/nuxt3.svg'},
    {title: 'Computed Properties in Nuxt 3', message: 'learn Nuxt 3 computed properties!', image: '/public/nuxt3.svg'},
    {title: 'Class Style and Bindings in Nuxt 3', message: 'learn Nuxt 3 Class Style and Bindings!', image: '/public/nuxt3.svg'},
    {title: 'List Rendering in Nuxt 3', message: 'learn Nuxt 3 List Rendering!', image: '/public/nuxt3.svg'},
  ]


    let row = [];
    let i,l, chunkSize = rowSize;

    for (i=0,l=categories.length; i<l; i+=chunkSize) {
      row.push(categories.slice(i,i+chunkSize));
    }
    return row;


  return JSON.stringify(row)
}

