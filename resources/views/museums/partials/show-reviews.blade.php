<div class="b-museum-reviews">
  <h1 class="b-museum-reviews__title">Reviews</h1>
  @forelse ($museum->reviews as $review)
    <div class="b-review__user">
      <strong>Created by:</strong>
      <span class="b-review__user">{{$review->user->name}}</span>
      <div class="b-review__text alert alert-info">
          {{$review->text}}
      </div>
    </div>
  @empty
    <div class="alert alert-warning">
      Sin reviews
    </div>
  @endforelse
</div>

