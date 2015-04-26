  <!--******************-->         
  <!--                  -->
  <!--    CONTACT       -->
  <!--                  -->
  <!--******************--> 

  <!-- MAKE JQUERY VALIDATION // CREATE REAL SUBMIT FORM-->

  <div class="content">
      <h1 id="contact"> Connect With Isobel! </h1>



  <!-- ugly form -->

  <div id="signupbox">

      <div id="signupwrap">

      <!-- http://ctec.clark.edu/~belgort/formprocessing/processform.php -->

      <form id="signupform"
  action ="result.php"
  method ="POST"
  name ="CTEC126 Final Project">
      <table>



      <tr>
      <td class ="label">
      <label id="lfirstname"
  for ="firstname"> Name </label> </td> <td class ="field">
      <input id="firstname"
  name ="firstname"
  placeholder ="Name (Required)"
  type ="text"
  value =""
  maxlength ="100">
      </td> <td class ="status"> </td> </tr>


  <tr>
      <td class ="label">
      <label id="lemail"
  for ="email"> Email Address </label> </td> <td class ="field">
      <input id="email"
  name ="email"
  type ="text"
  value =""
  placeholder ="Email (Required)"
  maxlength ="150">
      </td> <td class ="status"> </td> </tr>

  <tr>
      <td class ="label">
      <label id="lmessage"
  for ="message"> Message </label> </td> <td class ="field">
      <!--<input id="message" name="message" type="text" value="" maxlength="150">-->
      <textarea id="message"
  name ="message"
  type ="text"
  value =""
  placeholder ="Hello...">
      </textarea>

  </td> <td class ="status"> </td> </tr>


  <tr>
      <td class ="label">
      <label id="lsignupsubmit"
  class ="submit"
  for ="signupsubmit"> Send </label> </td> <td class ="field"
  colspan ="2">


      <input type ="submit"
  value ="Send"
  id="send"
  class ="submit">
      </td> </tr> </table> </form> </div> </div>


  <!-- FORM SCRIPT -->

  <script>
      $(document).ready(function() {



          // validate signup form on keyup and submit
          var validator = $("#signupform").validate({
              rules: {
                  firstname: "required",
                  lastname: "required",
                  username: {
                      required: true,
                      minlength: 2
                  },
                  password: {
                      required: true,
                      minlength: 5
                  },
                  password_confirm: {
                      required: true,
                      minlength: 5,
                      equalTo: "#password"
                  },
                  email: {
                      required: true,
                      email: true
                  },
                  sex: "required",
                  terms: "required"
              },
              messages: {
                  firstname: "Enter your firstname",
                  lastname: "Enter your lastname",
                  username: {
                      required: "Enter a username",
                      minlength: jQuery.validator.format("Enter at least {0} characters"),
                      remote: jQuery.validator.format("{0} is already in use")
                  },
                  password: {
                      required: "Provide a password",
                      minlength: jQuery.validator.format("Enter at least {0} characters")
                  },
                  password_confirm: {
                      required: "Repeat your password",
                      minlength: jQuery.validator.format("Enter at least {0} characters"),
                      equalTo: "Enter the same password as above"
                  },
                  email: {
                      required: "Please enter a valid email address",
                      minlength: "Please enter a valid email address",
                      remote: jQuery.validator.format("{0} is already in use")
                  },
                  sex: "Choose your Sex",
                  terms: "You must agree to continue"
              },
              // the errorPlacement has to take the table layout into account
              errorPlacement: function(error, element) {
                  if (element.is(":radio"))
                      error.appendTo(element.parent().next().next());
                  else if (element.is(":checkbox"))
                      error.appendTo(element.next());
                  else
                      error.appendTo(element.parent().next());
              },

              // ----- Changed this to actually send the form -----
              submitHandler: function(form) {
                  form.submit();
                  //alert("submitted!");
              },
              // set this class to error-labels to indicate valid fields
              success: function(label) {
                  // set &nbsp; as text for IE
                  label.html(" ").addClass("checked");
              },
              highlight: function(element, errorClass) {
                  $(element).parent().next().find("." + errorClass).removeClass("checked");
              }




          }); //end var validator = $("#signupform").validate({...}

          // propose username by combining first- and lastname
          $("#username").focus(function() {
              var firstname = $("#firstname").val();
              var lastname = $("#lastname").val();
              if (firstname && lastname && !this.value) {
                  this.value = (firstname + "." + lastname).toLowerCase();
              }
          });
      }); </script>
  <!-- END UGLY FORM -->