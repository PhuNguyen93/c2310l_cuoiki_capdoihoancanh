# BP CAR SERVICES
BP CAR SERVICES là một nền tảng cho phép người dùng dễ dàng thuê xe với quy trình đơn giản và thuận tiện. Dự án nhằm mục đích cung cấp dịch vụ cho thuê xe linh hoạt cho cả cá nhân và doanh nghiệp, đáp ứng nhu cầu di chuyển nhanh chóng và an toàn.

## Mục Lục

- [Giới thiệu](#giới-thiệu)
- [Yêu cầu Hệ thống](#yêu-cầu-hệ-thống)
- [Cài đặt](#cài-đặt)
- [Cấu trúc Dự án](#cấu-trúc-dự-án)
- [Giới thiệu về Công nghệ](#giới-thiệu-về-công-nghệ)


## Chức năng chính

----Chức năng người dùng:
1. **Đăng ký và Đăng nhập:** 
   - Người dùng có thể tạo tài khoản và đăng nhập để sử dụng dịch vụ.

2. **Xem Profile:** 
   - Người dùng có thể xem thông tin cá nhân của mình.

3. **Lịch sử thuê xe:** 
   - Người dùng có thể tra cứu lịch sử các chuyến thuê xe đã thực hiện.

4. **Thuê xe:** 
   - Khi người dùng chọn thuê xe, thông tin chuyến đi sẽ được gửi tới email mà họ đã đăng ký. Tuy nhiên, yêu cầu thuê xe cần được admin phê duyệt trước khi xác nhận.

-----Chức năng admin:
1. **Quản lý người dùng:** 
   - Admin có quyền duyệt hoặc từ chối yêu cầu thuê xe của người dùng.

2. **Quản lý danh sách xe:** 
   - Admin có thể thêm, sửa, xóa thông tin về xe có sẵn trong hệ thống.

3. **Quản lý tài xế:** 
   - Admin theo dõi và quản lý danh sách tài xế hoạt động.

4. **Theo dõi lịch sử mượn xe:** 
   - Admin có thể xem lịch sử mượn xe của người dùng để quản lý tốt hơn.

## Yêu cầu Hệ thống

- PHP >= 8.0
- Composer
- MySQL hoặc Dbearver
- Laravel >= 8.x

## Cài đặt

Hướng dẫn từng bước để cài đặt và chạy dự án:

1. Clone dự án về máy của bạn:
    \`\`\`
   git clone https://github.com/PhuNguyen93/c2310l_cuoiki_capdoihoancanh.git
    \`\`\`

2. Clone dự án về và để trong htdocs
    \`\`\`
    xam-> htdocs->C2310L_cuoiki_capdoihoancanh
    \`\`\`

3. Cài đặt các phụ thuộc:
    \`\`\`
    Cài đặt composer(Composer-Setup.exe) từ https://getcomposer.org/download/
    \`\`\`
    cd vào thư mục C2310L_cuoiki_capdoihoancanh
   \`\`\`
    composer install
   \`\`\`

4. Tạo file `.env` từ mẫu:
   \`\`\`
   cp .env.example .env
   \`\`\`

5. Cấu hình database trong file `.env`.
    Sau đó copy paste vào file .env để cấu hình dự án
\\\\\\\\\\\\\\\\\\\\\\\
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:AyTz76iSjgp5KLITasLGglXO6Ba5FggiHM1Il9GQHh4=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=transport_company_db
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=trangiabaotest2201@gmail.com
MAIL_PASSWORD="kkmo bnzt bpcq oxnr"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=trangiabaotest2201@gmail.com
MAIL_FROM_NAME="Vehicle Rental Service"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
\\\\\\\\\\\\\\\\\\\\\\\

6. Chạy lệnh để tạo key ứng dụng:
   \`\`\`
   php artisan key:generate
   \`\`\`

7. Chạy migrations:
   \`\`\`
   php artisan migrate
   \`\`\`

8. Chạy db seed
   \`\`\`
   php artisan db:seed
   \`\`\`

9. Chạy ứng dụng:
   \`\`\`
   php artisan serve
   \`\`\`

## Cấu trúc Dự án

Mô tả cấu trúc thư mục dự án của bạn, giải thích ngắn gọn về các thư mục và tệp quan trọng.

\`\`\`
- app/                # Chứa các model, controller
- routes/             # Định nghĩa routes
- resources/          # Chứa views, assets
- database/           # Chứa migrations, factories
\`\`\`

## Giới thiệu về Công nghệ

Các cộng nghệ mà nhóm đã sử dụng
- Laravel
- PHP
- MySQL hoặc Dbeaver
- Bootstrap (nếu có)
- HTML/CSS


