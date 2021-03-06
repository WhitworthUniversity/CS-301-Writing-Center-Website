$(function(){

	var schedule;
	var consultants;

	var old_time;
	var old_date;

	var consultationFlag ;
	var whatsThisFlag = false;



	function loadSchedule(){
		var old_val;
		$.getJSON('./data/data.json').done( function(data) {
			schedule = data.schedule;
			consultants = data.consultants;

			if(old_time.text() !== "Choose A Time"){
				old_val = old_time.val();

				for(var i=0;i < schedule.length && schedule[i].date != old_date;i++){}
				
				if(i != schedule.length){
					schedule[i].time_slots.push(old_val);
					schedule[i].time_slots.sort(function(t1,t2){return t1.split('-')[2] - t2.split('-')[2]});
				}
				else{
					var time_slot = {date:old_date,time_slots:[old_val]};
					schedule.push(time_slot);
				}

			}

	    });
	}

	$('#redirectAppt').on('click', function() {
		var index = $(this).attr("value");
		if (index)
			window.location.href = "viewAppointments.php";
		else
			window.location.href = "../html";
		return false;
	});

	// $('#redirectViewAppt').on('click', function() {
	// 	window.location.href = "../html/index.htm";
	// 	return false;
	// });

	$('#edit_post_notes').on('click', function() {
		window.location.href = "../html/postConsultation.php?id" + $(this).attr("value");
		return false;
	});

	$('.editAppointment').on('click', function() {
		window.location.href = "appointmentPopup.php?" + $(this).attr("value");
		return false;
	});

	$('#apptDate').on('blur',function(e){
		var date = $('#apptDate').val();

		$('#apptTime').find('option').remove().end().append('<option>Choose A Time</option>');

		for(var i=0;i < schedule.length && schedule[i].date != date;i++){}
		if(i != schedule.length){
			$.each(schedule[i].time_slots,function(index,slot){
				var args = slot.split('-');

					var t = args[2];
					if (t.length == 3) t = "0" + t;
					t = t[0]+t[1]+":"+t[2]+t[3];

				 $('#apptTime').append($('<option>', { 
				        value: slot,
				        text : t+"-"+consultants[args[1]]
				    }));
			});
		}
		
	});

	old_date = $('#apptDate').val();
	old_time = $('#apptTime option');

	// Event handler for when the checkbox is checked or unchecked
	$('#consultationNotes').on('click', function() {

		consultationFlag = $('#consultationNotes').is(':checked');

		if (!consultationFlag) {
			$('#instructorEmail').hide();
		}
		else {
			$('#instructorEmail').show();
		}

		// Toggle flag
		consultationFlag = !consultationFlag;
	});

	// Event handler for when the checkbox is checked or unchecked
	$('#whatsThis').on('click', function() {
		if (!whatsThisFlag) {
			$('#tooltip').show();
		}
		else {
			$('#tooltip').hide();
		}

		// Toggle flag
		whatsThisFlag = !whatsThisFlag;
	});




	loadSchedule();

});
