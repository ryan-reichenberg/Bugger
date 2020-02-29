# Bugger - Bug Tracking

A Distinction Task for COS30041 - Creating Secure and Scalable Software

An application that tracks bug descriptions by project and displays stats in a dashboard.

## Technologies
* Laravel Framework(PHP)
* Blade Templating Engine
* Eloquent ORM
* Docker
* MySQL
* Nginx

## To Get Started:
Simply run:\
`./start.sh`\
This will start the application in an Nginx web server with a MySQL instance.

To stop the running containers, run:\
`./stop.sh [--clean-up]`\
Run with the clean up flag to remove the created images.

## TODO:
* Improve Registraion workflow
* Integrate Email sending into Docker environment
* Create consistency among different size viewports
* Unit Tests

