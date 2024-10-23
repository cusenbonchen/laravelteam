@include('common/header')
@include('common/nav')
<div class="container">
<form action="{{ route('auth.register') }}" method="post">
@csrf
    <div class="mb-3">
      <label class="form-label" data-language="username"> </label>
      <input type="text" name="username" class="form-control" autocomplete="off" data-language="usernamePlaceholder" placeholder="" required>
    </div>
    <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" autocomplete="off" data-language="emailPlaceholder" placeholder="" required>
  </div> 
  <div class="mb-3">
      <label class="form-label" data-language="firstName"> </label>
      <input type="text" name="first_name" class="form-control" autocomplete="off" data-language="firstNamePlaceholder" placeholder="" required>
    </div>
    <div class="mb-3">
      <label class="form-label" data-language="lastName"> </label>
      <input type="text" name="last_name" class="form-control" autocomplete="off" data-language="lastNamePlaceholder" placeholder="" required>
    </div>
    <div class="mb-3">
      <label class="form-label" data-language="password"> </label>
      <input type="password" name="password" class="form-control" autocomplete="off" data-language="passwordPlaceholder" placeholder="" required>
    </div>
    <div class="mb-3">
      <label class="form-label" data-language="rePassword"></label>
      <input type="password" name="rePassword" class="form-control" autocomplete="off" data-language="passwordPlaceholder" placeholder="" required>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-3" data-language="register"> </button>
    </div>  
    @if(isset($message))
      <p>{{ $message }}</p>
  @endif
</form>
</div>
@include('common/footer')