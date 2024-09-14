@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Checkout</h1>

    <div class="card">
        <div class="card-body">
        <h5 class="card-title text-center">{{ $vehicle->vehicle_name }}</h5>
            <p class="card-text"><strong>License Plate:</strong> {{ $vehicle->license_plate }}</p>
            <p class="card-text"><strong>Rental Price:</strong> ${{ number_format($vehicle->rental_price, 2) }}</p>

            @if($vehicle->image)
                <img src="{{ asset('storage/' .$vehicle->image) }}" class="img-fluid" alt="Vehicle Image">
            @endif

            <form action="{{ route('processCheckout') }}" method="POST">
                @csrf
                <input type="hidden" name="vehicleId" value="{{ $vehicle->id }}">

                <div class="form-row mt-3">
                    <div class="form-column">
                        <div class="form-group">
                            <label for="recipientName"><i class="fas fa-user"></i> Recipient Name</label>
                            <input type="text" class="form-control" id="recipientName" name="recipientName" required>
                        </div>
                        <div class="form-group">
                            <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="pickupDate"><i class="fas fa-calendar-alt"></i> Pickup Date</label>
                            <input type="date" class="form-control" id="pickupDate" name="pickupDate" required>
                        </div>
                    </div>

                    <div class="form-column">
                        <div class="form-group">
                            <label for="dropoffDate"><i class="fas fa-calendar-check"></i> Dropoff Date</label>
                            <input type="date" class="form-control" id="dropoffDate" name="dropoffDate" required>
                        </div>
                        <div class="form-group">
                            <label for="pickupLocation"><i class="fas fa-map-marker-alt"></i> Pickup Location</label>
                            <input type="text" class="form-control" id="pickupLocation" name="pickupLocation" required>
                        </div>
                        <div class="form-group">
                            <label for="dropoffLocation"><i class="fas fa-map-marker-alt"></i> Dropoff Location</label>
                            <input type="text" class="form-control" id="dropoffLocation" name="dropoffLocation" required>
                        </div>
                        <div class="form-group">
                            <label for="paymentMethod"><i class="fas fa-credit-card"></i> Payment Method</label>
                            <select class="form-control" id="paymentMethod" name="paymentMethod" required>
                                <option value="cash">Cash</option>
                                <option value="local_card">Local Card</option>
                                <option value="visa">Visa</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="totalPrice"><i class="fas fa-dollar-sign"></i> Total Price</label>
                    <input type="text" class="form-control" id="totalPrice" name="totalPrice" readonly>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url('/') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pickupDateInput = document.getElementById('pickupDate');
        const dropoffDateInput = document.getElementById('dropoffDate');
        const totalPriceInput = document.getElementById('totalPrice');

        const rentalPricePerDay = parseFloat('{{ $vehicle->rental_price }}');

        function calculateTotalPrice() {
            const pickupDate = new Date(pickupDateInput.value);
            const dropoffDate = new Date(dropoffDateInput.value);

            if (pickupDate && dropoffDate && dropoffDate > pickupDate) {
                const timeDiff = dropoffDate - pickupDate;
                const daysDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

                const totalPrice = rentalPricePerDay * daysDiff;
                totalPriceInput.value = totalPrice.toFixed(2);
            } else {
                totalPriceInput.value = '0.00';
            }
        }

        pickupDateInput.addEventListener('change', calculateTotalPrice);
        dropoffDateInput.addEventListener('change', calculateTotalPrice);
    });
</script>
<style>
    body {
    background-color: #e9ecef; /* Màu nền nhẹ nhàng hơn */
}

.card {
    border: none; /* Loại bỏ viền mặc định */
    border-radius: 15px; /* Bo tròn góc */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15); /* Bóng mờ mạnh hơn */
}

.card-title {
    font-size: 2rem; /* Kích thước tiêu đề lớn hơn */
    font-weight: bold; /* Làm đậm chữ tiêu đề */
    color: #007BFF; /* Màu xanh nổi bật cho tiêu đề */
    border-bottom: 3px solid #007BFF; /* Đường viền dưới dày hơn */
    padding-bottom: 10px; /* Khoảng cách dưới tiêu đề */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); /* Thêm hiệu ứng bóng cho chữ */
    letter-spacing: 1px; /* Khoảng cách giữa các chữ cái */
}

.form-group label {
    font-weight: bold; /* Làm đậm nhãn */
    color: #333; /* Màu sắc nhãn tối và nổi bật */
    margin-bottom: 5px; /* Khoảng cách phía dưới nhãn */
}

/* Thêm màu nền và viền cho ô nhập liệu */
.form-control {
    border-radius: 8px; /* Bo tròn góc cho các ô nhập liệu */
    border: 1px solid #0d6efd; /* Viền màu xanh */
    padding: 10px; /* Thêm padding cho ô nhập liệu */
}

/* Thêm hiệu ứng hover cho nút */
.btn {
    border-radius: 25px; /* Bo tròn góc cho nút */
    padding: 10px 20px; /* Tăng padding cho nút */
    transition: background-color 0.3s; /* Hiệu ứng chuyển màu */
}

.btn-primary {
    background-color: #007BFF; /* Màu nút chính */
    border: none; /* Không viền */
    color: white; /* Chữ màu trắng */
}

.btn-primary:hover {
    background-color: #0056b3; /* Màu nền tối hơn khi hover */
}

.btn-secondary {
    background-color: #6c757d; /* Màu nền của nút quay lại */
    border: none; /* Không viền */
    color: white; /* Chữ màu trắng */
}

.btn-secondary:hover {
    background-color: #5a6268; /* Màu nền tối hơn khi hover */
}

/* Hình ảnh xe */
.img-fluid {
    border-radius: 15px; /* Bo tròn góc cho hình ảnh */
    margin-top: 20px; /* Thêm khoảng cách phía trên */
    border: 2px solid #007BFF; /* Viền hình ảnh */
}

/* Cột cho form */
.form-column {
    flex: 1; /* Làm cho mỗi cột chiếm 50% chiều rộng */
    margin-right: 20px; /* Khoảng cách giữa hai cột */
}

/* Để loại bỏ margin của cột cuối */
.form-column:last-child {
    margin-right: 0;
}

/* Bố cục flex cho form */
.form-row {
    display: flex; /* Sử dụng flexbox để chia cột */
    gap: 20px; /* Khoảng cách giữa các cột */
}

/* Thêm màu sắc cho các icon */
.fas {
    color: #007BFF; /* Màu xanh cho các biểu tượng */
}
</style>
@endsection