@include('common/header')
@include('common/nav')
<div class="container">
<form action="{{ route('auth.forgotPass') }}" method="post">
  @csrf
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" autocomplete="off" require data-language="emailPlaceholder" placeholder="" required>
  </div> 
  <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-3" data-language="sendButton"></button>
    </div>
    @if(isset($message))
      <p>{{ $message }}</p>
  @endif
</form>
</div>
@include('common/footer')