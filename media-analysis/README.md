# PHP SDK for Textalytics Media Analysis API

> Make the most of what people say about your company in social and traditional media..


## Description

This SDK allows to test the functionality provided by [Textalytics Media Analysis API](https://textalytics.com/semantic-api-media-analysis). It has the following structure:

* _MyClient.php_: example client.
* _SMAClient.php_: auxiliary class to wrap the API calls and the results.
* _Document.php_: auxiliary class to model the document used in the API.
* _Post.php_: auxiliary class to make a POST request.
* _Response.php_: auxiliary class that wraps the response.
* _config.inc_: environment configuration.
* _example.txt_: text example.
* _domain/*_: auxiliary classes to implement the different elements extracted by the API.


## Example Usage:
Use this command to analyze the contents of a text (specified directly or through a file) and extract 
all relevant information:
```sh
   php MyClient.php -key=<key> -what=<elements> -txt=<text> 
   php MyClient.php -key=<key> -what=<elements> -file=<filename>
```
You need a **key** to call textalytics services. If you don't know what your license key is, just check your [personal area](https://textalytics.com/personal_area) at Textalytics.


## Contact

Do you have any questions? Do you have any suggestiongs on how we can keep improving? Have you found a bug?
Contact us at support@textalytics.com or through our [Feedback section](https://textalytics.com/core/feedback).


## Usage, license and copying

Textalytics is a cloud service provided by DAEDALUS. S.A.

This client may be used in the terms described in the LICENSE file.

For details please refer to: http://www.textalytics.com

Copyright (c) 2014, DAEDALUS S.A. All rights reserved.

