# **EAP: Architecture Specification and Prototype**

An Online Shop that becomes your ‘street corner’ bookshop only a click away!

# **A7: Web Resources Specification**

This artefact documents the architecture  of the web app "The Last Chapter" to be developed, indicating the catalogue of resources, the CRUD (create, read, update, delete) operations for each resource and the format of JSON responses.

This specification adheres to the OpenAPI standard using YAML.

## **A7.1. Overview**

| | |
|:---------------|:-----------------------|
| **M01: Authentication and User Profile** | Web resources associated with user authentication and individual profile management. Includes the following system features: login/logout, registration, credential recovery, view and edit personal profile information. |
| **M02: Administrator/Management Area** | Web resources associated with website order, user, product and author management, specifically: view and edit orders, delete, view and edit properties; view and search users, view and change user information, block and delete user accounts; view, delete and edit product properties, view delete and edit products; view, delete and edit authors. |
| **M03: Product, Reviews & Wishlisting** | Web resources associated through the user interaction with products, through reviews & wishlisting, including the following features: add review; deleted review; add and remove product from wishlist. |
| **M04: Product and Categories** | Web resources associated with the search, applying filters and listing of the products available to the user. |
| **M05: Cart and Checkout** | Web resource associated with the aspect of buying, specifically: view, add/delete items from shopping cart and all the different stages of the checkout. |
| **M06: Static Pages** | Web resource associated with the static content the following pages: About us, Contact Us, FAQ, Error Page. |

## **A7.2. Permissions**

| | |
|:---------------:|:---------------|
| **PUB** | Users without priviledges |
| **USR** | Authenticated users |
| **ADM** | System administrators |
| **BUY** | User that has at least one purchase |
| **OWN** | Group of users that can updated their profiles and have priviledges regarding their previous purchases and reviews | 


## **A7.3. OpenAPI Specification**

```yaml
openapi: 3.0.0

info:
  version: 1.0.0
  title: 'LBAW The Last Chapter Web API'
  description: 'Web Resources Specification (A7) for The Last Chapter'

servers:
  - description: Production server
    url: http://lbaw2193.lbaw-prod.fe.up.pt

tags:
  - name: 'M01: Authentication and User Profile'
  - name: 'M02: Administrator/Managment Area'
  - name: 'M03: Product, Reviews & Wishlisting'
  - name: 'M04: Product and Categories'
  - name: 'M05: Cart & Checkout'
  - name: 'M06: Static pages'

paths:
  /login:
    get:
      operationId: R101
      summary: 'R101: Login Form'
      description: 'Provide login form. Access: PUB'
      tags:
         - 'M01: Authentication and User Profile'
      responses:
         '200':
           description: 'Ok. Show Log-in UI (UI03)'
    post:
      operationId: R102
      summary: 'R102: Login Action'
      description: 'Processes the login form submission. Access: PUB'
      tags:
        - 'M01: Authentication and User Profile' 

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                email:   
                  type: string
                password: 
                  type: string
              required:
                - email
                - password

      responses:
       '302':
         description: 'Redirect after processing the login credentials.'
         headers:
           Location:
             schema:
               type: string
             examples:
               302Success:
                 description: 'Successful authentication. Redirect to user profile.'
                 value: '/users/{id}'
               302Error:
                 description: 'Failed authentication. Redirect to login form.'
                 value: '/login'
    
  /logout:
    post:
      operationId: R103
      summary: 'R103: Logout Action'
      description: 'Logout the current authenticated user. Access: USR, ADM'
      tags:
        - 'M01: Authentication and User Profile'
      responses:
        '302':
          description: 'Redirect after processing logout.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful logout. Redirect to login form.'
                  value: '/login'

  /register:
      get:
        operationId: R104
        summary: 'R104: Register Form'
        description: 'Provide new user registration form. Access: PUB'
        tags:
          - 'M01: Authentication and User Profile'
        responses:
          '200':
            description: 'Ok. Show Sign-Up UI (UI04)'

      post:
        operationId: R105
        summary: 'R105: Register Action'
        description: 'Processes the new user registration form submission. Access: PUB'
        tags:
          - 'M01: Authentication and User Profile'

        requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  email:
                    type: string
                  username:
                    type: string
                  password: 
                    type: string
                  birth_date:
                    type: string  
                required:
                    - email
                    - username
                    - password
                    - birth_date

        responses:
          '302':
            description: 'Redirect after processing the new user information.'
            headers:
              Location:
                schema:
                  type: string
                examples:
                  302Success:
                    description: 'Successful registration. Redirect to user profile.'
                    value: '/users/{id}'
                  302Failure:
                    description: 'Failed registration. Redirect to register form.'
                    value: '/register'

  /users/{id}:
    get:
      operationId: R106
      summary: 'R106: View user profile'
      description: 'Show the individual user profile. Access: USR'
      tags:
        - 'M01: Authentication and User Profile'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      responses:
        '200':
          description: 'Ok. Show User Profile UI (UI18)'
        '404':
          description: 'Ok. Show the Error Page'         
  
  /users/{id}/edit:
    get:
      operationId: R107
      summary: 'R107: Edit user profile form'
      description: 'Page with a form to edit an authenticated users profile. Access: USR'
      tags:
        - 'M01: Authentication and User Profile'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      responses:
        '200':
          description: 'Ok. Show User Edit UI (UI18)'

    put:
      operationId: R108
      summary: 'R108: Edit profile Action'
      description: 'This web resource updates the information on an authenticated users profile, 
        and then redirects them back to their profile page. Access: USR'
      tags:
        - 'M01: Authentication and User Profile'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                name:   
                  type: string
                email: 
                  type: string
                phonenumber: 
                  type: string
                nif: 
                  type: string
                birthdate: 
                  type: string
                
                address:
                  type: object
                  properties:
                    name:
                      type: string
                    streetaddress:
                      type: string
                    adicionalinfo:
                      type: string
                    zipcode:
                      type: string
                    country:
                      type: string
                    phonenumber:
                      type: string
                    nif:
                      type: string

                paymentmethod:
                  type: object
                  properties:
                    paypal:   
                      type: object
                      properties:
                        email: 
                          type: string
                        password:
                          type: string
                    creditcard:
                      type: object
                      properties:
                        name:
                          type: string
                        cardnumber:
                          type: integer
                        expirationdate:
                          type: string
                        securitycode:
                          type: integer
                

      responses:
       '302':
         description: 'Redirect after processing the profile update'
         headers:
           Location:
             schema:
               type: string
             examples:
               302Success:
                 description: 'Successful Editing. Redirect to user profile.'
                 value: '/users/{id}'
               302Error:
                 description: 'Failed. Redirect to user profile.'
                 value: '/users/{id}' 
                 
                 
                 
  /login/credentialrec:
    get:
      operationId: R109
      summary: 'R109: Credential Recovery Form'
      description: 'Provide an email form. Access: USR'
      tags:
        - 'M01: Authentication and User Profile'
      responses:
        '200':
          description: 'Ok. Show Credential Recovery UI'

    post:
      operationId: R110
      summary: 'R110: Credential Recovery Action'
      description: 'Processes the email form submission. Access: USR'
      tags:
          - 'M01: Authentication and User Profile'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                email:
                  type: string
              required: 
                - email

      responses:
        '302':
          description: 'Redirect after processing the email.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'New password sent to email. Redirect to login form.'
                  value: '/login'
                302Failure:
                  description: 'Incorrect email.'
                  value: '/login/credentialrec'


  /admin/products/{id}:
    get:
      operationId: R201
      summary: 'R201: View Product List'
      description: 'Provide list of products. Access: ADM'
      tags: 
        - 'M02: Administrator/Managment Area'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      responses:
        '200':
          description: 'Ok.Show product list'
        '404':
            description: 'Products not found.'

    post:
      operationId: R202
      summary: 'R202: Edit Product on Product list'
      description: 'Edit any product detail. Access: ADM'
      tags: 
        - 'M02: Administrator/Managment Area'

      parameters:
      - in: path
        name: id
        schema:
          type: integer
        required: true
          
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                name:
                  type: string
                price:
                  type: number
                stock:
                  type: integer
                discount: 
                  type: number
                synopsis:
                  type: string
                product_type:
                  type: string
                book_with:
                  type: number
                book_height:
                  type: number
                
      responses:
        '302':
          description: 'Edit product details'
          headers:
            location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successfully edited product'
                  value: /admin
                302Error:
                  description: 'Failed editing review'
                  value: /admin/products/{id}


  /admin/orders/{id}:
    get:
      operationId: R203
      summary: 'R203: View Order List'
      description: 'Provide list of orders. Access: ADM'
      tags: 
        - 'M02: Administrator/Managment Area'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      responses:
        '200':
          description: 'Ok.Show order list'
        '404':
            description: 'Orders not found.'


    post:
      operationId: R204
      summary: 'R204 Edit Any Order Detail. Access: ADM'
      tags:
        - 'M02: Administrator/Managment Area'
        
      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  status:
                    type: string
                  date:
                    type: string
                  status_date:
                    type: string
                required:
                  - status

      responses:
        '302':
          description: 'edit order'
          headers:
            location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successfully edited order'
                  value: /admin
                302Error:
                  description: 'Failed editing order'
                  value: /admin/orders/{id}

  /admin/users/{id}:
    get:
      operationId: R205
      summary: 'R205: View User List'
      description: 'Provide list of users. Access: ADM'
      tags: 
        - 'M02: Administrator/Managment Area'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      responses:
        '200':
          description: 'Ok. Show user list'
        '404':
            description: 'Users not found.'


    post:
      operationId: R206
      summary: 'R206 Edit Any User Detail. Access: ADM'
      tags:
        - 'M02: Administrator/Managment Area'
        
      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  username:
                    type: string
                  email:
                    type: string
                  password:
                    type: string
                  name:
                    type: string
                  birth_date:
                    type: string
                

      responses:
        '302':
          description: 'Edit User Details'
          headers:
            location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successfully edited user'
                  value: /admin
                302Error:
                  description: 'Failed editing user'
                  value: /admin/users/{id}

  /admin/faq/{id}:
    get:
      operationId: R207
      summary: 'R207: View FAQ'
      description: 'Provide FAQ. Access: ADM'
      tags: 
        - 'M02: Administrator/Managment Area'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      responses:
        '200':
          description: 'Ok.Show user FAQ'
        '404':
            description: 'FAQ not found.'


    put:
      operationId: R208
      summary: 'R208 Edit Any FAQ. Access: ADM'
      tags:
        - 'M02: Administrator/Managment Area'
        
      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      requestBody:
          required: true
          content:
            application/x-www-form-urlencoded:
              schema:
                type: object
                properties:
                  question:
                    type: string
                  answer:
                    type: string
                required:
                  - question
                  - answer

      responses:
        '302':
          description: 'Edit FAQ'
          headers:
            location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successfully edited faq'
                  value: /admin/
                302Error:
                  description: 'Failed editing faq'
                  value: /admin/faq/{id}


  /products/{id}:
    get:
      operationId: R301
      summary: 'R301: View Product Page'
      description: 'Provide the product page of product with id {id}. Access: PUB'
      tags:
        - 'M03: Product, Reviews & Wishlisting'  

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      responses:
        '200':
          description: 'Ok. Show Product Page UI. (UI10)'
        '404':
          description: 'Product not found.'

  /products/{id}/reviews:
    get:
      operationId: R302
      summary: 'R302: View Product Reviews'
      description: 'Provide Reviews of a Product. Access: PUB'
      tags:
        - 'M03: Product, Reviews & Wishlisting'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      responses:
        '200':
          description: 'Success'
          content:
            application/json:
              schema:
                type: array
                items:
                  type: object
                  properties:
                    id_rev:
                      type: integer
                    date:
                      type: string
                    star_rating:
                      type: number
                    comment:
                      type: string
                    id_user:
                      type: integer
                    username:
                      type: string
                example:
                  - id_rev: 1
                    date: '2021-11-15'
                    star_rating: 4.4
                    comment: 'Great book. I recommend it to anyone who likes fantasy novels!'
                    id_user: 5
                    username: 'chitchat'
                  
        '404':
          description: 'Product not found.'

  /products/{id}/reviews/add:
    post:
      operationId: R303
      summary: 'R303: Add Review Action'
      description: 'Add a new review to a product already bought. Access: BUY'
      tags:
      - 'M03: Product, Reviews & Wishlisting'

      parameters:
      - in: path
        name: id
        schema:
          type: integer
        required: true

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                star_rating:
                  type: number
                comment:
                  type: string
                date:
                  type: string
              required:
                - star_rating
                - comment

      responses:
        '302':
          description: 'Adding a new review'
          headers:
            Location:
              schema:
                type: string
              examples: 
                302Success:
                  description: 'Successfully added a new review'
                  value: /products/{id}/reviews/{id_rev}
                302Error:
                  description: 'Failed adding a new review'
                  value: /products/{id}

        

  /products/{id}/reviews/{id_rev}/edit: 
    put:
      operationId: R304
      summary: 'R304: Edit Review Action'
      description: 'Edit a previously written review to a product already bought. Access: BUY, OWN'
      tags:
      - 'M03: Product, Reviews & Wishlisting'


      parameters:
      - in: path
        name: id
        schema:
          type: integer
        required: true
      - in: path
        name: id_rev
        schema:
          type: integer
        required: true

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                star_rating:
                  type: number
                comment:
                  type: string
                date:
                  type: string
              required:
                - star_rating
                - comment

      responses:
        '302':
          description: 'Editing a review'
          headers:
            Location:
              schema:
                type: string
              examples: 
                302Success:
                  description: 'Successfully edited review'
                  value: /products/{id}/reviews/{id_rev}
                302Error:
                  description: 'Failed editing review'
                  value: /products/{id}


  /products/{id}/reviews/{id_rev}/delete:
    delete:
      operationId: R305
      summary: 'R305: Delete Review Action'
      description: 'Delete a previously written review to a product already bought. Access: BUY, OWN, ADM'
      tags:
      - 'M03: Product, Reviews & Wishlisting'

      parameters:
      - in: path
        name: id
        schema:
          type: integer
        required: true
      - in: path
        name: id_rev
        schema:
          type: integer
        required: true

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                explanation:
                  type: string
              required:
                - explanation

      responses:
        '302':
          description: 'Deleting a review'
          headers:
            Location:
              schema:
                type: string
              examples: 
                302Success:
                  description: 'Successfully deleted review'
                  value: /products/{id}/reviews
                302Error:
                  description: 'Failed deleting review'
                  value: /products/{id}/reviews/{id_rev}

  /products/{id}/add_to_wishlist:
    post:
      operationId: R306
      summary: 'R306: Add To Wishlist Action'
      description: 'Add a product to Wishlist. Access: USR'
      tags:
      - 'M03: Product, Reviews & Wishlisting'
    
      parameters:
      - in: path
        name: id
        schema:
          type: integer
        required: true

      responses:
        '302':
          description: 'Adding to Wishlist'
          headers:
            Location:
              schema:
                type: string
              examples: 
                302Success:
                  description: 'Successfully added product to wishlist'
                  value: /products/{id}
                302Error:
                  description: 'Failed adding to wishlist'
                  value: /products/{id}

  /users/{id}/wishlist: 
    get:
      operationId: R307
      summary: 'R307: View User Wishlist'
      description: 'Show the individual user wishlist. Access: USR'
      tags:
        - 'M03: Product, Reviews & Wishlisting'

      parameters:
      - in: path
        name: id
        schema:
          type: integer
        required: true

      responses:
        '200':
          description: 'Ok. User Wishlist UI (UI19)'
        '404':
          description: 'User not found.'

  /users/{id}/wishlist/add_to_cart/{id_prod}:
    post:
      operationId: R308
      summary: 'R308: Add to cart from Wishlist'
      description: 'Add a previously wishlisted product to the cart. Access: USR'
      tags:
        - 'M03: Product, Reviews & Wishlisting'

      parameters:
      - in: path
        name: id
        schema:
          type: integer
        required: true
      - in: path
        name: id_prod
        schema:
          type: integer 
        required: true

      responses:
        '302':
          description: 'Moving from Wishlist to Cart'
          headers:
            Location:
              schema:
                type: string
              examples: 
                302Success:
                  description: 'Successfully added product to cart'
                  value: /users/{id}/wishlist
                302Error:
                  description: 'Failed adding to cart'
                  value: /users/{id}/wishlist


  /users/{id}/wishlist/remove_product/{id_prod}: 
      post:
          operationId: R309
          summary: 'R309: Remove from Wishlist'
          description: 'Remove a previously wishlisted product. Access: USR'
          tags:
              - 'M03: Product, Reviews & Wishlisting'

          parameters:
          - in: path
            name: id
            schema:
                type: integer
            required: true
          - in: path
            name: id_prod
            schema:
                type: integer  
            required: true

          responses:
              '302':
                  description: 'Deleting from Wishlist'
                  headers:
                      Location:
                          schema:
                              type: string
                          examples: 
                              302Success:
                                  description: 'Successfully deleted product from Wishlist'
                                  value: /users/{id}/wishlist
                              302Error:
                                  description: 'Failed removing from wishlist'
                                  value: /users/{id}/wishlist

  /api/products:
    get:
      operationId: R401
      summary: 'R401: Search Products Action'
      description : 'Search products and return the search results as JSON. Access: PUB'
      tags:
        - 'M04: Product and Categories'
      
      parameters:
        - in: query
          name: query
          description: String to use for full-text search index
          schema:
            type: string
          required: false
        - in: query
          name: max_price 
          description: Product maximum price 
          schema: 
            type: number
          required: false
        - in: query 
          name: min_price
          description: Product minimum price 
          schema:
            type: number
          required: false
        - in: query
          name: stock
          description: Product in/out of stock 
          schema:
            type: boolean
          required: false 
        - in: query
          name: discount
          description: Product with discount?
          schema:
            type: boolean 
          required: false 
        - in: query
          name: star_rating
          description: Product star rating
          schema:
            type : number 
          required: false 
        - in: query
          name: genre 
          description: Product genre's
          schema: 
           type : string 
          required: false 
        - in: query 
          name: product_type 
          description: Product type [Hard Cover/ Digital version]
          schema:
            type: string 
          required: false 
        - in: query
          name: language
          description: Product Language 
          schema: 
            type: string 
          required: false 
        - in: query 
          name: author 
          description: Product author 
          schema: 
            type: string 
          required: false
      
      responses:
        '200':
          description: 'Success'
          content:
            application/json:
              schema:
                type: array
                items:
                  type: object
                  properties:
                    id: 
                      type: string 
                    name:
                      type: string 
                    rating:
                      type: number
                    picture:
                      type: string
                      format: binary
                    price:
                      type: string
                  example:
                    - id: 1
                      name: 'Hacking the art of exploitation.'
                      rating: 4.5
                      picture: '/hacking-the-art-of-exploitation.png'
                      price: '52.37£'
                    - id: 5
                      name: 'Eloquent Javascript.'
                      rating: 4.2
                      picture: '/eloquent-javascript.png'
                      price: '35.72£'
  
  /users/{id}/cart:
    get:
      operationId: R501
      summary: 'R501: View Cart'
      description: 'Show the contents of the cart of a specific user. Access: USR'  
      tags:
        - 'M05: Cart & Checkout'

      parameters:
        - in: path
          name: id 
          schema: 
            type: integer 
          required: true 
      
      responses:
        '200':
          description: 'Ok. Show the User Cart UI (UI19)'
        '404':
          description: 'User not found, page not found.'
  
  /users/{id}/add_to_cart/{id_prod}:
    post: 
      operationId: R502
      summary: 'R502: Add to cart'
      description: 'Add a product to cart. Access: USR' 
      tags:
        - 'M05: Cart & Checkout'
      
      parameters:
        - in: path
          name: id
          schema:
            type: integer 
          required: true 
        - in: path
          name: id_prod
          schema:
            type: integer
          required: true

      requestBody:
        required: true
        content:  
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                quantity:
                  type: integer
              required:
                - quantity
      
      responses:
        '302':
          description: 'Adding product to wishlist'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successfully added the desired product to the cart'
                  value: /users/{id}/cart
                302Error:
                  description: 'Unable to add the specific product to the cart'
                  value: /users/{id}/cart
  
  /users/{id}/cart/remove_from_cart/{id_prod}:
    delete:
      operationId: R503
      summary: 'R503: Remove product from cart.'
      description: 'Remove a product in a user cart. Access: USR'
      tags:
        - 'M05: Cart & Checkout'
      
      parameters:
        - in: path
          name: id 
          schema:
            type: integer 
          required: true 
        - in: path
          name: id_prod 
          schema:
            type: integer 
          required: true 
      
      responses:
        '302':
          description: 'Deleting product from cart'
          headers:
            Location:
              schema:
                type: string 
              examples:
                302Success:
                  description: 'Succesfully delete product from user cart'
                  value: /users/{id}/cart
                302Error:
                  description: 'Unable to remove product from cart.'
                  value: /users/{id}/cart 
  
  /users/{id}/checkout/cart/remove_from_cart/{id_prod}:
    delete:
      operationId: R504
      summary: 'R504: Remove product from cart in checkout.'
      description: 'Remove a product in a user cart. Access: USR'
      tags:
        - 'M05: Cart & Checkout'
      
      parameters:
        - in: path
          name: id 
          schema:
            type: integer 
          required: true 
        - in: path
          name: id_prod 
          schema:
            type: integer 
          required: true 
      
      responses:
        '302':
          description: 'Deleting product from cart'
          headers:
            Location:
              schema:
                type: string 
              examples:
                302Success:
                  description: 'Succesfully delete product from user cart'
                  value: /users/{id}/cart
                302Error:
                  description: 'Unable to remove product from cart.'
                  value: /users/{id}/cart 
  
  /users/{id}/checkout/cart/add_to_cart/{id_prod}:
    post: 
      operationId: R505
      summary: 'R505: Add to cart in checkout'
      description: 'Add a product to cart. Access: USR'
      tags:
        - 'M05: Cart & Checkout'
      
      parameters:
        - in: path
          name: id
          schema:
            type: integer 
          required: true 
        - in: path
          name: id_prod
          schema:
            type: integer
          required: true
      
      responses:
        '302':
          description: 'Adding product to wishlist'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successfully added the desired product to the cart'
                  value: /users/{id}/cart
                302Error:
                  description: 'Unable to add the specific product to the cart'
                  value: /users/{id}/cart
  
  /users/{id}/checkout/address:
    get:
      operationId: R506
      summary: 'R506: Get user address in checkout'
      description: 'Get user address in checkout. Access: USR'
      tags:
        - 'M05: Cart & Checkout'
      
      parameters:
        - in: path
          name: id
          schema:
            type: integer 
          required: true

      responses:
        '200':
          description: 'Ok show User Address UI'
        '404':
          description: 'Unable to find user' 

  /users/{id}/checkout/payment:
    get:
      operationId: R507
      summary: 'R507: Checkout payment'
      description: 'Choose the payment method. Access: USR'
      tags:
        - 'M05: Cart & Checkout'
      
      parameters:
        - in: path
          name: id
          schema:
            type: integer 
          required: true 
      
      responses:
        '200':
          description: 'Ok show User Payment Method UI'
        '404':
          description: 'Unable to find user' 

    post: 
      operationId: R508 
      summary: 'R08: Add paymeny method in cart'
      description: 'Add/Change a payment method. Access: USR'
      tags: 
        - 'M05: Cart & Checkout'

      parameters:
      - in: path
        name: id
        schema:
          type: integer 
        required: true 
      
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                creditcard:
                  type: object
                  properties:
                    name:
                      type: string
                    expirationdate:
                      type: string 
                    securitycode:
                      type: integer 
                    cardnumber:
                      type: integer
                paypal:
                  type: object
                  properties:
                    email:
                      type: string
                    password:
                      type: string

      responses: 
        '302':
          description: 'Add payment method.'
          headers:
            Location:
              schema:
                type: string 
              examples:
                302Success:
                  description: 'Successfully added payment method'
                  value: /users/{id}/checkout/payment
                302Error:
                  description: 'Unable to add the desired payment method'
                  value: /users/{id}/checkout/payment 

  /users/{id}/checkout/add_address:
    post: 
      operationId: R509
      summary: 'R509: Add address to user'
      description: 'Add a product to cart. Access: USR'
      tags:
        - 'M05: Cart & Checkout'
      
      parameters:
        - in: path
          name: id
          schema:
            type: integer 
          required: true

      requestBody:
        required: true
        content: 
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                address: 
                  type: object
                  properties:
                    name:
                      type: string 
                    streetaddress:
                      type: string 
                    aditionalinfo:
                      type: string 
                    zipcode: 
                      type: string 
                    country:
                      type: string 
                    phonenumber:
                      type: string 
                    nif:
                      type: string 

      responses:
        '302':
          description: 'Adding address to user'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successfully added the desired address to the specified user'
                  value: /users/{id}/cart
                302Error:
                  description: 'Unable to add address to the specified user'
                  value: /users/{id}/cart
  /about:
    get:
      operationId: R601
      summary : 'R601: View About Us Page'
      description: 'Show the about us page. Access: PUB'
      tags:
        - 'M06: Static pages'

      responses:
        '200':
          description: 'Ok. Show About us UI'
        
        '404':
          description: 'Page not found.'
  
  /contact:
    get:
      operationId: R602
      summary: 'R602: View Contact Us Page'
      description: 'Show the contact us page. Access: PUB'
      tags:
        - 'M06: Static pages'
      
      responses:
        '200':
          description: 'Ok. Show Contact Us UI'

        '404':
          description: 'Page not found.'
  
  /faq:
    get:
      operationId: R603
      summary: 'R603: Frequently Asked Questions'
      description: 'Show the Frequently Asked Question Page. Access: PUB'
      tags:
        - 'M06: Static pages'
      
      responses:
        '200':
          description: 'Ok. Show the Frequently Asked Questions Page.'
          content:
            application/json:
              schema: 
                type: array
                items: 
                  type: object 
                  properties:
                    id:
                      type: integer
                    question:
                      type: string 
                    answer:
                      type: string 
                  example:
                    - id: 1
                      question: 'This a faq question.'
                      answer: 'This is the answer to the faq question.'
                    - id: 2
                      question: 'This another faq question.'
                      answer: 'This is the answer to the second faq question.'
        '404':
          description: 'Ok. Show the error page UI.'

  /error:
    get:
      operationId: R604
      summary: 'R604: Error'
      description: 'Show the Error Page. Access: PUB'
      tags:
        - 'M06: Static pages'
      
      responses:
        '200':
          description: 'Ok. Show the Error Page UI'

  /users/{id}/banned:
    get:
      operationId: R605
      summary: 'R605: Banned User Notice'
      description: 'Show the banned user notice page. Access: PUB'
      tags:
        - 'M06: Static pages'

      parameters:
        - in: path
          name: id 
          schema: 
            type: integer 
          required: true 
      
      responses:
        '200':
          description: 'Ok. Show banned user notice UI'
          content:
            application/json:
              schema: 
                type: array
                items: 
                  type: object  
                  properties:
                    id_user:
                      type: integer
                    reason:
                      type: string
                  example:
                    - id_user: 15
                      reason: 'User banned for abusing community guidelines.' 
        '404':
          description: 'Page not found.'
```

# **A8: Vertical prototype**

The Vertical Prototype includes the implementation of the higher priority features. This artefact aims to validate the architecture presented, also serving to gain familiarity with the technologies used in the project.

The implementation is based on the LBAW Framework and includes work on all layers of the architecture of the solution to implement: user interface, business logic and data access. 


## **A8.1. Implemented Features**

### **A8.1.1. Implemented User Stories**


| Identifier | Name | Priority | Description |
| -----------|-------------|---------|-------|
| US01 | Homepage | High | As a User, I want to access the homepage of the website, so that I can see the page recommendations, top sellers and the most recently added books.|
| US03 | View Specific Product | High |As a User, I want to be able to access a single product page, so that I can see the specific details about the product.|
| US04 | View Product Reviews | High | As a User, I want to view specific product reviews that can influence my purchase. |
| US05 | View Products by tags or categories* | High | As a User, I want to be able to view products from a single category or tags, so that I can search products by categories or tags. |
| US07 | FAQ Page | High | As a User, I want to access the FAQ page, so that the user can clarify frequent questions easily. |
| US08 | Search Products by name on the Search Bar | High | As a User, I want to search products on the website on the search bar, with autocomplete suggestions to ease the search. |
| US09 | Search Products by applying filters or tags* | High | As a User, I want to be able to narrow my search for books, given certain preferences. |
| US11 | View Shopping Cart* | High | As a User, I want to view the items in my cart, so that I can see all the items I’m considering buying. |
| US13 | About Us Page | Low | As a User, I want to access an About Us page, so that the user can see a complete website’s description. |
| US16 | Contact Us | Low | As a User, I want to access a Contact us page. |
| US17 | Sign/Log out | High |As an Administrator, I want to sign out of the website, so that I can safely close my account. |
| US20 | Administer User Accounts (search, view, edit, create, delete)* | High | As an Administrator, I want to administer user accounts, so that I can ‘control’ all the users with an account on my website. |
| US21 | Add Product | High | As an Administrator, I want to add a product to the system, so that users can purchase it. |
| US22 | Edit Product Information | High | As an Administrator, I want to edit product information, so that it is always correct. |
| US23 | Edit Product Stock | High | As an Administrator, I want to edit product stock, so that I can update it. |
| US29 | Archive Product | Low | As an Administrator, I want to archive a product, so that it cannot be purchased by users anymore. |
| US33 | Sign In | High | As a Guest, I want to sign in to my previously created account, so that I can access privileged information. |
| US34 | Sign Up | High | As a Guest, I want to create an account on the website, so that I can later authenticate myself and enter the system. |
| US36 | View Profile* | High | As an Authenticated user, I want to view my profile to check if my information is right. |
| US40 | View Wishlist* | High | As an Authenticated user, I want to view my Wishlist to remember the items I liked. |
| US43 | Sign Out | High | As an Authenticated user, I want to be able to sign out of the website. |
| US46 | Item Review | High | As a Buyer, I want to review an item that I bought. |
| US47 | Edit Review| High | As a Buyer, I want to be able to edit my review on an item to improve it. |
| US48 | Delete Review | High | As a Buyer, I want to delete my review on an item. |

 - The User Stories sinalized with an **asterisc** (*) are the ones we only implemented a 'view' skeleton, only retrieving data from the database, until the moment of delivery. 

### **A8.1.2. Implemented Web Resources**


#### **M01: Authentication and User Profile**

| Web Resource Reference | URL |
| -----------|-------------|
| R101: Login Form | GET /login |
| R102: Login Action | POST /login |
| R103: Logout Action | POST /logout |
| R104: Register Form | GET /register |
| R105: Register Action | POST /register |
| R106: View User Profile* | GET /users/{id} |


#### **M02: Administrator/Management Area** 

| Web Resource Reference | URL |
| -----------|-------------|
| R201: View Product List | GET /admin/products/{id} |
| R202: Edit Product on Product list | POST /admin/products/{id} |
| R202: Delete Product on Product list | POST /admin/products/{id} |
| R202: Create Product on Product list | POST /admin/products/{id} |


#### **M03: Product, Reviews & Wishlisting** 

| Web Resource Reference | URL |
| -----------|-------------|
| R301: View Product Page | GET /products/{id} |
| R302: View Product Reviews | GET /products/{id}/reviews |
| R303: Add Review Action | POST /products/{id}/reviews/add |
| R304: Edit Review Action | PUT /products/{id}/reviews/{id_rev}/edit |
| R305: Delete Review Action | DELETE /products/{id}/reviews/{id_rev}/delete |
| R307: View User Wishlist | GET /users/{id}/wishlist |


#### **M04: Product and Categories**

| Web Resource Reference | URL |
| -----------|-------------|
| R401: Search Products Action | GET /api/products |


#### **M05: Cart and Checkout** 

| Web Resource Reference | URL |
| -----------|-------------|
| R501: View Cart | GET /cart | 


#### **M06: Static Pages** 

| Web Resource Reference | URL |
| -----------|-------------|
| R601: View About Us Page | GET /about |
| R602: View Contact Us Page | GET /contact |
| R603: Frequently Asked Questions | GET /faq | 
## **A8.2. Prototype**

The prototype is available at http://lbaw2193.lbaw.fe.up.pt.

 - Credentials:
      - Admin:
            - email: lbaw2193@gmail.com 
            - password: lbaw2193_! 
      - User normal: 
            - email: johndoe@up.pt
            - password: lbaw_test

The code is available at https://git.fe.up.pt/lbaw/lbaw2122/lbaw2193 .


## **Change Log**:

* Week from Dec 6th to Dec 11th, 2021 - Started A7 - Divided Web Resources ideas in Modules.
* Week from Dec 12th to Dec 18th, 2021 - Continued A7 development.
* Week from Dec 19th to Dec 25th, 2021 - Finished A7 component, merged all team member work.
* Week from Dec 26th to Jan 1st, 2022 - Started A8.
* Week from Jan 2nd to January 6th, 2022 - Completed A8 - Vertical Prototype - Added Implemented Features until now to the wiki.

---

## **GROUP2193, 06/01/2022**
### **Authors** :

* Ana Matilde Guedes Perez da Silva Barra 	up201904795
* José Pedro Abreu Silva	up201904775
* Renato Dangel Fortes Leite 	up201908633
* Rui Pedro Mendes Moreira 	up201906355

---

### **Editor** :

* Rui Pedro Mendes Moreira 	up201906355