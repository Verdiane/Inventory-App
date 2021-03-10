@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Inventory</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">
                            <div class="row">
                                {{-- <div class="col-12"> --}}
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>
                                                    {{ $error }}
                                                </li>
                                            @endforeach
                                           </ul>
                                        </div>
                                    @endif
                                <form action="{{ route('orders.update', $order) }}" method="POST" role="form" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group row">

                                     <div class="col-md-3">
                                        <label for="name" class=" form-control-label">Name</label>
                                       <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $order->name) }}" placeholder="Enter item name">
                                     </div>
    
                                     <div class="col-md-3">
                                        <label for="image" class=" form-control-label">Image</label>
                                       <input id="image" type="file" name="image" onchange="previewImage(this)"
                                               class="form-control-file @error('image') is-invalid @enderror">

                                        @error('image')
                                             <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                     </div>

                                     <div class="col-md-3">
                                        <label for="quantity" class=" form-control-label">Quantity</label>
                                        <input id="quantity" type="text" class="form-control" name="quantity" value="{{ old('quantity', $order->quantity) }}" placeholder="Enter item quantity">
                                     </div>

                                     <div class="col-md-3">
                                        <label for="price" class=" form-control-label">Price</label>
                                        <input id="price" type="text" class="form-control" name="price" value="{{ old('price', $order->price) }}" placeholder="Enter item's price">
                                     </div>
                                     
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <label for="description" class=" form-control-label">Description</label>
                                            <textarea name="description"  cols="3" rows="5"
                                                      class="form-control @error('description') is-invalid @enderror">{{ old('description', $order->description) }}</textarea>
                                            @error('description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                 
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check-circle"></i> Edit Order
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
</div>

<script>

    function previewImage(input) {
        var file = input.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/jpg", "image/png"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
            $("#preview").attr('src', 'images/default.png');
            input.setAttribute("value", "");
            // $("#message").append("<p class='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg and png Images type allowed</span>");
        } else {
            var reader = new FileReader();
            reader.onload = function (e) {
                //  $("#message").empty();
                $('#preview').attr("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
    
@endsection

