<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 style="text-align: center;color: orangered">Trang Sửa Thông Tin Sản Phẩm</h1>
        <div class="content" style="margin-top:100px;">
            <div class="notice">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

            </div>
            <form class="needs-validation" enctype="multipart/form-data" method="POST" role="form"
                action="{{ route('crud.update', $product['id']) }}">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="product_name">Product's name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name"
                            placeholder="Enter name of product..." value="{{ $product['product_name'] }}">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="quantity">Price</label>
                        <div class="input-group">

                            <input type="number" class="form-control" id="price" placeholder="price" name="price"
                                aria-describedby="inputGroupPrepend" value="{{ $product['price'] }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="currency">.000 VNĐ</span>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="quantity">Quantity</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="sl">?</span>
                            </div>
                            <input type="number" class="form-control" id="quantity" placeholder="Quantity"
                                name="quantity" aria-describedby="inputGroupPrepend"
                                value="{{ $product['quantity'] }}">

                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="select_Mf">Chọn Hãng Xe</label>
                        <select multiple class="form-control" id="select_Mf" name="select_Mf">
                            @foreach ($mf as $o_mf)
                            <option value="{{ $o_mf['id']  }}">{{ $o_mf['mf_name'] }}</option>
                        @endforeach
                            {{-- @foreach ($product as $val)
                                <option value="{{ $val->manufacturer->id }}">
                                    {{ $val->manufacturer->mf_name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image_file" value="{{ asset('images/') }}/{{ $product['image'] }}">
                        <p></p>
                        <p><Strong>Old Image: </Strong><img style="width:100px;height:70px"
                                src="{{ asset('images/') }}/{{ $product['image'] }}" alt="fsf"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="image">Description</label>
                        <textarea class="form-control" id="description" rows="3"
                            name="description">{{ $product['description'] }}</textarea>
                    </div>
                </div>
                <button class="btn btn-outline-primary btn-sm" type="submit">Update Thông Tin Sản Phẩm</button>
            </form>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
