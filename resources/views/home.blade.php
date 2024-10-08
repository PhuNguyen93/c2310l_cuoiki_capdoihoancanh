@extends('layouts.app')

@section('content')

<div class="container"> @if(session('success')) <div class="alert alert-success"> {{ session('success') }} </div> @endif


<!-- Slider -->
<div id="imageSlider" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#imageSlider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#imageSlider" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#imageSlider" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('assets/images/car1.jpg') }}" class="d-block w-100 rounded" alt="Image 1">
            <div class="carousel-caption d-none d-md-block">
                <h5>Explore the Journey</h5>
                <p>Experience luxury and comfort on every road.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('assets/images/car2.jpg') }}" class="d-block w-100 rounded" alt="Image 2">
            <div class="carousel-caption d-none d-md-block">
                <h5>Unleash Performance</h5>
                <p>Feel the power of our high-performance vehicles.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('assets/images/car4.jpg') }}" class="d-block w-100 rounded" alt="Image 3">
            <div class="carousel-caption d-none d-md-block">
                <h5>Travel in Style</h5>
                <p>Your journey deserves the best aesthetics.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#imageSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#imageSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<style>
    .carousel-caption {
        background-color: rgba(0, 0, 0, 0.7);
        border-radius: 15px;
        padding: 20px;
    }

    h5 {
        font-family: 'Arial', sans-serif;
        font-weight: bold;
    }

    p {
        font-family: 'Arial', sans-serif;
    }
</style>

<!-- Product Section -->
<!-- Product Section -->
<div class="container mt-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">CARS FOR RENT</h1>
        <hr class="my-4">
        <p class="lead">Find your perfect rental car from our wide selection!</p>
    </div>
    <div class="row">

        @foreach ($vehicles as $vehicle)
        @if ($vehicle->status === 'Available')
            <div class="col-md-4 mb-4 d-flex justify-content-center">
                <div class="card shadow-sm transition-effect" style="width: 100%;">
                    <img src="{{ $vehicle->image ? asset('storage/' . $vehicle->image) : asset('assets/images/default-car.jpg') }}" class="card-img-top uniform-image" alt="{{ $vehicle->vehicle_name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $vehicle->vehicle_name }}</h5>
                        <p class="card-text"><strong>Rental Price:</strong> ${{ number_format($vehicle->rental_price, 2) }}/day</p>
                        <p class="card-text"><strong>License Plate:</strong> {{ $vehicle->license_plate }}</p>
                        <a href="{{ route('checkout', ['vehicleId' => $vehicle->id]) }}" class="btn btn-success">Rent Now</a>
                    </div>
                </div>
            </div>
        @endif
    @endforeach


    </div>
</div>

<!-- Why Choose Us Section -->
<div class="container my-5 p-5 bg-light rounded-3 shadow-lg">
    <h1 class="text-center mb-4 text-info">Why Choose Us</h1>
    <p class="text-center mb-5 text-secondary">
        We prioritize your satisfaction and strive to make your car rental experience as seamless as possible.
        With our wide selection of well-maintained vehicles, competitive prices, and simple booking process,
        you can trust us to meet your needs. Our dedicated customer service team is available around the clock
        to assist you, ensuring that you receive the support you deserve. Whether you need a car for a weekend
        getaway or a long road trip, choose us for a hassle-free and enjoyable journey.
    </p>

    <div class="row text-center g-4">
        @foreach([
            ['icon' => 'bi-person-fill', 'title' => 'Customer Support', 'description' => 'Exceptional customer support whenever you need it.'],
            ['icon' => 'bi-cash', 'title' => 'Best Price', 'description' => 'We guarantee the best prices for rental cars.'],
            ['icon' => 'bi-speedometer2', 'title' => 'Super Cars', 'description' => 'Experience the thrill of driving top-of-the-line supercars.'],
            ['icon' => 'bi-arrow-repeat', 'title' => 'Free Cancellation', 'description' => 'Enjoy the flexibility of free cancellation.'],
            ['icon' => 'bi-ui-checks', 'title' => 'Easy Process', 'description' => 'Renting a car is quick and effortless.'],
            ['icon' => 'bi-laptop', 'title' => 'Digital Services', 'description' => 'Convenience at your fingertips with digital services.'],
        ] as $service)
            <div class="col-md-4 d-flex">
                <div class="service-box p-4 bg-white border border-info rounded shadow-sm d-flex flex-column align-items-center">
                    <i class="{{ $service['icon'] }} fs-2 mb-3 text-info"></i>
                    <h5 class="mt-3 text-info">{{ $service['title'] }}</h5>
                    <p class="text-secondary mb-0">{{ $service['description'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Information Section -->
<div class="container my-5 p-5 bg-info rounded-3 text-light shadow-lg">
    <div class="row align-items-center">
        <div class="col-md-6">
            <img src="{{ asset('assets/images/imgdemo2.jpg') }}" alt="Car Rental" class="img-fluid rounded-circle transition-effect">
        </div>
        <div class="col-md-6">
            <div class="text-center mb-4">
                <img src="{{ asset('assets/images/logo2.png') }}" alt="Logo" width="100">
            </div>
            <h2 class="text-light fw-bold">Learn More About BP Car Services</h2>
            <p>
                BP Car Services connects you with top-tier car rentals in Vietnam. We aim to build a trustworthy rental
                community with a wide range of options.
            </p>
            <a href="#" class="btn btn-light text-info">Get More Information</a>
        </div>
    </div>
</div>

<style>
    .transition-effect {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .transition-effect:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .uniform-image {
        height: 200px; /* Đặt chiều cao đồng nhất cho hình ảnh */
        object-fit: cover; /* Đảm bảo hình ảnh không bị méo */
    }

    /* Cải thiện kiểu card */
    ..card {
    border: none; /* Loại bỏ viền thẻ */
    border-radius: 15px; /* Bo tròn góc thẻ */
    overflow: hidden; /* Ẩn phần vượt ra ngoài */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Thêm bóng đổ */
    transition: transform 0.2s, box-shadow 0.2s; /* Hiệu ứng chuyển tiếp */
}

.card:hover {
    transform: translateY(-5px); /* Nâng thẻ lên khi hover */
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2); /* Tăng bóng khi hover */
}

.card-title {
    font-weight: bold; /* Làm đậm tiêu đề */
    color: #007BFF; /* Màu sắc cho tiêu đề */
}

.card-text {
    color: #333; /* Màu sắc cho mô tả */
}

/* Cải thiện khoảng cách và căn giữa */
.card-body {
    padding: 20px; /* Tăng padding */
    text-align: center; /* Căn giữa nội dung */
}

/* Nút Rent Now */
.btn-success {
    background-color: #28a745; /* Màu sắc nút */
    border-color: #28a745; /* Biên nút */
    transition: background-color 0.3s, transform 0.3s; /* Hiệu ứng chuyển tiếp */
}

.btn-success:hover {
    background-color: #218838; /* Màu sắc nút khi hover */
    transform: scale(1.05); /* Tăng kích thước nút khi hover */
}
</style>
@endsection
