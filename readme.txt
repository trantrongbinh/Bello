- Tạo project: composer create-project laravel/laravel Bello "5.4.*" (Vào C:\xampp\htdocs để tạo)
- Fix error ajax "the server responded with a status of 500 (internal server error)": Do  gửi  ajax sử dụng phần mềm trung gian CSRF (VerifyCsrfToken),  cần cung cấp tiêu đề bổ sung với request
	+ Thêm thẻ meta vào mỗi trang (hoặc bố cục chính): <meta name="csrf-token" content="{{ csrf_token() }}">
	+ Và thêm vào tệp javascript ajax: 
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});