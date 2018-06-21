var url_global = 'http://localhost/www/alleybarker.com';
$('.loader').hide();
/*---------------------------------------------------*/
$(document).ready(function($) {
    $('.add-to-cart').click(function() {
        var product_id = $(this).val();
        var url = "/cart/addcart";
        var data = {
            id: product_id
        }
        var success = function(result) {
            var cartNumber = $('#cart-number').text();
            cartNumber = parseInt(cartNumber) + 1;
            $('#cart-number').html(cartNumber);
            swal({
                title: "Cám ơn!",
                text: "Bạn vừa thêm một sản phẩm vào giỏ hàng!",
                icon: "success",
                button: "Ok",
            });
            $('#show_sl').html(result);
        }
        var dataType = "text";
        $.get(url, data, success, dataType);
    });
});
/*------------------------------------------------*/
$(document).ready(function($) {
    $('.remove').click(function() {
        var rowId_product = $(this).val();
        var tr_id = $(this).attr('name');
        var token = $('#update_cart_token').val();
        var url = "/cart/remove-item";
        var data = {
            id: rowId_product,
            _token: token
        }
        var success = function(result) {
            if (result == 0) {
                $('#show_cart_table').hide();
                $('#show_cart_empty').show();
                $('.check_out_sum').html('');
            } else {
                $('#remove_tr' + tr_id).remove();
                $('.check_out_sum').html(result);
            }
        }
        var dataType = "text";

        swal({
                title: "Ban muốn bỏ sản phẩm này ?",
                text: "Sản phẩm này sẽ bị loại bỏ khỏi giỏ hàng của bạn!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Loại bỏ sản phẩm thành công!", {
                        icon: "success",
                    });
                    $.post(url, data, success, dataType);
                } else {
                    swal("Bạn đã giữ lại sản phẩm thành công!");
                }
            });

    });
});
/*-------------------------------------------------*/
$(document).ready(function($) {
    $('#submit_payment').click(function() {
        var token = $('#token').val();
        var ten_kh = $('#txt_ten_kh').val();
        var dia_chi_kh = $('#txt_dia_chi_kh').val();
        var so_dt_kh = $('#txt_sdt_kh').val();
        var email_kh = $('#txt_email_kh').val();
        var hinh_thuc_thanh_toan = $('#form-thanh-toan select[name=txt_hinh_thuc_tt]').val()
        var gioi_tinh_kh = $('#form-thanh-toan input[name=txt_gioi_tinh_kh]:checked').val();
        var ghi_chu_don_hang = $('#txt_ghi_chu').val();
        var tong_dh = $('#bill_total').text();

        var url = '/cart/payment';
        var data = {
            _token: token,
            txt_ten_kh: ten_kh,
            txt_dia_chi_kh: dia_chi_kh,
            txt_sdt_kh: so_dt_kh,
            txt_email_kh: email_kh,
            txt_hinh_thuc_tt: hinh_thuc_thanh_toan,
            txt_gioi_tinh_kh: gioi_tinh_kh,
            txt_ghi_chu: ghi_chu_don_hang
        }
        var success = function(result) {
            console.log(result);
            /*-------------------------*/
            $('#tenKhHd').html(ten_kh);
            $('#diaChiKhHd').html(dia_chi_kh);
            $('#soDtKhHd').html(so_dt_kh);
            $('#emailKhHd').html(email_kh);
            $('#cachThanhToanHd').html(hinh_thuc_thanh_toan);
            $('#diaChiKhHd').html(dia_chi_kh);
            $('#tongThanhToanHD').html(tong_dh);
            $('#item_payment_table').append(result);
            /*-------------------------*/
            $('#datHangThanhCong').modal('show');
            $('#closeDatHangThanhCong').click(function() {
                window.location.replace('http://localhost:8000/');
            });
        }
        var dataType = 'text';
        $.post(url, data, success, dataType);
    });
});
//-----------------------------------------------------
$(document).ready(function($) {
    $('.product-qty').change(function() {
        $('.loader').show();
        var token = $('#update_cart_token').val();
        var qty_item = $(this).val();
        var id_item = $(this).closest('div').attr('id');
        var button_name = $(this).attr('id');
        var url = '/cart/update';
        var data = {
            _token: token,
            id: id_item,
            qty: qty_item
        }
        var success = function(result) {
            $('#item' + button_name).html(result.item_price_update);
            $('#bill_total').html(result.cart_total_update);
            $('.loader').hide();
        }
        var dataType = "json";
        $.post(url, data, success, dataType);
    });
});
//----------------------------------------------------
$(document).ready(function($) {
    $('#btn-user-payment').click(function() {
        var tong_dh = $('#bill_total').text();
        var ghi_chu_don_hang = $('#user_ghi_chu').val();
        var hinh_thuc_thanh_toan = $('#user_payment select[name=user_hinh_thuc_tt]').val();
        var token = $('#user_payment_token').val();
        var url = '/cart/user-payment';
        var data = {
            _token: token,
            ghi_chu: ghi_chu_don_hang,
            hinh_thuc: hinh_thuc_thanh_toan
        }
        var success = function(result) {
            $('#cachThanhToanHd').html(hinh_thuc_thanh_toan);
            $('#tongThanhToanHD').html(tong_dh);
            $('#item_payment_table').append(result);
            $('#datHangThanhCong').modal('show');
            $('#closeDatHangThanhCong').click(function() {
                window.location.replace('http://localhost:8000/');
            });
        }
        var dataType = 'text';
        $.post(url, data, success, dataType);
    });
});
//----------------------------------------------------
$(document).ready(function($) {
    $('#search_item').keyup(function() {
        var search = $(this).val();
        var token = $('#search_token').val();
        var url = '/search';
        var data = {
            _token: token,
            key_word: search
        }
        var inn = '';
        var success = function(result) {
            for (i in result) {
                inn += '<li class="li_search well well-sm" >';
                inn += '<a href="/sanpham/' + result[i].id;
                inn += '" target="_blank">';
                inn += '<span> ';
                inn += result[i].name;
                inn += '</span>';
                inn += '</a>';
                inn += '</li>';
                $("#markToAdd").html(inn);
            }
        }
        var dataType = 'json';
        $.post(url, data, success, dataType);
    });
});
//----------------------------
$(document).ready(function($) {
    $('#profile-image1').on('click', function() {
        $('#profile-image-upload').click();
    });
});
//---------------------------
$(document).ready(function($) {
    $('#profile-image-upload').change(function() {
        $('#submit_change_avata').click();
    });
});
/*--------------*/
