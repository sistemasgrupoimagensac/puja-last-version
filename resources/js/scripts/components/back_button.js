const goBack = document.querySelector('#goback')
// back previus page
goBack.addEventListener('click', goPreviusPage)

function goPreviusPage() {
    window.history.back()
}