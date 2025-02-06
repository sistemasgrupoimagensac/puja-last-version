document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-like-btn').forEach(button => {
        button.addEventListener('click', async function (e) {
            e.preventDefault();

            let avisoId = this.dataset.avisoId;
            let totalLikes = document.querySelectorAll(`.total-likes-${avisoId}`);
            let icons = document.querySelectorAll(`.heart-icon-${avisoId}`);

            try {
                let response = await fetch(`/avisos/${avisoId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });

                if (response.status === 401) {
                    let data = await response.json();
                    window.location.href = "/login";
                    return;
                }

                if (response.ok) {
                    let data = await response.json();
                    
                    if (data.liked) {
                        icons.forEach((icon) => {
                            icon.classList.remove('fa-regular');
                            icon.classList.add('fa-solid');
                        })
                    } else {
                        icons.forEach((icon) => {
                            icon.classList.remove('fa-solid');
                            icon.classList.add('fa-regular');
                        })
                    }
                    totalLikes.forEach( cant_likes => {
                        cant_likes.textContent = data.total_likes
                    } )
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    });
});
