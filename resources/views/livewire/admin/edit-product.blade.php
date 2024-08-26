<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Add Product</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="/web/assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Products</li>
                        <li class="breadcrumb-item active">Edit Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card mt-5">
                    <div class="card-header pb-0 mb-4">
                        <h3>Edit Product > {{ $this->name }}</h3>
                    </div>
                    <div class="card-body add-post">

                        @error('message')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror

                        <form class="row" wire:submit="update">
                            <div class="col-12 col-sm-6">
                                <div>
                                    <img class="img-fluid" src="/storage/products/{{ $display_image }}" alt="">
                                </div>
                                <div class="col-12 col-lg-12 mb-3">
                                    <label for="validationCustom01">Image</label>
                                    <input wire:model="image" class="form-control" type="file"
                                        placeholder="Product Name">
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12 col-lg-12 mb-3">
                                    <label class="form-label" for="exampleFormControlTextarea1">Description</label>
                                    <textarea wire:model="description" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="col-12 col-lg-12 mb-3">
                                    <label for="validationCustom01">Name</label>
                                    <input wire:model="name" class="form-control" id="validationCustom01"
                                        type="text" placeholder="Product Name">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12 col-lg-12 mb-3">
                                    <label for="validationCustom01">Price</label>
                                    <input wire:model="price" class="form-control" id="validationCustom01"
                                        type="number" placeholder="Product Price">
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12 col-lg-12 mb-3">
                                    <label for="validationCustom01">Quantity</label>
                                    <input wire:model="quantity" class="form-control" id="validationCustom01"
                                        type="number" placeholder="Quantity">
                                    @error('quantity')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12 col-lg-12 mb-3">
                                    <label for="validationCustom01">Discount(Optional)</label>
                                    <input wire:model="discount" class="form-control" id="validationCustom01"
                                        type="number" placeholder="Discount">
                                    @error('discount')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12 col-lg-12 mb-3">
                                    <label for="validationCustom01">Brand (Optional)</label>
                                    <input wire:model="brand" class="form-control" id="validationCustom01"
                                        type="text" placeholder="Product Name">
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12 col-lg-12 mb-3">
                                    <label for="validationCustom01">Category</label>
                                    <select wire:model="category" class="form-select">
                                        <option selected="" disabled="" value="">Select Category
                                        </option>
                                        <option value="shirt">Shirt</option>
                                        <option value="bag">Bag</option>
                                        <option value="shoe">Shoe</option>
                                    </select>
                                    @error('category')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12 col-lg-12 mb-3">
                                    <label for="validationCustom01">Category</label>
                                    <select wire:model="category" class="form-select">
                                        <option selected="" disabled="" value="">Select Category
                                        </option>
                                        <option value="shirt">Shirt</option>
                                        <option value="bag">Bag</option>
                                    </select>
                                    @error('category')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12 col-lg-12 mb-3">
                                    <label for="validationCustom01">Tag (Optional)</label>
                                    <select wire:model="tag" class="form-select" id="validationTooltip04">
                                        <option selected="" value="">Select Product Tag</option>
                                        <option value="new">New</option>
                                        <option value="fresh">Fresh</option>
                                    </select>
                                    @error('tag')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            
                      
                            <div class="btn-showcase text-end">
                                <button type="submit" class="btn btn-primary" type="submit">
                                    <span wire:loading.remove  wire:target="update">Save Changes</span>
                                    <div wire:loading wire:target="update">
                                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                        <span role="status">Loading...</span>
                                    </div>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <script>
        window.addEventListener("showItems", function(e) {
            $("#itemModal").modal("show");
        });


        window.addEventListener("message", function(e) {

            let data = e.detail;

            console.log(data);

             Swal.fire({
                 title: data.title,
                 text: data.text,
                 icon: data.icon,
             });


        });
    </script>
</div>
