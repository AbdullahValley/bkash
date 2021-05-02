# bKash Payment ~ Laravel & Raw PHP
New bKash Payment Gateway API for Laravel Framework as well as Raw PHP. Specially for bKash Tokenized Checkout.

![bkash-payment](https://user-images.githubusercontent.com/30390432/90474593-6fa17000-e147-11ea-85d8-4702c6fa6a1d.png)
![bkash-tokenized-payment](https://user-images.githubusercontent.com/30390432/90474602-7334f700-e147-11ea-8e4e-6d93ac1d25dc.png)

## Laravel Framework
You can easily use it for your laravel framework project. Check the **routes.php, bkash-payment.blade.php** and **BkashController.php** files and enjoy.

## Raw PHP Guidelines
You can use it for your raw PHP project. I have collected these code from **bKash Developer** GitHub. Please goto **Raw PHP folder** and get all the files. Run the **payment.php** file on your server.
1. app_key/app_secret and username/password will be shared with merchants during payment gateway onboarding.
2. Merchant should preapre own code-base using provided sample.
3. Merchant should go through https://developer.bka.sh/reference first for clear understanding about payment gateway APIs.


## Information / Requirements
This is for **bkash Merchant** Payment Gateway. If You have bkash Merchant account then you can get payment from your customers and send them auto confirmation via your website.

1. PHP: cURL
2. Javascript : jQuery
3. To integrate bKash Payment Gateway your site must have a valid SSL certificate.
4. API timeout of 30sec should be set for all the APIs.

### Steps for using solutions of bKash Payment Gateway

#### Step 1: On-board as a bKash Merchant
> **app_key + app_secret** and **username + password** will be shared with merchants during payment gateway onboarding.
#### Step 2: Stage on Sandbox
> **Sandbox endpoint:** https://.sandbox.bka.sh
#### Step 3: Go Live on Production
> **Production endpoint:** https://.pay.bka.sh

#### Required APIs 
0. **Developer Portal** (detail Product, workflow, API information): https://developer.bka.sh/docs/checkout-process-overview
1. **Grant Token :** https://developer.bka.sh/v1.2.0-beta/reference#gettokenusingpost
2. **Create Payment :** https://developer.bka.sh/v1.2.0-beta/reference#createpaymentusingpost
3. **Execute Payment :** https://developer.bka.sh/v1.2.0-beta/reference#executepaymentusingpost
4. **Query Payment :** https://developer.bka.sh/v1.2.0-beta/reference#querypaymentusingget
5. **Search Transaction Details :** https://developer.bka.sh/v1.2.0-beta/reference#searchtransactionusingget

### Checkout Demo
1. Go to https://merchantdemo.sandbox.bka.sh/frontend/checkout/version/1.2.0-beta
2. **Wallet Number:** 01770618575
3. **OTP:** 123456
4. **Pin:** 12121

## License
### Alhamdulillah ~ All Praise is Due to ALLAH Alone ...

> **Its my open source contribution.** Thank you for using.

## Credits
1. [Abdullah Al Noman](https://github.com/AbdullahValley)
2. [Abdullah Al Mamun](https://github.com/mamun417) ❤️ ❤️
