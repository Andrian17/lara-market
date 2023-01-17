# Rest-API LaraMarket

## Development

1. Install dependencies using composer install
2. Generate the key using php artisan key:generate
3. Start your MySQL server
4. Run migration and seeder using php artisan migrate:fresh --seed
5. Install javascript depedencies using npm install
6. Bundle javascript depedencies using npm run dev
7. Start development server using php artisan serve

-   Catatan

1. Edit the env file if the db_username and db_password not the same
2. Create a database like env file

## How to used

### Base URL

end point http://127.0.0.1:8000/api/

### Register

end point /register
method POST
body :

<ul>
    <li>email : qwerty@gmail.com</li>
    <li>name : Qwerty</li>
    <li>password : qwerty</li>
    <li>c_password : qwerty</li>
</ul>

### Login

end point /login
method POST
body :

<ul>
    <li>email : qwerty@gmail.com</li>
    <li>password : qwerty</li>
</ul>

returns a token, use it on Header Authorization : Bearer :token
!![token-aurh](/example/token_auth.png)
!![token-aurh](/example/header_auth.png)

<!-- Seller Start -->

### Seller

#### Get All Seller

end point /resource-seller
method GET

#### Get Seller by id

end point /resource-seller/:id
method GET

#### Add Seller

end point /resource-seller
method POST
body :

<ul>
    <li>name : Seller1</li>
    <li>address : Jl. Qwerty No. 12</li>
</ul>

#### Update Seller

end point /resource-seller/:id
method PUT
body :

<ul>
    <li>name : New Seller1</li>
    <li>address : New Jl. Qwerty No. 12</li>
</ul>

#### Delete Seller

end point /resource-seller/:id
method DELETE

<!-- Seller End -->

<!-- Product Start -->

### Product

#### Get All Product

end point /resource-product
method GET

#### Get Product by id

end point /resource-product/:id
method GET

#### Add Product

end point /resource-product
method POST
body :

<ul>
    <li>name : Product1</li>
    <li>price : 2000000</li>
    <li>image_url : https://via.placeholder.com/320x240.png/006600?text=gadget+fuga</li>
    <li>seller_id : select one id seller </li>
</ul>

#### Update Product

end point /resource-product/:id
method PUT
body :

<ul>
    <li>name : new Product1</li>
    <li>price : 4000000</li>
    <li>image_url : https://via.placeholder.com/320x240.png/006600?text=gadget+fuga</li>
    <li>seller_id : select one id seller </li>
</ul>

#### Delete Seller

end point /resource-product/:id
method DELETE

<!-- Product End -->
