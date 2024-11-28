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
