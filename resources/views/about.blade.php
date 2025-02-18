<x-site>
    <section class="page-title" style="background-image: url({{ asset('images/background/page-title-bg.png') }});">
        <div class="auto-container">
            <div class="title-outer text-center">
                <h1 class="title">About us</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li>About</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="about-section-three" id="about">
        <div class="anim-icons d-none d-xl-block">
            <span class="icon icon-dots-2 bounce-y"></span>
        </div>
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-md-8 wow fadeInRight" data-wow-delay="600ms">
                    <div class="inner-column">
                        <div class="sec-title">
                            <span class="sub-title">About Our Company</span>
                            <p>Technical Services and Equipment Solutions Ltd (TSES) is a forward-thinking IT and renewable energy solutions company dedicated to designing, building, and implementing bespoke technology solutions for organizations across various industries. With a commitment to innovation and efficiency, we specialize in customized IT infrastructure, advanced security systems, and high-performance renewable energy solutions tailored to meet the unique needs of our clients.</p>

                            <p>At TSES, we integrate cutting-edge cloud computing, cybersecurity, and enterprise networking with sustainable solar power systems to create intelligent, energy-efficient, and secure environments. Our team of highly skilled engineers and technical experts work closely with businesses, government agencies, and institutions to develop tailored solutions in ICT infrastructure, data center migration, system server management, smart surveillance, access control, and clean energy integration.</p>

                            <p>We take pride in our ability to deliver scalable and sustainable solutions that drive operational efficiency, energy independence, and digital transformation. Our experience spans multiple sectors, including government, defense, education, finance, and telecommunications, with a track record of successful projects for organizations such as the Nigerian Navy, Maritime Academy of Nigeria, government agencies, private and public organisations, banks, and individuals</p>

                            <p>With TSES, organizations gain a reliable technology and energy partner that delivers custom-engineered solutions from project design and implementation to ongoing maintenance and support—ensuring long-term value, security, and sustainability.</p>
                        </div>
                    </div>
                </div>

                <div class="image-column col-md-4">
                    <div class="inner-column wow fadeInLeft">
                        <figure class="image-1 overlay-anim wow fadeInUp"><img src="{{ asset('images/resource/about-3.jpg') }}" alt></figure>
                        <figure class="image-2 overlay-anim wow fadeInRight"><img src="{{ asset('images/resource/about-4.jpg') }}" alt></figure>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="{{ asset('js/jquery.countdown.js') }}"></script>
        <script src="{{ asset('js/mixitup.js') }}"></script>
    @endpush
</x-site>
