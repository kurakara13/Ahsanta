@extends('layouts.app-all')

@section('css')

@stop

@section('style')
<style>
.blck-promo{
  background: #ffb100;
  z-index: 100;
  font-family: Montserrat-Regular;
  font-size: 12px;
  color: white;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 50px;
  height: 22px;
  border-radius: 11px;
  position: absolute;
  top: 12px;
  left: 12px;
}

.blck-promo-detail{
  background: #ffb100;
  font-family: Montserrat-Regular;
  font-size: 12px;
  color: white;
  padding: 10px;
  border-radius: 0px 10px 10px 0px;
  display: table;
}

.blck-new{
  background: #00b8ff;
  z-index: 100;
  font-family: Montserrat-Regular;
  font-size: 12px;
  color: white;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 50px;
  height: 22px;
  border-radius: 11px;
  position: absolute;
  top: 12px;
  left: 12px;
}

.cat-tag{
  background: #0000002e;
  color: white;
  padding: 5px;
  border-radius: 10px;
}
<?php if(count($productImages) == 0){ ?>

li.slick-active{
  display: none;
}
<?php } ?>
</style>

@stop

@section('menu')
<!-- Menu -->
<div class="wrap_menu">
	<nav class="menu">
		<ul class="main_menu">
			<li>
				<a href="{{asset('/')}}">Home</a>
			</li>

			<li class="sale-noti">
				<a href="{{asset('shop')}}">Shop</a>
			</li>

			<li>
				<a href="{{asset('blog')}}">Blog</a>
			</li>

			<li>
				<a href="{{asset('about')}}">About</a>
			</li>

			<li>
				<a href="{{asset('contact')}}">Contact</a>
			</li>
		</ul>
	</nav>
</div>

@stop


@section('content')
<!-- breadcrumb -->
<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
  <a href="{{url('/')}}" class="s-text16">
    Home
    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
  </a>
  <a href="{{url('shop')}}" class="s-text16">
    Shop
    <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
  </a>
  <span class="s-text17">
    {{$product->name}}
  </span>
</div>

<!-- Product Detail -->
<div class="container bgwhite p-t-35 p-b-80">
  <div class="flex-w flex-sb">
    <div class="w-size13 p-t-30 respon5">
      <div class="wrap-slick3 flex-sb flex-w">
        <div class="wrap-slick3-dots"></div>

        <div class="slick3">
          @if(count($productImages) == 0)
          <div class="item-slick3" data-thumb="{{asset('images/product/No_Image_Available.jpg')}}">
            <div class="wrap-pic-w">
              <img src="{{asset('images/product/No_Image_Available.jpg')}}" alt="IMG-PRODUCT" style="height:700px">
            </div>
          </div>
          @else
            @foreach($productImages as $key)
            <div class="item-slick3" data-thumb="{{asset('images/product/'.$key->name)}}">
              <div class="wrap-pic-w">
                <img src="{{asset('images/product/'.$key->name)}}" alt="IMG-PRODUCT">
              </div>
            </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>

    <div class="w-size14 p-t-30 respon5">
      <h4 class="product-detail-name m-text16 p-b-13">
        {{$product->name}}
      </h4>

      @if($product->id_promotion != null)
      @if($promo->type == 'free ongkir' || $promo->type == 'get item')
      <span class="block2-price m-text17 p-r-5">
        {{$product->percentPrice()}}
      </span>
      @else
      <span class="block2-oldprice m-text7 m-text17 p-r-5">
        {{$product->percentPrice()}}
      </span>
      @endif
      <span class="block2-newprice m-text8 m-text8 p-r-5">
        {!!$product->promoPrice()!!}
      </span>
      @else
      <span class="block2-price m-text17 p-r-5">
       {{$product->percentPrice()}}
      </span>
      @endif
      <!-- <span class="m-text17">
        {{$product->percentPrice()}}
      </span> -->

      @if($product->id_promotion != null)
      <div class="wrap-dropdown-content bo6 p-t-15 p-b-14">
        <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
          Promotion
          <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
          <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
        </h5>

        <div class="dropdown-content dis-none p-t-15 p-b-23">
            <p>{{$promo->name}}</p>
            <p>Order Minimum : {{$promo->minimum_order}}</p>
            <p>Price Minimum : {{$promo->percentPricePromo()}}</p>
        </div>
      </div>
      @endif

      <!--  -->
      <div class="p-t-33 p-b-60">
        @if($product->size != null)
        <div class="flex-m flex-w p-b-10">
          <div class="s-text15 w-size15 t-center">
            Size
          </div>

          <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
            <select class="selection-2" name="size">
              <option>Choose an option</option>
              @foreach (json_decode($product->size) as $key)
              <option value="{{$key}}">{{$key}}</option>
              @endforeach
            </select>
          </div>
        </div>
        @endif

        @if($product->color != null)
        <div class="flex-m flex-w">
          <div class="s-text15 w-size15 t-center">
            Color
          </div>

          <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
            <select class="selection-2" name="color">
              <option>Choose an option</option>
              @foreach (json_decode($product->color) as $key)
              <option value="{{$key}}">{{$key}}</option>
              @endforeach
            </select>
          </div>
        </div>
        @endif

        <div class="flex-r-m flex-w p-t-10">
          <div class="w-size16 flex-m flex-w">
            <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
              <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
              </button>

              <input class="size8 m-text18 t-center num-product" type="number" name="num-product" value="1">

              <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
              </button>
            </div>

            <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
              <!-- Button -->
              <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                Add to Cart
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="p-b-45">
        <div class="row">
          <div class="col-sm-6">
            <p class="s-text8 m-r-35">Category</p>
            <hr>
            @if($product->category != null)
              @foreach (json_decode($product->category) as $key)
              <?php $category = DB::table('category')->find($key) ?>
              <a href="" class="s-text8 m-r-15 cat-tag">{{$category->name}}</a>
              @endforeach
            @endif
          </div>
          <div class="col-sm-6">
            <p class="s-text8 m-r-35">Tags</p>
            <hr>
            @if($product->tags != null)
              @foreach (json_decode($product->tags) as $key)
              <?php $tags = DB::table('tags')->find($key) ?>
              <a href="" class="s-text8 m-r-15 cat-tag">{{$tags->name}}</a>
              @endforeach
            @endif
          </div>
        </div>
        <!-- <span class="s-text8 m-r-35">SKU: MUG-01</span>
        <span class="s-text8">Categories: Mug, Design</span> -->
      </div>

      <!--  -->
      <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
        <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
          Description
          <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
          <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
        </h5>

        <div class="dropdown-content dis-none p-t-15 p-b-23">
            {!!$product->description!!}
        </div>
      </div>

      <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
        <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
          Additional information
          <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
          <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
        </h5>

        <div class="dropdown-content dis-none p-t-15 p-b-23">
          <p class="s-text8">
            Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
          </p>
        </div>
      </div>

      <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
        <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
          Reviews (0)
          <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
          <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
        </h5>

        <div class="dropdown-content dis-none p-t-15 p-b-23">
          <p class="s-text8">
            Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
          </p>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Relate Product -->
<section class="relateproduct bgwhite p-t-45 p-b-138">
  <div class="container">
    <div class="sec-title p-b-60">
      <h3 class="m-text5 t-center">
        Related Products
      </h3>
    </div>

    <!-- Slide2 -->
    <div class="wrap-slick2">
      <div class="slick2">
        @foreach($productRelated as $key)
        <div class="item-slick2 p-l-15 p-r-15">
          <!-- Block2 -->
          <div class="block2">
            <div class="block2-img wrap-pic-w of-hidden pos-relative">
							@if($key->id_promotion != null)
							<div class="blck-promo">
								Promo
							</div>
							@elseif(date("Y-m-d H:i:s") < $key->created_at->addDays(7))
							<div class="blck-new">
								New
							</div>
							@endif
							<?php
								$image = DB::table('product_image')->where('id_product', $key->id)->where('status', 'Show')->where('cover',1)->first();
								if($image == null){
									$image = DB::table('product_image')->where('id_product', $key->id)->where('status', 'Show')->first();
								}

								if($image == null){
									$imageName = 'No_Image_Available.jpg';
								}else {
									$imageName = $image->name;
								}
							 ?>
              <img src="{{asset('images/product/'.$imageName)}}" alt="IMG-PRODUCT" height="300px">

              <div class="block2-overlay trans-0-4">
                <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                  <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                  <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                </a>

                <div class="block2-btn-addcart w-size1 trans-0-4">
                  <!-- Button -->
                  <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                    Add to Cart
                  </button>
                </div>
              </div>
            </div>

            <div class="block2-txt p-t-20">
              <a href="{{url('shop/detail/'.$key->id.substr(uniqid(),0,10))}}" class="block2-name dis-block s-text3 p-b-5" style="min-height:48px;">
                {{$key->name}}
              </a>

              @if($key->id_promotion != null)
              <?php $promotion = DB::table('promotion')->find($key->id_promotion);?>
              @if($promotion->type == 'free ongkir' || $promotion->type == 'get item')
              <span class="block2-price p-r-5">
               {{$key->percentPrice()}}
              </span>
              @else
              <span class="block2-oldprice m-text7 p-r-5">
                {{$key->percentPrice()}}
              </span>
              @endif
              <span class="block2-newprice m-text8 p-r-5">
                {!!$key->promoPrice()!!}
              </span>
              @else
              <span class="block2-price p-r-5">
               {{$key->percentPrice()}}
              </span>
              @endif
            </div>
          </div>
        </div>
				@endforeach
      </div>
    </div>

  </div>
</section>


<!-- Footer -->
<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
  <div class="flex-w p-b-90">
    <div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
      <h4 class="s-text12 p-b-30">
        GET IN TOUCH
      </h4>

      <div>
        <p class="s-text7 w-size27">
          Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
        </p>

        <div class="flex-m p-t-30">
          <a href="#" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
          <a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
          <a href="#" class="fs-18 color1 p-r-20 fa fa-pinterest-p"></a>
          <a href="#" class="fs-18 color1 p-r-20 fa fa-snapchat-ghost"></a>
          <a href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>
        </div>
      </div>
    </div>

    <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
      <h4 class="s-text12 p-b-30">
        Categories
      </h4>

      <ul>
        <li class="p-b-9">
          <a href="#" class="s-text7">
            Men
          </a>
        </li>

        <li class="p-b-9">
          <a href="#" class="s-text7">
            Women
          </a>
        </li>

        <li class="p-b-9">
          <a href="#" class="s-text7">
            Dresses
          </a>
        </li>

        <li class="p-b-9">
          <a href="#" class="s-text7">
            Sunglasses
          </a>
        </li>
      </ul>
    </div>

    <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
      <h4 class="s-text12 p-b-30">
        Links
      </h4>

      <ul>
        <li class="p-b-9">
          <a href="#" class="s-text7">
            Search
          </a>
        </li>

        <li class="p-b-9">
          <a href="#" class="s-text7">
            About Us
          </a>
        </li>

        <li class="p-b-9">
          <a href="#" class="s-text7">
            Contact Us
          </a>
        </li>

        <li class="p-b-9">
          <a href="#" class="s-text7">
            Returns
          </a>
        </li>
      </ul>
    </div>

    <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
      <h4 class="s-text12 p-b-30">
        Help
      </h4>

      <ul>
        <li class="p-b-9">
          <a href="#" class="s-text7">
            Track Order
          </a>
        </li>

        <li class="p-b-9">
          <a href="#" class="s-text7">
            Returns
          </a>
        </li>

        <li class="p-b-9">
          <a href="#" class="s-text7">
            Shipping
          </a>
        </li>

        <li class="p-b-9">
          <a href="#" class="s-text7">
            FAQs
          </a>
        </li>
      </ul>
    </div>

    <div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
      <h4 class="s-text12 p-b-30">
        Newsletter
      </h4>

      <form>
        <div class="effect1 w-size9">
          <input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
          <span class="effect1-line"></span>
        </div>

        <div class="w-size2 p-t-20">
          <!-- Button -->
          <button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
            Subscribe
          </button>
        </div>

      </form>
    </div>
  </div>

  <div class="t-center p-l-15 p-r-15">
    <a href="#">
      <img class="h-size2" src="{{asset('assets/images/icons/paypal.png')}}" alt="IMG-PAYPAL">
    </a>

    <a href="#">
      <img class="h-size2" src="{{asset('assets/images/icons/visa.png')}}" alt="IMG-VISA">
    </a>

    <a href="#">
      <img class="h-size2" src="{{asset('assets/images/icons/mastercard.png')}}" alt="IMG-MASTERCARD">
    </a>

    <a href="#">
      <img class="h-size2" src="{{asset('assets/images/icons/express.png')}}" alt="IMG-EXPRESS">
    </a>

    <a href="#">
      <img class="h-size2" src="{{asset('assets/images/icons/discover.png')}}" alt="IMG-DISCOVER">
    </a>

    <div class="t-center s-text8 p-t-20">
      Copyright © 2018 All rights reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
    </div>
  </div>
</footer>



<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
  <span class="symbol-btn-back-to-top">
    <i class="fa fa-angle-double-up" aria-hidden="true"></i>
  </span>
</div>

<!-- Container Selection -->
<div id="dropDownSelect1"></div>
<div id="dropDownSelect2"></div>

@endsection

@section('script')
<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('assets/vendor/select2/select2.min.js')}}"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});

		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect2')
		});
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('assets/vendor/slick/slick.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script>
	<script type="text/javascript">
		$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
      });
		});

		$('.block2-btn-addwishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});

		$('.btn-addcart-product-detail').each(function(){
			var nameProduct = $('.product-detail-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});
	</script>

@stop
