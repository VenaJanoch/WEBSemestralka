  
  
  <?php
  
  if (!isset($uzivatel)){
	  
	  
	  ?>
	  
	   <ul class= "topnav" id= "MyTopnav">
      <li><a href="index.php?web=stranky/prihlaseni"><span class="glyphicon glyphicon-user"></span> Prihlaseni</a></li>
      <li><a href="index.php?web=stranky/registrace"><span class="glyphicon glyphicon-log-in"></span> Registrace</a></li>
    </ul> 
	   <?php
	  
  }
  
  else
  {
	  
	  ?>
	  
	  
	  <a href="index.php?web=stranky/odhlaseni"><span class="glyphicon glyphicon-log-out"></span> <?php echo $uzivatel; ?>  (Odhlásit)  </a>
	  
	  <?php
  }

  ?>
  
  
