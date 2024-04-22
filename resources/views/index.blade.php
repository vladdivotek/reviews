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
                            <span class="date">{{ $review->created_at->format('d.m.Y H:m') }}</span>
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
@endsection
