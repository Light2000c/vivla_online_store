<!-- Page Sidebar Ends-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Carts</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="/web1/assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Carts</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid basic_table">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header ">
                        <h3>Carts Table</h3>
                    </div>

                    <div class="align-self-end search-form m-3">
                        <input wire:model.live.debounce.150ms="search" type="text" placeholder="Search here...">
                    </div>
                    <div class="table-responsive custom-scrollbar mt-2">
                        <table class="table">
                            <thead>
                                <tr class="border-bottom-primary">
                                    <th scope="col"></th>
                                    <th scope="col">Id</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Created_at</th>
                                    <th scope="col">Updated_at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                    <tr class="border-bottom-secondary">
                                        <th>
                                            <input class="form-check-input" wire:model="selectedItems" type="checkbox"
                                                id="checkbox-{{ $cart->id }}" value="{{ $cart->id }}">
                                        </th>
                                        <th scope="row">{{ $cart->id }}</th>
                                        <td>{{ $cart->user->name }}</td>
                                        <td>{{ $cart->product->name }}</td>
                                        <td>{{ $cart->quantity }}</td>
                                        <td> <img class="img-30 me-2"
                                                src="/products/{{ $cart->product->image }}" alt="profile"></td>
                                        <td>{{ $cart->product->price }}</td>
                                        <td>{{ $cart->product->price * $cart->quantity }}</td>
                                        <td>{{ $cart->created_at }}</td>
                                        <td>{{ $cart->updated_at }}</td>
                                        <td>
                                            <div>
                                                <div class="">
                                                    <button wire:click="delete({{ $cart->id }})"
                                                        class="btn btn-danger btn-sm" type="submit" wire:loading.attr="disabled" wire:target="delete({{ $cart->id }})">
                                                        <i wire:loading.remove
                                                            wire:target="delete({{ $cart->id }})"
                                                            class="bi bi-trash3-fill"></i>
                                                        <span wire:loading wire:target="delete({{ $cart->id }})"
                                                            class="spinner-border spinner-border-sm"
                                                            aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="m-2">
                        {{ $carts->withQueryString()->links() }}
                    </div>
                    <div class="align-self-start m-3">
                        <button wire:click="deleteSelected" class="btn btn-primary" type="submit" wire:loading.attr="disabled" wire:target="deleteSelected">
                            <span wire:loading.remove wire:target="deleteSelected">Delete Selected</span>
                            <span wire:loading wire:target="deleteSelected" class="spinner-border spinner-border-sm"
                                aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- Container-fluid Ends-->

    <script>
        window.addEventListener('message', function(e) {

            let data = e.detail;

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: data.icon,
                title: data.title
            });

        });
    </script>
</div>
