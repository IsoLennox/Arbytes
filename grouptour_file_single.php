<?php include("inc/tourheader.php"); ?> 
 
 <div id="page">
<?php
 
                    
                    
                echo "<div class='singlefile'><span class='right'> By: <a href='grouptour_profile.php'>Member Name</a> |  Date Time</span><h2>File Title (If Image)</h2><br/><img src=\"img/default_img.png\" title=\"File Title \" /> <br/><br/> "; 
                
            
                    echo "<span class='right'><a href=\"#\" onclick='return confirm(\"DELETE this file?\");'>Delete File</a></span>";
                    
              echo "<br/><br/><br/>";
                echo "<div class='singlefile'><span class='right'> By: <a href='grouptour_profile.php'>Member Name</a> |  Date Time</span><h2>File Title (If Document)</h2><br/><a href=\"#\"><img src=\"img/icons/downloadIcon.png\" title=\"Download this file\" />  Download File</a> <br/><br/>Preview:<h6><em>Please note that only .txt file will be formatted for readability.<br/> .docx, .csv, and .rtf will need to be opened in your text editor of choice.</em></h6><br/><div id=\"preview\"> This is a preview of the contents of the file if a document  </div> "; 
                
               
                    echo "<span class='right'><a href='#'><img src=\"img/icons/tiny-newpost.png\"/> Edit file</a></span>";
                
 
        
        
       
 
?>
     <br/><hr/>
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
    echo "<div class='note'>From: <a href='grouptour_profile.php'>Commenter Name</a><span class='right'> Date Time</span><br/><br/>Thanks for sharing! <br/>";

   
            echo "<span class='right'><a href='#' onclick=\"return confirm('DELETE this comment?');\"><img src=\"img/icons/delete.png\"/> Delete Comment</a></span>";
    
    
   
 

        ?>

    <br /> 
  </div>

</div>
</div>
</div>
<?php include("inc/footer.php"); ?> 