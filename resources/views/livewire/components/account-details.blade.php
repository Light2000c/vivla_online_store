<div>
    <div class="axil-dashboard-account">
        <form wire:submit="update" class="account-details-form">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input wire:model="name" type="text" class="form-control">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input wire:model="email" type="email" class="form-control">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <h5 class="title">Password Change</h5>
                    <div class="form-group">
                        <label>Password</label>
                        <input wire:model="current_password" type="password" class="form-control"
                            placeholder="Current Password">
                        @error('current_password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input wire:model="password" type="password" class="form-control" placeholder="New Password">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input wire:model="password_confirmation" type="password" class="form-control"
                            placeholder="Re-Enter Password">
                    </div>
                    <div class="form-group mb--0">
                        <button  type="submit" class="btn btn-primary axil-btn">
                            <span wire:loading.remove wire:target="update">Save Change</span>
                            <span wire:loading wire:target="update" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

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
