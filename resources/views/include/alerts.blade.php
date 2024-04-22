@if($errors->any())
  <div class="alert alert-danger mb-4">
    @foreach($errors->all() as $error)
    <div>{{ $error }}</div>
    @endforeach
  </div>
@endif

@if(session('success'))
  <div class="alert alert-success mb-4">
      {{ session('success') }}
  </div>
@endif
