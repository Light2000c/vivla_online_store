 <div class="page-body">
     <div class="container-fluid">
         <div class="page-title">
             <div class="row">
                 <div class="col-sm-6 ps-0">
                     <h3>Account</h3>
                 </div>
                 <div class="col-sm-6 pe-0">
                     <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="index.html">
                                 <svg class="stroke-icon">
                                     <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                 </svg></a></li>
                         <li class="breadcrumb-item active">Edit Profile</li>
                     </ol>
                 </div>
             </div>
         </div>
     </div>
     <!-- Container-fluid starts-->
     <div class="container-fluid">
         <div class="row">
             <div class="col-12 box-col-8">
                 <div class="card">
                     <div class="job-search">
                         <div class="card-body pb-0">
                           
                             <div class="job-description">
                                 <h3 class="mb-0">Personal Details </h3>
                                 <form wire:submit="update" class="form theme-form">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary" type="button" wire:loading.attr="disabled" wire:target="update">
                                           <span wire:loading.remove wire:target="update">Save Change</span>
                                           <span wire:loading wire:target="update" class="spinner-border spinner-border-sm"
                                               role="status" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                     <div class="row">
                                         <div class="col">
                                             <div class="mb-3">
                                                 <label class="form-label" for="exampleFormControlInput1">Full
                                                     Name:<span class="font-danger">*</span></label>
                                                 <input wire:model="name" class="form-control" id="exampleFormControlInput1"
                                                     type="text" placeholder="Enter your full name">
                                                     @error("name")
                                                     <small class="text-danger">{{ $message }}</small>
                                                     @enderror
                                             </div>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col">
                                             <div class="mb-3">
                                                 <label class="form-label" for="exampleFormControlInput3">Email:<span
                                                         class="font-danger">*</span></label>
                                                 <input wire:model="email" type="email" class="form-control" id="exampleFormControlInput3"
                                                     type="email" placeholder="Enter email">
                                                     @error("email")
                                                     <small class="text-danger">{{ $message }}</small>
                                                     @enderror
                                             </div>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col">
                                             <div class="mb-3">
                                                 <label class="form-label"
                                                     for="exampleFormControlpassword">Old Password:<span
                                                         class="font-danger">*</span></label>
                                                 <input wire:model="current_password" class="form-control" id="exampleFormControlpassword"
                                                     type="password" placeholder="Old Password">
                                                     @error("current_password")
                                                     <small class="text-danger">{{ $message }}</small>
                                                     @enderror
                                             </div>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col">
                                             <div class="mb-3">
                                                 <label class="form-label"
                                                     for="exampleFormControlpassword">New Password:<span
                                                         class="font-danger">*</span></label>
                                                 <input wire:model="password" class="form-control" id="exampleFormControlpassword"
                                                     type="password" placeholder="Enter password">
                                                     @error("password")
                                                     <small class="text-danger">{{ $message }}</small>
                                                     @enderror
                                             </div>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col">
                                             <div class="mb-3">
                                                 <label class="form-label" for="exampleFormControlpassword1">Repeat New
                                                     Password:<span class="font-danger">*</span></label>
                                                 <input wire:model="password_confirmation" class="form-control" id="exampleFormControlpassword1"
                                                     type="password" placeholder="Repeat New password">
                                             </div>
                                         </div>
                                     </div>
                                 </form>
                             </div>
                         </div>
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
