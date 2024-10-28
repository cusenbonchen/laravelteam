@include('common/header')
@include('common/nav')
<div class="container">
<form action="{{ route('auth.changePass') }}" method="post">
  @csrf
  <div class="mb-3">
    <input type="hidden" name="id" class="form-control" autocomplete="off">
   
    <input type="hidden" name="token_email" class="form-control" required autocomplete="off">  
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
   
</form>
</div>
<script>
  function getUrlParameter(name) {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(name);
  }

  document.addEventListener("DOMContentLoaded", () => {
      const token = getUrlParameter('token');
      const id = getUrlParameter('id');
      if (token) {
          document.querySelector('input[name="token_email"]').value = token;
      }
      if (id) {
          document.querySelector('input[name="id"]').value = id;
      }
  });
</script>
@include('common/footer')