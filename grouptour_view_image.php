<?php include("inc/tourheader.php"); ?> 
 
 <div id="page">
<?php
  

                echo "<div class='singlefile'><span class='right'> By: <a href='grouptour_profile.php'>Member Name</a></span><br/><img src=\"img/default_avatar.png\" /> <br/><br/> "; 
                
             
 
                    echo "<span class='right'><a href='#'><img src=\"img/icons/tiny-newpost.png\"/> Make Current Profile Image</a>
                    <br/>
                    <br/>
       <a href='#'><img src=\"img/icons/delete.png\"/> Delete Image</a>
                    
                    </span>";
               
                    
 
 
?>
     <br/> 
     <br/>
     <br/>
  <section class="wrapper">
	<div class="container" id="accordian">
 	<article class="label">
		<section class="label-title">
			<h1 class="name"><img src="img/icons/tiny-newpost.png"/> Create comment</h1>
<!--			<section class="subtitle">Subtitle Area</section>-->
		</section>
		<section class="label-description"> 
		
		<p>This feature is not available yet.</p>
 
		</section>
	</article>
</div>
     </section>

<h3 class="headings">Comments</h3>
<?php
 
 
    echo "<div class='note'>From: <a href='grouptour_profile.php'>Commenter Name</a><span class='right'>Date Time</span><br/><br/>This is a great Picture of you! <br/>";

 
            echo "<span class='right'><a href='#' onclick=\"return confirm('DELETE this comment?');\"><img src=\"img/icons/delete.png\"/> Delete Comment</a></span>";
   
    echo "<br/></div>  "; 

  
 

        ?>

    <br /> 
  </div>

</div>
<?php include("inc/footer.php"); ?> 