# Rest-API LaraMarket

YouTube https://youtu.be/Orc-v8e4WmE

CRUD API Product and Seller

## Desain database (Seller and Product)

![tbl-seller-and-products](/example/lara-market.png)

<div style="display: flex">
    <table border="1">
        <tr>
            <td colspan="3">Seller</td>
        </tr>
        <tr>
            <td>id</td>
            <td>name</td>
            <td>address</td>
        </tr>
        <tr>
            <td>PK integer</td>
            <td>varchar (100)</td>
            <td>TEXT</td>
        </tr>
    </table>
    <table border="1">
        <tr>
            <td colspan="6">Product</td>
        </tr>
        <tr>
            <td>id</td>
            <td>seller_id</td>
            <td>code_product</td>
            <td>name</td>
            <td>price</td>
            <td>image_url</td>
        </tr>
        <tr>
            <td>PK integer</td>
            <td>foreignID integer</td>
            <td>char (32)</td>
            <td>varchar (100)</td>
            <td>integer</td>
            <td>TEXT</td>
        </tr>
    </table>
</div>

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

1.  end point /register
2.  method POST
3.  body :

<ul>
    <li>email : qwerty@gmail.com</li>
    <li>name : Qwerty</li>
    <li>password : qwerty</li>
    <li>c_password : qwerty</li>
</ul>

### Login

1.  end point /login
2.  method POST
3.  body :

<ul>
    <li>email : qwerty@gmail.com</li>
    <li>password : qwerty</li>
</ul>

returns a token, use it on Header Authorization : Bearer :token

-   Token
    ![token-auth](/example/token_auth.png)
-   Auth
    ![token-auth](/example/header_auth.png)

<!-- Seller Start -->

### Seller

#### Get All Seller

1.  end point /resource-seller
2.  method GET

Seller with Products (hasMany)
![seller-with-products](/example/seller-with-products.png)

#### Get Seller by id

1.  end point /resource-seller/:id
2.  method GET

#### Add Seller

1.  end point /resource-seller
2.  method POST
3.  body :

<ul>
    <li>name : Seller1</li>
    <li>address : Jl. Qwerty No. 12</li>
</ul>

#### Update Seller

1.  end point /resource-seller/:id
2.  method PUT
3.  body :

<ul>
    <li>name : New Seller1</li>
    <li>address : New Jl. Qwerty No. 12</li>
</ul>

#### Delete Seller

1.  end point /resource-seller/:id
2.  method DELETE

<!-- Seller End -->

<!-- Product Start -->

### Product

#### Get All Product

1.  end point /resource-product
2.  method GET

Product with Seller (belongsTo / hasOne / One2one)
![product-with-seller](/example/product-with-seller.png)

#### Get Product by id

1.  end point /resource-product/:id
2.  method GET

#### Add Product

1.  end point /resource-product
2.  method POST
3.  body :

<ul>
    <li>name : Product1</li>
    <li>price : 2000000</li>
    <li>image_url : https://via.placeholder.com/320x240.png/006600?text=gadget+fuga</li>
    <li>seller_id : select one id seller </li>
</ul>

#### Update Product

1.  end point /resource-product/:id
2.  method PUT
3.  body :

<ul>
    <li>name : new Product1</li>
    <li>price : 4000000</li>
    <li>image_url : https://via.placeholder.com/320x240.png/006600?text=gadget+fuga</li>
    <li>seller_id : select one id seller </li>
</ul>

#### Delete Product

1.  end point /resource-product/:id
2.  method DELETE

#### Search Product

1.  end point /resource-product/search/:name
2.  method GET

<!-- Product End -->

<!-- CRUD -->

## CRUD in Dashboard

### Seller

#### List Seller

![list-seller](/example/Screenshot_16.png)

#### Detail Seller

![detail-seller](/example/Screenshot_17.png)

### Product

#### List Product

![list-product](/example/Screenshot_15.png)

#### Detail Product

![detail-product](/example/Screenshot_18.png)

#### Edit Product

![edit-product](/example/Screenshot_19.png)

## Dependeci

### Composer (PHP)

1. "laravel/sanctum": "^3.2",
2. "laravel/ui": "^4.2",

### NPM (Node JS) Default

1. "@popperjs/core": "^2.11.6",
2. "axios": "^1.1.2",
3. "bootstrap": "^5.2.3",
4. "laravel-vite-plugin": "^0.7.2",
5. "lodash": "^4.17.19",
6. "postcss": "^8.1.14",
7. "sass": "^1.56.1",
8. "vite": "^4.0.0"
