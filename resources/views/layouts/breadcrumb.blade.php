<div class="breadcrumb-bar text-center" data-aos="fade-down" data-aos-duration="1000">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title mb-2">{{ $title ?? 'Default Title' }}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb ?? 'Default Breadcrumb' }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
