@extends('templates.master')

@section('title', 'Home')

@section('content')

<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

<style>
	.list li{
		margin-top:10px;
	}
</style>
	<div class="container">
		<div class="content">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="col-lg-12 col-md-12">
						<br>
						<div class="row" style="text-align: justify;">
							<span style="font-size:25px;">Mẫu file upload câu hỏi <a href="/downloadmanual">tải về</a></span>
							<hr/>
							<ol class="list" style="list-style-type: upper-roman;font-size:17px;padding:10px 20px 20px 20px">
								<li>
									<b style="color:#428BCA">ĐĂNG NHẬP - ĐĂNG XUẤT</b>
									<ul>
										<li>Để đăng nhập vào hệ thống bạn ấn vào “Đăng nhập” ở góc trên bên phải.</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/home.png')}}" alt="..."></li>
										<li>Hệ thống sẽ đưa bạn đến trang login, ở đây bạn có thể đăng nhập ngay vào hệ thống nếu đã có tài khoản, còn nếu không các bạn ấn vào nút “Đăng ký”</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/login.png')}}" alt="..."></li>
										<li>Ở đây các bạn nhập đầy đủ thông tin cần thiết theo form bên dưới (những mục đánh dấu * là bắt buộc phải điền).</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/register.png')}}" alt="..."></li>
										<li>Sau khi nhập đầy đủ thông tin bạn ấn đăng ký, nếu đăng ký thành công hệ thống sẽ đưa bạn trở về trang đăng nhập còn nếu đăng ký thất bại hệ thống sẽ thông báo lỗi.</li>
									</ul>
								</li>
								<li style="margin-top:20px;">
									<b style="color:#428BCA">TẠO THƯ MỤC</b>
									<ul>
										<li>Bước 1: ấn vào nút “Tạo thư mục”.</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/click_folder.png')}}" alt="..."></li>
										<li>Bước 2: Nhập tên thư mục và ấn submit.</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/create_folder.png')}}" alt="..."></li>
										<li>Sau khi ấn “submit” thư mục của bạn vừa tạo sẽ hiện bên dưới</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/folder_ss.png')}}" alt="..."></li>
									</ul>
								</li>
								<li style="margin-top:20px;">
									<b style="color:#428BCA">TẠO FILE</b>
									<ul>
										<li>Bước 1: ấn vào nút “Tạo File”.</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/click_file.png')}}" alt="..."></li>
										<li>Bước 2: Điền tên file và ấn “submit”.</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/create_file.png')}}" alt="..."></li>
										<li>Sau khi ấn “submit” file của bạn vừa tạo sẽ hiện bên dưới</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/file_ss.png')}}" alt="..."></li>
									</ul>
								</li>
								<li style="margin-top:20px;">
									<b style="color:#428BCA">UPLOAD CÂU HỎI</b>
									<ul>
										<li>Bước 1: Chọn vào file muốn upload.</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/upload1.png')}}" alt="..."></li>
										<li>Bước 2: Chọn upload, sau đó tìm file word các bạn muốn upload lên.</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/upload2.png')}}" alt="..."></li>
										<li>Sau khi upload thành công kết quả sẽ hiện như hình bên dưới:</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/file_2.png')}}" alt="..."></li>										
									</ul>
								</li>
								<li style="margin-top:20px;">
									<b style="color:#428BCA">TRỘN ĐỀ</b>
									<ul>
										<li>Trộn đề trên cùng 1 file các bạn chỉ cần vào file muốn trộn và ấn “Trộn đề”</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/mix3.png')}}" alt="..."></li>
										<li>Sau khi ấn “Trộn đề” bạn điền đầy đủ thông tin cần bổ sung của đề muốn tạo vào form thông tin như hình bên dưới rồi ấn “Đã xong”.</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/mix4.png')}}" alt="..."></li>
										<li>Trộn đề trên nhiều file các bạn thực hiện như sau:</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/mix.png')}}" alt="..."></li>
										<li>Điền đầy đủ thông tin giống trộn đề trong 1 file</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/1.png')}}" alt="..."></li>
										<li>Sau khi điền đầy đủ thông tin ấn vào mũi tên để chuyển sang mục tiếp theo</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/2.png')}}" alt="..."></li>
										<li>Ở đây bạn sẽ phải điền số câu hỏi bạn muốn lấy từ mỗi file sau đó ấn "Tạo đề"  hệ thống sẽ trộn đề trong file các bạn đã chọn và tạo ra đề theo thông tin các bạn đã bổ sung và trả về kết quả như hình bên dưới</li>									
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/test1.png')}}" alt="..."></li>										
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/test2.png')}}" alt="..."></li>
										<li>Nếu bạn muốn download các bạn ấn vào nút “DOWNLOAD” để lưu lại file word.</li>
									</ul>
								</li>
								<li style="margin-top:20px;">
									<b style="color:#428BCA">TẠO NHÓM</b>
									<ul>
										<li>Bước 1: ấn vào nút “Tạo nhóm.</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/click_group.png')}}" alt="..."></li>
										<li>Bước 2: Điền tên file và ấn “submit”.</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/create_group.png')}}" alt="..."></li>
										<li>Sau khi ấn “submit” file của bạn vừa tạo sẽ hiện bên dưới</li>
										<li style="list-style-type:none;"><img style="width:100%" src="{{asset('public/img/huongdansudung/group_ss.png')}}" alt="..."></li>
									</ul>
								</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
@endsection