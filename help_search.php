<?php include("inc/non_session_header.php"); ?> 
 <div id="page">
 
<?php 

//turn search string into emplode array
if(isset($_POST['submit'])){
    if(isset($_GET['go'])){
        if(preg_match("/[A-Z  | a-z]+/", $_POST['query'])){
            
           // $query_string=$_POST['query'];
             $string=$_POST['query'];
             
            $string_array= explode(" ",$string);
     
            
            $no_results=4;
        foreach($string_array as $word){
//                            echo $word."<br/>";
            $query_string=$word;
           // echo "Query: ".$query_string."<br/>";
            
            
   
            
            
        
                        
            //ARTICLE SEARCH
            
                        
            $article_sql="SELECT * FROM help WHERE content REGEXP '[[:<:]]".$query_string."[[:>:]]'";
            //-run  the query against the mysql query function
            $article_result=mysqli_query($connection, $article_sql);
            $article_result_array=mysqli_fetch_assoc($article_result);
 
            if(!empty($article_result_array)){
                
                echo "<h2>Articles that mention \"". $query_string ."\":</h2>";
            foreach($article_result as $article){
          $title  =$article['title'];
          $article_id  =$article['id'];
                   
  //-display the result of the array
                
  echo "<ul>\n";
  echo "<li>" . "<a  href=\"help_single.php?article_id=$article_id\">"   .$title .  "</a></li>\n";
  echo "</ul>";
  }//end loop
            
            }else{
          //   echo "Query \"".$word."\" Gave No Article Results. Try a different keyword.<br/><br/> ";
                $no_results-=1;
                
            }
             
                        }//end each exploded string
       
        }//end preg match
        else{
        $_SESSION["message"] =  "Please enter a search query";
        }
    }
}
?> 
 
    </div>
<?php include("inc/footer.php"); ?> 