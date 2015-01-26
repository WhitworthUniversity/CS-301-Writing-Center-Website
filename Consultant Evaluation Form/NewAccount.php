<!DOCTYPE html>
<html>
  <body>
    <p> Thank you for your feedback. </p>
    <?php
      // This takes all the values from the form to be used in the query
      $Email = $_POST["email"];
      $Fname = $_POST["firstName"];
      $Lname = $_POST["lastName"];
      $Password = $_POST["password"];
      $Standing = $_POST["standing"];
      $Graduation_Year = $_POST["Graduation_Year"];
      $Language = $_POST["Language"];
      $Major = $_POST["Major"];
      $Secondary_Major = $_POST["Secondary_Major"];
      $Minor = $_POST["Minor"];
      $Appointment = $_POST["appointment"];
      $Modify = $_POST["modify"];
      $Delete = $_POST["delete"];
      $Announcement = $_POST["announcement"];
      $Remind = $_POST["remind"];


      // Initializes values to connect to the database
      $servername = "127.0.0.1";
      $username = "Admin";
      $password = "123";

      // Tries to connect to the database
      $db = new mysqli( $servername, $username, $password, "WritingCenter" );
      // If it fails, output a connection error
      if ( $db->connect_errno ) {
        die( 'Connect Error: ' . $db->connect_errno );
      }

      // Query to get the Consultant ID based on the name given in the form
      $GetConsultantID = 'Select Consultants.Consultant_ID FROM Consultants WHERE Consultants.fname =? AND Consultants.lname =?;';
      $GetClientID = 'Select Clients.Client_ID FROM Clients WHERE Clients.fname =? AND Clients.lname =?;';
      if ( $stmt = $db->prepare($GetConsultantID)) {
        // Escape any special characters to prevent monkey business
        $Consultant = $db->real_escape_string($Consultant);

        // Break up the string into a first name and a last name
        $fname_lname = explode(" ", $Consultant);

        // Bind the cleaned parameters to the pre-prepared query
        $stmt->bind_param("ss", $fname_lname[0],$fname_lname[1]);
        
        // Execute the query
        $result = $stmt->execute();

        // Retrieve the query results
        $result = $stmt->get_result();

        // This gets the ID from the result (THERE HAS TO BE A BETTER WAY TO DO THIS BUT THIS WORKS FOR NOW)
        $outp = "";
        while ( $row = $result->fetch_array(MYSQLI_ASSOC) ) {
          $outp .= $row['Consultant_ID'];           
        }
        $outp .="";

        // Escape any special characters to prevent monkey business
        $stmt2 = $db->prepare($GetClientID);
        $Client_Name = $db->real_escape_string($Client_Name);

        // Break up the string into a first name and a last name
        $Client_fname_lname = explode(" ", $Client_Name);

        // Bind the cleaned parameters to the pre-prepared query
        $stmt2->bind_param("ss", $Client_fname_lname[0], $Client_fname_lname[1]);

        // Execute the query
        $result2 = $stmt2->execute();

        // Retrieve the query results
        $result2 = $stmt2->get_result();

        // This gets the ID from the result (THERE HAS TO BE A BETTER WAY TO DO THIS BUT THIS WORKS FOR NOW)
        $outp2 = "";
        while ( $row = $result2->fetch_array(MYSQLI_ASSOC) ) {
          $outp2 .= $row['Client_ID'];           
        }
        $outp2 .="";

        // The results of both queries are stored in more useful names
        $Consultant_ID = $outp;
        $Client_ID = $outp2;

        // Escape any special characters to prevent monkey business
        $Email_Instructor = $db->real_escape_string($Email_Instructor);
        $Date = $db->real_escape_string($Date);
        $Client_Type = $db->real_escape_string($Client_Type);
        $Language = $db->real_escape_string($Language);
        $Instructor = $db->real_escape_string($Instructor);
        $Class = $db->real_escape_string($Class);
        $projectType =$db->real_escape_string($projectType);
        $Comments =$db->real_escape_string($Comments);
        $Section = $db->real_escape_string($Section);

        // Figure out the boolean entry of the table
        if ($Email_Instructor == "true" )
          $Email_Instructor = 1;
        else{
          $Email_Instructor = 0;
          print_r("Here?");
        }

        // This inserts all the data into the post_consultation_notes based on the data that was input by the user
        $query1 = "Insert into post_consulatation_notes (Client_ID, Consultant_ID, Native_Language, Copy_Sent, Class_, Assignment, Professor, Date_, Notes) VALUES (?,?,?,?,?,?,?,?,?);";
        
        // Something about monkey business
        if($stmt3 = $db->prepare($query1)){

          // Bind the cleaned parameters to the pre-prepared query1
          $stmt3->bind_param("sssisssss", $Client_ID, $Consultant_ID, $Language, $Email_Instructor, $Class, $projectType, $Instructor, $Date, $Comments);
          // Execute the insertion
          $stmt3->execute();
        }
        else {
          die( 'Error in query preparation. error = ' . $db->errno .
          " " . $db->error );
        }

        // Close the database
        $db->close();
      }
        else {
          die( 'Error in query preparation. error = ' . $db->errno .
          " " . $db->error );
        }

    ?>

  </body>
</html>