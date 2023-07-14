# Web_Fashion_E-Commerce

# Trang web kinh doanh thời trang

### Đối tượng sử dụng
- Quản trị viên (Super Admin, Admin)
- Khách hàng

### Chức năng từng đối tượng
A. Quản trị viên
- Quản lý người dùng
- Quản lý nhà sản xuất
- Quản lý sản phẩm, ...
- Quản lý đơn hàng

B. Khách hàng
- Đăng ký, đăng nhập, đăng xuất
- Xem chi tiết sản phẩm
- Đặt hàng
- Quảng lý giỏ hàng



### Phân tích chức năng

- Đăng bài tuyển dụng

| Các tác nhân | Nhà tuyển dụng |
| ------ | ------ |
| Mô tả | Đăng bài tuyển dụng |
| Kích hoạt | Người dùng ấn vào nút “Đăng bài tuyển dụng” trên thanh menu |
| Đầu vào | Tên công ty<br>Tên công việc<br>Địa điểm: thành phố - quận (select2 - load về local)<br>Remote | Local? (checkbox)<br>Có cho part time không? (radio)<br>Mức lương (slidebar)<br>Ngôn ngữ (multiple select2)<br>Yêu cầu thêm (textarea)<br>Thời gian<br>Số lượng<br>File JD |
| Trình tự xử lý | |
| Đầu ra | Đúng: Hiển thị trang người dùng và thông báo thành công<br>Sai: Hiển thị trang đăng nhập và thông báo thất bại |
| Lưu ý | Kiểm tra ô nhập không được để trống bằng JavaScript |


