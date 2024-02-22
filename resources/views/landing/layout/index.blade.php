<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Untree.co">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="favicon.png">

	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,400;0,700;1,700&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

	 <!-- Favicon -->
	 <link rel="icon" type="image/x-icon" href="{{ asset('landing/images/favicon.ico')}}" />

	<link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('landing/css/animate.min.css')}}">
	<link rel="stylesheet" href="{{ asset('landing/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{ asset('landing/css/owl.theme.default.min.css')}}">
	<link rel="stylesheet" href="{{ asset('landing/css/jquery.fancybox.min.css')}}">
	<link rel="stylesheet" href="{{ asset('landing/fonts/icomoon/style.css')}}">
	<link rel="stylesheet" href="{{ asset('landing/fonts/flaticon/font/flaticon.css')}}">
	<link rel="stylesheet" href="{{ asset('landing/css/aos.css')}}">
	<link rel="stylesheet" href="{{ asset('landing/css/style.css')}}">

	<title>Toko Malhest | {{ $title}}</title>
</head>

<body>

	<div class="search-form" id="search-form">
		<form action="">
			<input type="search" class="form-control" placeholder="Enter keyword to search...">
			<button class="button">
				<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
					<path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
				</svg>
			</button>
			<button class="button">
				<div class="close-search">
					<span class="icofont-close js-close-search"></span>
				</div>
			</button>

		</form>
	</div>

	<div class="site-mobile-menu">
		<div class="site-mobile-menu-header">
			<div class="site-mobile-menu-close">
				<span class="icofont-close js-menu-toggle"></span>
			</div>
		</div>
		<div class="site-mobile-menu-body"></div>
	</div>



	{{-- Navbar --}}
    @include('landing.component.navbar')
    {{-- End Navbar --}}


	{{-- Content --}}
    @yield('content')
    {{-- End Content --}}

	{{-- Footer --}}
    @include('landing.component.footer')
    {{-- End footer --}}

	{{-- sweetalert razid --}}
	@include('sweetalert::alert')

	@yield('script')
	<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
	<script src="{{ asset('landing/js/popper.min.js')}}"></script>
	<script src="{{ asset('landing/js/bootstrap.min.js')}}"></script>
	<script src="{{ asset('landing/js/owl.carousel.min.js')}}"></script>
	<script src="{{ asset('landing/js/jquery.animateNumber.min.js')}}"></script>
	<script src="{{ asset('landing/js/jquery.waypoints.min.js')}}"></script>
	<script src="{{ asset('landing/js/jquery.fancybox.min.js')}}"></script>
	<script src="{{ asset('landing/js/jquery.sticky.js')}}"></script>
	<script src="{{ asset('landing/js/aos.js')}}"></script>
	<script src="{{ asset('landing/js/custom.js')}}"></script>
	{{-- sweetalert2 --}}
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
	  $('.confirm-delete').click(function(event) {
  
	  //This will choose the closest form to the button
	  var form =  $(this).closest("form");
  
	  //don't let the form submit yet
	  event.preventDefault();
  
		  //configure sweetalert alert as you wish
		  Swal.fire({
			  title: 'Apakah Anda Yakin?',
			  // text: "Data Akan di Hapus",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'ya, delete!'
		  }).then((result) => {
			  if (result.isConfirmed) {
				  Swal.fire(
				  'Success!',
				  'Data Successfully deleted',
				  'success'
				  )
				  form.submit();
			  }
		  })
	  });
  	</script>

	{{-- Get Provinsi,kabupaten Api Raja Ongkir --}}
	<script>
		$(function () {
			$.ajaxSetup({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
			});

			$(function() {
				
				$('#province').on('change', function () {
				let provinsi_id = $('#province').val();
	
				$.ajax({
					type: 'POST',
					url: "{{ route('getCity') }}",
					data: {provinsi_id: provinsi_id},
					cache: false,
					success: function (msg) {
						$('#city').html(msg);
					},
					error:function (data) {
						console.log('error:',data);
					}
					});
				});

			});
		});
	</script>
	
	
	
	
</body>

</html>
