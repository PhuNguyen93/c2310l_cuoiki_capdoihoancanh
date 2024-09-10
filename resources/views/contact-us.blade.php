@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row text-center g-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <img src="https://via.placeholder.com/50" alt="Location Icon" class="mb-3">
                    <h5 class="card-title">Address</h5>
                    <p class="card-text">3A Tan Tien</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <img src="https://via.placeholder.com/50" alt="Email Icon" class="mb-3">
                    <h5 class="card-title">Mail Us</h5>
                    <p class="card-text">nguyenphu0809@gmail.com</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <img src="https://via.placeholder.com/50" alt="Phone Icon" class="mb-3">
                    <h5 class="card-title">Telephone</h5>
                    <p class="card-text">0367777747</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <img src="https://via.placeholder.com/50" alt="Website Icon" class="mb-3">
                    <h5 class="card-title">Website</h5>
                    <p class="card-text">aaaaa.com</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="card-title text-primary">Send Your Message</h4>
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Your Name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" class="form-control" placeholder="Your Email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Your Phone">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Your Project">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Subject">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="4" placeholder="Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <div class="list-group-item border-0 shadow-sm mb-3">
                    <h5 class="mb-1">Our Branch 01</h5>
                    <p class="mb-1"><strong>Address:</strong> 3A Tan Tien</p>
                    <p><strong>Telephone:</strong>0367777747</p>
                </div>
            </div>

            <div class="d-flex justify-content-center align-items-center mt-4">
                <a href="#" class="btn btn-primary rounded-circle me-2"><i class="bi bi-facebook"></i></a>
                <a href="#" class="btn btn-primary rounded-circle me-2"><i class="bi bi-twitter"></i></a>
                <a href="#" class="btn btn-primary rounded-circle me-2"><i class="bi bi-instagram"></i></a>
                <a href="#" class="btn btn-primary rounded-circle me-2"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection
