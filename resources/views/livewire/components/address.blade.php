<div>
    <div class="row d-flex justify-content-end  mb-5">
        <div class="col-3">
            <button wire:click="openCreateModal" class="btn btn-lg" style="background-color: #d6b446;">
                <i class="bi bi-plus"></i> New
            </button>
        </div>
    </div>
    <div class="row row--30">
        @if($addresses->count())
        @foreach ($addresses as $address)
            <div class="col-lg-6">
                <div class="address-info mb--40 border">
                    <div class="addrss-header d-flex align-items-center justify-content-between m-3">
                        {{-- <h5 class="title mb-0">Address {{ $loop->index + 1 }}</h5> --}}
                        <div class="col-3">
                            <button wire:click="setAsDefault({{ $address->id }})" class="btn btn-outline-primary btn-lg"
                                @disabled($address->active === 1)>
                                <span wire:loading.remove wire:target="setAsDefault({{ $address->id }})">Set as
                                    Default</span>
                                <span wire:loading wire:target="setAsDefault({{ $address->id }})"
                                    class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="d-flex">
                            <a wire:click="openUpdateModal({{ $address->id }})"
                                class="btn btn-outline-primary  me-3"><i class="far fa-edit"></i></a>
                            <a wire:click="delete({{ $address->id }})" class="btn btn-outline-danger ">
                                <i wire:loading.remove wire:target="delete({{ $address->id }})"
                                    class="far fa-trash text-danger"></i>
                                <span wire:loading wire:target="delete({{ $address->id }})"
                                    class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </a>
                        </div>

                    </div>
                    <ul class="address-details m-3">
                        <li>Name: {{ "$address->firstname $address->lastname" }}</li>
                        <li>Email: {{ $address->email }}</li>
                        <li>Phone: {{ $address->phone }}</li>
                        <li>Phone: {{ $address->phone }}</li>
                        <li class="mt--30">{{ $address->street }}</li>
                        <li>city: {{ $address->city }}</li>
                        <li>country: {{ $address->country }}</li>
                    </ul>
                </div>
            </div>
        @endforeach
        @else
        <div class="col-lg-12">
        <div class="alert alert-info" role="alert">
            No Address to Show Yet!
        </div>
        </div>
        @endif
        {{-- <div class="col-lg-6">
            <div class="address-info">
                <div class="addrss-header d-flex align-items-center justify-content-between">
                    <h4 class="title mb-0">Billing Address</h4>
                    <a href="#" class="address-edit"><i class="far fa-edit"></i></a>
                </div>
                <ul class="address-details">
                    <li>Name: Annie Mario</li>
                    <li>Email: annie@example.com</li>
                    <li>Phone: 1234 567890</li>
                    <li class="mt--30">7398 Smoke Ranch Road <br>
                        Las Vegas, Nevada 89128</li>
                </ul>
            </div>
        </div> --}}

    </div>



    <!-- Create Modal -->
    <div wire:ignore.self class="modal modal-lg fade" id="createModal" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Address</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3" style="padding-top: 30px; padding-bottom: 30px;">
                    <div class="axil-dashboard-account">
                        <form wire:submit="send" class="account-details-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input wire:model="firstname" type="text" class="form-control"
                                            placeholder="First Name">
                                        @error('firstname')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input wire:model="lastname" type="text" class="form-control"
                                            placeholder="Last Name">
                                        @error('lastname')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input wire:model="email" type="email" class="form-control"
                                            placeholder="name@example.com">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input wire:model="phone" type="text" class="form-control">
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Street Address</label>
                                        <input wire:model="street" type="text" class="form-control">
                                        @error('street')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input wire:model="city" type="text" class="form-control">
                                        @error('city')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb--40">
                                        <label>Country/ Region</label>
                                        <select wire:model="country" class="select2">
                                            <option value="uk">United Kindom (UK)</option>
                                            <option value="us">United States (USA)</option>
                                            <option value="u">United Arab Emirates (UAE)</option>
                                            <option value="1">Australia</option>
                                        </select>
                                        @error('country')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="form-group mb--0">
                                        <button type="submit" class="btn btn-lg" value="" style="background-color: #d6b446;">
                                            <span wire:loading.remove wire:target="send">Save</span>
                                            <span wire:loading wire:target="send"
                                                class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Create Modal -->



    <!-- Update Modal -->
    <div wire:ignore.self class="modal modal-lg fade" id="updateModal" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Address</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <div class="axil-dashboard-account">
                        <form wire:submit="update" class="account-details-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input wire:model="firstname" type="text" class="form-control"
                                            placeholder="First Name">
                                        @error('firstname')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input wire:model="lastname" type="text" class="form-control"
                                            placeholder="Last Name">
                                        @error('lastname')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input wire:model="email" type="email" class="form-control"
                                            placeholder="name@example.com">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input wire:model="phone" type="text" class="form-control">
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Street Address</label>
                                        <input wire:model="street" type="text" class="form-control">
                                        @error('street')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input wire:model="city" type="text" class="form-control">
                                        @error('city')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb--40">
                                        <label>Country/ Region</label>
                                        <select wire:model="country" class="select2">
                                            <option value="uk">United Kindom (UK)</option>
                                            <option value="us">United States (USA)</option>
                                            <option value="u">United Arab Emirates (UAE)</option>
                                            <option value="1">Australia</option>
                                        </select>
                                        @error('country')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group mb--0">
                                        <button type="submit" class="btn btn-primary" value="">
                                            <span wire:loading.remove wire:target="update">Save</span>
                                            <span wire:loading wire:target="update"
                                                class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Update Modal -->



    <script>
        window.addEventListener("openCreateModal", function(e) {
            $("#createModal").modal("show");
        });

        window.addEventListener("closeCreateModal", function(e) {
            $("#createModal").modal("hide");
        });

        window.addEventListener("openUpdateModal", function(e) {
            $("#updateModal").modal("show");
        });

        window.addEventListener("closeUpdateModal", function(e) {
            $("#updateModal").modal("hide");
        });


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
