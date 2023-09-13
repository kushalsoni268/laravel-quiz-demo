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

-------------------------------------------------------

---------------------- Laravel Socialite Demo --------------------

Project Name : laravel-socialite-demo

----------------------------------------------------------------
----------------------------------------------------------------
PROJECT DESCRIPTION

=> Implement following features.

1) Register/Login with custom email.
2) Login with google.
3) Login with facebook.
4) Login with twitter.
5) Login with twitter.
----------------------------------------------------------------
----------------------------------------------------------------
STEPS TO MAKE DEMO PROJECT

----------------------------------------------------------------
Step1 : Install fresh laravel project

Commands :
1) composer create-project --prefer-dist laravel/laravel laravel-socialite-demo
----------------------------------------------------------------
Step2 : Install auth 

Commands :
1) composer require laravel/ui
2) php artisan ui bootstrap --auth  
----------------------------------------------------------------
Step3 : Perform changes in migrartions & run migrartions 

Commands :
1) php artisan migrate
----------------------------------------------------------------
Step4 : Install collective form

Commands :
1) composer require laravelcollective/html

Note : Add required changes config file app.php 
----------------------------------------------------------------
Step5 : Integarte theme & implement register/login with custom email.
----------------------------------------------------------------
Step6 : Implement login with google using larave socialite.

First install "laravel/socialite" package

Commands :
1) composer require laravel/socialite

Create new application in google devceloper console and get application credentials
now add configuration changes as per "Implement login with google" Reference Link.
----------------------------------------------------------------

Reference Links:
1) Install auth laravel : https://www.positronx.io/how-to-properly-install-and-use-bootstrap-in-laravel/
2) Install collective form laravel : https://ekimunyime.medium.com/working-with-forms-in-laravel-8-a28283301622
3) Implement login with google : https://www.itsolutionstuff.com/post/laravel-6-socialite-login-with-google-gmail-accountexample.html
----------------------------------------------------------------
----------------------------------------------------------------

Steps To Get Google Application Credentials: 

1) Open Link & Login with google account : https://console.cloud.google.com/

2) Create new project

3) Go to "Credentials" menu in left sidebar, Now click on create credentials and select "OAuth client Id" .

4) Create "OAuth consent screen".

5) Now again follow step 3 & select application type

6) Add valid "Authorized redirect URIs" and create OAuth client ID.

Note: Use this client Id & client secret in configuration file "config/service.php".

----------------------------------------------------------------
----------------------------------------------------------------