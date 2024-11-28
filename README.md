CARA CLONE SOURCE CODE
1. Git Clone < link source code>
2. composer install
3. Aktifkan ( .env ) Setting database, username, password
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed --class="AppSeeder"
7. php artisan db:seed --class="ProvinceSeeder"
8. php artisan db:seed --class="CitySeeder"
9. Menggunakan Min. PHP 8.*
10. Jika menggunakan lokal masuk AppServiceProvider.php coment code berikut :
      if (config('app.env') === 'local') {
            URL::forceScheme('https');
        }
11. Jika Sudah di deploy/menggunakan ngrok aktifkan code di atas
Tujuannya supaya ketika menjalankan payment gatwey midtrans work

#Tambahkan Code Berikut di bagian .env

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tokomalhest@gmail.com
MAIL_PASSWORD=qgqhyiplbgeasrrk
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="tokomalhest@gmail.com"
MAIL_FROM_NAME="ecommerce"



MIDTRANS_SERVER_KEY= < key midtrans >
MIDTRANS_CLIENT_KEY= < key client midtrans >
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true



