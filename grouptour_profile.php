<?php include("inc/tourheader.php"); ?>


  
     <div id="page"> 
        <div class="tabbedPanels">
        <ul class="tabs">
        <li><a class="profiletour_1" href="#panel1" tabindex="1">Contact Info</a></li>  
       
        <li><a class="profiletour_2" href="#panel3" tabindex="2">Group Posts</a></li>
        <li><a class="profiletour_3" href="#panel4" tabindex="2">Files</a></li>
        <li><a class="profiletour_4" href="#panel5" tabindex="2">Avatar Gallery</a></li>
          
            </ul>
            
            
            
            <div class="panelContainer">
            <div id="panel1" class="panel">
            <h1>Member Name</h1>  
            
           
            
       <a href="#"><img src="img/icons/tiny-messages.png"/> Send Message</a>   

              
                <h3><a class="profiletour_5" href="grouptour_blog.php">View Blog</a> </h3>   
  
<!--        //else show default_avatar -->
      <img src="img/default_avatar.png" title="No Profile Image"/>
                
          <br/><br/> <a class="profiletour_6" href="upload_profile_img.php"><img src="img/icons/upload-icon.png"/>  Upload New Profile Picture</a>
             
           
           
            
           
            <p>Email: f.lastame@email.me</p> 
                <p>Group: <a href='#'>Group name</a> (Admin)
       </p> 
            
            <p>Profile Content:</p> <div class="note">This is a Profile! You can write whatever you'd like! Adding #tags will soon be a feature! </div>
            
         <span class='right'><a class="profiletour_7" href='#' ><img src="img/icons/tiny-newpost.png"/> Edit Profile</a></span><br/><br/>"; 
                 
            
 </div><!-- END PANEL 1 -->
   
    
    
    
    
        <div id="panel3" class="panel"><h2>Posts By Member Name</h2>
  <div class='note'><a href='grouptour_note_single.php'>Post Title</a><span class='right'>Published: February 12, 2015 a	11:00pm</span></div> 
    </div><!-- END PANEL 3 -->
    
    
    <div id="panel4" class="panel">
        <h2>Files Uploaded by Member Name</h2>
          
       <?php
                     echo "<div class='memb_files'> <a href='grouptour_file_single.php'><img src=\"img/default_img.png\" title=\"file-icon\" /></a>
                    <br/><br/> <a href='#'><strong>File Title</strong></a> <br /><a href='grouptour_profile.php'>Member Name</a> <br />  February 12, 2015 a	9:00pm<br/></div> "; 
             
             
                     echo "<div class='memb_files'> <a href='grouptour_file_single.php'><img src=\"img/file.PNG\" title=\"file-icon\" /></a><span class='right'> <a href='#'><strong>File Title</strong></a> <br /><a href='grouptour_profile.php'> Member Name </a> <br />  February 12, 2015 a	9:00pm</span><br/></div> "; 
      ?>  
    </div><!-- END PANEL 4 -->
 
 


    <div id="panel5" class="panel">
        <h2>Profile Images</h2>
       
          <a href="#"/> Upload New Profile Picture</a><br/>  <Br/>
          
     
   <div class='avatar_gallery'><a href="grouptour_view_image.php"><img src="img/default_avatar.png" title="profile image" /></a></div> 
          
    </div><!-- END PANEL 5 -->
    
     
    
    

</div>
            
            
        
</div><!-- end tabbed panels -->
 
</div>







<!--    TOUR JAVASCRIPT-->


<!-- The JavaScript -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
        <script type="text/javascript">
			$(function() {
				/*
				the json config obj.
				name: the class given to the element where you want the tooltip to appear
				bgcolor: the background color of the tooltip
				color: the color of the tooltip text
				text: the text inside the tooltip
				time: if automatic tour, then this is the time in ms for this step
				position: the position of the tip. Possible values are
					TL	top left
					TR  top right
					BL  bottom left
					BR  bottom right
					LT  left top
					LB  left bottom
					RT  right top
					RB  right bottom
					T   top
					R   right
					B   bottom
					L   left
				 */
				var config = [
					{
						"name" 		: "profiletour_1",
						"bgcolor"	: "black",
						"color"		: "white",
						"position"	: "TL",
						"text"		: "Each member profile contains tabs. This tab contains profile content and contact information",
						"time" 		: 5000
					},
					{
						"name" 		: "profiletour_2",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "This tab shows all the Group Posts the member has authored.",
						"position"	: "TL",
						"time" 		: 5000
					},
					{
						"name" 		: "profiletour_3",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "This tab contains file uploads the member has uploaded.",
						"position"	: "TL",
						"time" 		: 5000
					},
					{
						"name" 		: "profiletour_4",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "Here you can view all of the profile images that the member has uploaded, and any comments made on them.",
						"position"	: "TL",
						"time" 		: 5000
					},
					{
						"name" 		: "profiletour_5",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "In the member's profile, you can send them a private message and view their blog.",
						"position"	: "TL",
						"time" 		: 5000
					},
					{
						"name" 		: "profiletour_6",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "A member can upload multiple profile images. The uploads will all be in the 'avatar gallery'. After profile images are uploaded, a member can choose between the images in their gallery to be their current profile image. Only a member viewing their own prfoile will be able to see the 'Upload Profile Image' option.",
						"position"	: "TL",
						"time" 		: 5000
					},
					{
						"name" 		: "profiletour_7",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "Each member can update their profile content. Only a member viewing their own prfoile will be able to see the 'Edit Profile' option.",
						"position"	: "TL",
						"time" 		: 5000
					}

				],
				//define if steps should change automatically
				autoplay	= false,
				//timeout for the step
				showtime,
				//current step of the tour
				step		= 0,
				//total number of steps
				total_steps	= config.length;
					
				//show the tour controls
				showControls();
				
				/*
				we can restart or stop the tour,
				and also navigate through the steps
				 */
				$('#activatetour').live('click',startTour);
				$('#canceltour').live('click',endTour);
				$('#endtour').live('click',endTour);
				$('#restarttour').live('click',restartTour);
				$('#nextstep').live('click',nextStep);
				$('#prevstep').live('click',prevStep);
				
				function startTour(){
					$('#activatetour').remove();
					$('#endtour,#restarttour').show();
					if(!autoplay && total_steps > 1)
						$('#nextstep').show();
					showOverlay();
					nextStep();
				}
				
				function nextStep(){
					if(!autoplay){
						if(step > 0)
							$('#prevstep').show();
						else
							$('#prevstep').hide();
						if(step == total_steps-1)
							$('#nextstep').hide();
						else
							$('#nextstep').show();	
					}	
					if(step >= total_steps){
						//if last step then end tour
						endTour();
						return false;
					}
					++step;
					showTooltip();
				}
				
				function prevStep(){
					if(!autoplay){
						if(step > 2)
							$('#prevstep').show();
						else
							$('#prevstep').hide();
						if(step == total_steps)
							$('#nextstep').show();
					}		
					if(step <= 1)
						return false;
					--step;
					showTooltip();
				}
				
				function endTour(){
					step = 0;
					if(autoplay) clearTimeout(showtime);
					removeTooltip();
					hideControls();
					hideOverlay();
				}
				
				function restartTour(){
					step = 0;
					if(autoplay) clearTimeout(showtime);
					nextStep();
				}
				
				function showTooltip(){
					//remove current tooltip
					removeTooltip();
					
					var step_config		= config[step-1];
					var $elem			= $('.' + step_config.name);
					
					if(autoplay)
						showtime	= setTimeout(nextStep,step_config.time);
					
					var bgcolor 		= step_config.bgcolor;
					var color	 		= step_config.color;
					
					var $tooltip		= $('<div>',{
						id			: 'tour_tooltip',
						className 	: 'tooltip',
						html		: '<p>'+step_config.text+'</p><span class="tooltip_arrow"></span>'
					}).css({
						'display'			: 'none',
						'background-color'	: bgcolor,
						'color'				: color
					});
					
					//position the tooltip correctly:
					
					//the css properties the tooltip should have
					var properties		= {};
					
					var tip_position 	= step_config.position;
					
					//append the tooltip but hide it
					$('BODY').prepend($tooltip);
					
					//get some info of the element
					var e_w				= $elem.outerWidth();
					var e_h				= $elem.outerHeight();
					var e_l				= $elem.offset().left;
					var e_t				= $elem.offset().top;
					
					
					switch(tip_position){
						case 'TL'	:
							properties = {
								'left'	: e_l,
								'top'	: e_t + e_h + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_TL');
							break;
						case 'TR'	:
							properties = {
								'left'	: e_l + e_w - $tooltip.width() + 'px',
								'top'	: e_t + e_h + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_TR');
							break;
						case 'BL'	:
							properties = {
								'left'	: e_l + 'px',
								'top'	: e_t - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_BL');
							break;
						case 'BR'	:
							properties = {
								'left'	: e_l + e_w - $tooltip.width() + 'px',
								'top'	: e_t - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_BR');
							break;
						case 'LT'	:
							properties = {
								'left'	: e_l + e_w + 'px',
								'top'	: e_t + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_LT');
							break;
						case 'LB'	:
							properties = {
								'left'	: e_l + e_w + 'px',
								'top'	: e_t + e_h - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_LB');
							break;
						case 'RT'	:
							properties = {
								'left'	: e_l - $tooltip.width() + 'px',
								'top'	: e_t + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RT');
							break;
						case 'RB'	:
							properties = {
								'left'	: e_l - $tooltip.width() + 'px',
								'top'	: e_t + e_h - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RB');
							break;
						case 'T'	:
							properties = {
								'left'	: e_l + e_w/2 - $tooltip.width()/2 + 'px',
								'top'	: e_t + e_h + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_T');
							break;
						case 'R'	:
							properties = {
								'left'	: e_l - $tooltip.width() + 'px',
								'top'	: e_t + e_h/2 - $tooltip.height()/2 + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_R');
							break;
						case 'B'	:
							properties = {
								'left'	: e_l + e_w/2 - $tooltip.width()/2 + 'px',
								'top'	: e_t - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_B');
							break;
						case 'L'	:
							properties = {
								'left'	: e_l + e_w  + 'px',
								'top'	: e_t + e_h/2 - $tooltip.height()/2 + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_L');
							break;
					}
					
					
					/*
					if the element is not in the viewport
					we scroll to it before displaying the tooltip
					 */
					var w_t	= $(window).scrollTop();
					var w_b = $(window).scrollTop() + $(window).height();
					//get the boundaries of the element + tooltip
					var b_t = parseFloat(properties.top,10);
					
					if(e_t < b_t)
						b_t = e_t;
					
					var b_b = parseFloat(properties.top,10) + $tooltip.height();
					if((e_t + e_h) > b_b)
						b_b = e_t + e_h;
						
					
					if((b_t < w_t || b_t > w_b) || (b_b < w_t || b_b > w_b)){
						$('html, body').stop()
						.animate({scrollTop: b_t}, 500, 'easeInOutExpo', function(){
							//need to reset the timeout because of the animation delay
							if(autoplay){
								clearTimeout(showtime);
								showtime = setTimeout(nextStep,step_config.time);
							}
							//show the new tooltip
							$tooltip.css(properties).show();
						});
					}
					else
					//show the new tooltip
						$tooltip.css(properties).show();
				}
				
				function removeTooltip(){
					$('#tour_tooltip').remove();
				}
				
				function showControls(){
					/*
					we can restart or stop the tour,
					and also navigate through the steps
					 */
					var $tourcontrols  = '<div id="tourcontrols" class="tourcontrols">';
					$tourcontrols += '<p>Profile Tour</p>';
					$tourcontrols += '<span class="button" id="activatetour">Start the tour</span>';
						if(!autoplay){
							$tourcontrols += '<div class="nav"><span class="button" id="prevstep" style="display:none;">< Previous</span>';
							$tourcontrols += '<span class="button" id="nextstep" style="display:none;">Next ></span></div>';
						}
						$tourcontrols += '<a id="restarttour" style="display:none;">Restart the tour</span>';
						$tourcontrols += '<a id="endtour" style="display:none;">End the tour</a>';
						$tourcontrols += '<span class="close" id="canceltour"></span>';
					$tourcontrols += '</div>';
					
					$('BODY').prepend($tourcontrols);
					$('#tourcontrols').animate({'right':'30px'},500);
				}
				
				function hideControls(){
					$('#tourcontrols').remove();
				}
				
				function showOverlay(){
					var $overlay	= '<div id="tour_overlay" class="overlay"></div>';
					$('BODY').prepend($overlay);
				}
				
				function hideOverlay(){
					$('#tour_overlay').remove();
				}
				
			});
        </script>
        
        
        
<?php include("inc/footer.php"); ?> 