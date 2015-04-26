<?php include("inc/non_session_header.php"); ?> 


 <div id="help_page"><?php echo message(); ?>
 

 <section class="wrapper">
	<div class="container" id="accordian">
 	<article class="label">
		<section class="label-title">
			<h1 class="name"><img src="img/icons/tiny-newpost.png"/> 
			
		 
       Add A Help Article
       </h1>
<!--			<section class="subtitle">Subtitle Area</section>-->
		</section>
		<section class="label-description"> 
			<form action="create_help.php" method="post">
 
        <p>Title:
        <input type="text" name="title" value="" /> </p>
        
         <p>Content: <br/>
    <textarea name="content" value="" rows="3" cols="80"></textarea></p>
         
      <input type="submit" name="submit" value="Create" />
    </form>
		</section>
	</article>
</div>
     </section>
 
 
     
<hr/>
 


 
 

</div>
<?php include("inc/footer.php"); ?> 