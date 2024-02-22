@extends('admin.layout.index')

@section('content')
    
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Slider | <span class="text-secondary fs-5">Add</span></h1>
    </div>

    <div class="row">

      <!-- Area Chart -->
      <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Add Data</h6>
            <a href="{{ route('slider.index')}}" class="btn btn-danger btn-sm sm-auto">Back</a>
          </div>
          <!-- Card Body -->
          <div class="card-body">
                <form action="{{ route('slider.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="caption" class="form-label">Caption</label>
                        <input type="text" class="form-control @error('caption') is-invalid @enderror" id="caption" placeholder="Optional" name="caption">
                        @error('caption')
                             <div class="invalid-feedback">
                                {{ $message}}
                             </div>
                        @enderror
                     </div>

                     <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"  name="image">
                        @error('image')
                             <div class="invalid-feedback">
                                {{ $message}}
                             </div>
                        @enderror
                     </div>
                     <div class="mb-3">
                      <label for="status" class="form-label">Status</label>
                      <select id="status" class="form-select @error('status') is-invalid @enderror" name="status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                      </select>
                      @error('status')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
          </div>
        </div>
      </div>

    </div>


</div>

@endsection

