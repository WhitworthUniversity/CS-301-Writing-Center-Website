<!--
Title: Make Appointment Popup Template
Author: Alec Moore
Date: 3/7/2015
-->
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Popup Template</title>

    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/popupStyle.css">
</head>
<body>
<div class="popup">
    <div class="head">
        <h1>Make Appointment</h1>
    </div>
    <form action="" method="post">
        <div>
            <label>Client Name</label>
            <input type="text" name="clientName" placeholder="Client Name"/>
        </div>

        <div>
            <div class="one">
                <label>Date</label>
                <select name="apptDate">
                    <option>Choose A Day</option>
                </select>
            </div>

            <div class="two">
                <label>Time</label>
                <select name="apptTime">
                    <option>Choose A Time</option>
                </select>
            </div>
        </div>

        <div>
            <div class="one">
                <label>Course Number</label>
                <input type="text" name="courseNum"/>
            </div>

            <div class="two">
                <label>Course Name</label>
                <input type="text" name="courseName"/>
            </div>
        </div>

        <div>
            <div class="one">
                <label>Instructor Name</label>
                <input type="text" name="instructorName"/>
            </div>

            <div class="two">
                <label>Assignment Name</label>
                <input type="text" name="assignmentName"/>
            </div>
        </div>

        <div>
            <label>Assignment Description</label>
            <textarea name="assignmentDescription"></textarea>
        </div>

        <div>
            <input type="checkbox" name="consultationNotes"/>
            <label>Send Post-Consultation notes to instructor</label>
            <a>Whats this?</a>
        </div>

        <div>
            <button type="submit" class="btn">Save</button>
            <button class="btn">Cancel</button>
        </div>

    </form>
</div>
</body>
</html>
