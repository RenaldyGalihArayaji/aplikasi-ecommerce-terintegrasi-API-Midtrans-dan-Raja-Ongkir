<!-- Halaman View -->
@extends('admin.layout.index')

@section('content')
    
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Report | <span class="text-secondary fs-5">Sales</span></h1>
    </div>

    <!-- Content Row -->

    <div class="row">
      <!-- Area Chart -->
      <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Sales</h6>
          </div>
          <!-- Card Body -->
          <div class="card-body">
            <form action="{{ route('salesData')}}" method="get" class="mb-4">
              @csrf
              <div class="row">
                  <div class="col-md-6 mb-2">
                      <label for="salesStart" class="form-label">Start Date</label>
                      <input type="date" name="salesStart" id="salesStart" class="form-control">
                  </div>
                  <div class="col-md-6 mb-2">
                      <label for="salesEnd" class="form-label">End Date</label>
                      <input type="date" name="salesEnd" id="salesEnd" class="form-control">
                  </div>
                  <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-danger mb-2"><i class="fa-solid fa-file-pdf"></i> Export PDF</button>

                    <a href="{{ route('excelSales', ['salesStart' => 'placeholder', 'salesEnd' => 'placeholder']) }}" onclick="this.href='/report-sales-excel/'+  document.getElementById('salesStart').value + '/' + document.getElementById('salesEnd').value " class="btn btn-success mb-2"><i class="fa-solid fa-file-excel"></i> Export Excel</a>

                    <a href="{{ route('print', ['salesStart' => 'placeholder', 'salesEnd' => 'placeholder']) }}" onclick="this.href='/report-sales-print/'+  document.getElementById('salesStart').value + '/' + document.getElementById('salesEnd').value " class="btn btn-info mb-2"><i class="fa-solid fa-print"></i> Print</a>

                 </div>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
</div>

@endsection
