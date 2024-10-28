 
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lấy lại mật khẩu SENDZ</title>
</head>
<body style="width: 650px;">
<h1>Lấy lại mật khẩu</h1> 
<p><em>Xin thông báo <b>{{$mailData['lastname']}}</b> đã thực hiện lấy lại mật khẩu thành công!!!.</em></p><br/><br/>
<p>Để đảm bảo an toàn trong khi sử dụng, đề nghị <b>{{$mailData['lastname']}}</b> đọc kỹ các hướng dẫn, các điều khoản, điều kiện liên quan đến việc sử dụng dịch vụ được đăng tải trên website sendz.top </p>
<p>Đây là email tự động. <b>{{$mailData['lastname']}}</b> vui lòng không gửi thư vào địa chỉ này. Mọi vướng mắc liên quan đến dịch vụ, <b>{{$mailData['lastname']}}</b> liên hệ với Trung tâm dịch vụ khách hàng của SEN theo số điện thoại 0838008448 hoặc mail cusenbonchen@gmail.com.</p><br/><br/>


Nhấp vào link để lấy lại mật khẩu <a style="font-size: 15px" href="https://sendz.top/changepass?id={{$mailData['id']}}&token={{ $mailData['body'] }}">https://sendz.top/changepass?id={{$mailData['id']}}&token={{ $mailData['body'] }}</a>

<p>Cám ơn <b>{{$mailData['lastname']}}</b> đã sử dụng dịch vụ của chúng tôi!</p><br/>
</body> 
</html>