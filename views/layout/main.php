<!DOCTYPE html>
<html>
<head>
	<title>CI Test</title>


<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>


:root {
  --lvl : 1px;
  --bg : green;
  --lvl2 : 1px;
  --rtlvl : 1px;
  --rtlvlnum : 1px;
  
}

.vldivout {
  padding-left: var(--rtlvl) ;
  height:100%;
  #border-left: 5px solid rgb(51, 153, 102);
 # border: 2px solid black;
}



.vldivin {
  
  #padding-left: calc(1 * var(--rtlvl) );
  padding-left: 15px;
  height:100%;
  #color: green;
  border-left: 3px solid #339933;
  #border: 2px solid black;
  
}

    .lvl1 {
      padding-left: 33px ;
      #padding-left: var( --rtlvl )  ;
    #  padding-left: calc( ( 50 * var( --lvl ) + 15px ) );
      #padding-left: -62px;
     # background-color: var(--bg);
      
    }

    .lvl2 {
    # padding-left: var( --rtlvlnum ) ;
  #   border: 2px solid blue;
    }


.vldivout{

   #border: 2px solid black;
} 
    .outdiv{
      
      background-color: white;
      text-decoration: black;
     # border-left:2px solid red;

     margin-bottom:0px;
     margin-top:0px;
     padding-top: 0px;
     padding-bottom: 0px;
    border-left: 2px solid #339966;
     #border-style:solid;




    }


.singleitem {
  padding-left: calc(var( --rtlvl ) * 1 ) ;
#padding-left: 51px;
}

.tskitm {

  #  margin-left: calc(var(--rtlvlnum) * 1 );
  #margin-left: 18px;
  margin-top: 10px;
    #border-left: 2px solid #897F7F; 
   # border: 0.01px solid blue;
}

.tskhr {

  margin-top:10px;
  margin-bottom:0px;
  padding-top: 0px;
  padding-bottom: 5px;
 border: 0.01px solid #5CB3FF;
#border: 0.01px solid #F4F6F6

}

 
.selitem {
  background-color: brown;
  text-decoration-color: white;
}
  
a:active {
  color: red;
}

a:hover {
  background-color: white;
  color: hotpink;
}


.txthlt {
 background-color:  #8A4117;
 #text-decoration-color: white;
 color: white; !important

}

a:active {
  color: white;
}


.disitm {
  display: block;
}

.hiditm {
  display: none;
}

.disabled { cursor: not-allowed; }



.v2 {
  padding-left: var(--rtlvl);

}

 </style>
</head>

<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url(); ?>">Ardhas</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo base_url(); ?>">Home<span class="sr-only">(current)</span></a></li>
        <li><a href="<?php echo base_url() ?>users/register">Register</a></li>
         <li><a href="<?php echo base_url() ?>projects">Projects</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          </ul>
        </li>
      </ul>

      <?php if($this->session->userdata('logged_in')): ?>
         <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo base_url(); ?>users/logout">Logout</a></li>
      <?php endif; ?>

        <li class="dropdown">
          <ul class="dropdown-menu">
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>



<div class="container">
	
	<div class="col-xs-2">

	<?php 
	if($this->session->flashdata('loginerr')):
		echo $this->session->flashdata('loginerr');
	endif;

	?>


	<?php $this->load->view('users/login_view'); ?>


	</div>


	<div class="col-xs-10">

    <?php $this->load->view($main_view); ?>

	</div>
</div>

</body>
</html>