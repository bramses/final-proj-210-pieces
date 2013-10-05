$(document).ready(function()
{
	var buildingChoices;
	var building;
	var numtype;
	var numPeople;
	var roomNumber;
	var buildingtype;
	
	$('#area').change(function(){		
		buildingChoices = $(this).val();
		$('#buildingsdiv').load(buildingChoices + "buildings.txt");
	});
	
	$('#buildingsdiv').on('change', '#buildings', (function(){		
		building = $(this).val();
		$('#typediv').load(buildingChoices + "type.txt");
	})
	);
	
	$('#typediv').on('change', '#type', function(){
		numtype = $(this).val();
		if($(this).val() == "2person")
		{ 
			buildingtype = (building + "2");
		}
		else if($(this).val() == "3person") 
		{
			buildingtype = (building + "3");
		}
		$.ajax({
			type: 'POST',
			url: 'getrooms.php',
			data: {place: buildingtype},
			success: function(data){
				$('#availablediv').html(data);
			}
		})
	});
		
	
	$('#availablediv').on('change', '#available', function(){
		roomNumber = $(this).val();
		if(numtype == "single")
		{ 
			showPeopleForm(1);
		}
		else if(numtype == "double") 
		{
			showPeopleForm(2);
		}
		else if(numtype == "2person")
		{ 
			showPeopleForm(2);
		}
		else if(numtype == "3person") 
		{
			showPeopleForm(3);
		}
		else if(numtype == "6apartment")
		{ 
			showPeopleForm(6);
		}
		else if(numtype == "2double") 
		{
			showPeopleForm(4);
		}
	});
			
	$('#peoplediv').on('submit', '#inputform', function(e){
     e.preventDefault();
     var str = $("#inputform").serialize() + '&place=' + buildingtype + '&numPeople=' + numPeople + '&roomNumber=' + roomNumber + '&building=' + building;
     $.ajax({
			type: 'POST',
			url: 'checkStudents.php',
			data: str,
			success: function(data)
			{
				if(data == 1)
				{
					$.ajax({
						type: 'POST',
						url: 'register.php',
						data: str,
						success: function(data){
							if(data == "occupied") alert("Sorry, your living area is already occupied");
							else 
							{
								$('#registerblurb').html("Registration successful!");
								$.ajax({
									type: 'POST',
									url: 'emailconfirm.php',
									data: str,
									success: function(data){
										$('#registerblurb').append(" Confirmation emails have been sent!");
									}
								})

							}
						}
					})
				}
				else alert("One or more fields do not match the information we have on record.");
			}
		})
     });

	
	function showPeopleForm(numberPeople)
	{
		
		numPeople = numberPeople;
		var form = $('<form id = "inputform" name="input" action="register.php" method="get"></form>');
		$('#peoplediv').html("");
		for($i = 1; $i <= numPeople; $i++)
		{
			form.append('Person ' + $i + ': <br/>First name: <input type=\"text\" name=\"firstname'+$i+'\"><br/>Last name: <input type=\"text\" name=\"lastname'+$i+'\"><br/>ID Number: <input type = \"text\" name = \"id'+$i+'\"><br/><br/>'
			);
		}
		form.append('<input id = "submit" type="submit" value="Submit">');
		$('#peoplediv').html(form);
	}
		
	
});