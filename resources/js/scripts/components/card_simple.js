
const heartButtons = document.querySelectorAll('.heart-button')

heartButtons.forEach(function(button) {
    button.addEventListener('click', function () {
        const heartIcon = button.querySelector('.fa-heart')
        const isLiked = button.dataset.like === 'true'

        if (isLiked) {
            heartIcon.classList.remove('fa-solid')
            heartIcon.classList.add('fa-regular')
        } else {
            heartIcon.classList.remove('fa-regular')
            heartIcon.classList.add('fa-solid')
        }

        button.dataset.like = isLiked ? 'false' : 'true'
    })
})

