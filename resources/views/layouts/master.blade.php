<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Brand City') }}</title>

    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->

    <!-- Favicons Icon -->
    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <!-- CSS Style -->
    <link rel="stylesheet" type="text/css" href="/resources/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/resources/css/font-awesome.min.css" media="all">
    <link rel="stylesheet" type="text/css" href="/resources/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="/resources/css/owl.theme.css">
    <link rel="stylesheet" type="text/css" href="/resources/css/jquery.bxslider.css">
    <link rel="stylesheet" type="text/css" href="/resources/css/jquery.mobile-menu.css">
    <link rel="stylesheet" type="text/css" href="/resources/css/style.css" media="all">
    <link rel="stylesheet" type="text/css" href="/resources/css/revslider.css">
    <link rel="stylesheet" type="text/css" href="/resources/css/fancybox.css">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,600,800,400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700' rel='stylesheet' type='text/css'>
</head>

<body class="cms-index-index cms-home-page">

    <div id="loader" style="position: fixed; display: none; width: 100%; height: 100%; z-index: 10000; background: black; opacity: 0.85;">
        <img src="/resources/images/loader.gif" style="top: 50%; left: 50%; position: absolute;">
    </div>
    <div id="page">
        @include('includes.header')
        @include('includes.nav')
        @yield('content')
        @include('includes.footer')
    </div>
   
    @include('includes.mobile-menu')
    @include('includes.fancybox-quickview')

    <!-- JavaScript -->
    <script src="/resources/js/jquery.min.js"></script>
    <script src="/resources/js/bootstrap.min.js"></script>
    <script src="/resources/js/common.js"></script>
    <script src="/resources/js/owl.carousel.min.js"></script>
    <script src="/resources/js/jquery.mobile-menu.min.js"></script>
    <script src="/resources/js/revslider.js"></script>
    <script src="/resources/js/countdown.js"></script>

    <script src="/resources/js/jquery.flexslider.js"></script>
    <script src="/resources/js/cloud-zoom.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

    <script>
        jQuery(document).ready(function () {

            // var test = "<p>Paragraph here</p>";
            // html = $.parseHTML(test);
            // document.write(html);

            var $log = $( "#log" );
            str = "<p>Paragraph here</p>";
            html = $.parseHTML( str );
            nodeNames = [];

            $log.html( html );

            // $.each( test, function( i, el ) {
            //   console.log(el.nodeName);
            // });

            jQuery('#rev_slider_4').show().revolution({
                dottedOverlay: 'none',
                delay: 5000,
                startwidth: 915,
                startheight: 497,
                hideThumbs: 200,
                thumbWidth: 200,
                thumbHeight: 50,
                thumbAmount: 2,
                navigationType: 'thumb',
                navigationArrows: 'solo',
                navigationStyle: 'round',
                touchenabled: 'on',
                onHoverStop: 'on',
                swipe_velocity: 0.7,
                swipe_min_touches: 1,
                swipe_max_touches: 1,
                drag_block_vertical: false,
                spinner: 'spinner0',
                keyboardNavigation: 'off',
                navigationHAlign: 'center',
                navigationVAlign: 'bottom',
                navigationHOffset: 0,
                navigationVOffset: 20,
                soloArrowLeftHalign: 'left',
                soloArrowLeftValign: 'center',
                soloArrowLeftHOffset: 20,
                soloArrowLeftVOffset: 0,
                soloArrowRightHalign: 'right',
                soloArrowRightValign: 'center',
                soloArrowRightHOffset: 20,
                soloArrowRightVOffset: 0,
                shadow: 0,
                fullWidth: 'on',
                fullScreen: 'off',
                stopLoop: 'off',
                stopAfterLoops: -1,
                stopAtSlide: -1,
                shuffle: 'off',
                autoHeight: 'off',
                forceFullWidth: 'on',
                fullScreenAlignForce: 'off',
                minFullScreenHeight: 0,
                hideNavDelayOnMobile: 1500,
                hideThumbsOnMobile: 'off',
                hideBulletsOnMobile: 'off',
                hideArrowsOnMobile: 'off',
                hideThumbsUnderResolution: 0,
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                startWithSlide: 0,
                fullScreenOffsetContainer: ''
            });

           

            //Add to cart
            $(document).on('click', '.btn-cart', function () {
                
                var product_id = this.id;
                var user_id = $('.user_id').val();
                var quantity = $('.qty').val();
                var thisRef = $(this);
                $('#addToCartBtn').attr('disabled', 'disabled');
                $('#addToCartText').text('PROCESSING');
                if (product_id && quantity != 0) {
                    showLoader();
                    $.ajax({
                        type: "POST",
                        url: '/response_add_to_cart',
                        data: {
                            _token: '{!! csrf_token() !!}',
                            product_id: product_id,
                            user_id: user_id,
                            quantity: quantity
                        },
                        success: function (response) {
                            hideLoader();
                            var result = JSON.parse(response);
                            if (result == "success") {
                                $('#productAdded').fadeIn();
                                location.reload();
                            } else if (result == "update success") {
                                $('#productAdded').fadeIn();
                                location.reload();
                            } else if (result == "sorry message") {
                                alert("Sorry this item is no longer available!");
                            } else if (result == "failed") {
                                alert("Failed");
                            } else if (result == "limit exceed"){
                                $('#limitExceed').fadeIn();
                            }
                            $('#addToCartBtn').removeAttr('disabled');
                            $('#addToCartText').text('ADD TO CART');
                        }
                    });
                }else{
                    alert("Invalid information");
                }
            });

            //Add to cart fancy-box
            $(document).on('click', '.fancybox_cart_button', function(){
                var product_id = this.id;
                var user_id = $('.user_id').val();
                var quantity = $('.qty-fancy').val();
                var thisRef = $(this);
                $('.fancybox_cart_button').attr('disabled', 'disabled');
                $('.fancybox_cart_button').text('PROCESSING');
                if (product_id && quantity != 0) {
                    showLoader();
                    $.ajax({
                        type: "POST",
                        url: '/response_add_to_cart',
                        data: {
                            _token: '{!! csrf_token() !!}',
                            product_id: product_id,
                            user_id: user_id,
                            quantity: quantity
                        },
                        success: function (response) {
                            hideLoader();
                            var result = JSON.parse(response);
                            if (result == "success") {
                                $('#productAdded').fadeIn();
                                location.reload();
                            } else if (result == "update success") {
                                $('#productAdded').fadeIn();
                                location.reload();
                            } else if (result == "sorry message") {
                                alert("Sorry this item is no longer available!");
                            } else if (result == "failed") {
                                alert("Failed");
                            } else if (result == "limit exceed"){
                                $('#limitExceed').fadeIn();
                            }
                            $('.fancybox_cart_button').removeAttr('disabled');
                            $('.fancybox_cart_button').text('ADD TO CART');
                        }
                    });
                }else{
                    alert("Invalid information");
                }
            });

            //Add to wishlist
            $('.wishlist').click(function () {
                var product_id = this.id;
                var user_id = $('.user_id').val();
                $(this).attr('disabled', 'disabled');
                if (product_id == "") {

                } else {
                    showLoader();
                    $.ajax({
                        type: "POST",
                        url: '/response_add_to_wishlist',
                        data: {
                            _token: '{!! csrf_token() !!}',
                            product_id: product_id,
                            user_id: user_id
                        },
                        success: function (response) {
                            hideLoader();
                            //console.log(response);
                            var result = JSON.parse(response);
                            if (result == "success") {
                                location.reload();
                            } else if (result == "already exist") {
                                alert("Item already exist!");
                            } else if (result == "sorry message") {
                                alert("Sorry this item is no longer available!");
                            } else if (result == "failed") {
                                alert("Failed");
                            }
                        }
                    });
                }
            });

            // Show Fancy box
            $(document).on('click', '.quickViewModal', function () {
               
                var id = this.id;
                $(this).attr('disabled', 'disabled');
                showLoader();
                $.ajax({
                        type: "POST",
                        url: '/response_get_quickView_data',
                        data: {
                            _token: '{!! csrf_token() !!}',
                            id: id
                        },
                        success: function (response) {
                            hideLoader();
                            var result = JSON.parse(response);
                           // console.log(response);
                           $(this).removeAttr('disabled');
                            if(result != "" || result != null){
                                 $('#fancybox-overlay').show();
                                 $('#fancybox-wrap').show();
                                var data = result;
                                //console.log(data);
                                jQuery(data).each(function(i, item){
                                    var core = item.core;
                                    var variant = item.variant;
                                    $(core).each(function(i, core_items){
                                        $('.fancy_box_product_name').text(core_items.product_name);
                                        $('.fancy_box_description').html($.parseHTML(core_items.product_description));
                                        $(".rate_counts").text(core_items.rate_counts + " Review(s)");
                                        var rate = (core_items.average_rating / 5) * 100;
                                        $(".fancy_box_rating").width(rate);
                                        $('.fancy_box_image').attr('src', $('#hostUrl').val() + core_items.product_thumbnail);
                                        $(".product_discount_hidden").val(core_items.product_discount);
                                        var size_arr = new Array();
                                        var id_arr = new Array();
                                        var price_arr = new Array();
                                        $(variant).each(function(i, item){
                                            if(variant.length > 1){
                                                //console.log(variant[0].id);
                                                if(item.product_quantity > 0){
                                                    $('#inStockFancy').show();
                                                    $('#outOfStockFancy').hide();
                                                    $('.add-to-box').show();
                                                }else{
                                                    $('#inStockFancy').hide();
                                                    $('#outOfStockFancy').show();
                                                    $('.add-to-box').hide();
                                                }
                                                $(".fancybox_cart_button").attr("id", variant[0].id);
                                                $(".wishlist").attr("id", variant[0].id);
                                                $(".compare_product").attr("id", variant[0].id);

                                                if(core_items.product_discount == null){
                                                    $(".price_special").text("PKR: " + variant[0].product_sale_price);
                                                    $(".price_reqular").text("");
                                                }else{
                                                    //$(".product_discount_hidden").text(core_items.product_discount);
                                                    var discount = variant[0].product_sale_price - ((core_items.product_discount / 100) * variant[0].product_sale_price);
                                                    $(".price_special").text("PKR: " + discount);
                                                    $(".price_reqular").text("PKR: " + variant[0].product_sale_price);
                                                }

                                                size_arr.push({"size" : item.product_size,
                                                                "id" : item.id,
                                                                "price" : item.product_sale_price});


                                            }else{
                                                if(item.product_quantity > 0){
                                                    $('#inStockFancy').show();
                                                    $('#outOfStockFancy').hide();
                                                    $('.add-to-box').show();
                                                }else{
                                                    $('#inStockFancy').hide();
                                                    $('#outOfStockFancy').show();
                                                    $('.add-to-box').hide();
                                                }
                                                $(".fancybox_cart_button").attr("id", item.id);
                                                $(".wishlist").attr("id", item.id);
                                                $(".compare_product").attr("id", item.id);
                                                if(core_items.product_discount == null){
                                                    $(".price_special").text("PKR: " + item.product_sale_price);
                                                    $(".price_reqular").text("");
                                                }else{
                                                    //$(".product_discount_hidden").text(core_items.product_discount);
                                                    var discount = item.product_sale_price - ((core_items.product_discount / 100) * item.product_sale_price);
                                                    $(".price_special").text("PKR: " + discount);
                                                    $(".price_reqular").text("PKR: " + item.product_sale_price);
                                                }
                                                size_arr.push({"size" : item.product_size,
                                                                "id" : item.id,
                                                                "price" : item.product_sale_price});

                                            }
                                        });

                                        console.log(size_arr);
                                       
                                        $(size_arr).each(function(i, data){
                                            if(data["size"]){
                                                $('.select_size').find('option').remove().end().append('<option id = "' + data.id + '" class = "' + data.price + '">' + data.size + '</option>');
                                            }else{
                                                $('.select_size').hide();
                                            }
                                        });
                                        
                                    });

                                });
                            }
                           
                        }
                    });
            });

            //Hide Fancy Box
            $(document).on('click', '#fancybox-close', function () {
                $('#fancybox-overlay').hide();
                $('#fancybox-wrap').hide();
            });

            var sum = 0;
            $('.product_subtotal').each(function() {
                sum += Number($(this).text());
            });
            

            //Set text on grand price Span
            if(getCookie("C-D")){
                var coupon = getCookie('C-D');
                showLoader();
                $.ajax({
					type: "POST",
					url: '/resonse_add_coupon',
					data: {
                        _token: '{!! csrf_token() !!}',
                        coupon: coupon
					},
					success: function (response) {
                        hideLoader();
                        var result = JSON.parse(response);
                        if (result == "failed") {
                            alert('Coupon expire');
                        } else {
                            var array = result;
                            $(result).each(function(i, item){
                                if(item['status'] == "success"){
                                    var total_after_coupon = sum - item['value'];
                                    $(".grand_total").text("Grand Total - PKR: " + total_after_coupon);
                                }
                            });
                        }
					}
				});
                
            }else{
                $(".grand_total").text("PKR: " + sum);
            }
             

            //Update Cart
            $(document).on('click', '.update_cart', function () {
                $(this).attr('disabled', 'disabled');
                $(this).text('PROCESSING');
               var data = [];
               $('.quantity').each(function(){
                   data.push({ id: $(this).attr('id'), quantity : $(this).val()  });
                });
                //alert(val);
                showLoader();
                $.ajax({
					type: "POST",
					url: '/response_update_cart',
					data: {
                         _token: '{!! csrf_token() !!}',
						data: JSON.stringify(data)
					},
					success: function (response) {
                        hideLoader();
                        //console.log(response);
						var result = JSON.parse(response);
						if (result == "success") {
							location.reload();
						} else {
							alert("Something wrong while updating");
						}
					}
				});

            });

            //Clear Cart
            $(document).on('click', '.clear_cart', function () {
                var button = $(this);
                $.confirm({
					title: 'Alert!',
					content: 'Once you click DELETE button, all items from your cart will be deleted. Are you sure you want proceed?',
					type: 'red',
					typeAnimated: true,
					buttons: {
						Delete: {
							text: 'DELETE',
							btnClass: 'btn-red',
							action: function () {
                                button.attr('disabled', 'disabled');
                                button.text('PROCESSING');
                                showLoader();
								$.ajax({
									type: "POST",
									url: '/response_clear_cart',
									data: {
                                        _token: '{!! csrf_token() !!}'
									},
									success: function (response) {
                                        hideLoader();
										//console.log(response);
										var result = JSON.parse(response);
										if (result == "successs") {
											location.reload();
										} else {
											alert("There is no item to delete");
										}
									}
								});
							}
						},
						close: function () {}
					}
				});
            });

            //Remove one item from cart
             $(document).on('click', '.remove_item', function () {
               var id = this.id;
               var thisRef = $(this);
               $.confirm({
					title: 'Are you sure?',
					content: 'Once you click DELETE button this item will be deleted from your cart. Are you sure you want to proceed?',
					type: 'red',
					typeAnimated: true,
					buttons: {
						Delete: {
							text: 'DELETE',
							btnClass: 'btn-red',
							action: function () {
                                thisRef.attr('disabled', 'disabled');
                                showLoader();
								$.ajax({
									type: "POST",
									url: '/response_delete_one_item',
									data: {
                                        _token: '{!! csrf_token() !!}',
										id: id
									},
									success: function (response) {
                                        hideLoader();
										var result = JSON.parse(response);
										if (result == "successs") {
                                            location.reload();
                                            //thisRef.parent().parent().remove();
                                            //$('grandT').text(final_price);
										} else {
											alert("Something wrong while deleting");
										}
									}
								});
							}
						},
						close: function () {}
					}
				});
            });
 
            //Search Items
            $('.search_dropdown').keyup(function(){
                var query_val = $(this).val();
                var category = $('#cat').val();
                if(query_val != ""){ 
                    $.ajax({
                        type: "POST",
                        url: '/response_search_dropdown',
                        data: {
                            _token: '{!! csrf_token() !!}',
                            query_val: query_val,
                            category: category
                        },
                        success: function (response) {
                            var result = JSON.parse(response); 
                            //console.log(response); 
                                $('.search_dropdown_list').fadeIn();
                                $('.search_dropdown_list').html(result);
                           
                        }
                    });
                }
               
            });

            //DropDown (Search)
            $(document).on('click', '.dropdown_listitems', function(){
                $('.search_dropdown').val($(this).text());
                $('.search_dropdown_list').fadeOut();
            });

            //Delete one item from wishlist
            $(document).on('click', '.delete_one_item_wishlist', function(){
                var id = this.id;
                var thisRef = $(this);
               $.confirm({
					title: 'Alert!',
					content: 'Once you click DELETE button this item will DELETE from your wishlist. Are you sure you want proceed?',
					type: 'red',
					typeAnimated: true,
					buttons: {
						Delete: {
							text: 'DELETE',
							btnClass: 'btn-red',
							action: function () {
                                thisRef.attr('disabled', 'disabled');
                                showLoader();
								$.ajax({
									type: "POST",
									url: '/response_delete_one_item_wishlist',
									data: {
                                        _token: '{!! csrf_token() !!}',
										id: id
									},
									success: function (response) {
                                        hideLoader();
										var result = JSON.parse(response);
										if (result == "successs") {
                                            location.reload();
                                            //thisRef.parent().parent().remove();
										} else {
											alert("Something wrong while deleting");
										}
									}
								});
							}
						},
						close: function () {}
					}
				});
            });

            //Clear whole wishlist
            $(document).on('click', '.clear_wishlist', function(){
                var button = $(this);
                $.confirm({
					title: 'Alert!',
					content: 'Once you click DELETE button this whole Wishlist will be deleted. Are you sure you want proceed?',
					type: 'red',
					typeAnimated: true,
					buttons: {
						Delete: {
							text: 'DELETE',
							btnClass: 'btn-red',
							action: function () {
                                button.attr('disabled', 'disabled');
                                button.text('PROCESSING');
                                showLoader();
								$.ajax({
									type: "POST",
									url: '/clear_wishlist',
									data: {
                                        _token: '{!! csrf_token() !!}'
									},
									success: function (response) {
                                        hideLoader();
										//console.log(response);
										var result = JSON.parse(response);
										if (result == "successs") {
											location.reload();
										} else {
											alert("Something wrong while deleting");
										}
									}
								});
							}
						},
						close: function () {}
					}
				});
            });

             //Filters
             $(document).on('click', '.filter_values', function(){
               var id = this.id;
               showLoader();
                $.ajax({
					type: "POST",
					url: '/set_filter_cookie',
					data: {
                        _token: '{!! csrf_token() !!}',
                        id: id
					},
					success: function (response) {
						//console.log(response);
                        hideLoader();
						var result = JSON.parse(response);
						 
							window.location.href='/filter';
						 
					}
				});
            });

            //Comapre_products
            $(document).on('click', '.compare_product', function(){ 
                $(this).attr('disabled', 'disabled');
                var id = this.id;
                if(getCookie('cp_2')){
                    document.cookie = 'cp=;expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/';
                    document.cookie = 'cp_2=;expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/';
                    //document.cookie = "cp="+id"; path=/";
                    document.cookie = "cp=" + id + ";"  + ";path=/"
                    $.confirm({
                                title: 'Compare With',
                                content: 'Please select another product to compare with',
                                type: 'green',
                                typeAnimated: true,
                                buttons: {
                                    Delete: {
                                        text: 'Okay!',
                                        btnClass: 'btn-green',
                                        action: function () {
                                        }
                                    },
                                    close: function () {}
                                }
                            });
                }else{
                    if(getCookie('cp')){
                        if(getCookie('cp') == id){
                            $.confirm({
                                title: 'Same Products',
                                content: 'Please choose a different product to commpare',
                                type: 'red',
                                typeAnimated: true,
                                buttons: {
                                    Delete: {
                                        text: 'Okay!',
                                        btnClass: 'btn-red',
                                        action: function () {
                                        }
                                    },
                                    close: function () {}
                                }
                            });
                        }else{
                            showLoader();
                            $.ajax({
                                type: "POST",
                                url: '/resonse_compare_products',
                                data: {
                                    _token: '{!! csrf_token() !!}',
                                    id: id
                                },
                                success: function (response) {
                                    hideLoader();
                                    //console.log(response);
                                    var result = JSON.parse(response);
                                    if(result == "success"){
                                        //document.cookie = "cp_2="+id"; path=/";
                                        document.cookie = "cp_2=" + id + ";"  + ";path=/"
                                        window.location.href='/compare_products';
                                    }else{
                                        $.confirm({
                                            title: 'Warning',
                                            content: 'Please choose product of similar types',
                                            type: 'red',
                                            typeAnimated: true,
                                            buttons: {
                                                Delete: {
                                                    text: 'Okay!',
                                                    btnClass: 'btn-red',
                                                    action: function () {
                                                    }
                                                },
                                                close: function () {}
                                            }
                                        });
                                    }
                                    
                                }
                            });
                           
                        }
                    }else{
                       // document.cookie = "cp= +id ; path=/";
                        document.cookie = "cp=" + id + ";"  + ";path=/"
                        $.confirm({
                                title: 'Alert!',
                                content: 'Please select another product to compare!',
                                type: 'green',
                                typeAnimated: true,
                                buttons: {
                                    Delete: {
                                        text: 'Okay!',
                                        btnClass: 'btn-green',
                                        action: function () {
                                        }
                                    },
                                    close: function () {}
                                }
                            });
                    }
                }
            });

            // edit contact info
            $(document).on('click', '.edit_contact_info', function(){
               // alert("as");
                $(this).hide();
                $('.name_contact_info').hide();
                $('.email_contact_info').hide();
                $('.inputFirstName_contact_info').show();
                $('.inputLastName_contact_info').show();
                $('.inputEmail_contact_info').show();
                $('.save_contact_info').show();
            });

            //deactivate subscription
            $(document).on('click', '.deactivate_subscription', function(){
                var button = $(this);
                 $.confirm({
                    title: 'Alert!',
                    content: 'Are you sure you want to deactivate Newsletters subscription?',
                    type: 'red',
                    typeAnimated: true,
                    buttons: {
                    Delete: {
                        text: 'Yes!',
                        btnClass: 'btn-red',
                        action: function () {
                            button.attr('disabled', 'disabled');
                            button.text('PROCESSING');
                            $.ajax({
                                type: "POST",
                                url: '/resonse_deactivate_subscription',
                                data: {
                                    _token: '{!! csrf_token() !!}'
                                },
                                success: function (response) {
                                    //console.log(response);
                                    var result = JSON.parse(response);
                                    if(result == "success"){
                                        location.reload();
                                    }else if(result == "failed"){
                                        alert('Uuable to deactivate subscription!');
                                    }	
                                }
                            });
                            }
                        },
                        close: function () {}
                    }
                });
            });

            //edit primary billing address
            $(document).on('click', '.edit_primary_billing_address', function(){
                $(this).hide();
                $('.billing_address_detail').hide();
                $('.input_billing_address').show();
            });

            //Manage Address
            $(document).on('click', '.manage_add', function(){
                $('.input_manage_address').show();
            });

            //Add new shipping address from checkout 
            $(document).on('change', '.address-select', function(){ 
               if($(this).val() == "new_add"){
                $('.continue_checkout').hide();
                $('#billing-new-address-form').show();
               }
            });

            //Add Coupon
            $(document).on('click', '.btn_coupon_submit', function(){
                if(!$('#coupon_code').val() == ""){
                    var coupon = $('#coupon_code').val();
                    showLoader();
                    $.ajax({
                        type: "POST",
                        url: '/resonse_add_coupon',
                        data: {
                            _token: '{!! csrf_token() !!}',
                            coupon: coupon
                        },
                        success: function (response) {
                       // console.log(response);
                            var result = JSON.parse(response);
                             if(result == "failed"){
                                hideLoader();
                                $('.applied_failed').show();
                                $('.applied_success').hide();
                                $('.applied_failed').text('This coupon is invalid or deactivated by admin!');
                            }else{
                                var array = result;
                                hideLoader();
                                $(result).each(function(i, item){
                                    if(item['status'] == "success"){
                                        var g_total = $(".grand_total").html().split(" ");
                                        var total_after_coupon = g_total[1] - item['value']
                                        $('.applied_failed').hide();
                                        $('.applied_success').show();
                                        $('.applied_success').text('Coupon Applied successfully!');
                                        document.cookie = "C-D=" + coupon + ";"  + ";path=/"
                                        $('.final_price').text("PKR: " + total_after_coupon);
                                    }
                                });
                            }	
                        }
                    });
                }else{
                    hideLoader();
                    $('.applied_failed').show();
                    $('.applied_failed').text('Please enter valid coupon!');
                }
            });

            //save address and continue (Place Order Page)
            $(document).on('click', '.continue_checkout', function(){
                //alert($('.address-select').val());
                if($('.address-select').val() == "" || $('.address-select').val() == null){
                    alert("Invalid address");
                }else{
                    $('.step-one').hide();
                    $('.step_one_activate').removeClass('active');
                    $('.step-two').show();
                    $('.step_two_activate').addClass('active');
                }
            });

            //save shipping method and continue (Place Order Page)
            $(document).on('click', '.shipping_method_continue', function(){
                if($('.radio').val() == ""){
                    alert('Invalid information');
                }else{
                    $('.step-one').hide();
                    $('.step-two').hide();
                    $('.step_one_activate').removeClass('active');
                    $('.step_two_activate').removeClass('active');
                    $('.step-three').show();
                    $('.step_three_activate').addClass('active');
                }
            });

            //save payment-info and continue (Place Order Page)
            $(document).on('click', '.payment_info_continue', function(){
                if($('.radio_payment_info').val() == ""){
                    alert('Invalid payment method!');
                }else{
                    $('.step-one').hide();
                    $('.step-two').hide();
                    $('.step-three').hide();
                    $('.step_one_activate').removeClass('active');
                    $('.step_two_activate').removeClass('active');
                    $('.step_three_activate').removeClass('active');
                    $('.step-four').show();
                    $('.step_four_activate').addClass('active');
                }
            });

            //Place Order button
            $(document).on('click', '.place_order_btn', function(){
                $(this).attr('disabled', 'disabled');
                $(this).text('PROCESSING');
                var address;
                var shipping_charges = $('.radio').val();
                var payment_method = $('.radio_payment_info').val();
                if($('.address-select').val() == "primary"){
                    address = 0;
                }else{
                    address = 1;
                }
                showLoader();
                $.ajax({
                    type: "POST",
                    url: '/resonse_place_order',
                    data: {
                         _token: '{!! csrf_token() !!}',
                         address : address,
                         shipping_charges : shipping_charges,
                         payment_method : payment_method
                    },
                    success: function (response) {
                        hideLoader();
                        //console.log(response);
                        var result = JSON.parse(response);
                        if(result == "success"){
                            //location.reload();
                            window.location.href='/';
                        }else if(result == "failed"){
                            alert('Unable to place order');
                        }	
                    }
                });
                
            });

            //Proceed to checkout
            $(document).on('click', '.btn-proceed-checkout', function(){
                $(this).attr('disabled', 'disabled');
                $(this).text('PROCESSIG');
                $.ajax({
                    type: "POST",
                    url: '/resonse_proceed_to_checkout',
                    data: {
                         _token: '{!! csrf_token() !!}'
                    },
                    success: function (response) {
                        console.log(response);
                        var result = JSON.parse(response);
                        if(result == "success"){
                            window.location = '/checkout';
                            $(this).removeAttr('disabled');
                            $(this).text('PROCEED TO CHECKOUT');
                        }else if(result == "failed"){
                            alert('The product you added to cart is no longer available!');
                            location.reload();
                        }else{
                            alert('There is no item in your cart. First add item and then Checkout.')
                            location.reload();
                        }	
                    }
                });
            });

            //Back links - Place Order
            $(document).on('click', '.back-link', function(){
                if(this.id == "section_two"){
                    $('.step-one').show();
                    $('.step-three').hide();
                    $('.step-two').hide();
                    $('.step_one_activate').addClass('active');
                    $('.step_two_activate').removeClass('active');
                    $('.step_three_activate').removeClass('active');
                }else if(this.id == "section_three"){
                    $('.step-one').hide();
                    $('.step-three').hide();
                    $('.step-two').show();
                    $('.step_one_activate').removeClass('active');
                    $('.step_two_activate').addClass('active');
                    $('.step_three_activate').removeClass('active');
                }
            });

            //When change size of product
            $(document).on('change', '.select_size', function(){
                var id = $(this).children("option:selected").attr("id");
                var price = $(this).children("option:selected").attr("class");
                var discount = $('.product_discount_hidden').val();

               // console.log(id + " - " + price + " - " + discount);

                $('.btn-cart').attr('id',id);
                $('.wishlist').attr('id', id);
                $('.compare_product').attr('id', id); 

                if(discount != ""){
                    var total_price = price;
                    var discount = total_price - ((discount / 100) * total_price);
                    $('.price_special').text("PKR: " + discount);
                    $('.price_reqular').text("PKR: " + price);
                }else{
                    $('.price_special').text("PKR: " + price);
                }

                
            });

            //Fade Our Search div
            $(document).on('click', '.container', function(){
                $('.search_dropdown_list').fadeOut();
            });

            if($('.hidden_input_for_size').val() == "null"){
                $('.select_size_detail_page').hide();
            }

        });

        function showLoader(){
            $('#loader').show();
        }

        function hideLoader(){
            $('#loader').hide();
        }

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
                }
            }
            return "";
        }

    </script>

    <!-- Hot Deals Timer 1-->
    <script>
        var dthen1 = new Date("12/25/17 11:59:00 PM");
        start = "08/04/15 03:02:11 AM";
        start_date = Date.parse(start);
        var dnow1 = new Date(start_date);
        if (CountStepper > 0)
            ddiff = new Date((dnow1) - (dthen1));
        else
            ddiff = new Date((dthen1) - (dnow1));
        gsecs1 = Math.floor(ddiff.valueOf() / 1000);

        var iid1 = "countbox_1";
        CountBack_slider(gsecs1, "countbox_1", 1);
    </script>
</body>

</html>
