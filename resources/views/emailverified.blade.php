@include('common/header')
@include('common/nav')
<div class="container">
<form action="{{ route('auth.emailverified') }}" method="post">
  @csrf
  <div class="mb-3">
    Xác nhận thành công!!! Bấm <b>Hoàn tất</b> để tiếp tục
    <input type="hidden" name="id" class="form-control" autocomplete="off">
   
    <input type="hidden" name="token_email" class="form-control" required autocomplete="off">  
  </div>  
  <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-3">Hoàn tất</button>
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