--------------- Kushal Soni Practical ----------------

Admin Details
URL : http://127.0.0.1:8000/admin/login
Username : admin
Password : Admin@123

Admin Details
URL : http://127.0.0.1:8000/login
Username : user1
Password : User@123

API Collection (Json) : https://api.postman.com/collections/12887336-29d5ff52-7093-4cea-85e0-8f54dbedd36f?access_key=PMAT-01H75MDTA2HS90GWN94QN2TYPF

------------------------------------------------------

php artisan make:migration create_user_images_table --create=user_images
php artisan make:migration create_suppliers_table --create=suppliers
php artisan make:migration create_resellers_table --create=resellers
php artisan make:migration create_user_datas_table --create=user_datas

php artisan make:job SyncUsers
php artisan make:command  SyncUsers

php artisan sync:users