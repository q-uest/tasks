<!DOCTYPE html>
<html>
<head>
	<title>CI Test</title>


<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <style>


:root {
  --lvl : 1px;
  --bg : #9A3F36;
  --lvl2 : 1px;
  --rtlvl : 1px;
  --rtlvlnum : 1px;
  --vertln : 1px solid #9A3F36 ;
  --outbrdr :5px solid #2E4053;  
}

.vldivout {
  padding-left: var(--rtlvl) ;
  #height:100%;
  
}


body {
  background-color: #F4F6F6;
}
.vldivin {
  
  #padding-left: calc(1 * var(--rtlvl) );
  padding-left: 15px;
  height:100%;
  #color: green;
  #border-left: 3px solid #339933;
  border-left: var(--vertln);
  #border: 2px solid black;

}


.omdiv {
  #border-left: 3px solid #339933;

}

    .lvl1 {
    #  padding-left: 33px ;
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
      background-color: #F4F6F6
     # background-color: white;
      text-decoration: black;
     # border-left:2px solid red;

     margin-bottom:0px;
     margin-top:0px;
     padding-top: 0px;
     padding-bottom: 0px;
    #border-left: 2px solid #339966;
    #border-left: ;
    padding-left: 10px;
     #border-style:solid;


    }

.leftbord{
     #border: 2px solid red;
     border-left: 2px solid #666633;
     #margin-left: -15px;
     padding-left: 0px;
     padding-right: 0px;
}

.lastitm {
  border-left: 2px solid #339933;
}
.unsetlb
{
  border-left:1px solid red !important;
}
  .multirows {
     #border-left: 2px solid #339933;
     #padding-left: 10px;
  }

.indiv1{

 padding-left: 10px;

}

.encdiv {
  overflow-y: hidden;
  overflow-x: scroll;
 # border: 2px solid red;
  #padding-left: calc(var( --rtlvl ) * 1 ) ;
}



.lftpad {
 padding-left: calc(var( --rtlvl ) * 1 ) ;  
}

.singleitem {
 #border: 2px solid blue;
  width: var(--scrollper);
 padding-left: calc(var( --rtlvl ) * 1 ) ; 
}

.tskitm {

  #  margin-left: calc(var(--rtlvlnum) * 1 );
  #margin-left: 18px;
  margin-top: 10px;
    #border-left: 2px solid #897F7F; 
   # border: 0.01px solid blue;
   width: var(--scrollper);
}

.tskhr {

  margin-top:0px;
  margin-bottom:0px;
  padding-top: 0px;
  padding-bottom: 5px;
 border: 0.01px solid  #5CB3FF;
 padding:0px;


}

.tophr {

  margin-top:0px;
  margin-bottom:0px;
  padding-top: 0px;
  padding-bottom: 0px;
  border: 1.5px dotted  #666633;
 #padding:0px;


}

.bothr {

  margin-top:0px;
  margin-bottom:0px;
  padding-top: 0px;
  padding-bottom: 0px;
 border: 1.5px dotted  #666633;
 #padding:0px;


}


.endhr {
  height:10px;
  border-width:0;
  color:grey;
  background-color:grey;
  margin-top:0px;
  margin-bottom: 0px;
  padding:0px;

}

.prjendhr {
  height:10px;
  border-width:0;
  color:grey;
  background-color:#f09348;
  margin-top:0px;
  margin-bottom: 0px;
  padding:0px;

}


 .bord {
  border:2px solid red;
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


.outrbrdr {

border-right: var(--outbrdr);
border-left: var(--outbrdr);
border-bottom: var(--outbrdr);
  
}

.txthlt {
 background-color:#2E4053   ;
 ##8A4117;
 
 #text-decoration-color: white;
 color: white; !important

}

.rtdivc3 {

border-left: 10px solid #063852;
#background-color:#897F7F ;
#color:#8A4117;

}

.tskhglt
{

background-color:orange;
cursor:pointer;

#color: white;
#color:#2E4053;
}

.rtdiv {
  
  font-size: 20px; 
  font-weight: bold; 
  padding-bottom:2px;
  padding-top: 10px;
  margin-bottom:12px;
  }

.rtdivmov {
  font-size: 20px; 
  font-weight: bold; 
  padding-bottom:2px;
  padding-top: 10px;
  margin-bottom:10px;
  border-bottom: 2px solid red;
}

.rtdivmot {
  font-size: 20px; 
  font-weight: bold; 
  padding-bottom:2px;
  padding-top: 10px;
#  border-bottom:'';
  margin-bottom:12px;
}

.rtname{

  font-weight: bold;
  font-size: 25px;
  margin-top: 15px;
  margin-bottom: 15px;
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



<div class="container-fluid">
	
	<div class="col-xs-1">

	<?php 
	if($this->session->flashdata('loginerr')):
		echo $this->session->flashdata('loginerr');
	endif;

	?>



  
  <?php $this->load->view('users/login_view'); ?>


	</div>


	<div class="col-xs-11">

    <?php $this->load->view($main_view); ?>

	</div>
</div>

</body>
</html>