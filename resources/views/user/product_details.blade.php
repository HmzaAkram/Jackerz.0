<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <base href="/public">
    <meta charset="utf-8">
    <title>Jakerz | Product Details</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="shortcut icon" type="image/x-icon" href="user/assets/imgs/theme/favicon.ico">
    <link rel="stylesheet" href="user/assets/css/main.css">
    <link rel="stylesheet" href="user/assets/css/custom.css">
</head>

<body>
    @include('sweetalert::alert')
    @include('user.header')
    @include('user.mobile_header')  
    <main class="main">
        @if(session()->has('message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Failed!</strong> {{session()->get('message')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="product-detail accordion-detail">
                        <div class="row mb-50">

<!-- --------------------------------------------------------------------------------->
<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="detail-gallery">
        <!-- Main Product Image -->
        <div class="product-main-image" style="overflow: hidden; text-align: center; border-radius: 10px; margin-bottom: 15px;">
            <img id="mainImage" src='{{asset("products_images/" . $product->images[0]->image_url)}}' alt="product image" style="width: 100%; height: 450px; border-radius: 10px;">
        </div>

        <!-- Thumbnail Images -->
        <div class="thumbnail-images" style="display: flex; gap: 10px; margin-top: 15px;">
            @foreach ($product->images as $index => $image)
                <div class="thumbnail" style="border: 1px solid #ddd; padding: 5px; border-radius: 5px; cursor: pointer; width: 100px; text-align: center;" data-image-url="{{ asset('products_images/' . $image->image_url) }}">
                    <img src='{{ asset("products_images/" . $image->image_url) }}' alt="product thumbnail" style="width: 100%; height: auto; border-radius: 5px;">
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    // Reference to the main image element
    const mainImage = document.getElementById('mainImage');

    // Add event listeners to all thumbnails
    document.querySelectorAll('.thumbnail').forEach(thumbnail => {
        thumbnail.addEventListener('click', () => {
            // Update the main image source with the clicked thumbnail's image URL
            const newImageUrl = thumbnail.getAttribute('data-image-url');
            mainImage.src = newImageUrl;
        });
    });
</script>

<!-- ------------------------------------------------------------------------------- -->

    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="detail-info">
            <h5 class="title-detail">{{$product->title}}</h5>
            <div class="product-detail-rating">
                <div class="pro-details-brand">
                    <span> Category: <a href="#">{{$product->category}}</a></span>
                </div>
                <div class="product-rate-cover text-end">
                    <div class="product-rate d-inline-block">
                        <div class="product-rating" style="width:90%"></div>
                    </div>
                    <span class="font-small ml-5 text-muted"> (25 reviews)</span>
                </div>
            </div>
            <div class="clearfix product-price-cover">
                <div class="product-price primary-color float-left">
                    <ins><span class="text-brand">${{$product->discount_price}}</span></ins>
                    <ins><span class="old-price font-md ml-15">${{$product->price}}</span></ins>
                    <span class="save-price font-md color3 ml-15">25% Off</span>
                </div>
            </div>
            <div class="bt-1 border-color-1 mt-15 mb-15"></div>
            <div class="product_sort_info font-xs mb-30">
                <ul>
                    <li class="mb-10"><i class="fi-rs-refresh mr-5"></i> 30 Day Return Policy</li>
                    <li><i class="fi-rs-credit-card mr-5"></i> Cash on Delivery available</li>
                </ul>
            </div>
            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
            <div class="detail-extralink">
                <form action="{{url('add-to-cart',$product->id)}}" method="post">
                    @csrf
                    <div class="number" style="display: flex; align-items: center; gap: 5px;">
    <span class="minus" style="cursor: pointer; padding: 5px 10px; background: #ddd; border-radius: 5px;">-</span>
    <input class="unclickable-input" name="quantity" type="number" value="1" min="1"
        style="width: 50px; text-align: center; border: 1px solid #ccc; border-radius: 5px; padding: 5px;" />
    <span class="plus" style="cursor: pointer; padding: 5px 10px; background: #ddd; border-radius: 5px;">+</span>
</div>

                    <div class="product-extra-link2">
                        @if($product->quantity <1)
                            <div>
                            <p style="font-size: 12px;">
                                Availability:<span class="in-stock text-danger ml-5">{{$product->quantity}} Items In Stock</span>
                            </p>
                            </div>
                            <button style="opacity: 0.5;cursor: not-allowed;" disabled type="submit" class="button button-add-to-cart">Add to cart</button>
                        @else
                            <button type="submit" class="button button-add-to-cart">Add to cart</button>
                        @endif
                    </div>
                </form>
            </div>
            <ul class="product-meta font-xs color-grey mt-50">
                <li>Availability:<span class="in-stock text-success ml-5">{{$product->quantity}} Items In Stock</span></li>
            </ul>
        </div>
    </div>
</div>

                            <!-- <section id="product-details">
                                <div class="tab-style3">
                                    <ul class="nav nav-tabs text-uppercase">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Product Details</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content shop_info_tab entry-main-content">
                                        <div class="tab-pane fade show active" id="Additional-info">
                                            <table class="font-md">
                                                <tbody>
                                                    <tr>
                                                        <th>Screen Size</th>
                                                        <td>
                                                            <p>{{$product->screen_size}}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Graphics Card</th>
                                                        <td>
                                                            <p>{{$product->graphics_type}}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Graphics Card Memory</th>
                                                        <td>
                                                            <p>{{$product->graphics_card_memory}}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Processor Generation</th>
                                                        <td>
                                                            <p>{{$product->processor_generation}} Generation</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Processor Type</th>
                                                        <td>
                                                            <p>{{$product->processor_type}}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Processor</th>
                                                        <td>
                                                            <p>{{$product->processor}}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Operatin System</th>
                                                        <td>
                                                            <p>{{$product->operating_system}}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Keyboard</th>
                                                        <td>
                                                            <p>{{$product->keyboard}}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Processor Speed</th>
                                                        <td>
                                                            <p>{{$product->processor_speed}}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Screen Resolution</th>
                                                        <td>
                                                            <p>{{$product->screen_resolution}}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>RAM(System Memory)</th>
                                                        <td>
                                                            <p>{{$product->ram}}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Color</th>
                                                        <td>
                                                            <p>{{$product->color}}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>SSD Capacity</th>
                                                        <td>
                                                            <p>{{$product->ssd_capacity}}</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>      
                            </section>                         -->
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">{{$product->category}}</h5>
                            <ul class="categories">
                                <li><span style="font-weight:bold">Title: </span> {{$product->title}} {{$product->processor}}</li>
                                <li><span style="font-weight:bold">Category: </span>{{$product->category}}</li>
                                <li><span style="font-weight:bold">Color: </span>{{$product->color}}</li>
                                <li><span style="font-weight:bold">size: </span>{{$product->size}}</li>
                            </ul>
                        </div>                        
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('user.footer')    
    <!-- Vendor JS-->
    <script src="user/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="user/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="user/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="user/assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="user/assets/js/plugins/slick.js"></script>
    <script src="user/assets/js/plugins/jquery.syotimer.min.js"></script>
    <script src="user/assets/js/plugins/wow.js"></script>
    <script src="user/assets/js/plugins/jquery-ui.js"></script>
    <script src="user/assets/js/plugins/perfect-scrollbar.js"></script>
    <script src="user/assets/js/plugins/magnific-popup.js"></script>
    <script src="user/assets/js/plugins/select2.min.js"></script>
    <script src="user/assets/js/plugins/waypoints.js"></script>
    <script src="user/assets/js/plugins/counterup.js"></script>
    <script src="user/assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="user/assets/js/plugins/images-loaded.js"></script>
    <script src="user/assets/js/plugins/isotope.js"></script>
    <script src="user/assets/js/plugins/scrollup.js"></script>
    <script src="user/assets/js/plugins/jquery.vticker-min.js"></script>
    <script src="user/assets/js/plugins/jquery.theia.sticky.js"></script>
    <!-- <script src="user/assets/js/plugins/jquery.elevatezoom.js"></script>
    Template  JS -->
    <script src="user/assets/js/main.js?v=3.3"></script>
    <script src="user/assets/js/shop.js?v=3.3"></script></body>
    <!-- <script>
        	$(document).ready(function() {
			$('.minus').click(function () {
				var $input = $(this).parent().find('input');
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				$input.val(count);
				$input.change();
				return false;
			});
			$('.plus').click(function () {
				var $input = $(this).parent().find('input');
				$input.val(parseInt($input.val()) + 1);
				$input.change();
				return false;
			});
		});
    </script> -->
<script>
    document.querySelector('.minus').addEventListener('click', function() {
        const input = document.querySelector('.unclickable-input');
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
        }
    });

    document.querySelector('.plus').addEventListener('click', function() {
        const input = document.querySelector('.unclickable-input');
        input.value = parseInt(input.value) + 1;
    });
</script>
</html>