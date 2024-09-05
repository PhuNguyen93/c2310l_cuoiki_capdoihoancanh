@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Slider -->
        <div id="imageSlider" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#imageSlider" data-bs-slide-to="0" class="active" aria-current="true"
                    aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#imageSlider" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#imageSlider" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/images/car1.jpg') }}" class="d-block w-100" alt="Image 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First Slide</h5>
                        <p>Description for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/images/car2.jpg') }}" class="d-block w-100" alt="Image 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second Slide</h5>
                        <p>Description for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/images/car4.jpg') }}" class="d-block w-100" alt="Image 3">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third Slide</h5>
                        <p>Description for the third slide.</p>
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
    </div>

    <!-- Product -->
    <div class="container mt-5">
        <div class="row">
            <!-- loop -->
            <div class="container mt-5">
                <div class="d-flex align-items-center justify-content-center">
                    <hr class="flex-grow-1 bg-dark border-0" style="height: 2px;">
                    <h1 class="mx-3 fw-bold">CARS</h1>
                    <hr class="flex-grow-1 bg-dark border-0" style="height: 2px;">
                </div>
                <div class="row">
                    <!-- Vòng lặp qua dữ liệu xe -->
                    @foreach ($vehicles as $vehicle)
                        <div class="col-md-4 mt-2">
                            <div class="card">
                                <!-- Hiển thị hình ảnh -->
                                <img src="{{ $vehicle->image ? asset('storage/' . $vehicle->image) : asset('assets/images/default-car.jpg') }}"
                                    class="card-img-top" alt="{{ $vehicle->vehicle_name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $vehicle->vehicle_name }}</h5>
                                    <p class="card-text"><strong>Rental Price:</strong> ${{ $vehicle->rental_price }}/day
                                    </p>
                                    <p class="card-text"><strong>Number of seats:</strong> {{ $vehicle->number_of_seats }}
                                    </p>
                                    <p class="card-text"><strong>License Plate:</strong> {{ $vehicle->license_plate }}</p>
                                    <a href="#" class="btn btn-primary">Rent</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <!-- About Us -->
    <div class="container my-5 bg-info-subtle p-5 rounded-4">
        <h1 class="text-center mb-4">Why Choose Us</h1>
        <p class="text-center mb-5">We prioritize your satisfaction and strive to make your car rental experience as
            seamless as possible. With our wide selection of well-maintained vehicles, competitive prices, and simple
            booking process, you can trust us to meet your needs. Our dedicated customer service team is available around
            the clock to assist you, ensuring that you receive the support you deserve. Whether you need a car for a weekend
            getaway or a long road trip, choose us for a hassle-free and enjoyable journey.</p>

        <div class="row g-4">
            <!-- Each service item -->
            <div class="col-md-4">
                <div class="service-box text-center">
                    <div class="service-icon">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <h5>Customer Support</h5>
                    <p>Our dedicated team is here to provide exceptional customer support whenever you need it.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-box text-center">
                    <div class="service-icon">
                        <i class="bi bi-cash"></i>
                    </div>
                    <h5>Best Price</h5>
                    <p>We guarantee the best prices for our rental cars, ensuring you get the most value for your money.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-box text-center">
                    <div class="service-icon">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <h5>Super Cars</h5>
                    <p>Experience the thrill of driving our top-of-the-line supercars that are sure to leave a lasting
                        impression.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-box text-center">
                    <div class="service-icon">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <h5>Free Cancellation</h5>
                    <p>Enjoy the flexibility of free cancellation, giving you peace of mind in case your plans change.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-box text-center">
                    <div class="service-icon">
                        <i class="bi bi-ui-checks"></i>
                    </div>
                    <h5>Easy Process</h5>
                    <p>Our streamlined process makes renting a car quick and effortless, saving you time and hassle.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-box text-center">
                    <div class="service-icon">
                        <i class="bi bi-laptop"></i>
                    </div>
                    <h5>Digital Services</h5>
                    <p>Take advantage of our convenient digital services, making your car rental experience even more
                        convenient and efficient.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5 bg-info-subtle p-5 rounded-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('assets/images/imgdemo2.jpg') }}" alt="Car Rental" class="img-fluid">
            </div>
            <div class="col-md-6">
                <div class="text-center mb-3">
                    <img src="{{ asset('assets/images/logo2.png') }}" alt="Logo" width="100">
                </div>
                <h2 class="fw-bold">Do you want to know more about BP Car Services?</h2>
                <p>BP Car Services connects customers with top-tier car rental services in Vietnam. With a wide range of
                    options, professional services, and reliability, we aim to build a civilized and trustworthy car rental
                    community.</p>
                <a href="#" class="btn btn-primary">Get More Information</a>
            </div>
        </div>
    </div>
@endsection
