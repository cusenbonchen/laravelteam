@include('common/header')
@include('common/nav')
<div class="container">
  <form action="{{ route('auth.login') }}" method="post">
    @csrf 
    <div class="mb-3">
      <label class="form-label" data-language="username"></label>
      <input type="text" name="username" class="form-control" autocomplete="off" data-language="usernamePlaceholder" placeholder="" required>
    </div>
    <div class="mb-3">
      <label class="form-label" data-language="password"></label>
      <input type="password" name="password" class="form-control" autocomplete="off" data-language="passwordPlaceholder" placeholder="" required>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-3" data-language="login_button"></button>
    </div>
    <a href="{{ route('auth.forgot') }}" data-language="forgotPassword"></a>
    <a href="{{ route('auth.registerView') }}" data-language="register"></a>
    @if(isset($message))
        <p>{{ $message }}</p>
    @endif
  </form>
</div>
@include('common/footer')