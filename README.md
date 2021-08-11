# Hospital management app

This app was made according gained task, during 4-5 days. 

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_21.png)

## Installation

    git clone https://github.com/arvydux/hospital.git
    cd hospital
    composer update
    cp .env.example .env
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
    php artisan serve    

## Credentials

Jonas Balciunas
login:jonas.jalciunas@email.com
password:secret1234

Andrius Lubauskas
login:andrius.lubauskas@email.com
password:secret1234

Receptionist
login:receptionist@email.com
password:secret1234

## REST API

Get all prescriptions
http://127.0.0.1:8000/api/prescriptions

Get patient's prescriptions
http://127.0.0.1:8000/api/prescriptions/patient/{id}

id - patient ID

# Getting started

This app can use as receptionists to register patients and make appointments for them as well the doctors to see their patients, its prescriptions, and also make new ones and cancel it. 

In our database there are 4 tables prefilled with data by seeders. So, we do not need to fill or register it ourselves. "Doctor" table contain 5 doctors records. "Users" table contain 3 records: 2 for doctors and 1 for receptionist. "Roles" table contain to 2 roles for doctors and 1 for receptionist. And finally, table "user_roles" contain records which map users with their roles. 
![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_1.png)

Let's begin from the doctor. For demonstration sake we will login as "Jonas Balciunas" (it's credentals are showed above).

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_2.png)

For while thas doctor's shedule table is empty, so receptionist can't make appointment to it. Let's add a few days of work. Click "Add workday"

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_3.png)

Now we have shedule with several days of work. And receptionist can make appointment for patients to that doctor. 

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_4.png)

Now lets login as "Receptionist" (it's credentals are showed above).

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_5.png)

Here the receptionist can see all doctors registered in that system. First, we need to add a patient to dababase. Lets' to it. I will add myself with my real email. And for the demonstration sake lets add a few more patients.  

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_6.png)

After that we can make appointments for Jonas Balciunas. Go to the "View appointments" and click "Book appointment".

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_7.png)

Now we see a list of time slots for Jonas Balciunas. Amount of slots available according doctor's shedule and appointment duration time. 

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_8.png)

Lets select free availabe slot and pick a patient from the list and register for it the appointment.

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_9.png)

Lets try to make another appointment for the same doctor (Jonas Balciunas). Now after patient have been registered, we can see that time slot is also reserved/unavailable anymore.

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_10.png)

Now we can see a list of doctors appointments. 

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_11.png)

Let's change a time of some appointment.

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_12.png)

Now patient's(my) appointment time is changed.

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_13.png)

Let's again login as "Jonas Balciunas", and click to "View patients"

Here doctor can see a paginated lixt of all this patients.

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_14.png)

Now let's click "Make prescription" for patients(Arvydas Kavaliauskas).

When we type drug name, the query is being made to "Drugs" table, to retrieve results, so user could select appropeate record from drop down list. The table "drugs" consist of 20.000 fake records, made with DrugSeeder.

The table "drugs" consist of 20.000 fake records, made with DrugSeeder.

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_15.png)

Click "Add prescription"

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_16.png)

After prescription was made, patient receives an email about prescription assigned.

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_17.png)

Now let's click "View prescriptions"

We can see a paginated list of patient's prescriptions. Doctor can see paginated list of prescriptions of his pateints. Doctor can cancel prescriptions until 1 hour after being created. If 1 hour have beeen passed there is not possible to delete it.

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_20.png)

There is a dashboard with of statistics is availabe abouts for every logged user.

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_22.png)

The REST API requests are available. We can get list of all prescriptions, or just one's patients by providing it's ID parameter. API queries are described above.

![Image description](https://github.com/arvydux/hospital/blob/main/src/Screenshot_19.png)


That is all. 

I hope you liked my app. :)

Thank you for your attention!
