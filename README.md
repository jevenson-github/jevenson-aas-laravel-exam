

<!-- ABOUT THE TEST -->
## Goal

Develop an API or service to manage and visualize an organizational chart. The endpoints
should be able to handle position names and define connections between positions.


### Prerequisites

* Laravel 10
* Composer
* PHP ^8.1
* MySQL 8
* Postman


<!-- PROJECT SETUP AND INSTRUCTION   --> 
## Project Setup

### Cloning the Project 

After you clone this project there are some files that need to run your Laravel Application . 

### 1. Install Composer Dependencies

* Run the following command : 
    * *composer install* 

### 2. Setup the Environment ( .env )

* Duplicate the file :
    * Duplicate or copy the ( .env.example ) file.
* Rename the Copy : 
    * Rename the duplicated file to (.env ) . 

### 3. Generate Application Key 

* Run the following command : 
  *  *php artisan key: generate*

### 4. Install Node.js Dependencies if you are using JavaScript libraries or CSS ( Optional )

* Run the following command:
  * *npm install*
* Once the npm is installed , run the following command to compile JavaScript and CSS assets
  * *npm run dev*

### 5. Migrate Database
* Run the following command:
  * *php artisan migrate*

### 6. Launch the project

* Run the following command
  * *php artisan serve*
* Viewing the application 
   * Great! Now that you've installed all the necessary dependencies and the server is up and running, 
     you can access the web application by pasting the following URL into your browser: 
   * URL : *http://127.0.0.1:8000*
   * This will allow you to view and start your own modification in project.


## Test Laravel API with Artisan 

*  Create separate testing file 
  * *copy and paste your .env file and rename the file to .env.testing*
*  Create separate database for testing 
  * rename your database in .env.testing.    
    DB_CONNECTION=mysql  
    DB_HOST=127.0.0.1  
    DB_PORT=3306  
    DB_DATABASE=laravel_testing  
    DB_USERNAME=root  
    DB_PASSWORD=  
* Migrate the testing database 
  * *php artisan migrate*
* Run test
  * *php artisan test*


## Test Laravel API with Postman   

  To test your Laravel API with Postman, create a new request, set the method (GET, POST, etc.).  
  Enter the URL (e.g., http://127.0.0.1:8000/api/position), add any necessary headers , body data or raw JSON , and click Send to view the response.    
  

## Test Laravel API using the web template ( Optional )
  
 You can also test the web application on the client side by visiting http://127.0.0.1:8000.  
 This will allow you to interact with the API functionalities through an interactive user interface. 



