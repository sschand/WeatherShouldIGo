<nav class="navbar navbar-inverse navbar-custom navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
         </button>
        <a class="navbar-brand" href="index.html">Windstagra'm</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse navbar-right ">
        <ul class="nav navbar-nav">
          <li class=" hidden">
            <a href="#page-top"></a>
          </li>
          <li class="page-scroll">
            <a href="#" data-toggle="modal" data-target="#myModalLogin">Login</a>
          </li>
          <li class="page-scroll">
            <a href="#" data-toggle="modal" data-target="#myModalRegister" >Register</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>
  <!--  login modal-->
  <div id="myModalLogin" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content login">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Login</h4>
        </div>
        <div class="modal-body">
          <form action="/login/store_user_login" method=post id=loginform>
              <div class="">
                <input class="col-md-10" name="email_login" type="email" placeholder="Email">
                <?= form_error('email_login', '<div class="error">', '</div>');?>
              </div>
              <div class="">
                  <input class="col-md-10" name="password_login" type="password" placeholder="Password">
                   <?= form_error('password_login', '<div class="error">', '</div>');?>
              </div>

              <input type="Submit" class="btn btn-default" value=Login id=loginbtn>

          </form>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <!--  Register modal-->
  <div id="myModalRegister" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Register</h4>
        </div>
        <div class="modal-body" >
          <form class="form-horizontal" action="/login/store_user_login" method=post id=regform>
             <div >
              <input class="col-md-10" name ="name"  type="text" placeholder="Full Name">
              <?= form_error('name', '<div class="error">', '</div>');?>
             </div>
             <div >
                <input class="col-sm-10" name="user_name" type="text" placeholder="User name">
                <?= form_error('user_name', '<div class="error">', '</div>');?>
             </div>
             <div >
              <input class="col-sm-10" name="email" type="email" placeholder="Email" class=emailinput>
              <?= form_error('email', '<div class="error">', '</div>');?>
             </div>
             <div >
                <input class="col-sm-10" name="password" type="password" placeholder="Password (8 char min)">
                <?= form_error('password', '<div class="error">', '</div>');?>
             </div>
             <div >
              <input class="col-sm-10" name="confirm_password" type="password" placeholder="Confirm Password">
               <?= form_error('confirm_password', '<div class="error">', '</div>');?>
             </div>
             <div >
                <input class="col-sm-10" name="dob" type="date" id="datepicker" placeholder="Date of Birth">
                <?= form_error('dob', '<div class="error">', '</div>');?>
             </div>
             <div class="">
                <input type="Submit" class="btn btn-default" value="Register" id="regbtn">
             </div>


          </form>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
