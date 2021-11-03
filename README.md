# Laravel OpenAPI Example

Laravel içerisinde OpenAPI/Swagger kullanımıyla ilgili yazdığım blog yazısına ait
projedir.

## Kullanımı

```sh
$ git clone https://github.com/erenhatirnaz/laravel-openapi-example.git
$ cd laravel-openapi-example
$ composer install
$ php artisan key:generate
$ cp .env.example .env # .env dosyasındaki db bilgilerini doldurun
$ php artisan l5-swagger:generate
$ php artisan serve
```

Uygulamayı ayağa kaldırdıktan sonra http://localhost:8000/api/documentation adresine
girerek SwaggerUI arayüzü kullanabilirsiniz.
