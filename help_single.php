<?php include("inc/non_session_header.php"); ?> 
 
 <div id="help_page">
<?php

$article_id =$_GET['article_id'];
    //query to view articles that belong to your company
$query  = "SELECT * ";
		$query .= "FROM help ";
		$query .= "WHERE id={$article_id} "; 
		$all_articles = mysqli_query($connection, $query); 
        $articles_array= mysqli_fetch_assoc($all_articles);
        



        if(!empty($articles_array)){ 

            foreach($all_articles as $article){
                
                
            
                $content=$article['content']; 
                
                echo message();
                echo "<h2>".$article['title']."</h2><br/>".$content." <br/>  "; 
                
                if($_SESSION['user_id']==91){
                    echo "<span class='right'><a href='edit_help_article.php?article_id={$article['id']}'><img src=\"img/icons/tiny-newpost.png\"/> Edit article</a></span>";
                }
                
                echo "<br/>"; 
            }
 
        
        
        }elseif(empty($articles_array)){
            echo "This article does not exist.";
        }
 
?>
  </div>

</div>
<?php include("inc/footer.php"); ?> 