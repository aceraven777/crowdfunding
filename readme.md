# Laravel 5 Boilerplate

Boilerplate for website with frontend and backend (admin) pages.

## Setup

This setup by default have users and admin_users table and their respective models and AuthControllers. Views for the admin is in the folder ```resources/views/admin```. You can change the name to your liking.

#### Config

Check the app/auth.php.

#### Middleware

Check ```app/Http/Middleware/Authenticate.php```. Define login redirect path for each guard if you are attempting to access a page that require auth credentials.

#### Auth Controllers

All Auth Controllers extends ```AuthBaseController``` then call the parent constructor and pass the guard in the parameter, the purpose of this is to make sure the ```url.intended``` is valid for current segment.

Example:

1. Assuming that you are logged out.
2. When you visit ```/backend```, the ```url.intended``` is set to ```/backend```, then you will redirect back to ```/backend/login```
3. Then you visit ```/login``` (the guard of this will be 'web'), so the code in the constructor of ```AuthBaseController``` will remove the ```url.intended``` in the session because the current url intended is for the guard 'admin'.
