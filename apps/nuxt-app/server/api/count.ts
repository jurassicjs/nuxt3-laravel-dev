let counter = 0
export default () => {
  counter++
  console.log('hit')
  return JSON.stringify(counter)
}

