<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME ICONS STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!--CUSTOM STYLES-->
    <link href="assets/css/style.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>
      <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
      }

      .notification {
        background-color: #555;
        color: white;
        text-decoration: none;
        padding: 15px 26px;
        position: relative;
        display: inline-block;
        border-radius: 2px;
      }

      .notification:hover {
        background: red;
      }

      .notification .badge {
        position: absolute;
        top: -10px;
        right: -10px;
        padding: 5px 10px;
        border-radius: 50%;
        background-color: red;
        color: white;
      }

    td.highlight {
        background-color: whitesmoke !important;
    }
    .vertical-center {
  margin: 0;
  position: absolute;
  top: 50%;
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
  }

    #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            }

            #myImg:hover {opacity: 0.7;}

            /* The Modal (background) */
            .modal {
              display: none; /* Hidden by default */
              position: fixed; /* Stay in place */
              z-index: 1; /* Sit on top */
              padding-top: 100px; /* Location of the box */
              left: 0;
              top: 0;
              width: 100%; /* Full width */
              height: 100%; /* Full height */
              overflow: auto; /* Enable scroll if needed */
              background-color: rgb(0,0,0); /* Fallback color */
              background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
            }

            /* Modal Content (image) */
            .modal-content {
              margin: auto;
              display: block;
              width: 80%;
              max-width: 700px;
            }

            /* Caption of Modal Image */
            #caption {
              margin: auto;
              display: block;
              width: 80%;
              max-width: 700px;
              text-align: center;
              color: #ccc;
              padding: 10px 0;
              height: 150px;
            }

            /* Add Animation */
            .modal-content, #caption {
              -webkit-animation-name: zoom;
              -webkit-animation-duration: 0.6s;
              animation-name: zoom;
              animation-duration: 0.6s;
            }

            @-webkit-keyframes zoom {
              from {-webkit-transform:scale(0)}
              to {-webkit-transform:scale(1)}
            }

            @keyframes zoom {
              from {transform:scale(0)}
              to {transform:scale(1)}
            }

            /* The Close Button */
            .close {
              position: absolute;
              top: 15px;
              right: 35px;
              color: #f1f1f1;
              font-size: 40px;
              font-weight: bold;
              transition: 0.3s;
            }

            .close:hover,
            .close:focus {
              color: #bbb;
              text-decoration: none;
              cursor: pointer;
            }

            /* 100% Image Width on Smaller Screens */
            @media only screen and (max-width: 700px){
              .modal-content {
                width: 100%;
              }
            }
    * {
      box-sizing: border-box;
    }

    /*the container must be positioned relative:*/
    .autocomplete {
      position: relative;
      display: inline-block;
    }

    input {
      border: 1px solid transparent;
      background-color: #ffffff;
      padding: 5px;
      font-size: 16px;
    }

    input[type=text] {
      background-color: #f1f1f1;
      width: 100%;
    }

    .autocomplete-items {
      position: absolute;
      border: 1px solid #d4d4d4;
      border-bottom: none;
      border-top: none;
      z-index: 99;
      /*position the autocomplete items to be the same width as the container:*/
      top: 100%;
      left: 0;
      right: 0;
    }
    input[type=submit] {
      background-color: DodgerBlue;
      color: #fff;
      cursor: pointer;
    }
    .autocomplete-items div {
      padding: 10px;
      cursor: pointer;
      background-color: #fff;
      border-bottom: 1px solid #d4d4d4;
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
      background-color: #e9e9e9;
    }

    /*when navigating through the items using the arrow keys:*/
    .autocomplete-active {
      background-color: DodgerBlue !important;
      color: #ffffff;
    }
    input[type=checkbox] {width:25px; height:25px;}

    .tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
    </style>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a  class="navbar-brand" href="/">ACCBID

                </a>
            </div>

            <div class="notifications-wrapper">
<ul class="nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user-plus"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user-plus"></i> My Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="fa fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>

            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav  class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                  <li>
                      <a class="@yield('Dashboard')"  href="#"><i class="fa fa-database"></i>DASHBOARD<span class="fa arrow"></span></a>
                      <ul class="nav nav-second-level">
                          <li>
                              <a href="#"><i class="fa"></i>Summary</a>
                          </li>
                           <li>
                              <a href="#"><i class="fa"></i>Monitoring</a>
                          </li>
                      </ul>
                  </li>
                    <li>
                        <a class="@yield('Master Management')"  href="#"><i class="fa fa-database "></i>Master Management<span class="fa arrow"></span></a>
						            <ul class="nav nav-second-level">
                            <li>
                                <a href="/viewBalaiLelang"><i class="fa"></i>Balai Lelang</a>
                            </li>
                             <li>
                                <a href="/OnlineEvent"><i class="fa"></i>Online Event</a>
                            </li>
							              <li>
                                <a href="#"><i class="fa"></i>Unit</a>
                            </li>
							              <li>
                                <a href="/MasterGCM"><i class="fa"></i>Master GCM</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="@yield('User Management')"  href="#"><i class="fa fa-user "></i>User Management<span class="fa arrow"></span></a>
						            <ul class="nav nav-second-level">
                            <li>
                                <a href="#"><i class="fa"></i>Role Management</a>
                            </li>
                             <li>
                                <a href="#"><i class="fa"></i>User Mobile</a>
                            </li>
							              <li>
                                <a href="#"><i class="fa"></i>User CMS</a>
                            </li>
							              <li>
                                <a href="/VerifikasiAccountBidding" class="notification"><i class="fa"></i>Verifikasi Account Bidding <span class="badge">@yield('AccountBindingNotif')</span></a>
                            </li>
                            <li>
                                <a href="/showApprovalChangesUser" class="notification"><i class="fa"></i>Approval Changes User<span class="badge">@yield('ApprovalChangesUserNotif')</span></a>
                            </li>
                        </ul>
                    </li>


                    <li>
                        <a class="@yield('Auction Event')" href="/AuctionEvent"><i class="fa fa-calendar "></i>Auction Event</a>
                    </li>

                    <li>
                        <a class="@yield('Auction Result')" href="#"><i class="fa fa-car "></i>Auction Result <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="/AuctionResultSold">Sold</a>
                            </li>
                             <li>
                                <a href="/AuctionResultUnsold">Unsold</a>
                            </li>
							               <li>
                                <a href="/AuctionResultBatalLelang">Batal Lelang</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a class="@yield('Bank Account')" href="#"><i class="fa fa-money "></i>Bank Account <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="BankAccountBalaiLelang">Balai Lelang</a>
                            </li>
                             <li>
                                <a href="/BankAccountCustomer"></i>Customer</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a class="@yield('Content Management')" href="#"><i class="fa fa-dollar "></i>Content Management<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="/showContentManagementPromo">Promo</a>
                            </li>
                             <li>
                                <a href="/showContentManagementMasterContent">MasterContent</a>
                            </li>
                            <li>
                               <a href="#">Push Notifications</a>
                           </li>
                           <li>
                              <a href="#">Recommend</a>
                          </li>
                          <li>
                             <a href="#">Support</a>
                         </li>
                        </ul>
                    </li>

                    <li>
                        <a class="@yield('Deposit')" href="#"><i class="fa fa-dollar "></i>Deposit<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Top Up</a>
                            </li>
                             <li>
                                <a href="#">Penarikan</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a class="@yield('View History')" href="/showViewHistoryAndTransaction"><i class="fa fa-history "></i>View History and Transaction</a>
                    </li>
                </ul>
            </div>

        </nav>
        <!-- /. SIDEBAR MENU (navbar-side) -->
        <div id="page-wrapper" class="page-wrapper-cls">
        @yield('content')
        <!-- /. PAGE WRAPPER  -->
        </div>
        </div>
    <!-- /. WRAPPER  -->
    <footer >
        &copy; 2015 YourCompany | By : <a href="http://www.designbootstrap.com/" target="_blank">DesignBootstrap</a>
    </footer>

    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker-standalone.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>
    @yield('scripts')
  @stack('scriptgue')
</body>
</html>
