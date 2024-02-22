@extends('landing.layout.index')

@section('content')

<div class="page-heading bg-light">
    <div class="container">
      <div class="row align-items-end text-center">
        <div class="col-lg-7 mx-auto">
          <h1>About Shop</h1>  
          <p class="mb-4"><a href="{{ route('home')}}">Home</a> / <strong>About</strong></p>        
        </div>
      </div>
    </div>
  </div>

  

  <div class="untree_co-section">
    <div class="container">

      <div class="row mb-5 mx-3">
        <div class="col-lg-4 mb-5 order-2 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
          <div class="contact-info">

            <div class="address mt-4 ">
              <i class="icon-room"></i>
              <h4 class="mb-2">Location:</h4>
              <p>Jl.Belik Pemalang , kecamatan Belik , kabupaten Pemalang , Jawa Tengah</p>
            </div>

            <div class="open-hours mt-4">
              <i class="icon-clock-o"></i>
              <h4 class="mb-2">Open:</h4>
              <p>
                Monday-Saturday: <br>
                8 AM - 9 PM
              </p>
            </div>

            <div class="email mt-4">
              <i class="icon-envelope"></i>
              <h4 class="mb-2">Email:</h4>
              <p>tokomalhest@gmail.con</p>
            </div>

            <div class="phone mt-4">
              <i class="icon-phone"></i>
              <h4 class="mb-2">Phone:</h4>
              <p>+62 8239 29372 828</p>
            </div>

          </div>
        </div>
        <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="200">
          <img src="{{ asset('landing/images/logo.png')}}" alt="Image" class="rounded" width="60%">
        </div>
      </div>

      <div class="row mx-3">
        <div class="co-md-12">
          <h4>Description</h4>
          <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi necessitatibus qui numquam, eaque quaerat nemo asperiores vitae fugit, aut harum dolorem aliquid voluptatem quo natus dolorum reprehenderit nulla optio esse.
          </p>
        </div>
      </div>

    </div>
  </div> <!-- /.untree_co-section -->



@endsection

