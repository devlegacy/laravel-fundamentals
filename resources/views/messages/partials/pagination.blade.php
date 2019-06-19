<div class="d-flex justify-content-center">
  {{$messages->fragment('hash')->appends(request()->query())->links()}}
  {{-- links('pagination.custom') --}}
</div>
