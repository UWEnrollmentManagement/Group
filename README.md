[![Build Status](https://travis-ci.org/UWEnrollmentManagement/Group.svg?branch=master)](https://travis-ci.org/UWEnrollmentManagement/Group)
[![Latest Stable Version](https://poser.pugx.org/uwdoem/group/v/stable)](https://packagist.org/packages/uwdoem/group)

UWDOEM/Group
=============

Smoothly poll the University of Washington's Person Web Service (PWS) and Student Web Service (SWS) to aggregate data on a given affiliate, using X.509 certificate authentication.

Notice
------

This is *not* an official library, endorsed or supported by any party who manages or owns information accessed via GWS. This library is *not* endorsed or supported by the University of Washington Department of Enrollment Management.

Installation
------------

This library is published on packagist. To install using Composer, add the `"uwdoem/group": "1.*"` line to your "require" dependencies:

```
{
    "require": {
        "uwdoem/aliro": "1.*"
    }
}
```

Of course it is possible to use *Aliro* without Composer by downloading it directly, but use of Composer to manage packages is highly recommended. See [Composer](https://getcomposer.org/) for more information.


Use
---

You will need a private key and university signed certificate to access the GWS.

You can set the required settings anywhere in your app, but we recommend using a local-settings.php file.

```
// Intialize the required settings 
define('UW_GWS_BASE_PATH', '/path/to/your/api/'); 
define('UW_GWS_SSL_KEY_PATH', './path/to/your/key'); 
define('UW_GWS_SSL_CERT_PATH', './path/to/your/certificate'); 
define('UW_GWS_SSL_KEY_PASSWD', 'yourpassword'); // Can be blank for no password: '' 
define('UW_GWS_VERBOSE', true); // (Optional) Whether to include verbose cURL messages in error messages.
```

The terms `UW_GWS_SSL_KEY_PATH and UW_GWS_SSL_CERT_PATH` correspond to the absolute locations of your private key and university-signed certificate. `The UW_GWS_SSL_KEY_PASSWD` corresponds to the string which unlocks your private key; if your key does not have a password then use a blank string, eg: ''.

The term `UW_GWS_BASE_PATH` corresponds to the base URL for the group web service.

Now you can create a group access object, and begin querying the GWS. For more information about which endpoints are available, please refer to the GWS documentation.

```
$g = new Group("test_group_name"); // You can pass either the group name or id

$memberList = $g->getMembers()
```

Troubleshooting
---

_X-Act-As_

Some endpoints will return an error if you set X-Act-As, while others allow it. Make sure you are using UWDOEM/Connection 3.*, and that you are not including X-Act-As in connection options.

Requirements
---
* PHP 7.0
* uwdoem/connection 3.*
