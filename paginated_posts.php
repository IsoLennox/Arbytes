<?php
include("inc/header.php");
?> 
<header><style>
    div.pagination {
	padding: 3px;
	margin: 3px;
}

div.pagination a {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #AAAADD;
	
	text-decoration: none; /* no underline */
	color: #000099;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #000099;

	color: #000;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
		border: 1px solid #000099;
		
		font-weight: bold;
		background-color: #000099;
		color: #FFF;
	}
	div.pagination span.disabled {
		padding: 2px 5px 2px 5px;
		margin: 2px;
		border: 1px solid #EEE;
	
		color: #DDD;
	}
	
    </style></header>
 <?php
 
 
	/*
		Place code to connect to your DB here.
	*/
	//include('config.php');	// include your code to connect to DB.

	$tbl_name="notes";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name";
	$total_pages = mysqli_fetch_array(mysqli_query($query));
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	$targetpage = "paginated_notes.php"; 	//your file name  (the name of this file)
	$limit = 2; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name LIMIT $start, $limit";
	$result = mysqli_query($sql);
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev\">� previous</a>";
		else
			$pagination.= "<span class=\"disabled\">� previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\">next </a>";
		else
			$pagination.= "<span class=\"disabled\">next </span>";
		$pagination.= "</div>\n";		
	}
?>

	<?php
		while($row = mysqli_fetch_array($result))
		{
	
		// Your while loop here
            echo "page";
	
		}
	?>

<?=$pagination?>
	
 

 <div id="page">
     <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
 <h2>Paginated Notes</h2>
 
 
 

Sort by: member, Month, Day, Year
<hr/>
 
 

 
 
<?php
    //query to view notes that belong to your company
$query  = "SELECT * ";
		$query .= "FROM notes ";
		$query .= "WHERE company_id={$_SESSION['company_id']} ORDER BY datetime DESC"; 
		$all_notes = mysqli_query($connection, $query); 
        $notes_array= mysqli_fetch_assoc($all_notes);

 

        if(!empty($notes_array)){ 

            foreach($all_notes as $note){
                
                        
$comment_count=array();
                //get comment count
$query  = "SELECT * ";
$query .= "FROM comments ";
$query .= "WHERE note_id={$note['id']} "; 
$all_comments = mysqli_query($connection, $query); 
$comments_array= mysqli_fetch_assoc($all_comments);

                foreach($all_comments as $comment){

//                     echo "comment<br/>";
                    array_push($comment_count, "1");
    
                }
                
                
                 $query  = "SELECT * ";
		$query .= "FROM members ";
		$query .= "WHERE id={$note['author']} "; 
		$all_notes = mysqli_query($connection, $query); 
        $array= mysqli_fetch_assoc($all_notes);
 
                
                $content=$note['content'];
                $summary = substr($content, 0, 100);
                
                echo "<div class='note'><strong>".$note['title']."</strong><span class='right'> By: <a href='member_profile.php?user_id={$note['author']}'>".$array['first_name']." ".$array['last_name']."</a> |  ".$note{'datetime'}."</span><br/><br/>".$summary."...<br/><a href='note_single.php?note_id={$note['id']}'>Read More</a><br/><span class='right'>".count($comment_count)." comments</span><br/></div> "; 
            }
 
        
        
        }elseif(empty($array)){
            echo "No notes";
        }


?>
</div>
 <?php
include("inc/footer.php");
?> 