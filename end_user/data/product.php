<?php
// Danh mục
// id
//tên danh mục

$list_product_cat= array(
    1=>array(
        'id'=>1,
        'cat_title'=>'Laptop'
    ),
    2=>array(
        'id'=>2,
        'cat_title'=>'Macbook'
    ),
    3=>array(
        'id'=>3,
        'cat_title'=>'Mobile'
    )
);

//Dữ liệu sản phẩm
$list_product=array(
    1=>array(
        'id'=>1,
        'product_name'=>'iPhone 14 Pro Max 128GB',
        'code'=>'', //mã sản phẩm,
        'price'=>2000000,
        'product_information'=>'iPhone 14 Pro Max sở hữu thiết kế màn hình Dynamic Island ấn tượng cùng màn hình OLED 6,7 inch hỗ trợ always-on display và hiệu năng vượt trội với chip A16 Bionic. Bên cạnh đó máy còn sở hữu nhiều nâng cấp về camera với cụm camera sau 48MP, camera trước 12MP dùng bộ nhớ RAM 6G đa nhiệm vượt trội.  ',
        'product_thumb'=>'https://cdn2.cellphones.com.vn/x/media/catalog/product/t/_/t_m_18.png', //ảnh đại diện
        'product_desc'=>'iPhone 14 Pro Max', //nội dung sản phẩm
        'id_cat'=>3, //id cate
    ),
    2=>array(
        'id'=>2,
        'product_name'=>'iPhone 13 128GB ',
        'code'=>'', //mã sản phẩm,
        'price'=>25000000,
        'product_information'=>'Về kích thước, iPhone 13 sẽ có 4 phiên bản khác nhau và kích thước không đổi so với series iPhone 12 hiện tại. Nếu iPhone 12 có sự thay đổi trong thiết kế từ góc cạnh bo tròn (Thiết kế được duy trì từ thời iPhone 6 đến iPhone 11 Pro Max) sang thiết kế vuông vắn (đã từng có mặt trên iPhone 4 đến iPhone 5S, SE).  ',
        'product_thumb'=>'https://cdn2.cellphones.com.vn/x/media/catalog/product/1/3/13_4_7_2_7.jpg', //ảnh đại diện
        'product_desc'=>'iPhone 13', //nội dung sản phẩm
        'id_cat'=>3, //id cate
    ),
    3=>array(
        'id'=>3,
        'product_name'=>'iPhone 14 Pro Max 128GB',
        'code'=>'', //mã sản phẩm,
        'price'=>10000000,
        'product_information'=>'iPhone 14 Pro Max sở hữu thiết kế màn hình Dynamic Island ấn tượng cùng màn hình OLED 6,7 inch hỗ trợ always-on display và hiệu năng vượt trội với chip A16 Bionic. Bên cạnh đó máy còn sở hữu nhiều nâng cấp về camera với cụm camera sau 48MP, camera trước 12MP dùng bộ nhớ RAM 6G đa nhiệm vượt trội.  ',
        'product_thumb'=>'https://cdn2.cellphones.com.vn/x/media/catalog/product/t/_/t_m_18.png', //ảnh đại diện
        'product_desc'=>'iPhone 14 Pro Max', //nội dung sản phẩm
        'id_cat'=>3, //id cate
    ),
    4=>array(
        'id'=>4,
        'product_name'=>'Apple MacBook Air M1 256GB 2020',
        'code'=>'', //mã sản phẩm,
        'price'=>18000000,
        'product_information'=>'Macbook Air M1 là dòng sản phẩm có thiết kế mỏng nhẹ, sang trọng và tinh tế cùng với đó là giá thành phải chăng nên MacBook Air đã thu hút được đông đảo người dùng yêu thích và lựa chọn. Đây cũng là một trong những phiên bản Macbook Air mới nhất mà khách hàng không thể bỏ qua khi đến với CellphoneS. Dưới đây là chi tiết về thiết kế, cấu hình của máy.  ',
        'product_thumb'=>'https://cdn2.cellphones.com.vn/x/media/catalog/product/t/_/t_m_18.png', //ảnh đại diện
        'product_desc'=>'iPhone 14 Pro Max', //nội dung sản phẩm
        'id_cat'=>2, //id cate
    ),
    5=>array(
        'id'=>5,
        'product_name'=>'Macbook Pro 14 M1 Pro 10 CPU - 16 GPU 16GB 1TB 2021',
        'code'=>'', //mã sản phẩm,
        'price'=>43990000,
        'product_information'=>'Macbook Pro 14 inch 2021 được trang bị cấu hình khủng với chip Apple M1 Pro (10CPU/16GPU) kết hợp với bộ nhớ RAM 16GB và SSD 1TB mang lại trải nghiệm tuyệt vời với hiệu suất cực đỉnh.

        Sản phẩm hàng chính hãng Apple Việt Nam, bảo hành 12 tháng, đổi mới 30 ngày nếu lỗi, hỗ trợ trả góp 0% và thu cũ đổi mới.',
        'product_thumb'=>'https://cdn2.cellphones.com.vn/x/media/catalog/product/m/a/macbook-pro-2021-06_8.jpg', //ảnh đại diện
        'product_desc'=>'iPhone 14 Pro Max', //nội dung sản phẩm
        'id_cat'=>2,
    ), //id cate
    6=>array(
        'id'=>6,
        'product_name'=>'Laptop gaming MSI GF63 Thin 11SC 664VN',
        'code'=>'', //mã sản phẩm,
        'price'=>14500000,
        'product_information'=>'Nhìn chung, chiếc laptop mang một vẻ ngoài khá thon gọn, tổng bề dày chỉ 21,7 mm và có khối lượng khoảng 1,86kg. Tuy nhiên vì là dòng máy gaming nên ở phần giữa của nắp máy được in chìm logo rồng đỏ quen thuộc nhằm tạo điểm nhấn. Đặc biệt hơn, phần thông gió ở phía dưới được in ẩn hình chữ X khá độc đáo.',
        'product_thumb'=>'https://cdn2.cellphones.com.vn/x/media/catalog/product/t/e/text_ng_n_21_.png', //ảnh đại diện
        'product_desc'=>'iPhone 14 Pro Max', //nội dung sản phẩm
        'id_cat'=>1, //id cate
    ),
    7=>array(
        'id'=>7,
        'product_name'=>'iPhone 14 Pro Max 128GB',
        'code'=>'', //mã sản phẩm,
        'price'=>2000000,
        'product_information'=>'iPhone 14 Pro Max sở hữu thiết kế màn hình Dynamic Island ấn tượng cùng màn hình OLED 6,7 inch hỗ trợ always-on display và hiệu năng vượt trội với chip A16 Bionic. Bên cạnh đó máy còn sở hữu nhiều nâng cấp về camera với cụm camera sau 48MP, camera trước 12MP dùng bộ nhớ RAM 6G đa nhiệm vượt trội.  ',
        'product_thumb'=>'https://cdn2.cellphones.com.vn/x/media/catalog/product/t/_/t_m_18.png', //ảnh đại diện
        'product_desc'=>'iPhone 14 Pro Max', //nội dung sản phẩm
        'id_cat'=>3, //id cate
    ),
    8=>array(
        'id'=>8,
        'product_name'=>'iPhone 13 128GB ',
        'code'=>'', //mã sản phẩm,
        'price'=>25000000,
        'product_information'=>'Về kích thước, iPhone 13 sẽ có 4 phiên bản khác nhau và kích thước không đổi so với series iPhone 12 hiện tại. Nếu iPhone 12 có sự thay đổi trong thiết kế từ góc cạnh bo tròn (Thiết kế được duy trì từ thời iPhone 6 đến iPhone 11 Pro Max) sang thiết kế vuông vắn (đã từng có mặt trên iPhone 4 đến iPhone 5S, SE).  ',
        'product_thumb'=>'https://cdn2.cellphones.com.vn/x/media/catalog/product/1/3/13_4_7_2_7.jpg', //ảnh đại diện
        'product_desc'=>'iPhone 13', //nội dung sản phẩm
        'id_cat'=>3, //id cate
    ),
    9=>array(
        'id'=>9,
        'product_name'=>'iPhone 14 Pro Max 128GB',
        'code'=>'', //mã sản phẩm,
        'price'=>10000000,
        'product_information'=>'iPhone 14 Pro Max sở hữu thiết kế màn hình Dynamic Island ấn tượng cùng màn hình OLED 6,7 inch hỗ trợ always-on display và hiệu năng vượt trội với chip A16 Bionic. Bên cạnh đó máy còn sở hữu nhiều nâng cấp về camera với cụm camera sau 48MP, camera trước 12MP dùng bộ nhớ RAM 6G đa nhiệm vượt trội.  ',
        'product_thumb'=>'https://cdn2.cellphones.com.vn/x/media/catalog/product/t/_/t_m_18.png', //ảnh đại diện
        'product_desc'=>'iPhone 14 Pro Max', //nội dung sản phẩm
        'id_cat'=>3, //id cate
    
    ),
    10=>array(
        'id'=>10,
        'product_name'=>'iPhone 14 Pro Max 128GB',
        'code'=>'', //mã sản phẩm,
        'price'=>10000000,
        'product_information'=>'iPhone 14 Pro Max sở hữu thiết kế màn hình Dynamic Island ấn tượng cùng màn hình OLED 6,7 inch hỗ trợ always-on display và hiệu năng vượt trội với chip A16 Bionic. Bên cạnh đó máy còn sở hữu nhiều nâng cấp về camera với cụm camera sau 48MP, camera trước 12MP dùng bộ nhớ RAM 6G đa nhiệm vượt trội.  ',
        'product_thumb'=>'https://cdn2.cellphones.com.vn/x/media/catalog/product/t/_/t_m_18.png', //ảnh đại diện
        'product_desc'=>'iPhone 14 Pro Max', //nội dung sản phẩm
        'id_cat'=>3, //id cate
    
    )
)
?>