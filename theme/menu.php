 <nav class="navbar navbar-mod navbar-fixed-top" role="banner" style="">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" style="background-color:#ff9933" data-toggle="collapse" data-target=".navbar-collapse">
                        <span style="color:#fff" class="sr-only">Toggle navigation</span>
                        <span style="color:#fff" class="icon-bar"></span>
                        <span style="color:#fff" class="icon-bar"></span>
                        <span style="color:#fff" class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo web_root; ?>"><img style="width:60px" src="<?php echo web_root; ?>img/ust.jpg" alt="logo"></a>
                </div>
                
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav mod-menu" style="font-size:13px;"  > 
                        <li hover="ff9933" class="<?php echo (currentpage_public() == 'student') ? "active" : false;?>">  <a href="<?php echo web_root; ?>student/">Students</a></li> 
                        <li  class="<?php echo (currentpage_public() == 'attendance') ? "active" : false;?>"> <a href="<?php echo web_root; ?>attendance/">Attendance</a></li> 

                        <li class="dropdown"> 
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Utilities <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu"   style="" > 
                                <li class="<?php echo (currentpage_public() == 'course') ? "active" : false;?>"><a href="<?php echo web_root; ?>course/index.php">Courses</a></li>
                                <li class="<?php echo (currentpage_public() == 'department') ? "active" : false;?>"><a href="<?php echo web_root; ?>department/index.php">Departments</a></li>
                                <li class="<?php echo (currentpage_public() == 'user') ? "active" : false;?>"><a href="<?php echo web_root; ?>user/index.php">Users</a></li> 
                            </ul>
                        </li>
                        <li class="dropdown"> 
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu"   style="" > 
                                <li class="<?php echo ($title == 'Attendance') ? "active" : false;?>"><a href="<?php echo web_root; ?>report/index.php?view=attendance">Attendance</a></li> 
                                <li class="<?php echo ($title == 'Logs') ? "active" : false;?>"><a href="<?php echo web_root; ?>report/index.php?view=logs">Logs</a></li> 
                            </ul>
                        </li> 
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Howdy, <?php echo $_SESSION['ACCOUNT_NAME'];  ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu"  style="" >
                            <li>
                                <a href="<?php echo web_root; ?>user/index.php?view=edit&id=<?php echo $_SESSION['ACCOUNT_ID'];  ?>">Edit</a>
                            </li>
                            <li>
                                <a href="<?php echo web_root; ?>user/index.php?view=view&id=<?php echo $_SESSION['ACCOUNT_ID'];  ?>">View</a>
                            </li>
                            <li>
                                <a href="<?php echo web_root; ?>logout.php">Logout</a>
                            </li>
                          
                        </ul>
                    </li>                   
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
        