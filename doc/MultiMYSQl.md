#Multiple MYSQL

#Configure Database Connections:

Thêm dòng này vào trong connections 

```
'mysql3' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_SECONDARY', '127.0.0.1'),
            'port' => env('DB_PORT_SECONDARY', '3306'),
            'database' => env('DB_DATABASE_SECONDARY', 'forge'),
            'username' => env('DB_USERNAME_SECONDARY', 'forge'),
            'password' => env('DB_PASSWORD_SECONDARY', ''),
        ], 
```

#Environment Configuration
Cập nhật tệp .env của bạn để kết nối cho cơ sở dữ liệu thứ ``n``

```
DB_CONNECTION_SECONDARY=mysql3
DB_HOST_SECONDARY=127.0.0.1
DB_PORT_SECONDARY=3306
DB_DATABASE_SECONDARY=your_secondary_database
DB_USERNAME_SECONDARY=your_secondary_username
DB_PASSWORD_SECONDARY=your_secondary_password
```
# Run Migrations and Seeders: 
thay tên --database=DB_CONNECTION của bạn

```
php artisan migrate --database=mysql3
php artisan db:seed --database=mysql3

```

