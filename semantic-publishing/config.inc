<?php //config.inc 
/**********************************************************************************/
/* Textalytics semantic publishing API 1.0                                        */ 
/* API Configuration file                                                         */
/*                                                                                */
/* @author     Textalytics                                                        */
/* @version    1.0 -- 02/2014                                                     */
/* @contact    http://www.textalytics.com (http://www.daedalus.es)                */
/* @copyright  Copyright (c) 2014, DAEDALUS S.A. All rights reserved.             */
/**********************************************************************************/

// Service parameters
define('PROTOCOL','http');
define('HOST_API','textalytics.com');
define('SERVICE_NAME','/api/sempub/1.0');
 
define('SERVICE_URL_SEMTAG', PROTOCOL."://".HOST_API.SERVICE_NAME.'/semantic_tagging');
define('SERVICE_URL_MANAGE', PROTOCOL."://".HOST_API.SERVICE_NAME.'/manage');
define('SERVICE_URL_CHECK', PROTOCOL."://".HOST_API.SERVICE_NAME.'/check');

// User parameters
define('KEY', '<<<your license key>>>');
?>
