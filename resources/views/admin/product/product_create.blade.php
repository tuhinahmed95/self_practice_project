@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2>Product Crete</h2>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('product.list') }}" class="btn btn-primary me-3">Back To Product List</a>
                </div>
                <div class="card-body">
                   <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Category</label>
                                    <select name="category_id" class="form-control category">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Subcategory</label>
                                    <select name="subcategory_id" class="form-control subcategory">
                                        <option value="">Select SubCategory</option>
                                        @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Brand</label>
                                    <select name="brand_id" class="form-control">
                                        <option value="">Select Brand</option>
                                        @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" name="product_name">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Product Price</label>
                                    <input type="number" class="form-control" name="price">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Discount Price</label>
                                    <input type="number" class="form-control" name="discount">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Short Description</label>
                                    <input type="text" class="form-control" name="short_des">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Tags</label>
                                    <input type="text" class="form-control border-0 px-0" name="tags[]" id="input-tags">
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Long Description</label>
                                    <textarea name="long_des" id="summernote" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Additional Information</label>
                                    <textarea name="addi_info" id="summernote2" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Preview Image</label>
                                    <input type="file" class="form-control" name="preview"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                    <div class="my-2">
                                        <img width="100" src="" id="blah" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="upload__box">
                                    <span class="d-block pb-2">Gallery Image</span>
                                    <div class="upload__btn-box">
                                      <label class="upload__btn">
                                        <p>Upload images</p>
                                        <input type="file" multiple="" data-max_length="20" class="upload__inputfile" name="gallery[]">
                                      </label>
                                    </div>
                                    <div class="upload__img-wrap"></div>
                                  </div>
                            </div>

                            <div class="col-lg-6 m-auto mt-3">
                                <div class="mb-3">
                                   <button type="submit" class="btn btn-primary w-100">Add Product</button>
                                </div>
                            </div>
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
<script>
    $("#input-tags").selectize({
        delimiter: ",",
        persist: false,
        create: function (input) {
            return {
                value: input,
                text: input,
            };
        },
    });
</script>

<script>
    $('.category').change(function(){
        var category_id = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"POST",
            url: "/getsubCategory",
            data: {'category_id':category_id},
            success: function (data){
               $('.subcategory').html(data);
            }
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote();
        $('#summernote2').summernote();
    });
</script>

<script>
    // use for js multiple image preview
    jQuery(document).ready(function () {
  ImgUpload();
});

function ImgUpload() {
  var imgWrap = "";
  var imgArray = [];

  $('.upload__inputfile').each(function () {
    $(this).on('change', function (e) {
      imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
      var maxLength = $(this).attr('data-max_length');

      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);
      var iterator = 0;
      filesArr.forEach(function (f, index) {

        if (!f.type.match('image.*')) {
          return;
        }

        if (imgArray.length > maxLength) {
          return false
        } else {
          var len = 0;
          for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i] !== undefined) {
              len++;
            }
          }
          if (len > maxLength) {
            return false;
          } else {
            imgArray.push(f);

            var reader = new FileReader();
            reader.onload = function (e) {
              var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
              imgWrap.append(html);
              iterator++;
            }
            reader.readAsDataURL(f);
          }
        }
      });
    });
  });

  $('body').on('click', ".upload__img-close", function (e) {
    var file = $(this).parent().data("file");
    for (var i = 0; i < imgArray.length; i++) {
      if (imgArray[i].name === file) {
        imgArray.splice(i, 1);
        break;
      }
    }
    $(this).parent().parent().remove();
  });
}
</script>

@endsection
