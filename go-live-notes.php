1. Remove 'This is a test' from UsersController.php
2. Check all [Add Code] blocks to fill missing requiremnts
3. Change $email->domain('rentsquaredev.com');
4. Create One Time Fee Email
5. Payment Method Contoller - Change user and password from demo/password
6. Remove rentsquaredev from email images

Cron Jobs
/home2/onepage3/public_html/lib/Cake/Console/cake SendReminder -app /home2/onepage3/public_html/app
/home2/onepage3/public_html/lib/Cake/Console/cake UpdateBilling -app /home2/onepage3/public_html/app

To Do:

1. Resident Payment Screen
//Calculate Rent Due = Rent Total + Recurring Fee - Free Rent
//		ACH => Rent Total + recurring fee - free rent + fee $3.95 (fee only if tenant paying fees)
//		CC/Debit - Rent Total + recurring fee - free rent + fee  2.75% (fee only if tenant percent)

2. Recurring & Default checkbox on Add payment screen

3. Talk to sean about emails being sent out per day limit on shared hosting











API Test

username
demo

password
password

POST URL
https://gateway.teledraft.com/api/transact.php

Visa
4111111111111111
MasterCard
5431111111111111
DiscoverCard
6011601160116611
American Express
341111111111111
Credit Card Expiration
10/10
account (ACH)
123123123
routing (ACH)
123123123

Add a Customer to the Customer Vault:
Data posted to the Payment Gateway by Merchant

 username=demo&password=password&firstname=Joe&lastname=Smith&address1=1234 Main St.&city=Chicago&state=IL&country=US&ccnumber=4111111111111111&ccexp=1010&customer_vault=add_cus

Update a Customer’s credit card number and expiration date:
 username=demo&password=password&ccnumber=5431111111111111&ccexp=1012&customer_vault=update_ 
 

Process a ‘sale’ transaction using a Customer Vault record:
 username=demo&password=password&amount=10.00&customer_vault_id=00001
