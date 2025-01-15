<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin | Add Product</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="admin/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="admin/assets/images/favicon.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  </head>
  <body>
    <div class="container-scroller">
      @include('admin.sidebar')
      <div class="container-fluid page-body-wrapper">
        @include('admin.navbar')
        <div class="main-panel">
          <div class="content-wrapper">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('message')}}
                </div>
            @endif
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <form action="{{route('admin.add_product')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="card-body">
                            <h4 class="card-title">Add Product Form</h4>
                            <p class="card-description"> Jacket details </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Product Title</label>
                                        <div class="col-sm-9">
                                            <input name="title" type="text" class="form-control" style="color: #fff"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Category</label>
                                        <div class="col-sm-9">
                                            <select name="category" class="form-control" style="color: #fff">
                                                @foreach ($categories as $category)
                                                <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="card-description"> Jacket Specifications </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Material</label>
                                        <div class="col-sm-9">
                                            <input name="material" placeholder="ex: Leather" type="text" class="form-control" style="color: #fff"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Size</label>
                                        <div class="col-sm-9">
                                            <input name="size" placeholder="ex: S, M, L, XL" type="text" class="form-control" style="color: #fff"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Color</label>
                                        <div class="col-sm-9">
                                            <input name="color" placeholder="ex: Brown, Black" type="text" class="form-control" style="color: #fff"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Design Type</label>
                                        <div class="col-sm-9">
                                            <input name="design_type" placeholder="ex: Biker, Bomber" type="text" class="form-control" style="color: #fff"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="card-description"> Price & Discount </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Price</label>
                                        <div class="col-sm-9">
                                            <input name="price" placeholder="ex: $120" type="text" class="form-control" style="color: #fff"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Discount Price</label>
                                        <div class="col-sm-9">
                                            <input name="discount_price" placeholder="ex: 10%" type="text" class="form-control" style="color: #fff"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="card-description"> Other Details </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Quantity</label>
                                        <div class="col-sm-9">
                                            <input name="quantity" placeholder="ex: 20" type="text" class="form-control" style="color: #fff"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Product Images</label>
        <div class="col-sm-9">
            <input id="images" type="file" name="images[]" class="file-upload-default" multiple>
            <div class="input-group">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Images">
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                </span>
            </div>
        </div>
    </div>
</div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="input-group col-sm-9">
                                            <button type="submit" class="btn btn-info">Add Product</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
          @include('admin.footer')
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="admin/assets/js/file-upload.js"></script>
    <script src="admin/assets/js/typeahead.js"></script>
    <script src="admin/assets/js/select2.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
  </body>
</html>
