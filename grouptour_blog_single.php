<?php include("inc/tourheader.php"); ?> 
 
 <div id="page">
<?php

  
                echo "<div class='singlenote'><span class='right'> By: <a href='grouptour_profile.php'>Member Name</a> |  Date Time</span><h2>Public Post Title </h2><br/>Today I went on a nice walk! <br/>  "; 
                 
                    echo "<span class='right'><a href='#'><img src=\"img/icons/tiny-newpost.png\"/> Edit post</a></span>";
                
                echo "<br/></div><hr/>"; 
          
 
        
       
 
?>
  <section class="wrapper">
	<div class="container" id="accordian">
 	<article class="label">
		<section class="label-title">
			<h1 class="name"><img src="img/icons/tiny-newpost.png"/> Create comment</h1>
<!--			<section class="subtitle">Subtitle Area</section>-->
		</section>
		<section class="label-description"> 
    
    <form action="#" method="post">
 
         
         <p>comment: <br/>
    <textarea name="content" value="" rows="10" cols="80"></textarea></p>
         
      <input type="submit" name="submit" value="Create comment" />
    </form>
		</section>
	</article>
</div>
     </section>

<h3 class="headings">Comments</h3>
<?php 
    
    echo "<div class='note'>From: <a href='grouptour_profile.php'>Member Name</a><span class='right'> Date Time</span><br/><br/>That sounds lovely! <br/>";
 
            echo "<span class='right'><a href='#' onclick=\"return confirm('DELETE this comment?');\"><img src=\"img/icons/delete.png\"/> Delete Comment</a></span>"; 
    echo "<br/></div>  "; 

  
    
   
 

        ?>

    <br /> 
  </div>

</div>
<?php include("inc/footer.php"); ?> 