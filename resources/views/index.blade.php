@extends('layouts.app')

@section('title')
    {{ 'Reviews' }}
@endsection

@section('description')
    {{ 'Reviews' }}
@endsection

@section('keywords')
    {{ 'Reviews' }}
@endsection

@section('styles')
    @vite('resources/scss/modules/reviews.scss')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4 mb-4">
            <h2>Leave a review</h2>
            @include('include.alerts')
            <div class="form">
                <form method="post" action="{{ route('review.store') }}">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone" required>
                    </div>
                    <div class="mb-3">
                        <textarea name="message" id="message" class="form-control" rows="5" placeholder="Message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-general">Leave a review</button>
                </form>
            </div>
        </div>
        <div class="col-lg-8 mb-4">
            <h2>Reviews</h2>
            <div class="reviews">
            @if($reviews->count() > 0)
                @foreach($reviews as $review)
                    <div class="review-card">
                        <div class="review-card-header">
                            <a href="{{ 'mailto:' . $review->email }}" title="{{ 'Comment: ' . $review->name }}">{{ $review->name }}</a>
                            <span class="date">{{ $review->created_at }}</span>
                        </div>
                        <div class="review-card-body">
                            <p>{{ $review->message }}</p>
                        </div>
                        <div class="review-card-footer">
                            <div class="images">
                                <a href="" title="{{ 'Photo to comment: ' . $review->name . ' ' . $loop->iteration }}">
                                    <img src="" alt="{{ 'Photo to comment: ' . $review->name . ' ' . $loop->iteration }}">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/modules/reviews.js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector('.form').querySelector('form');

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                if (validateForm()) {
                    const formData = new FormData(form);
                    axios.post(form.getAttribute('action'), Object.fromEntries(formData))
                        .then(response => {
                            const review = response.data;
                            insertReview(review);
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

            function insertReview(review) {
                console.log(review);
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
                dateSpan.textContent = review.created_at;

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

                const imageLink = document.createElement('a');
                imageLink.href = '';
                imageLink.title = 'Photo to comment: ' + review.name;
                const image = document.createElement('img');
                image.src = ''; // Add image source here
                image.alt = 'Photo to comment: ' + review.name;

                imageLink.appendChild(image);
                imagesDiv.appendChild(imageLink);
                reviewCardFooter.appendChild(imagesDiv);

                reviewCard.appendChild(reviewCardHeader);
                reviewCard.appendChild(reviewCardBody);
                reviewCard.appendChild(reviewCardFooter);

                const reviewsContainer = document.querySelector('.reviews');
                reviewsContainer.insertBefore(reviewCard, reviewsContainer.firstChild);
            }
        });
    </script>
@endsection
