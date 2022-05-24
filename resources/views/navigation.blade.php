<header class="global-header">
    <section class="container">
        <div class="row">
            <div class="col-lg-2">
                <a class="logo-branch" href="/">
                    <img width="120px" class="mt-1 mb-1" src="https://www.cars.com/images/logo_cars-46214ae902ff93ba8fa2e40fb73dfa02.png?vsn=d"/>
                </a>
            </div>
            <div class="col-lg-10">
                <nav class="nav-item">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/">Cars for Sale</a></li>
                        <li><a href="/">Research & Reviews</a></li>
                        <li><a href="/">News & Videos</a></li>
                        <li><a href="/">Sell Your Car</a></li>
                        <li><a href="/">Service & Repair</a></li>
                        @php
                            $cartSession = Session::get('cart') ?? [];
                        @endphp
                        <li class="float-right"><a href="/cart">Shoping Cart (<span class="text-danger">{{ count($cartSession) }}</span>)</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</header>
<section class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="banner-top mt-1 mb-2">
                <img src="https://platform.cstatic-images.com/ad-creative/c3323f05-5a12-4bdb-9982-74a38a2f67a9/20220325_cars_spring_hero_2020_cl.jpg"/>
            </div>
        </div>
        @if(session()->has('notify'))
            <div class="col-lg-12">
            <div class="alert alert-primary alert-dismissible fade show mt-2" role="alert">
                <strong class="text-uppercase">[{{ session()->get('notify')['status'] }}]</strong> {{ session()->get('notify')['message'] }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            </div>
            <script>
                setTimeout(()=>{
                    $('.alert').hide();
                },3000);
            </script>
        @endif
    </div>
</section>
