let counter = 0
export default () => {
  const rowSize = 2
  const categories = [
    {title: 'Getting Started in Nuxt 3', message: 'setup a new Nuxt 3 project!'},
    {title: 'Routing in Nuxt 3', message: 'learn Nuxt 3 routing from beginner to advanced!'},
    {title: 'Templates in Nuxt 3', message: 'learn Nuxt 3 templates!'},
    {title: 'Reativity Fundementals in Nuxt 3', message: 'learn Nuxt 3 Reativity!'},
    {title: 'Composeables in Nuxt 3', message: 'learn Nuxt 3 composeables!'},
    {title: 'Computed Properties in Nuxt 3', message: 'learn Nuxt 3 computed properties!'},
    {title: 'Class Style and Bindings in Nuxt 3', message: 'learn Nuxt 3 Class Style and Bindings!'},
    {title: 'List Rendering in Nuxt 3', message: 'learn Nuxt 3 List Rendering!'},
  ]


    let row = [];
    let i,l, chunkSize = rowSize;

    for (i=0,l=categories.length; i<l; i+=chunkSize) {
      row.push(categories.slice(i,i+chunkSize));
    }
    return row;


  return JSON.stringify(row)
}

