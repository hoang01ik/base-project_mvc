-- Tạo cơ sở dữ liệu
-- CREATE DATABASE IF NOT EXISTS db_mvc;
-- USE db_mvc;

-- Bảng Tài khoản
CREATE TABLE IF NOT EXISTS TaiKhoan (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL,
    trangthai ENUM('Kích hoạt', 'Bị khóa') DEFAULT 'Kích hoạt',
    token VARCHAR(255) NULL UNIQUE,
    PRIMARY KEY (id)
);

-- Bảng Khách hàng
CREATE TABLE IF NOT EXISTS KhachHang (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_tai_khoan INT NOT NULL,
    HoTen VARCHAR(255) NOT NULL,
    NgaySinh DATE,
    GioiTinh ENUM('Nam', 'Nữ', 'Khác'),
    DiaChi VARCHAR(255),
    SoDienThoai VARCHAR(255),
    Email VARCHAR(255),
    FOREIGN KEY (id_tai_khoan) REFERENCES TaiKhoan(id)
);

-- Bảng Loại sản phẩm
CREATE TABLE IF NOT EXISTS LoaiSanPham (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    TenLoai VARCHAR(255) NOT NULL
);

-- Bảng Nhà cung cấp
CREATE TABLE IF NOT EXISTS NhaCungCap (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    TenNhaCungCap VARCHAR(255) NOT NULL,
    DiaChi VARCHAR(255),
    SoDienThoai VARCHAR(255),
    Email VARCHAR(255)
);

-- Bảng Trạng thái sản phẩm
CREATE TABLE IF NOT EXISTS TrangThaiSanPham (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    TenTrangThai VARCHAR(255) NOT NULL
);





-- Bảng Đơn hàng
CREATE TABLE IF NOT EXISTS DonHang (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_khach_hang INT,
    NgayDatHang DATETIME NOT NULL,
    TongTien DECIMAL(10, 2),
    TrangThai ENUM('Cho xử lý', 'Đang xử lý', 'Hoàn thành', 'Đã hủy') DEFAULT 'Cho xử lý',
    FOREIGN KEY (id_khach_hang) REFERENCES KhachHang(id)
);


-- Bảng Kho hàng
CREATE TABLE IF NOT EXISTS KhoHang (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    tenkho VARCHAR(255),
    vi_tri_kho VARCHAR(255)
);


-- Bảng Sản phẩm
CREATE TABLE IF NOT EXISTS SanPham (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    TenSanPham VARCHAR(255) NOT NULL,
    id_loai INT,
    HangSanXuat VARCHAR(255),
    MoHinh VARCHAR(255),
    Gia DECIMAL(10, 2),
    SoLuongTon INT,
    MoTa VARCHAR(255),
    HinhAnh VARCHAR(255),
    id_nha_cung_cap INT,
    id_trang_thai INT(11) DEFAULT 0,
    id_kho INT,
    FOREIGN KEY (id_loai) REFERENCES LoaiSanPham(id),
    FOREIGN KEY (id_nha_cung_cap) REFERENCES NhaCungCap(id),
    FOREIGN KEY (id_trang_thai) REFERENCES TrangThaiSanPham(id),
    FOREIGN KEY (id_kho) REFERENCES KhoHang(id)
);

-- Bảng Chi tiết đơn hàng
CREATE TABLE IF NOT EXISTS DonHangChiTiet (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_don_hang INT,
    id_san_pham INT,
    SoLuong INT,
    DonGia DECIMAL(10, 2),
    FOREIGN KEY (id_don_hang) REFERENCES DonHang(id),
    FOREIGN KEY (id_san_pham) REFERENCES SanPham(id)
);

-- Thêm dữ liệu vào bảng TrangThaiSanPham
INSERT INTO TrangThaiSanPham (TenTrangThai) VALUES
('Kinh doanh'),
('Ngừng kinh doanh'),
('Hết hàng');

-- Thêm bản ghi vào bảng Tài khoản
INSERT INTO TaiKhoan (username, password, role, trangthai, token) VALUES
('admin1', 'password1', 'admin', 'Kích hoạt', 'token1'),
('admin2', 'password2', 'admin', 'Kích hoạt', 'token2'),
('user1', 'password3', 'user', 'Kích hoạt', 'token3'),
('user2', 'password4', 'user', 'Kích hoạt', 'token4'),
('user3', 'password5', 'user', 'Bị khóa', 'token5');

-- Thêm bản ghi vào bảng Khách hàng
INSERT INTO KhachHang (id_tai_khoan, HoTen, NgaySinh, GioiTinh, DiaChi, SoDienThoai, Email) VALUES
(3, 'Nguyen Van A', '1990-01-01', 'Nam', 'Ha Noi', '0123456789', 'vana@gmail.com'),
(4, 'Tran Thi B', '1992-02-02', 'Nữ', 'Ho Chi Minh', '0987654321', 'thib@gmail.com'),
(5, 'Le Van C', '1985-03-03', 'Nam', 'Da Nang', '0321654987', 'vanc@gmail.com');

-- Thêm bản ghi vào bảng Loại sản phẩm
INSERT INTO LoaiSanPham (TenLoai) VALUES
('Điện thoại'),
('Máy tính bảng'),
('Phụ kiện điện tử');

-- Thêm bản ghi vào bảng Nhà cung cấp
INSERT INTO NhaCungCap (TenNhaCungCap, DiaChi, SoDienThoai, Email) VALUES
('NCC A', 'Ha Noi', '0123456789', 'ncca@gmail.com'),
('NCC B', 'Ho Chi Minh', '0987654321', 'nccb@gmail.com');

-- Thêm bản ghi vào bảng Kho hàng
INSERT INTO KhoHang (tenkho, vi_tri_kho) VALUES
('Kho A', 'Ha Noi'),
('Kho B', 'Ho Chi Minh');

-- Thêm bản ghi vào bảng Sản phẩm
INSERT INTO SanPham (TenSanPham, id_loai, HangSanXuat, MoHinh, Gia, SoLuongTon, MoTa, HinhAnh, id_nha_cung_cap, id_trang_thai, id_kho) VALUES
('iPhone 13', 1, 'Apple', 'iPhone 13 Pro', 999.99, 10, 'Smartphone cao cấp', 'iphone13.jpg', 1, 1, 1),
('Samsung Galaxy S21', 1, 'Samsung', 'Galaxy S21', 799.99, 15, 'Smartphone tầm trung', 'galaxys21.jpg', 1, 1, 1),
('iPad Air', 2, 'Apple', 'iPad Air 4', 599.99, 8, 'Máy tính bảng', 'ipadair.jpg', 1, 1, 1),
('Ốp lưng iPhone', 3, 'Phụ kiện', 'Ốp lưng iPhone 13', 19.99, 100, 'Ốp lưng bảo vệ điện thoại', 'oplung.jpg', 2, 1, 2);

-- Thêm bản ghi vào bảng Đơn hàng
INSERT INTO DonHang (id_khach_hang, NgayDatHang, TongTien, TrangThai) VALUES
(1, '2024-10-16 10:00:00', 1199.99, 'Cho xử lý'),
(2, '2024-10-16 11:00:00', 599.99, 'Đang xử lý'),
(3, '2024-10-16 12:00:00', 19.99, 'Hoàn thành');

-- Thêm bản ghi vào bảng Chi tiết đơn hàng
INSERT INTO DonHangChiTiet (id_don_hang, id_san_pham, SoLuong, DonGia) VALUES
(1, 1, 1, 999.99),
(1, 4, 10, 19.99),
(2, 3, 1, 599.99);
