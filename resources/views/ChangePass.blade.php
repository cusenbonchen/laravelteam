@include('common/header')
@include('common/nav')
<div class="container">
<form action="{{ route('auth.changePass') }}" method="post">
  @csrf
  <div class="mb-3">
    <label class="form-label" data-language="codeMail"></label>
    @if(isset($message))  
      <input type="hidden" name="email" class="form-control" value="{{ $message['email'] }}" autocomplete="off">
    @endif
    <input type="text" name="token_email" class="form-control" required autocomplete="off"> 
  </div> 
  <div class="mb-3">
      <label class="form-label" data-language="password"></label>
      <input type="password" name="password" class="form-control" autocomplete="off" data-language="successToken" required placeholder="">
    </div>
    <div class="mb-3">
      <label class="form-label" data-language="rePassword"></label>
      <input type="password" name="rePassword" class="form-control" autocomplete="off" data-language="successToken" required placeholder="">
    </div>
  <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-3" data-language="sendButton"></button>
    </div>
    @if(isset($message))
      <p>{{ $message['text'] }}</p>  
  @endif
</form>
</div>
@include('common/footer')