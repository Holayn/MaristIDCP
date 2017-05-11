function displayFields() {
	document.getElementById('stu_dob_field').style.display = 'none';
	
	// document.getElementById('stu_display').style.display = 'none';
	// document.getElementById('cert_display').style.display = 'none';
	// document.getElementById('emp_display').style.display = 'none';
	// document.getElementById('prg_specs').style.display = 'none';
	
	var x = document.getElementById('question1').value;
	if(x == "stu_dob_after") {
		document.getElementById('stu_dob_field').style.display = 'inline';
		document.getElementById('stu_dob1').required = true;
	}
	// else if(x == "course") {
	// 	alert("course");
	// 	document.getElementById('crs_display').style.display = 'inline';
	// }
	// else if(x == "instructor") {
	// 	alert("instructor");
	// 	document.getElementById('ins_display').style.display = 'inline';
	// }
	// else if(x == "student") {
	// 	alert("student");
	// 	document.getElementById('stu_display').style.display = 'inline';
	// }
	// else if(x == "certificate") {
	// 	alert("certificate");
	// 	document.getElementById('cert_display').style.display = 'inline';
	// }
	// else if(x == "employer") {
	// 	alert("employer");
	// 	document.getElementById('emp_display').style.display = 'inline';
	// }
	else {
	document.getElementById('stu_dob_field').style.display = 'none';
	document.getElementById('stu_dob1').required = false;
	}
}

function changeInput(){
	var x = document.getElementById('where1').value;
	if (x == "")
	document.getElementById('spec1').type = 'date';
}



