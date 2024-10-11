<main class="main-wrapper">
    <!-- Start Breadcrumb Area  -->
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">Contact</li>
                        </ul>
                        <h1 class="title">Contact With Us</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                    <div class="inner">
                        <div class="bradcrumb-thumb">
                            <img src="/web/assets/images/product/product-45.png" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->

    <!-- Start Contact Area  -->
    <div class="axil-contact-page-area axil-section-gap">
        <div class="container">
            <div class="axil-contact-page">
                <div class="row row--30">
                    <div class="col-lg-8">
                        <div class="contact-form">
                            <h3 class="title mb--10">We would love to hear from you.</h3>
                            <p>If you’ve got great products your making or looking to work with us then drop us a line.
                            </p>
                            <form wire:submit="send" id="contact-form">
                                <div class="row row--10">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="contact-name">Name <span>*</span></label>
                                            <input wire:model="name" type="text" name="contact-name"
                                                id="contact-name">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="contact-email">E-mail <span>*</span></label>
                                            <input wire:model="email" type="email" name="contact-email"
                                                id="contact-email">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="contact-phone">Subject <span>*</span></label>
                                            <input wire:model="subject" type="text" name="contact-phone"
                                                id="contact-phone">
                                            @error('subject')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-message">Your Message</label>
                                            <textarea wire:model="message" name="contact-message" id="contact-message" cols="1" rows="2"></textarea>
                                            @error('message')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb--0">
                                            <button name="submit" type="submit" id="submit"
                                                class="axil-btn btn-bg-primary" wire:loading.attr="disabled" wire:target="send">
                                               <span wire:loading.remove wire:target="send">Send Message</span>
                                               <span wire:loading wire:target="send" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-location mb--40">
                            <h4 class="title mb--20">Our Store</h4>
                            <span class="address mb--20">2750 FM 1463 Road,
                                Suite 150-233 Katy Tx 77494,
                                United States.
                                of America</span>
                            <span class="phone">Phone: +1 713 820 7857</span>
                            <span class="email">Email: Hello@etrade.com</span>
                        </div>
                        <div class="opening-hour">
                            <h4 class="title mb--20">Opening Hours:</h4>
                            <p>Monday to Saturday: 10am - 5pm
                                <br> Sundays: 10am - 4pm
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Google Map Area  -->
            <div class="axil-google-map-wrap axil-section-gap pb--0">
                <div class="mapouter">
                    <div class="gmap_canvas">
                        {{-- <iframe width="1080" height="500" id="gmap_canvas"
                            src="https://maps.google.com/maps?q=melbourne&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe> --}}
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3463.9159643711905!2d-95.85493512424073!3d29.751145175072608!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86412380bef7c8d7%3A0xca2dbf085decb096!2s2750%20FM%201463%20150%20233%2C%20Katy%2C%20TX%2077494%2C%20USA!5e0!3m2!1sen!2sng!4v1726945075635!5m2!1sen!2sng" width="1080" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" id="gmap_canvas"></iframe>
                    </div>
                </div>
            </div>
            <!-- End Google Map Area  -->
        </div>
    </div>
    <!-- End Contact Area  -->

    <script>
        window.addEventListener("message", function(e) {

            let data = e.detail;

            console.log(data);

            Swal.fire({
                title: data.title,
                text: data.text,
                icon: data.icon,
                showCancelButton: true,
                confirmButtonText: 'Go To Product',
                cancelButtonText: 'Close'
            }).then((result) => {
                 if (result.isConfirmed) {
                     // Redirect to the URL
                     //  window.location.href = data.redirectUrl;
                 }
            });

        });
    </script>
</main>
