<div id="wrapper">
         <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><?php echo $_SESSION["user"]; ?> </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="user-setting.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="settings.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                       
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
         
                  
        
                    <li>
                        <a class="active" href="index.php" style="background: #e17339;"><i class="fa fa-dashboard"></i> Status</a>
                    </li>
                   <li><a href="/chilee/admin/brands.php"><i class="fa fa-dashboard"></i> Brands</a></li>
              
             <li><a href="/chilee/admin/categories.php"><i class="fa fa-dashboard"></i> Categories</a></li>
               <li><a href="/chilee/admin/products.php"> <i class="fa fa-dashboard"></i> Products</a></li>
              <li><a href="/chilee/admin/archives.php"><i class="fa fa-dashboard"></i> Archives</a></li>
               
               <li><a href="payment.php"> <i class="fa fa-dashboard"></i>Payment</a></li>
               <li><a href="profit.php"> <i class="fa fa-dashboard"></i>Profit</a></li> 
               <li><a href="inventory.php"> <i class="fa fa-dashboard"></i>inventory</a></li>   
      </ul>
        
        
      

            </div>

        </nav>
        
        <!-- /. NAV SIDE  -->