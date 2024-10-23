 
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lấy lại mật khẩu Vietcombank</title>
</head>
<body style="width: 650px;">
<h1>Lấy lại mật khẩu Agribank</h1> 
<p><em>Sacombank Việt Nam xin thông báo <b>{{$mailData['lastname']}}</b> đã thực hiện lấy lại mật khẩu thành công!!!.</em></p><br/><br/>
<p>Để đảm bảo an toàn trong khi sử dụng, đề nghị <b>{{$mailData['lastname']}}</b> đọc kỹ các hướng dẫn, các điều khoản, điều kiện liên quan đến việc sử dụng dịch vụ được đăng tải trên website XXXX.com.vn </p>
<p>Đây là email tự động. <b>{{$mailData['lastname']}}</b> vui lòng không gửi thư vào địa chỉ này. Mọi vướng mắc liên quan đến dịch vụ, <b>{{$mailData['lastname']}}</b> liên hệ với Trung tâm dịch vụ khách hàng của SEN BANK theo số điện thoại XXXX hoặc mail cusenbonchen@gmail.com.</p><br/><br/>


<p style="font-size: 20px">Mã xác minh của bạn là: <b style="font-size: 26px">{{ $mailData['body'] }}</b> </p>

<p>Cám ơn <b>{{$mailData['lastname']}}</b> đã sử dụng dịch vụ của Agribank!</p><br/>
</body> 
</html>