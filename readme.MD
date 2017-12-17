# Gallery site

Test project for two kind of users(editor, regular) where 

###editor user can 

* create, update, delete galleries and add or delete photos from that galleries
* view galleries list and view photos in gallery

### regular user can

* view galleries list and view photos in gallery

## Configuration

* unpack archive
* open app/config.php and set baseUrl to match with your server (optional)
* if you are able to run shell script then run ./install.sh else run
    * composer dump-autoload (will make autoloader vendor/autoload.php)
    * php seeder.php (will fill json files inside app/storage folder with fake data for testing)
* open browser and navigate to the url witch you set as your baseUrl ex. http://gallery.local  
        
## Structure

* app                
    * Controllers
        * Auth.php
        * Gallery.php
        * Home.php
        * Photo.php
    * Models
        * Gallery.php    
        * Photo.php    
        * User.php    
    * storage
        * galleries.json
        * photos.json
        * users.json
    * views
        * auth
            * login.php
        * gallery 
            * create.php    
            * edit.php    
            * index.php 
        * layouts
            * footer.php
            * header.php
        * photo
            * index.php
        * home.php               
    * config.php
* src
    * Interfaces
        * StorageInterface.php
    * Storage
        * JsonStorage.php
    * App.php        
    * BaseController.php        
    * BaseModel.php        
    * Upload.php        
* uploads
* .htaccess
* composer.json
* config.php
* index.php
* install.sh    
* install.sh
* readme.MD
* seeder.php    
