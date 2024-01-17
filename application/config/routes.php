<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Videocatalog';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['video/watch/(:any)'] = 'Videocatalog/watch/$1';
$route['video/place-order/(:any)'] = 'Videocatalog/placeProductOrder/$1';
$route['video/place-order/(:any)/(:num)'] = 'Videocatalog/placeProductOrder/$1/$2'; //response
$route['video/submit-product-order']['post'] = 'Videocatalog/productOrderFormSubmit';
$route['video/search'] = 'Videocatalog/searchResult';
$route['video/search/(:any)'] = 'Videocatalog/searchResult/$1'; //category to show

$route['subscriber/register'] = 'Register/showRegistrationForm';
$route['subscriber/register/(:any)'] = 'Register/showRegistrationForm/$1';
$route['subscriber/proc-register']['post'] = 'Register/procRegistrationForm';

$route['subscriber/account-activation/(:any)']['get'] = 'Register/activateAccount/$1';

$route['subscriber/signin'] = 'Signin/showSignInForm';
$route['subscriber/signin/(:any)/(:any)'] = 'Signin/showSignInForm/$1/$2';
$route['subscriber/proc-signin']['post'] = 'Signin/procSignIn';

$route['subscriber/logout'] = 'Signin/logout';
$route['subscriber/logout/(:any)'] = 'Signin/logout/$1';

$route['subscriber/account-view/(:any)']['get'] = 'Membership/showSubscriberAccountDetails/$1';


$route['admin/dashboard'] = 'Admin/showDashboard';
$route['admin/dashboard/(:any)'] = 'Admin/showDashboard/$1';

$route['admin/ls-category'] = 'Admin/showAllCategory';
$route['admin/ls-category/(:num)'] = 'Admin/showAllCategory/$1';

$route['admin/ls-videos'] = 'Admin/showAllVideo';
$route['admin/ls-videos/(:num)'] = 'Admin/showAllVideo/$1';

$route['admin/video-upload'] = 'Admin/showVideoUploader';
$route['admin/video-upload/(:num)'] = 'Admin/showVideoUploader/$1';

$route['admin/edit-video-upload'] = 'Admin/showEditVideoUploader';
$route['admin/edit-video-upload/(:any)'] = 'Admin/showEditVideoUploader/$1';
$route['admin/proc-edit-video'] = 'Admin/processEditVideo';
$route['admin/proc-delete-video'] = 'Admin/processDeleteVideo';

$route['admin/encode-video-upload/(:any)'] = 'Admin/processEncodeVideoRequest/$1'; //request video encoding

$route['admin/new-category'] = 'Admin/showCreateCategory';
$route['admin/new-category/(:num)'] = 'Admin/showCreateCategory/$1';

$route['admin/edit-category'] = 'Admin/showEditCategory';
$route['admin/edit-category/(:any)'] = 'Admin/showEditCategory/$1';

$route['admin/login'] = 'Admin/processLogin';
$route['admin/logout'] = 'Admin/processLogout';

$route['admin/change-password'] = 'Admin/showChangePassword';
$route['admin/change-password/(:num)'] = 'Admin/showChangePassword/$1';
$route['admin/proc-new-password'] = 'Admin/procChangePassword';

$route['admin/proc-video-upload'] = 'Admin/processUploadVideo';

$route['admin/proc-new-category'] = 'Admin/processCreateCategory';
$route['admin/proc-edit-category'] = 'Admin/processEditCategory';
$route['admin/proc-del-category'] = 'Admin/processEditCategory';

$route['admin/ls-products'] = 'Admin/showProductList';
$route['admin/ls-products/(:num)'] = 'Admin/showProductList/$1';
$route['admin/new-product'] = 'Admin/showCreateProduct';
$route['admin/new-product/(:num)'] = 'Admin/showCreateProduct/$1';
$route['admin/edit-product/(:any)'] = 'Admin/showEditProduct/$1';

$route['admin/proc-new-product'] = 'Admin/processNewProduct';
$route['admin/proc-edit-product'] = 'Admin/processEditProduct';
$route['admin/proc-delete-product'] = 'Admin/processDeleteProduct';

$route['admin/product-orders'] = 'Admin/showAllProductOrders';
$route['admin/product-orders/(:num)'] = 'Admin/showAllProductOrders/$1';
$route['admin/respond-product-order/(:num)'] = 'Admin/procRespondProductOrder/$1';
$route['admin/del-product-order'] = 'Admin/procDeleteProductOrder';

$route['admin/proc-homebanner-upload'] = 'Admin/procUpdateHomeBanner';

$route['admin/ls-subscribers'] = 'Admin/showMembershipSubscribers';
$route['admin/ls-subscribers/(:any)'] = 'Admin/showMembershipSubscribers/$1';

$route['admin/ls-subscription-plan'] = 'Admin/showMembershipPlans';
$route['admin/ls-subscription-plan/(:any)'] = 'Admin/showMembershipPlans/$1';

$route['admin/new-subscription-plan'] = 'Admin/showCreateMembershipPlan';
$route['admin/new-subscription-plan/(:num)'] = 'Admin/showCreateMembershipPlan/$1';

$route['admin/proc-new-subscription-plan']['post'] = 'Admin/procCreateMembershipPlan';

$route['admin/edit-subscription-plan'] = 'Admin/showEditMembershipPlan';
$route['admin/edit-subscription-plan/(:any)'] = 'Admin/showEditMembershipPlan/$1';
$route['admin/proc-edit-subscription-plan']['post'] = 'Admin/procEditMembershipPlan';

$route['admin/del-subscription-plan']['post'] = 'Admin/procDeleteSubscriptionPlan';


//webhooks
$route['api/hook/add-media-resp']['post'] = 'Wencoding_manager/addMediaEncResponse';
$route['api/hook/update-media-resp']['post'] = 'Wencoding_manager/updateMediaEncResponse';
$route['api/hook/update-mediaposter-resp']['post'] = 'Wencoding_manager/updateMediaPosterResponse';
$route['api/hook/delete-media-resp']['post'] = 'Wencoding_manager/deleteMediaEncResponse';
$route['api/hook/get-mediastatus-resp']['post'] = 'Wencoding_manager/getMediaEncStatusResponse';

//ajax requests
$route['api/video-search/(:any)']['post'] = 'Videocatalog/searchQueryResponder/$1';