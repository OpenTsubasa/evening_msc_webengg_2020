<?php

    session_start();

	if (isset($_GET['page'])) {
    	Go($_GET['page']);
    } else {
        Go('error');
    }

    function Go($page) {
    	include('controllerhelper.php');
        
        $page = SanitizeString($page);
        
        if ($page != 'like' && $page != 'unlike') {
            include($header);
        } else if (($_SERVER['REQUEST_METHOD'] == 'POST') && (($page == 'like') || ($page == 'unlike'))) {
            switch ($page) {
                case 'like':
                    unset($message);
                    if(isset($_POST['pid']) && !empty($_POST['pid'])) {
                        $pid = $_POST['pid'];
                        $cid = $_SESSION['customer']['cid'];
                        if (!Like($pid, $cid)) {
                            $message = "error";
                        }
                    }  else {
                        $message = "error";
                    }
                    if (!isset($message)) {
                        $message = "Successfully Liked :-)";
                    }
                    $data = array(
                        "message" => $message, 
                        "pid" => $pid
                    );
                    echo json_encode($data);
                    break;

                case 'unlike':
                    unset($message);
                    if(isset($_POST['pid']) && !empty($_POST['pid'])) {
                        $pid = $_POST['pid'];
                        $cid = $_SESSION['customer']['cid'];
                        if (!UnLike($pid, $cid)) {
                            $message = "error";
                        }
                    }  else {
                        $message = "error";
                    }
                    if (!isset($message)) {
                        $message = "Oooh! Un-Liked :-(";
                    }
                    $data = array(
                        "message" => $message, 
                        "pid" => $pid
                    );
                    echo json_encode($data);
                    break;
            }
            return;
        } else {
            include($header);
        }
        
    	
        if (array_key_exists($page, $pages)) {
            switch ($page) {
                case 'home':
                    unset($movie_trivia);
                    $movie_trivia = GetJSONData();
                    if (empty($movie_trivia) || !isset($movie_trivia)) {
                        $movie_trivia = "Currently unavailable!!!";
                    }
                    include($pages[$page]);
                    break;

                case 'register':
                    unset($message);
                    unset($successmessage);
                    include($pages[$page]);
                    break;

                    case 'processregistration':
                        if (isset($_POST['submit']) != '') {
                            if (trim($_POST['name'])=='' || trim($_POST['email'])=='' || trim($_POST['password'])=='') {
                                $message = "Please fill all the fields with valid data.";
                            } else {
                                $name = SanitizeString(trim($_POST['name']));
                                $email = SanitizeString(trim($_POST['email']));
                                $password = SanitizeString(trim($_POST['password']));

                                if (CheckForExistingEmail($email)) {
                                    $message = "The email has already been used for registration.";
                                } else {
                                    $password = md5($password);
                                    if (CreateNewCustomer($name, $email, $password)) {
                                        $customer = CheckForCustomer($email, $password);
                                        $_SESSION['customer'] = $customer;
                                        $successmessage = "Registration successful. And you are also logined in.";
                                    }
                                }
                            }
                            include($pages[$page]);
                        } else {
                            include($error);
                        }
                        break;

                case 'login':
                    unset($message);
                    unset($successmessage);
                    include($pages[$page]);
                    break;

                    case 'processloggingin':
                        if (isset($_POST['submit']) != '') {
                            if (trim($_POST['email'])=='' || trim($_POST['password'])=='') {
                                $message = "Please fill all the fields with valid data.";
                            } else {
                                $email = SanitizeString(trim($_POST['email']));
                                $password = SanitizeString(trim($_POST['password']));
                                $password = md5($password);

                                $customer = CheckForCustomer($email, $password);

                                if ($customer == null) {
                                    $message = "Wrong \"email\" or \"password\". Please try arain.";
                                } else {
                                    $_SESSION['customer'] = $customer;
                                    $successmessage = "Logging-in successful.";
                                }
                            }
                            include($pages[$page]);
                        } else {
                            include($error);
                        }
                        break;

                case 'myinfo':
                    unset($message);
                    if (!isset($_SESSION['customer'])) {
                        $message = "You haven't logged-in yet.";
                    }
                    include($pages[$page]);
                    break;

                case 'myinterests':
                    unset($message);
                    if (!isset($_SESSION['customer'])) {
                        $message = "You haven't logged-in yet.";
                    } else {
                        $customerinterests = GetCustomerInterests($_SESSION['customer']['cid']);
                        if ($customerinterests == null) {
                            $message = "You have no interests yet. You can easily add items to your interest-list by just clicking on the corresponding like-button of any product from our product page.";
                        }
                    }
                    include($pages[$page]);
                    break;

                case 'products':
                    unset($message);
                    if (isset($_GET['q'])) {
                        $q = SanitizeString($_GET['q']);
                        switch ($q) {
                            case '1':
                                $products = GetAllProductsWithRelatedMovies(GetNMostRecentlyAddedProducts(6));
                                break;
                            case '2':
                                $products = GetAllProductsWithRelatedMovies(GetNMostPopularProducts(6));
                                break;
                            case '3':
                                $products = GetAllProductsWithRelatedMovies(GetNProductsInGivenCostRange(6, 5001, 9999999999));
                                break;
                            case '4':
                                $products = GetAllProductsWithRelatedMovies(GetNProductsInGivenCostRange(6, 4001, 5000));
                                break;
                            case '5':
                                $products = GetAllProductsWithRelatedMovies(GetNProductsInGivenCostRange(6, 3001, 4000));
                                break;
                            case '6':
                                $products = GetAllProductsWithRelatedMovies(GetNProductsInGivenCostRange(6, 2001, 3000));
                                break;
                            case '7':
                                $products = GetAllProductsWithRelatedMovies(GetNProductsInGivenCostRange(6, 1001, 2000));
                                break;
                            case '8':
                                $products = GetAllProductsWithRelatedMovies(GetNProductsInGivenCostRange(6, 0, 1000));
                                break;
                            case '9':
                                $products = GetAllProductsWithRelatedMovies(GetNProductsInGivenMovieYearRange(6, 2011, 9999));
                                break;
                            case '10':
                                $products = GetAllProductsWithRelatedMovies(GetNProductsInGivenMovieYearRange(6, 2006, 2010));
                                break;
                            case '11':
                                $products = GetAllProductsWithRelatedMovies(GetNProductsInGivenMovieYearRange(6, 2001, 2005));
                                break;
                            case '12':
                                $products = GetAllProductsWithRelatedMovies(GetNProductsInGivenMovieYearRange(6, 1996, 2000));
                                break;
                            case '13':
                                $products = GetAllProductsWithRelatedMovies(GetNProductsInGivenMovieYearRange(6, 0, 1995));
                                break;
                            default:
                                $products = GetAllProductsWithRelatedMovies();
                                break;
                        }
                    } else {
                        $products = GetAllProductsWithRelatedMovies();
                    }
                    if ($products == null) {
                        $message = "Currently the product stock is empty!!! Please come back again later :-)";
                    } else {
                        if (isset($_SESSION['customer'])) {
                            $customerinterests = GetCustomerInterests($_SESSION['customer']['cid']);
                        }
                    }
                    include($pages[$page]);
                    break;

                case 'logout':
                    unset($message);
                    if (isset($_SESSION['customer'])) {
                        unset($_SESSION['customer']);
                        $message = "You have been successfully logged-out.";
                    } else {
                        $message = "You haven't logged-in yet.";
                    }
                    include($pages[$page]);
                    break;

                case 'aboutus':
                    include($pages[$page]);
                    break;

                case 'admin':
                    unset($message);
                    unset($successmessage);
                    if (isset($_SESSION['admin'])) {
                        $customers = GetAllCustomerInfo();
                    }
                    include($pages[$page]);
                    break;

                    case 'adminlogin':
                        unset($message);
                        unset($successmessage);
                        if (isset($_POST['submit']) != '') {
                            if (trim($_POST['username'])=='' || trim($_POST['password'])=='') {
                                $message = "Please fill all the fields with valid data.";
                            } else {
                                $username = SanitizeString(trim($_POST['username']));
                                $password = SanitizeString(trim($_POST['password']));

                                if (($username==ADMINISTRATOR_USERNAME) && ($password==ADMINISTRATOR_PASSWORD)) {
                                    $_SESSION['admin'] = ADMINISTRATOR_USERNAME;
                                    $successmessage = "Admin Login successful.";
                                    $customers = GetAllCustomerInfo();
                                } else {
                                    $message = "Wrong admimistrator \"username\" or \"password\". Please try arain.";
                                }
                            }
                            include($pages[$page]);
                        } else {
                            include($error);
                        }
                        break;

                    case 'adminlogout':
                        unset($message);
                        if (isset($_SESSION['admin'])) {
                            unset($_SESSION['admin']);
                            $message = "Admin logout successful.";
                        }
                        include($pages[$page]);
                        break;
                
                default:
                    include($incomplete);
                    break;
            }
    	} else {
            include($error);
    	}

    	include($footer);
    }

?>