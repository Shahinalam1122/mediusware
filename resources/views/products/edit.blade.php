@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
    </div>
   
    <?php
        use App\Models\ProductVariantPrice;
        use App\Models\Product; 

        //$product_name=  Product::find($product_variant_prices["product_id"]);

        //echo $product_name;
    ?>
<form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <section>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Product Name</label>
                            <input type="text" value="{{ $product->title }}" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Product SKU</label>
                            <input type="text" value="{{ $product->sku }}" name="sku"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea id="" cols="30" rows="4" name="description" class="form-control">{{ $product->description }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Media</h6>
                    </div>
                    <div class="card-body border">
                        <input type="file" name="photo" id="photo" />
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Variants</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Option</label>
                                    <select id="variant" name="variant" class="form-control">
                                        <option value="">Select your variant</option>
                                        <?php
                                            foreach ($variants as $value) {
                                        ?>

                                            <option value="{{ $value->id }}">{{ $value->title }}</option>
                                              
                                        <?php
                                            }
                                        ?>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label  
                                           class="float-right text-primary"
                                           style="cursor: pointer;">Remove</label>
                                    <label for="">.</label>
                                    <input v-model="item.tags" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Add another option</button>
                    </div>

                    <div class="card-header text-uppercase">Preview</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <td>Variant</td>
                                    <td>Price</td>
                                    <td>Stock</td>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        use App\Models\ProductVariant;
                                        $variant_name1="";
                                        $variant_name2="";
                                        $variant_name3="";

                                        //print_r($variant_name->variant);

                                        foreach ($product_variant_prices as $value) {
                                        
                                        //print_r($value);
                                       
                                            $variant_name1=ProductVariant::find($value->product_variant_one)->variant?? "";

                                            $variant_name2=ProductVariant::find($value->product_variant_two)->variant?? "";
                                       
                                            $variant_name3=ProductVariant::find($value->product_variant_three)->variant?? "";
                                      
                                        
                                    ?>
                                        
                                         
                                        <tr>
                                            <td>{{ $variant_name1 }}/{{ $variant_name2 }}/{{ $variant_name3 }}</td>

                                            <td>
                                                <input type="text" name="id[]" value="{{ $value->id }}" hidden/>
                                                <input type="text" name="price[]" class="form-control" value="{{ $value->price }}">
                                            </td>
                                            <td>
                                                <input type="text" name="stock[]" class="form-control" value="{{ $value->stock }}">
                                            </td>
                                        </tr>

                                    <?php   
                                        }    
                                    ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit"  class="btn btn-lg btn-primary">Update</button>
        <button type="button" class="btn btn-secondary btn-lg">Cancel</button>
    </section>
</form>
@endsection
