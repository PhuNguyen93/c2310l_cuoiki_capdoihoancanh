<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Đặt chiều cao tối thiểu cho body */
        }
        .footer {
            margin-top: auto; /* Tự động đưa footer xuống cuối */
            background-color: #343a40; /* Màu nền tối hơn */
            color: #ffffff; /* Màu chữ trắng */
            padding: 2rem 0; /* Giảm padding */
            font-size: 0.8rem; /* Giảm kích thước chữ */
            z-index: 1000; /* Đảm bảo footer nằm trên cùng */ 
        }

        .footer h6 {
            font-weight: bold;
            font-size: 1.2rem; /* Giảm kích thước chữ tiêu đề */
            margin-bottom: 0.5rem; /* Giảm khoảng cách dưới tiêu đề */
            text-transform: uppercase;
        }

        .footer p, .footer a {
            font-size: 0.8rem; /* Giảm kích thước chữ */
            margin: 0.3rem 0; /* Giảm khoảng cách dưới các thẻ p */
            color: #f8f9fa; /* Màu chữ nhạt hơn */
            text-decoration: none;
        }

        .footer a:hover {
            color: #ffc107; /* Màu vàng khi hover */
            text-decoration: underline; /* Gạch chân khi hover */
        }

        .social-icons a {
            margin: 0 0.3rem; /* Giảm khoảng cách giữa các biểu tượng */
            font-size: 1.2rem; /* Kích thước biểu tượng lớn hơn một chút */
            color: #ffffff; /* Màu chữ trắng */
        }

        .social-icons a:hover {
            color: #ffc107; /* Màu vàng khi hover */
        }

        .footer .container {
            max-width: 1200px; /* Giới hạn chiều rộng cho footer */
        }
    </style>
    <title>BP Car Services</title>
</head>
<body>
    <div class="content">
        <!-- Nội dung chính của bạn -->
    </div>

    <footer class="footer">
        <div class="container text-center text-md-left">
            <div class="row">
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-4">
                    <h6>BP Car Services</h6>
                    <p><strong>Phone:</strong> 0367777747</p>
                    <p><strong>Support Hotline:</strong> 7AM - 10PM</p>
                    <p><strong>Email:</strong> <a href="mailto:nguyenphu0809@gmail.com">nguyenphu0809@gmail.com</a></p>
                    <p>Send us an email</p>
                    <div class="social-icons">
                        <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
                        <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-4">
                    <h6>Our Services</h6>
                    <p><a href="#">Car Repair</a></p>
                    <p><a href="#">Oil Change</a></p>
                    <p><a href="#">Tire Replacement</a></p>
                    <p><a href="#">Car Wash</a></p>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-4">
                    <h6>Policy</h6>
                    <p><a href="#">Terms and Conditions</a></p>
                    <p><a href="#">Privacy Policy</a></p>
                    <p><a href="#">Feedback</a></p>
                    <p><a href="#">Dispute Resolution</a></p>
                </div>
            </div>

            <div class="row text-center mt-4">
                <div class="col-md-12">
                    <p>&copy; 2024 BP Car Services. All rights reserved.</p>
                    <p>Address: Your Address Here</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>