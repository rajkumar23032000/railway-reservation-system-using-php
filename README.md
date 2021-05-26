# railway-reservation-system-using-php
Railway Reservation System

This web application has two portals :

1. Admin Portal --> the admin can add the details of the train, update the details and delete the trains.
2. User Portal --> the user can book tickets for the available journeys and view the booking details

Technology Stack:- Frontend --> HTML, CSS, Bootstrap, jQuery. Backend --> PHP, MySQL

Steps to download and run this application :-

1. Download and extract the file.
2. Create the following database using phpmyadmin or mysql :- a. create a database "railwayreservationsysyem". b. create 3 tables "user_details", "train_details", "booking_details" in the created database. c. Structure of "user_details" table --> email_id(type-varchar(30), primary), passwd(type-varchar(100)), user_name(type-varchar(30)), mobile_no(type-bigint(20), role(type-int(11))). d. Structure of "train_details" table --> train_no(type-varchar(30), primary), train_name(type-varchar(50)), journey_from(type-varchar(30)), journey_to(type-varchar(30)), journey_date(type-date), journey_timing(type-time), price(type-int(11)), total_seats(type-int(11)), tickets_booked(type-int(11)). e. Structure of "booking_details" table --> s_no(type-int, primary), train_no(type-varchar(30)), email_id(type-varchar(30)), no_of_seats(type-int(11)), booked_time(type-datetime).
3. Start the server and run the files.
signin.html or signup.html is the starting page.
