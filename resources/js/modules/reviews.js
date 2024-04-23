// import { Fancybox } from "@fancyapps/ui/dist/fancybox/fancybox.esm.js";
// import "@fancyapps/ui/dist/fancybox/fancybox.css";
//
// Fancybox.bind('[data-fancybox="gallery"]', {
//     // Your custom options
// });

document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('.form').querySelector('form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        if (validateForm()) {
            const formData = new FormData(form);
            axios.post(form.getAttribute('action'), formData)
                .then(response => {
                    const review = response.data.review;
                    if (response.data.pagination) insertReview(review);
                    form.reset();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });

    function validateForm() {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const message = document.getElementById('message').value;

        const nameRegex = /^[a-zA-Z\s]{1,100}$/;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const phoneRegex = /^[\d()+\- ]+$/;
        const messageMaxLength = 1000;

        if (!nameRegex.test(name)) {
            alert('Please enter a valid name (up to 100 letters and spaces only).');
            return false;
        }
        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            return false;
        }
        if (!phoneRegex.test(phone)) {
            alert('Please enter a valid phone number.');
            return false;
        }
        if (message.length > messageMaxLength) {
            alert('Message should not exceed 1000 characters.');
            return false;
        }
        return true;
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        return `${day}.${month}.${year} ${hours}:${minutes}`;
    }

    function insertReview(review) {
        const reviewCard = document.createElement('div');
        reviewCard.classList.add('review-card');

        const reviewCardHeader = document.createElement('div');
        reviewCardHeader.classList.add('review-card-header');

        const reviewerLink = document.createElement('a');
        reviewerLink.href = 'mailto:' + review.email;
        reviewerLink.title = 'Comment: ' + review.name;
        reviewerLink.textContent = review.name;

        const dateSpan = document.createElement('span');
        dateSpan.classList.add('date');
        dateSpan.textContent = formatDate(review.created_at);

        reviewCardHeader.appendChild(reviewerLink);
        reviewCardHeader.appendChild(dateSpan);

        const reviewCardBody = document.createElement('div');
        reviewCardBody.classList.add('review-card-body');

        const messageParagraph = document.createElement('p');
        messageParagraph.textContent = review.message;

        reviewCardBody.appendChild(messageParagraph);

        const reviewCardFooter = document.createElement('div');
        reviewCardFooter.classList.add('review-card-footer');

        const imagesDiv = document.createElement('div');
        imagesDiv.classList.add('images');

        if (review.images && review.images.length > 0) {
            review.images.forEach((element) => {
                const imageLink = document.createElement('a');
                imageLink.href = '';
                imageLink.title = 'Photo to comment: ' + review.name;
                const image = document.createElement('img');
                image.src = element;
                image.alt = 'Photo to comment: ' + review.name;

                imageLink.appendChild(image);
                imagesDiv.appendChild(imageLink);
            });
        }

        reviewCardFooter.appendChild(imagesDiv);

        reviewCard.appendChild(reviewCardHeader);
        reviewCard.appendChild(reviewCardBody);
        reviewCard.appendChild(reviewCardFooter);

        const reviewsContainer = document.querySelector('.reviews');
        reviewsContainer.insertBefore(reviewCard, reviewsContainer.firstChild);
    }
});
