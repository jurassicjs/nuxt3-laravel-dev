let counter = 0
export default () => {
  const rowSize = 2
  const categories = [
    {title: 'Nuxt 3', message: 'Nuxt 3 for beginners course', image: '/public/nuxt3.svg', tags: [{title: 'Front End', link: '/frontend-courses'}]},
    {title: 'Laravel', message: 'Laravel For beginners course', image: '/public/laravel.svg', tags: [{title: 'Bank End', link: '/backend-courses'}]},
    {title: 'PHP', message: 'Ultimate PHP Course', image: '/public/php-logo.svg', tags: [{title: 'Bank End', link: '/backend-courses'}]},
    {title: 'Nginx', message: 'Nginx Course for Beginners', image: '/public/nginx.svg', tags: [{title: 'Servers', link: '/server-courses'}]},
    {title: 'Docker', message: 'Docker Course for Beginners', image: '/public/docker.svg', tags: [{title: 'containerization', link: '/containerization-courses'}]},
    {title: 'Linux', message: 'Linux Course for Beginners', image: '/public/linux.svg', tags: [{title: 'OS', link: '/os-courses'}]},

  ]


    let row = [];
    let i,l, chunkSize = rowSize;

    for (i=0,l=categories.length; i<l; i+=chunkSize) {
      row.push(categories.slice(i,i+chunkSize));
    }
    return row;


  return JSON.stringify(row)
}

