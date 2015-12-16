@extends('templates.master')

@section('title', 'Home')

@section('content')

<link rel="stylesheet" href="{{ asset('public/css/font-lato.css') }}">

<div class="container">
	<div class="content">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="col-lg-12 col-md-12">					
					<br>
					<div class="row">
						<table style="width:100%">
							<tr>
								<td style="width:50%;padding-right:10px;">
									<img style="width:100%" src="{{asset('public/img/home/image1.png')}}">
								</td>
								<td style="width:50%;padding-left:10px;">
									<h3 style="color:#428BCA;margin-top:0px;">Giới thiệu</h3>
									TronDe.vn là phần mềm quản lý ngân hàng câu hỏi và trộn đề online theo yêu cầu. TronDe.vn giúp cho các thầy/cô có thể tổ chức ngân hàng câu hỏi của mình một cách thuận tiện với các tính năng chính như sau
									<ul>	
										<li>	Ngân hàng câu hỏi được tổ chức theo cấu trúc cây thư mục, dễ quản lý</li>
										<li>	Không giới hạn số lượng câu hỏi</li>
										<li>	Chia sẻ câu hỏi với nhóm đồng nghiệp hoặc chia sẻ công khai</li>
										<li>	Upload/download câu hỏi dạng file word </li>
										<li>	Trộn đề từ nhiều file/thư mục khác nhau với số lượng đề, câu không giới hạn.</li>
										<li>	Tùy biến mẫu đề in hoặc xuất ra file MS Word.</li>
									</ul>
								</td>
							</tr>																					
						</table>
					</div>
					<div class="row">
						<table style="width:100%">
							<tr>
								<td style="width:70%;padding-right:10px;">
									<h3 style="color:#428BCA">Chính sách riêng tư</h3>
									<ul style="padding-left:20px">
										<li>Ngân hàng câu hỏi của các cá nhân được đảm bảo không chia sẻ cho bất kỳ một cá nhân hay tổ chức nào khác.</li>
										<li>Các cá nhân có thể chia sẻ các câu hỏi của mình theo nhóm hoặc công khai.</li>
									</ul>
								</td>
								<td style="width:30%;padding-left:10px;">
									<img style="width:100%" src="{{asset('public/img/home/lock.jpg')}}">
								</td>
							</tr>
						</table>
					</div>
					<div class="row">
						<table style="width:100%">
							<tr>
								<td style="width:40%;padding-right:10px;">
									<img style="width:100%" src="{{asset('public/img/home/free.jpg')}}">
								</td>
								<td style="width:60%;padding-left:10px;">
									<h3 style="color:#428BCA">Cam kết của TD</h3>
									<ul style="padding-left:20px">
										<li>Miễn phí: www.tronde.vn sẽ luôn miễn phí.<br>
										<li>An toàn: Ngân hàng câu hỏi được bảo mật và không chia sẻ với bất kỳ cá nhân hay tổ chức nào nếu không được sự đồng ý của thầy/cô.
									</ul>
								</td>
							</tr>
						</table>
					</div>
					<div class="row">
						<table style="width:100%">
							<tr>
								<td style="width:70%;padding-right:10px;">
									<h3 style="color:#428BCA">Đối tượng sử dụng</h3>
									<ul style="padding-left:20px">
										<li>Tất cả các thầy, cô có nhu cầu quản lý và tạo đề thi trắc nghiệm cho tất cả các môn học và các cấp học.</li>
									</ul>
								</td>
								<td style="width:30%;padding-left:10px;">
									<img style="width:100%" src="{{asset('public/img/home/teacher.png')}}">
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection