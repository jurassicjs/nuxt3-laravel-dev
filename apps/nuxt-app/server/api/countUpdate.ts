
export default (counter) => {
  counter++
  console.log('hit')
  return JSON.stringify(counter)
}
