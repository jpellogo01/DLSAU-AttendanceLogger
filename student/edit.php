<?php 
 if (!isset($_SESSION['ACCOUNT_ID'])){
    redirect(web_root."index.php");
   }

// $autonum = New Autonumber();
// $res = $autonum->single_autonumber(2);
 @$StudentID = $_GET['id'];
    if($StudentID==''){
  redirect("index.php");
}
  $stud = New Student();
  $s_student = $stud->select_student($StudentID);

  $birthday = date_format(date_create($s_student->BirthDate),'m/d/Y');
  $mv = date_format(date_create($s_student->BirthDate),'m');
  $m =date_format(date_create($s_student->BirthDate),'M');
  $d = date_format(date_create($s_student->BirthDate),'d');
  $y = date_format(date_create($s_student->BirthDate),'Y');


  if ($s_student->Gender == 'Male') {
    # code...
   $radio =  '<div class="col-md-8">
             <div class="col-lg-5">
                <div class="radio">
                  <label><input   id="optionsRadios1" name="optionsRadios" type="radio" value="Female">Female</label>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="radio">
                  <label><input id="optionsRadios2"  checked="True" name="optionsRadios" type="radio" value="Male">Male</label>
                </div>
              </div> 
             
          </div>';
  }else{
       $radio =  '<div class="col-md-8">
             <div class="col-lg-5">
                <div class="radio">
                  <label><input   id="optionsRadios1"  checked="True" name="optionsRadios" type="radio" value="Female">Female</label>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="radio">
                  <label><input id="optionsRadios2"  name="optionsRadios" type="radio" value="Male"> Male</label>
                </div>
              </div> 
             
          </div>';

  }

   switch ($s_student->YearLevel) {

     case 'First':
       # code...
        $level ='<select class="form-control input-sm" name="YearLevel" id="YearLevel">
                  <option value="none" >Select</option>
                  <option SELECTED value="First">First</option>
                  <option value="Second">Second</option>
                  <option value="Third" >Third</option>
                  <option value="Fourth" >Fourth</option>
              </select> ';
       break;
     case 'Second':
       # code...
        $level ='<select class="form-control input-sm" name="YearLevel" id="YearLevel">
                  <option value="none" >Select</option>
                  <option value="First">First</option>
                  <option SELECTED value="Second">Second</option>
                  <option value="Third" >Third</option>
                  <option value="Fourth" >Fourth</option>
              </select> ';

       break;
     case 'Third':
       # code...
        $level ='<select class="form-control input-sm" name="YearLevel" id="YearLevel">
                  <option value="none" >Select</option>
                  <option value="First">First</option>
                  <option value="Second">Second</option>
                  <option SELECTED value="Third" >Third</option>
                  <option value="Fourth" >Fourth</option>
              </select> ';
       break;
     case 'Fourth':
       # code...
        $level ='<select class="form-control input-sm" name="YearLevel" id="YearLevel">
                  <option value="none" >Select</option>
                  <option value="First">First</option>
                  <option value="Second">Second</option>
                  <option value="Third" >Third</option>
                  <option SELECTED value="Fourth" >Fourth</option>
              </select> ';
       break;

     default:
       # code...
       $level ='<select class="form-control input-sm" name="YearLevel" id="YearLevel">
                  <option  SELECTED value="none" >Select</option>
                  <option value="First">First</option>
                  <option value="Second">Second</option>
                  <option value="Third" >Third</option>
                  <option value="Fourth" >Fourth</option>
              </select> ';
       break;
   }
 ?> 

<section id="feature" class="transparent-bg">
    <div class="container">
       <div class="center wow fadeInDown">
             <h2 class="page-header">Update Student</h2>
            <!-- <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p> -->
        </div>

        <div class="row">
            <div class="features">

                 <form class="form-horizontal span6  wow fadeInDown" action="controller.php?action=edit" method="POST">      
                      <div class="form-group">
                      <div class="col-md-8">                     
                        <img src="<?php echo $s_student->StudPhoto;?>" alt="user image" width="166" height="166" id="photoImg">
                      </div>
  
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "photo">Photo:</label>

                      <div class="col-md-8"> 
                      <input type="file" id="photo" name="photo" accept="image/png,image/jpeg,image/jpg" onChange="display_img(this)" />
                      </div>
                    </div>
                  </div>
                         <input class="form-control input-sm" id="StudentID" name="StudentID" placeholder=
                            "Student ID" type="hidden" value="<?php echo $s_student->ID;?>">
                         <input class="form-control input-sm" id="IDNO" name="IDNO" placeholder=
                            "Student ID" type="hidden" value="<?php echo $s_student->StudentID;?>"  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "Firstname">Firstname:</label>

                      <div class="col-md-8">
                        
                         <input class="form-control input-sm" id="Firstname" name="Firstname" placeholder=
                            "Firstname" type="text" value="<?php echo $s_student->Firstname;?>" required  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "Lastname">Lastname:</label>

                      <div class="col-md-8">
                        
                         <input class="form-control input-sm" id="Lastname" name="Lastname" placeholder=
                            "Lastname" type="text" value="<?php echo $s_student->Lastname;?>" required  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "Middlename">Middlename:</label>

                      <div class="col-md-8">
                        
                         <input class="form-control input-sm" id="Middlename" name="Middlename" placeholder=
                            "Middlename" type="text" value="<?php echo $s_student->Middlename;?>" required  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                      </div>
                    </div>
                  </div>

                   <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "Address">Address:</label>

                      <div class="col-md-8">
                        
                         <input class="form-control input-sm" id="Address" name="Address" placeholder=
                            "Address" type="text" value="<?php echo $s_student->Address;?>" required  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                      </div>
                    </div>
                  </div> 

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "Gender">Sex:</label>

                      <?php
                        echo $radio;
                      ?>

                      <!-- <div class="col-md-8">
                         <div class="col-lg-5">
                            <div class="radio">
                              <label><input checked id="optionsRadios1" checked="True" name="optionsRadios" type="radio" value="Female">Female</label>
                            </div>
                          </div>

                          <div class="col-lg-4">
                            <div class="radio">
                              <label><input id="optionsRadios2" checked="" name="optionsRadios" type="radio" value="Male"> Male</label>
                            </div>
                          </div> 
                         
                      </div> -->
                    </div>
                  </div> 

                   <!-- <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "BirthDate">Date of birth:</label>
 
                      <div class="col-md-8">
                         <div class="input-group" id=""> 
                              <div class="input-group-addon"> 
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input id="datemask2" name="BirthDate"  value="<?php echo $birthday;?>" type="text" class="form-control " size="7" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                            </div>
                      </div>
                    </div>
                  </div>  -->

                  <div class="form-group">
                      <div class="rows">
                        <div class="col-md-8">
                          <h4>
                          <div class="col-md-4">
                            <label class="col-lg-12 control-label">Date of Birth</label>
                          </div>

                          <div class="col-lg-3">
                            <select class="form-control input-sm" name="month">
                              <option>Month</option>
                              <?php


                                 echo '<option SELECTED value='.$mv.'>'.$m.'</option>';

                                 $mon = array('Jan' => 1 ,'Feb'=> 2,'Mar' => 3 ,'Apr'=> 4,'May' => 5 ,'Jun'=> 6,'Jul' => 7 ,'Aug'=> 8,'Sep' => 9 ,'Oct'=> 10,'Nov' => 11 ,'Dec'=> 12 );    
                                
                            
                                foreach ($mon as $month => $value ) { 
                                # code...
                               
                                echo '<option value='.$value.'>'.$month.'</option>';
                                }
                              
                                   
                              ?>
                            </select>
                          </div>
 
                          <div class="col-lg-2">
                            <select class="form-control input-sm" name="day">
                              <option>Day</option>
                            <?php 
                             echo '<option SELECTED value='.$d.'>'.$d.'</option>';
                              $d = range(1, 31);
                              foreach ($d as $day) {
                                echo '<option value='.$day.'>'.$day.'</option>';
                              }
                            
                            ?>
                              
                            </select>
                          </div>

                          <div class="col-lg-3">
                            <select class="form-control input-sm" name="year">
                              <option>Year</option>
                            <?php 
                                echo '<option SELECTED value='.$y.'>'.$y.'</option>';
                                $years = range(2010, 1900);
                                foreach ($years as $yr) {
                                echo '<option value='.$yr.'>'.$yr.'</option>';
                                }
                            
                            ?>
                            
                            </select>
                          </div>
                          </h4>
                        </div>
                      </div>
                    </div> 
                   <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "ContactNo">Mobile No:</label>

                      <div class="col-md-8">
                        
                         <input class="form-control input-sm" id="ContactNo" name="ContactNo" placeholder=
                            "Mobile Number" type="any" value="<?php echo $s_student->ContactNo;?>" required  onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off">
                      </div>
                    </div>
                  </div> 

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "CourseID">Course:</label>

                      <div class="col-md-8">
                       <select class="form-control input-sm" name="CourseID" id="CourseID">
                       <option value="none" >Select</option>
                          <?php 

                           $mydb->setQuery("SELECT * FROM `tblcourse` WHERE CourseID=".$s_student->CourseID);
                           $cur = $mydb->loadResultList();

                            foreach ($cur as $result) {
                              echo '<option SELECTED value='.$result->CourseID.' >'.$result->CourseCode.' </option>';
 
                            }

                            $mydb->setQuery("SELECT * FROM `tblcourse` WHERE CourseID <>".$s_student->CourseID);
                            $cur = $mydb->loadResultList();

                            foreach ($cur as $result) {
                              echo '<option value='.$result->CourseID.' >'.$result->CourseCode.' </option>';

                            }
                          ?>


                         
                        </select> 
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "YearLevel">Level:</label>

                      <div class="col-md-8">
                        <?php echo $level; ?>
                      </div>
                    </div>
                  </div>
                 
            
             <div class="form-group">
                    <div class="col-md-8">
                      <label class="col-md-4 control-label" for=
                      "idno"></label>

                      <div class="col-md-8">
                       <button class="btn btn-mod btn-sm" name="save" type="submit" ><span class="fa fa-save fw-fa"></span>  Save</button> 
                          <!-- <a href="index.php" class="btn btn-info"><span class="fa fa-arrow-circle-left fw-fa"></span></span>&nbsp;<strong>List of Users</strong></a> -->
                       </div>
                    </div>
                  </div> 
        </form>


            
            </div><!--/.services-->
        </div><!--/.row-->  
    </div><!--/.container-->
</section><!--/#feature-->
 

<!-- <section id="bottom">
    <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
    
    </div> 
</section> --><!--/#bottom-->
       