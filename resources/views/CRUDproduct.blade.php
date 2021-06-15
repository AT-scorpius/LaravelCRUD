<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="container">
        <h1 style="color: orange;text-align: center">Admin Page</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Manage</h3>
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

                    </div>
                    <form action="{{ route('crud.search') }}" method="get">
                        <div class="col-md-6 mb-4">
                            <h4 class="panel-title" style="color: rgb(0, 153, 241)">Search</h4>
                            <div class="input-group md-form form-sm form-2 pl-0">
                                <input class="form-control my-0 py-1 amber-border" name="search" type="text"
                                    placeholder="What do you want to search for?" aria-label="Search" required>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>

                    </form>

                </div>
                <p></p>
                @if (isset($listSearch))
                    <div class="result-search">
                        <div style="color: orangered" class="notice-search"> <strong> Có {{ count($listSearch) }} Sản
                                Phẩm Được Tìm Thấy Với từ khóa "{{ $key }}" !</strong></div>

                    </div>
                    <p></p>
                    @if (count($listSearch) > 0)
                      
                            <div class="product-found">
                                <table class="table table-hover" id="dev-table">
                                    <thead>
                                        <tr>
                                            <th>ID product</th>
                                            <th>Name Product</th>
                                            <th>Manufacturer</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($listSearch as $product)
                                        <tr>
                                            <td>{{ $product['id'] }}</td>
                                            <td>{{ $product['product_name'] }}</td>
                                            <td>

                                                {{ $product->manufacturer->mf_name }}
                                            </td>
                                            <td>{{ $product['price'] }}</td>
                                            <td>{{ $product['quantity'] }}</td>
                                            <td>{{ $product['description'] }}</td>
                                            <td><img style="width:100px;height:70px"
                                                    src="{{ asset('images/') }}/{{ $product['image'] }}"
                                                    alt="fsf"></td>
                                            <td><button type="button" class="btn btn-success"
                                                    onclick="window.location='{{ route('crud.edit', $product['id']) }}'">Chỉnh
                                                    Sửa
                                                </button>
                                            </td>

                                            <td>
                                                <form action="{{ route('crud.destroy', $product['id']) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button name="delete" class="btn btn-danger"
                                                        type="submit">Xóa</button>
                                                </form>
                                            <td>
                                            </td>
                                        </tr>
                    @endforeach
                    </tr>

                    </tbody>
                    </table>
                @endif


            </div>
            @endif
            <p></p>
        </div>

        <p>
            <button class="btn btn-outline-success" data-toggle="collapse" href="#collapseExample" role="button"
                aria-expanded="false" aria-controls="collapseExample">
                Create Product
            </button>
        </p>
        <div class="collapse" id="collapseExample">
            <form class="needs-validation" enctype="multipart/form-data" method="POST" role="form"
                action="{{ route('crud.store') }}">
                {{--  --}}
                @csrf
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="product_name">Product's name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name"
                            placeholder="Enter name of product..." value="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="quantity">Price</label>
                        <div class="input-group">

                            <input type="number" class="form-control" id="price" placeholder="price" name="price"
                                aria-describedby="inputGroupPrepend">
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
                                name="quantity" aria-describedby="inputGroupPrepend">

                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="select_Mf">Chọn Hãng Xe</label>
                        <select multiple class="form-control" id="select_Mf" name="select_Mf">
                            @foreach ($mf as $o_mf)
                                <option value="{{ $o_mf['id'] }}">{{ $o_mf['mf_name'] }}</option>
                            @endforeach
                            {{-- @foreach ($products as $product)
                                            <option value="{{ $product->manufacturer->id }}">
                                                {{ $product->manufacturer->mf_name }}</option>
                                        @endforeach --}}
                        </select>
                    </div>s
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image_file">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="image">Description</label>
                        <textarea class="form-control" id="description" rows="3" name="description"> </textarea>
                    </div>
                </div>
                <button class="btn btn-outline-primary btn-sm" type="submit">Save</button>
            </form>
            <p></p>
        </div>

    </div>

    </div>
    <table class="table table-hover" id="dev-table">
        <thead>
            <tr>
                <th>ID product</th>
                <th>Name Product</th>
                <th>Manufacturer</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($products as $product)
            <tr>
                <td>{{ $product['id'] }}</td>
                <td>{{ $product['product_name'] }}</td>
                <td>
                    {{-- @foreach ($mf as $o_mf)
                                @if ($o_mf['id'] == $product['mf_id'])
                                    {{ $o_mf['mf_name'] }}
                                @endif
                            @endforeach --}}
                    {{ $product->manufacturer->mf_name }}
                </td>
                <td>{{ $product['price'] }}</td>
                <td>{{ $product['quantity'] }}</td>
                <td>{{ $product['description'] }}</td>
                <td><img style="width:100px;height:70px" src="{{ asset('images/') }}/{{ $product['image'] }}"
                        alt="fsf"></td>
                <td><button type="button" class="btn btn-success"
                        onclick="window.location='{{ route('crud.edit', $product['id']) }}'">Chỉnh Sửa
                    </button>
                </td>

                <td>
                    <form action="{{ route('crud.destroy', $product['id']) }}" method="post">
                        @csrf
                        @method('delete')
                        <button name="delete" class="btn btn-danger" type="submit">Xóa</button>
                    </form>
                <td>
                </td>
            </tr>
            @endforeach
            </tr>

        </tbody>
    </table>
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
    <!------ Include the above in your HEAD tag ---------->
</body>

</html>
