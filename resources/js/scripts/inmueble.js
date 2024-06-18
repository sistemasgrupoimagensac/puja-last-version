const fullText = document.querySelector('#fullText')
const shortText = document.querySelector('#shortText')

const verMasBtn = document.querySelector('#verMasBtn')
const verMenosBtn = document.querySelector('#verMenosBtn')

verMasBtn?.addEventListener('click', () => {
  fullText.style.display = 'block'
  shortText.style.display = 'none'
  verMasBtn.style.display = 'none'
  verMenosBtn.style.display = 'block'
})

verMenosBtn?.addEventListener('click', () => {
  fullText.style.display = 'none'
  shortText.style.display = 'block'
  verMenosBtn.style.display = 'none'
  verMasBtn.style.display = 'block'
})