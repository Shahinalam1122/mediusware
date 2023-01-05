@extends('layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Products</h1>
</div>


<div class="card">
    <form action="/product" method="get" class="card-header">
        <div class="form-row justify-content-between">
            <div class="col-md-2">
                <input type="text" name="titlesearch" placeholder="Product Title" class="form-control">
            </div>
            <div class="col-md-2">
                <select name="variant" id="" class="form-control">
                    <option value="" selected>--Select a Variant--</option>

                    <?php

                    use Illuminate\Support\Facades\DB;

                    foreach ($variants as $value) {
                    ?>
                        <option value="{{ $value->id }}">{{ $value->title }}</option>
                    <?php
                    }
                    ?>

                    <?php
                    //foreach ($product_variants as $value) {
                    ?>
                        {{-- <option value="{{ $value->id }}">{{ $value->variant }}</option> --}}
                    <?php
                    //}
                    ?>
                </select>
            </div>

            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Price Range</span>
                    </div>
                    <input type="text" name="price_from" aria-label="First name" placeholder="From" class="form-control">
                    <input type="text" name="price_to" aria-label="Last name" placeholder="To" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <input type="date" name="date" placeholder="Date" class="form-control">
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary float-right"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>

    <div class="card-body">
        <div class="table-response">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Variant</th>
                        <th width="150px">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        foreach($products as $product){
                            $product_id=$product->id;
                    @endphp

                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title }} <br> Created at : {{ $product->created_at }}</td>
                        <td>{{ substr($product->description,0,50) }}</td>
                        <td>
                            <dl class="row mb-0" style="height: 80px; overflow: hidden" id="variant">

                                <dt class="col-sm-3 pb-0">

                                    <?php

                                    //  $variants= DB::Select("SELECT pv.id,pv.variant,v.title, pv.product_id FROM product_variants pv, variants v where v.id=pv.variant_id and product_id='$product_id'");

                                    $price=DB::select("SELECT pvp.price, pvp.stock FROM product_variant_prices pvp where product_id='$product_id';");

                                    $variants = DB::Select("SELECT a.variant color , b.variant size , c.variant style
                                        from product_variants a , product_variants b , product_variants c,variants v
                                        where a.variant_id='1'
                                        and b.variant_id='2'
                                        and c.variant_id='6'
                                        
                                        and v.id=a.variant_id                                                                       
                    
                                        and a.product_id='$product_id'
                                        and b.product_id='$product_id'
                                        and c.product_id='$product_id'");

                                    foreach ($variants as $key => $value) {
                                        echo $value->size . "/";
                                        echo $value->color . "/";
                                        echo $value->style . "<br>";
                                    }

                                     //print_r($price);
                                    ?>
                                </dt>
                                <dd class="col-sm-9">
                                    <dl class="row mb-0">
                                        
                                        <dt class="col-sm-4 pb-0"> <?php foreach ($price as $value) {
                                            echo "Price :".$value->price."<br>";
                                        }?></dt>
                                        <dd class="col-sm-8 pb-0"> <?php foreach ($price as $value) {
                                            echo "InStock :".$value->stock."<br>";
                                        }?></dd>
                                    </dl>
                                </dd>
                            </dl>
                            <button onclick="$('#variant').toggleClass('h-auto')" class="btn btn-sm btn-link">Show more</button>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('product.edit',$product->id) }}" class="btn btn-success">Edit</a>
                            </div>
                        </td>
                    </tr>
                    @php
                    }
                    @endphp

                </tbody>

            </table>
        
        </div>
       
    </div>

    <div class="card-footer">
        <div class="row justify-content-between">
            <div class="col-md-6">
                <p>Showing 1 to 10 out of 100</p>
            </div>
            <div class="col-md-2">

            </div>
        </div>
    </div>
</div>

@endsection