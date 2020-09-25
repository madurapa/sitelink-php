# SiteLink API Integration in PHP for Self Storage Websites

SiteLink's self-storage software helps small and large self-storage operators manage their self-storage tenants and grow profits while reducing costs.

##### PHP 7.* VERSIONS

> This codebase was written many years ago. That was the PHP 5 era, since then they have abandoned some of the old functions that were used when it upgraded to PHP 7 so this codebase will not work smoothly on PHP 7. Unfortunately, I couldn't do the maintenance on time due to a lack of finding spare time. If you want to upgrade or add new features please contact me via madu.rapa@gmail.com - _September 2020_


## Introduction

This code base is written in PHP and use CodeIgniter Web Framework 3 but if you can get the idea, you can implement this into any framework even into any language. CodeIgniter documentation can be found at http://www.codeigniter.com/user_guide/


## The Plot

When I try integrate SiteLink API to a site I was searching for some reference to get some help but have I ended up with nothing. I only had their API doc but with the API doc you can do almost nothing. I think they should provide more details. I’m going to list down what are the cons with their documentation.
* There is no explanation about which steps you have to fallow (which method you have to call in the first place and which one next and so on…)
* Some method’s parameter names are different than in the API doc.
* Lack of code samples for different languages.

But their support team is just amazing… They always be there to help you at anytime. This code base is here just because of their help. You can reach them at apisupport@sitelink.com
 
## Requirements

* SiteLink API Usage License Agreement: http://apilicense.sitelink.com
* You must obtain a SiteLink API License Key by clicking on the following link and filling out the
  request form: http://apilicensekey.sitelink.com
* An additional application, located at (http://apilicenseapplication.sitelink.com), and separate written permission of such API Integrators is required.
* Latest Version of the API Document: http://apidoc.sitelink.com

> It's a password protected PDF which requires an Nondisclosure Agreement to be signed to receive the password.
> You will have to provide the below information about the company and they will send you their (NDA).
> * Company Name
> * Company Mailing Address
> * Company Phone Number
> * Company Website

* A Corporate API User Account

> To access a training video on how to create the API User Account click the link below and go to Corporate Control -> API Users and Rights. http://www.sitelink.com/support/training
  
## Server Requirements

* Port 443 open for HTTPS communication.
* SoapClient is required.
* Apache mod_rewrite extension must be enabled.


## The Steps!

This is the most important part of this code base. In this section you are going to understand which steps you need to fallow to be able to connect to Sitelink API then get and send the relevant data for the operation.

1. [Before you start](https://github.com/madurapa/sitelink-php/wiki/Before-you-start)
2. [Get list of Storage Locations](https://github.com/madurapa/sitelink-php/wiki/Get-list-of-Storage-Locations)
3. [Get Site Information by Location Code](https://github.com/madurapa/sitelink-php/wiki/Get-list-of-Units-Information-by-Location-Code)
4. [Get list of Units Information by Location Code](https://github.com/madurapa/sitelink-php/wiki/Get-Site-Information-by-Location-Code)
5. [Get Unit Information by Unit ID](https://github.com/madurapa/sitelink-php/wiki/Get-Unit-Information-by-Unit-ID)
