<div class="b-museum-information">
  <h1 class="b-museum__name b-museum__name--detail">
      {{ $museum->name }}
  </h1>

  <div class="b-museum__description">
      {{ $museum->description }}
  </div>

  <div class="b-museum__hours">
      <strong>Hours: </strong> {{ $museum->hours }}
  </div>

  <div class="b-museum__phone">
      <strong>Phone: </strong> {{ $museum->phone }}
  </div>
  <div class="b-museum__ranking">
      <strong>Ranking: </strong> {{ $museum->ranking }}
  </div>
</div>
