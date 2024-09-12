@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $vehicle->vehicle_name }}</h5>
            <p class="card-text">License Plate: {{ $vehicle->license_plate }}</p>
            <p class="card-text">Rental Price: ${{ $vehicle->rental_price }}</p>

            <!-- Hiển thị hình ảnh của xe nếu có -->
            @if($vehicle->image)
                <img src="{{ asset('storage/' . $vehicle->image) }}" class="img-fluid" alt="Vehicle Image">
            @endif

            <!-- Form thông tin người nhận xe và địa điểm -->
            <form action="{{ route('processCheckout') }}" method="POST">
                @csrf
                <input type="hidden" name="vehicleId" value="{{ $vehicle->id }}">

                <div class="form-group">
                    <label for="recipientName">Recipient Name</label>
                    <input type="text" class="form-control" id="recipientName" name="recipientName" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="pickupDate">Pickup Date</label>
                    <input type="date" class="form-control" id="pickupDate" name="pickupDate" required>
                </div>

                <div class="form-group">
                    <label for="dropoffDate">Dropoff Date</label>
                    <input type="date" class="form-control" id="dropoffDate" name="dropoffDate" required>
                </div>

                <div class="form-group">
                    <label for="pickupLocation">Pickup Location</label>
                    <input type="text" class="form-control" id="pickupLocation" name="pickupLocation" required>
                </div>

                <div class="form-group">
                    <label for="dropoffLocation">Dropoff Location</label>
                    <input type="text" class="form-control" id="dropoffLocation" name="dropoffLocation" required>
                </div>

                <!-- Phương thức thanh toán -->
                <div class="form-group">
                    <label for="paymentMethod">Payment Method</label>
                    <select class="form-control" id="paymentMethod" name="paymentMethod" required>
                        <option value="cash">Cash</option>
                        <option value="local_card">Local Card</option>
                        <option value="visa">Visa</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="totalPrice">Total Price</label>
                    <input type="text" class="form-control" id="totalPrice" name="totalPrice" readonly>
                </div>

                <!-- Nút confirm và back -->
                <a href="{{ url('/') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Confirm</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const pickupDateInput = document.getElementById('pickupDate');
    const dropoffDateInput = document.getElementById('dropoffDate');
    const totalPriceInput = document.getElementById('totalPrice');

    // Giá thuê xe mỗi ngày (dữ liệu lấy từ biến $vehicle->rental_price từ PHP)
    const rentalPricePerDay = parseFloat('{{ $vehicle->rental_price }}');

    // Hàm tính tổng số tiền thuê
    function calculateTotalPrice() {
        const pickupDate = new Date(pickupDateInput.value);
        const dropoffDate = new Date(dropoffDateInput.value);

        if (pickupDate && dropoffDate && dropoffDate > pickupDate) {
            const timeDiff = dropoffDate - pickupDate;
            const daysDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24)); // Chuyển đổi ms sang ngày và làm tròn lên

            // Tính tổng tiền
            const totalPrice = rentalPricePerDay * daysDiff;
            totalPriceInput.value = totalPrice.toFixed(2); // Hiển thị 2 chữ số thập phân
        } else {
            totalPriceInput.value = '0.00'; // Reset nếu không hợp lệ
        }
    }

    // Gọi hàm tính tổng tiền khi thay đổi ngày nhận và ngày trả xe
    pickupDateInput.addEventListener('change', calculateTotalPrice);
    dropoffDateInput.addEventListener('change', calculateTotalPrice);
});

</script>

@endsection
