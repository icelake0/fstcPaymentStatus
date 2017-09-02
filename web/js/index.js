		  var matricNumber;
		  function getPoint(grade){
			switch(grade){
			case "AA" : return 4.0;
			case "A" : return 3.5;
			case "AB" : return 3.25;
			case "B" : return 3.0;
			case "BC" : return 2.75;
			case "C" : return 2.50;
			case "CD" : return 2.25;
			case "D" : return 2.0;
			case "F" : return 0.0;
			case undefined : return 0.0;
			case "" : return 0.0;
			case " " : return 0.0;
			default : return 0.0;
			}
		  }
		  function getGrade(score){
				if(score>=75){
					return "AA";
				}
				else if(score>=70 && score<75){
					return "A";
				}
				else if(score>=65 && score<70){
					return "AB";
				}
				else if(score>=60 && score<65){
					return "B";
				}
				else if(score>=55 && score<60){
					return "BC";
				}
				else if(score>=50 && score<55){
					return "C"
				}
				else if(score>=45 && score<50){
					return "CD"
				}
				else if(score>=40 && score<45){
					return "D";
				}
				else {
					return "F";
				}
		  }
		  function getComment(gp){
			  if(gp>=3.5){
				 return "<p>DISTINCTION</p>";
			  }
			  else if(gp>=3.0){
				return "<p>UPPER CREDIT</p>";
			  }
			  else if(gp>=2.0){
				return "<p>LOWER CREDIT</p>";
			  }
			  else if(gp>=1.0){
				return "<p>PASS</p>";
			  }
			  else{
				return "<p>FAIL</p>";
			  }
		  }
		  $(document).one("pagecreate","#pageone",function(){
			  //$(document).on("ready",function(){
			  for(j=1; j<=6; j++){
				  for(i=1; i<=15; i++){
						$("#sim"+j+"resultpage").find("#mainContainer").append("<div class=\"ui-grid-c coursecad\" id=\"sim"+j+"coursecad"+i+"\"></div>");
							$("#sim"+j+"coursecad"+i).append("<div style=\"color:#9999ff; font-size:20px;\">Course "+i+"</div>");
							$("#sim"+j+"coursecad"+i).append("<div><input type=\"text\" id=\"sim"+j+"ctt"+i+"\" value=\" \" placeholder='c-title'></div>");
							$("#sim"+j+"coursecad"+i).append("<div class=\"ui-block-a\"><input type=\"text\" id=\"sim"+j+"cc"+i+"\" value=\" \" placeholder=\"c-code\"></div>");
							$("#sim"+j+"coursecad"+i).append("<div class=\"ui-block-b\"><input type=\"text\" id=\"sim"+j+"cu"+i+"\" value=\" \" placeholder=\"c-unit\"></div>");
							$("#sim"+j+"coursecad"+i).append("<div class=\"ui-block-c\"><input type=\"text\" id=\"sim"+j+"score"+i+"\" value=\" \" placeholder=\"score\"></div>");
							$("#sim"+j+"coursecad"+i).append("<div class=\"ui-block-d\"><input type=\"text\" id=\"sim"+j+"grade"+i+"\" value=\" \" placeholder=\"grade\"></div>");
						$("#sim"+j+"resultpage").find("#mainContainer").append("<br/>");
					}
				  $("#sim"+j+"resultpage").find("#mainContainer").append("<a href=\"#sim"+j+"GPAmodel\" class=\"ui-btn ui-coner-all\" id=\"calcSim"+j+"GpBtn\" data-transition=\"fade\">Save & Calculate</a>");
			  }
			});
				 $("#login").on("tap",function(){
					var matNum = document.getElementById("matricnumber").value;
					var pass = document.getElementById("password").value;
					if(matNum===""){
						document.getElementById("loginError").innerHTML="please enter your  matric number";
					}
					else if(pass===""){
						document.getElementById("loginError").innerHTML="please enter your password";
					}
					else{
						matricNumber=matNum;
						document.getElementById("loginsatus").innerHTML="MatricNumber : "+matricNumber;
						$.ajax({
							url: "http://softwork.herokuapp.com/api/login/"+matNum+"/"+pass,
							success: loginSussess
						});
					}
					
				});
				$("#signup").on("tap",function(){
					var matNum = document.getElementById("regmatnum").value;
					var pass = document.getElementById("regpass").value;
					var cpass = document.getElementById("regcpass").value;
					if(matNum.length < 8){
						document.getElementById("signupError").innerHTML="Matric number must be atleast 8 characters long";
					}
					else if(pass.length < 8){
						document.getElementById("signupError").innerHTML="password must be atleast 8 characters long";
					}
					else if(pass!==cpass){
						document.getElementById("signupError").innerHTML="password does not match";
					}
					else{
						$.ajax({
							url: "http://softwork.herokuapp.com/api/register/"+matNum+"/"+pass,
							success: signupsucess
						});
					}
				});
				function loginSussess(result){
					if(result==="Incorrect MatricNumber or password"){
						document.getElementById("loginError").innerHTML=result;
					}
					else{
						//porpulate user info with recived files
						$.mobile.changePage("../index.html#pageone");
						document.getElementById("password").value="";
						$.ajax({
							url: "http://softwork.herokuapp.com/api/getsim1Result/"+matricNumber,
							success: updateSim1ResultForm
						});
					}
				}
				function signupsucess(result){
					if(result==="MatricNumber already registered"){
						document.getElementById("signupError").innerHTML=result;
					}
					else{
						document.getElementById("loginError").innerHTML="SIGNUP SUSSESSFUL, LOGIN";
						$.mobile.changePage("../index.html#loginpage");
					}
				}
				function updateSim1ResultForm(myObj){
					//myObj = JSON.parse(myObj);
					for(i=1; i<=15; i++){
					document.getElementById("sim1ctt"+i).value = myObj["sim1ctt"+i];
					document.getElementById("sim1cc"+i).value = myObj["sim1cc"+i];
					document.getElementById("sim1cu"+i).value = myObj["sim1cu"+i];
					document.getElementById("sim1score"+i).value = myObj["sim1score"+i];
					document.getElementById("sim1grade"+i).value = myObj["sim1grade"+i];
					}
					//matricNumber = document.getElementById("matricNumber").value;
					$.ajax({
						url: "http://softwork.herokuapp.com/api/getsim2Result/"+matricNumber,
						success: updateSim2ResultForm
					});
				}
				function updateSim2ResultForm(myObj){
					//myObj = JSON.parse(myObj);
					for(i=1; i<=15; i++){
					document.getElementById("sim2ctt"+i).value = myObj["sim2ctt"+i];
					document.getElementById("sim2cc"+i).value = myObj["sim2cc"+i];
					document.getElementById("sim2cu"+i).value = myObj["sim2cu"+i];
					document.getElementById("sim2score"+i).value = myObj["sim2score"+i];
					document.getElementById("sim2grade"+i).value = myObj["sim2grade"+i];
					}
					$.ajax({
						url: "http://softwork.herokuapp.com/api/getsim3Result/"+matricNumber,
						success: updateSim3ResultForm
					});
				}
				function updateSim3ResultForm(myObj){
					//myObj = JSON.parse(myObj);
					for(i=1; i<=15; i++){
					document.getElementById("sim3ctt"+i).value = myObj["sim3ctt"+i];
					document.getElementById("sim3cc"+i).value = myObj["sim3cc"+i];
					document.getElementById("sim3cu"+i).value = myObj["sim3cu"+i];
					document.getElementById("sim3score"+i).value = myObj["sim3score"+i];
					document.getElementById("sim3grade"+i).value = myObj["sim3grade"+i];
					}
					$.ajax({
							url: "http://softwork.herokuapp.com/api/getsim4Result/"+matricNumber,
							success: updateSim4ResultForm
						});
				}
				function updateSim4ResultForm(myObj){
					//myObj = JSON.parse(myObj);
					for(i=1; i<=15; i++){
					document.getElementById("sim4ctt"+i).value = myObj["sim4ctt"+i];
					document.getElementById("sim4cc"+i).value = myObj["sim4cc"+i];
					document.getElementById("sim4cu"+i).value = myObj["sim4cu"+i];
					document.getElementById("sim4score"+i).value = myObj["sim4score"+i];
					document.getElementById("sim4grade"+i).value = myObj["sim4grade"+i];
					}
					$.ajax({
							url: "http://softwork.herokuapp.com/api/getsim5Result/"+matricNumber,
							success: updateSim5ResultForm
						});
				}
				function updateSim5ResultForm(myObj){
					//myObj = JSON.parse(myObj);
					for(i=1; i<=15; i++){
					document.getElementById("sim5ctt"+i).value = myObj["sim5ctt"+i];
					document.getElementById("sim5cc"+i).value = myObj["sim5cc"+i];
					document.getElementById("sim5cu"+i).value = myObj["sim5cu"+i];
					document.getElementById("sim5score"+i).value = myObj["sim5score"+i];
					document.getElementById("sim5grade"+i).value = myObj["sim5grade"+i];
					}
					$.ajax({
							url: "http://softwork.herokuapp.com/api/getsim6Result/"+matricNumber,
							success: updateSim6ResultForm
						});
				}
				function updateSim6ResultForm(myObj){
					//myObj = JSON.parse(myObj);
					for(i=1; i<=15; i++){
					document.getElementById("sim6ctt"+i).value = myObj["sim6ctt"+i];
					document.getElementById("sim6cc"+i).value = myObj["sim6cc"+i];
					document.getElementById("sim6cu"+i).value = myObj["sim6cu"+i];
					document.getElementById("sim6score"+i).value = myObj["sim6score"+i];
					document.getElementById("sim6grade"+i).value = myObj["sim6grade"+i];
					}
				}
			$(document).one("pagecreate","#sim1resultpage",function(){
				$("#sim1score1").keyup(function(){
					var score = document.getElementById("sim1score1").value;
					console.log("hello");
					document.getElementById("sim1grade1").value =getGrade(score);
				});
				$("#sim1score2").keyup(function(){
					var score = document.getElementById("sim1score2").value;
					document.getElementById("sim1grade2").value =getGrade(score);
				});
				$("#sim1score3").keyup(function(){
					var score = document.getElementById("sim1score3").value;
					document.getElementById("sim1grade3").value =getGrade(score);
				});
				$("#sim1score4").keyup(function(){
					var score = document.getElementById("sim1score4").value;
					document.getElementById("sim1grade4").value =getGrade(score);
				});
				$("#sim1score5").keyup(function(){
					var score = document.getElementById("sim1score5").value;
					document.getElementById("sim1grade5").value =getGrade(score);
				});
				$("#sim1score6").keyup(function(){
					var score = document.getElementById("sim1score6").value;
					document.getElementById("sim1grade6").value =getGrade(score);
				});
				$("#sim1score7").keyup(function(){
					var score = document.getElementById("sim1score7").value;
					document.getElementById("sim1grade7").value =getGrade(score);
				});
				$("#sim1score8").keyup(function(){
					var score = document.getElementById("sim1score8").value;
					document.getElementById("sim1grade8").value =getGrade(score);
				});
				$("#sim1score9").keyup(function(){
					var score = document.getElementById("sim1score9").value;
					document.getElementById("sim1grade9").value =getGrade(score);
				});
				$("#sim1score10").keyup(function(){
					var score = document.getElementById("sim1score10").value;
					document.getElementById("sim1grade10").value =getGrade(score);
				});
				$("#sim1score11").keyup(function(){
					var score = document.getElementById("sim1score11").value;
					document.getElementById("sim1grade11").value =getGrade(score);
				});
				$("#sim1score12").keyup(function(){
					var score = document.getElementById("sim1score12").value;
					document.getElementById("sim1grade12").value =getGrade(score);
				});
				$("#sim1score13").keyup(function(){
					var score = document.getElementById("sim1score13").value;
					document.getElementById("sim1grade13").value =getGrade(score);
				});
				$("#sim1score14").keyup(function(){
					var score = document.getElementById("sim1score14").value;
					document.getElementById("sim1grade14").value =getGrade(score);
				});
				$("#sim1score15").keyup(function(){
					var score = document.getElementById("sim1score15").value;
					document.getElementById("sim1grade15").value =getGrade(score);
				});
				$("#calcSim1GpBtn").on("tap",function(){
					//http://softwork.herokuapp.com/api/updateSim1Result/1234/hello
					var sim1result = new Object();
					for(i=1; i<=15; i++){
						sim1result["sim1ctt"+i]=document.getElementById("sim1ctt"+i).value;
						sim1result["sim1cc"+i]=document.getElementById("sim1cc"+i).value;
						sim1result["sim1cu"+i]=document.getElementById("sim1cu"+i).value;
						sim1result["sim1score"+i]=document.getElementById("sim1score"+i).value;
						sim1result["sim1grade"+i]=document.getElementById("sim1grade"+i).value;
					}
					sim1result=JSON.stringify(sim1result);
					//console.log(sim1result);
					//console.log(sim1result);
					$.ajax({
						url: "http://softwork.herokuapp.com/api/updateSim1Result/"+matricNumber+"/"+sim1result
					});
						var totalcu=0;
						var totalpoint=0;
						for(i=1; i<=15; i++){
							var cu = parseFloat(document.getElementById("sim1cu"+i).value);
							totalcu=totalcu+cu;
							var grade=document.getElementById("sim1grade"+i).value;
							point=parseFloat(getPoint(grade));
							point*=cu;
							totalpoint+=point;
						}
						var sim1GPA=totalpoint/totalcu;
						document.getElementById("sim1GPA").innerHTML=sim1GPA;
						document.getElementById("sim1GPAComment").innerHTML=getComment(sim1GPA);
						//console.log(sim1GPA);
						
						//var valu= $('#grade1').find(":selected").text()
						//console.log(valu);
				});
			});	
				
				
			$(document).one("pagecreate","#sim2resultpage",function(){
				$("#sim2score1").keyup(function(){
					var score = document.getElementById("sim2score1").value;
					document.getElementById("sim2grade1").value =getGrade(score);
				});
				$("#sim2score2").keyup(function(){
					var score = document.getElementById("sim2score2").value;
					document.getElementById("sim2grade2").value =getGrade(score);
				});
				$("#sim2score3").keyup(function(){
					var score = document.getElementById("sim2score3").value;
					document.getElementById("sim2grade3").value =getGrade(score);
				});
				$("#sim2score4").keyup(function(){
					var score = document.getElementById("sim2score4").value;
					document.getElementById("sim2grade4").value =getGrade(score);
				});
				$("#sim2score5").keyup(function(){
					var score = document.getElementById("sim2score5").value;
					document.getElementById("sim2grade5").value =getGrade(score);
				});
				$("#sim2score6").keyup(function(){
					var score = document.getElementById("sim2score6").value;
					document.getElementById("sim2grade6").value =getGrade(score);
				});
				$("#sim2score7").keyup(function(){
					var score = document.getElementById("sim2score7").value;
					document.getElementById("sim2grade7").value =getGrade(score);
				});
				$("#sim2score8").keyup(function(){
					var score = document.getElementById("sim2score8").value;
					document.getElementById("sim2grade8").value =getGrade(score);
				});
				$("#sim2score9").keyup(function(){
					var score = document.getElementById("sim2score9").value;
					document.getElementById("sim2grade9").value =getGrade(score);
				});
				$("#sim2score10").keyup(function(){
					var score = document.getElementById("sim2score10").value;
					document.getElementById("sim2grade10").value =getGrade(score);
				});
				$("#sim2score11").keyup(function(){
					var score = document.getElementById("sim2score11").value;
					document.getElementById("sim2grade11").value =getGrade(score);
				});
				$("#sim2score12").keyup(function(){
					var score = document.getElementById("sim2score12").value;
					document.getElementById("sim2grade12").value =getGrade(score);
				});
				$("#sim2score13").keyup(function(){
					var score = document.getElementById("sim2score13").value;
					document.getElementById("sim2grade13").value =getGrade(score);
				});
				$("#sim2score14").keyup(function(){
					var score = document.getElementById("sim2score14").value;
					document.getElementById("sim2grade14").value =getGrade(score);
				});
				$("#sim2score15").keyup(function(){
					var score = document.getElementById("sim2score15").value;
					document.getElementById("sim2grade15").value =getGrade(score);
				});
				$("#calcSim2GpBtn").on("tap",function(){
					//http://softwork.herokuapp.com/api/updateSim1Result/1234/hello
					var sim2result = new Object();
					for(i=1; i<=15; i++){
						sim2result["sim2ctt"+i]=document.getElementById("sim2ctt"+i).value;
						sim2result["sim2cc"+i]=document.getElementById("sim2cc"+i).value;
						sim2result["sim2cu"+i]=document.getElementById("sim2cu"+i).value;
						sim2result["sim2score"+i]=document.getElementById("sim2score"+i).value;
						sim2result["sim2grade"+i]=document.getElementById("sim2grade"+i).value;
					}
					sim2result=JSON.stringify(sim2result);
					//console.log(sim2result);
					//console.log(sim2result);
					$.ajax({
						url: "http://softwork.herokuapp.com/api/updateSim2Result/"+matricNumber+"/"+sim2result
					});
						var totalcu=0;
						var totalpoint=0;
						for(i=1; i<=15; i++){
							var cu = parseFloat(document.getElementById("sim2cu"+i).value);
							totalcu=totalcu+cu;
							var grade=document.getElementById("sim2grade"+i).value;
							point=parseFloat(getPoint(grade));
							point*=cu;
							totalpoint+=point;
						}
						var sim2GPA=totalpoint/totalcu;
						document.getElementById("sim2GPA").innerHTML=sim2GPA;
						document.getElementById("sim2GPAComment").innerHTML=getComment(sim2GPA);
						console.log(sim2GPA);
						
						//var valu= $('#grade1').find(":selected").text()
						//console.log(valu);
				});
			});
				
				
				
			$(document).one("pagecreate","#sim3resultpage",function(){
				$("#sim3score1").keyup(function(){
					var score = document.getElementById("sim3score1").value;
					document.getElementById("sim3grade1").value =getGrade(score);
				});
				$("#sim3score2").keyup(function(){
					var score = document.getElementById("sim3score2").value;
					document.getElementById("sim3grade2").value =getGrade(score);
				});
				$("#sim3score3").keyup(function(){
					var score = document.getElementById("sim3score3").value;
					document.getElementById("sim3grade3").value =getGrade(score);
				});
				$("#sim3score4").keyup(function(){
					var score = document.getElementById("sim3score4").value;
					document.getElementById("sim3grade4").value =getGrade(score);
				});
				$("#sim3score5").keyup(function(){
					var score = document.getElementById("sim3score5").value;
					document.getElementById("sim3grade5").value =getGrade(score);
				});
				$("#sim3score6").keyup(function(){
					var score = document.getElementById("sim3score6").value;
					document.getElementById("sim3grade6").value =getGrade(score);
				});
				$("#sim3score7").keyup(function(){
					var score = document.getElementById("sim3score7").value;
					document.getElementById("sim3grade7").value =getGrade(score);
				});
				$("#sim3score8").keyup(function(){
					var score = document.getElementById("sim3score8").value;
					document.getElementById("sim3grade8").value =getGrade(score);
				});
				$("#sim3score9").keyup(function(){
					var score = document.getElementById("sim3score9").value;
					document.getElementById("sim3grade9").value =getGrade(score);
				});
				$("#sim3score10").keyup(function(){
					var score = document.getElementById("sim3score10").value;
					document.getElementById("sim3grade10").value =getGrade(score);
				});
				$("#sim3score11").keyup(function(){
					var score = document.getElementById("sim3score11").value;
					document.getElementById("sim3grade11").value =getGrade(score);
				});
				$("#sim3score12").keyup(function(){
					var score = document.getElementById("sim3score12").value;
					document.getElementById("sim3grade12").value =getGrade(score);
				});
				$("#sim3score13").keyup(function(){
					var score = document.getElementById("sim3score13").value;
					document.getElementById("sim3grade13").value =getGrade(score);
				});
				$("#sim3score14").keyup(function(){
					var score = document.getElementById("sim3score14").value;
					document.getElementById("sim3grade14").value =getGrade(score);
				});
				$("#sim3score15").keyup(function(){
					var score = document.getElementById("sim3score15").value;
					document.getElementById("sim3grade15").value =getGrade(score);
				});
				$("#calcSim3GpBtn").on("tap",function(){
					//http://softwork.herokuapp.com/api/updatesim3Result/1234/hello
					var sim3result = new Object();
					for(i=1; i<=15; i++){
						sim3result["sim3ctt"+i]=document.getElementById("sim3ctt"+i).value;
						sim3result["sim3cc"+i]=document.getElementById("sim3cc"+i).value;
						sim3result["sim3cu"+i]=document.getElementById("sim3cu"+i).value;
						sim3result["sim3score"+i]=document.getElementById("sim3score"+i).value;
						sim3result["sim3grade"+i]=document.getElementById("sim3grade"+i).value;
					}
					sim3result=JSON.stringify(sim3result);
					//console.log(sim3result);
					//console.log(sim3result);
					$.ajax({
						url: "http://softwork.herokuapp.com/api/updateSim3Result/"+matricNumber+"/"+sim3result
					});
						var totalcu=0;
						var totalpoint=0;
						for(i=1; i<=15; i++){
							var cu = parseFloat(document.getElementById("sim3cu"+i).value);
							totalcu=totalcu+cu;
							var grade=document.getElementById("sim3grade"+i).value;
							point=parseFloat(getPoint(grade));
							point*=cu;
							totalpoint+=point;
						}
						var sim3GPA=totalpoint/totalcu;
						document.getElementById("sim3GPA").innerHTML=sim3GPA;
						document.getElementById("sim3GPAComment").innerHTML=getComment(sim3GPA);
						//console.log(sim3GPA);
						
						//var valu= $('#grade1').find(":selected").text()
						//console.log(valu);
				});
			});
				
			$(document).one("pagecreate","#sim4resultpage",function(){
				$("#sim4score1").keyup(function(){
					var score = document.getElementById("sim4score1").value;
					document.getElementById("sim4grade1").value =getGrade(score);
				});
				$("#sim4score2").keyup(function(){
					var score = document.getElementById("sim4score2").value;
					document.getElementById("sim4grade2").value =getGrade(score);
				});
				$("#sim4score3").keyup(function(){
					var score = document.getElementById("sim4score3").value;
					document.getElementById("sim4grade3").value =getGrade(score);
				});
				$("#sim4score4").keyup(function(){
					var score = document.getElementById("sim4score4").value;
					document.getElementById("sim4grade4").value =getGrade(score);
				});
				$("#sim4score5").keyup(function(){
					var score = document.getElementById("sim4score5").value;
					document.getElementById("sim4grade5").value =getGrade(score);
				});
				$("#sim4score6").keyup(function(){
					var score = document.getElementById("sim4score6").value;
					document.getElementById("sim4grade6").value =getGrade(score);
				});
				$("#sim4score7").keyup(function(){
					var score = document.getElementById("sim4score7").value;
					document.getElementById("sim4grade7").value =getGrade(score);
				});
				$("#sim4score8").keyup(function(){
					var score = document.getElementById("sim4score8").value;
					document.getElementById("sim4grade8").value =getGrade(score);
				});
				$("#sim4score9").keyup(function(){
					var score = document.getElementById("sim4score9").value;
					document.getElementById("sim4grade9").value =getGrade(score);
				});
				$("#sim4score10").keyup(function(){
					var score = document.getElementById("sim4score10").value;
					document.getElementById("sim4grade10").value =getGrade(score);
				});
				$("#sim4score11").keyup(function(){
					var score = document.getElementById("sim4score11").value;
					document.getElementById("sim4grade11").value =getGrade(score);
				});
				$("#sim4score12").keyup(function(){
					var score = document.getElementById("sim4score12").value;
					document.getElementById("sim4grade12").value =getGrade(score);
				});
				$("#sim4score13").keyup(function(){
					var score = document.getElementById("sim4score13").value;
					document.getElementById("sim4grade13").value =getGrade(score);
				});
				$("#sim4score14").keyup(function(){
					var score = document.getElementById("sim4score14").value;
					document.getElementById("sim4grade14").value =getGrade(score);
				});
				$("#sim4score15").keyup(function(){
					var score = document.getElementById("sim4score15").value;
					document.getElementById("sim4grade15").value =getGrade(score);
				});
				$("#calcSim4GpBtn").on("tap",function(){
					//http://softwork.herokuapp.com/api/updatesim4Result/1234/hello
					var sim4result = new Object();
					for(i=1; i<=15; i++){
						sim4result["sim4ctt"+i]=document.getElementById("sim4ctt"+i).value;
						sim4result["sim4cc"+i]=document.getElementById("sim4cc"+i).value;
						sim4result["sim4cu"+i]=document.getElementById("sim4cu"+i).value;
						sim4result["sim4score"+i]=document.getElementById("sim4score"+i).value;
						sim4result["sim4grade"+i]=document.getElementById("sim4grade"+i).value;
					}
					sim4result=JSON.stringify(sim4result);
					//console.log(sim4result);
					//console.log(sim4result);
					$.ajax({
						url: "http://softwork.herokuapp.com/api/updateSim4Result/"+matricNumber+"/"+sim4result
					});
						var totalcu=0;
						var totalpoint=0;
						for(i=1; i<=15; i++){
							var cu = parseFloat(document.getElementById("sim4cu"+i).value);
							totalcu=totalcu+cu;
							var grade=document.getElementById("sim4grade"+i).value;
							point=parseFloat(getPoint(grade));
							point*=cu;
							totalpoint+=point;
						}
						var sim4GPA=totalpoint/totalcu;
						document.getElementById("sim4GPA").innerHTML=sim4GPA;
						document.getElementById("sim4GPAComment").innerHTML=getComment(sim4GPA);
						//console.log(sim4GPA);
						
						//var valu= $('#grade1').find(":selected").text()
						//console.log(valu);
				});
			});
			$(document).one("pagecreate","#sim5resultpage",function(){
				$("#sim5score1").keyup(function(){
					var score = document.getElementById("sim5score1").value;
					document.getElementById("sim5grade1").value =getGrade(score);
				});
				$("#sim5score2").keyup(function(){
					var score = document.getElementById("sim5score2").value;
					document.getElementById("sim5grade2").value =getGrade(score);
				});
				$("#sim5score3").keyup(function(){
					var score = document.getElementById("sim5score3").value;
					document.getElementById("sim5grade3").value =getGrade(score);
				});
				$("#sim5score4").keyup(function(){
					var score = document.getElementById("sim5score4").value;
					document.getElementById("sim5grade4").value =getGrade(score);
				});
				$("#sim5score5").keyup(function(){
					var score = document.getElementById("sim5score5").value;
					document.getElementById("sim5grade5").value =getGrade(score);
				});
				$("#sim5score6").keyup(function(){
					var score = document.getElementById("sim5score6").value;
					document.getElementById("sim5grade6").value =getGrade(score);
				});
				$("#sim5score7").keyup(function(){
					var score = document.getElementById("sim5score7").value;
					document.getElementById("sim5grade7").value =getGrade(score);
				});
				$("#sim5score8").keyup(function(){
					var score = document.getElementById("sim5score8").value;
					document.getElementById("sim5grade8").value =getGrade(score);
				});
				$("#sim5score9").keyup(function(){
					var score = document.getElementById("sim5score9").value;
					document.getElementById("sim5grade9").value =getGrade(score);
				});
				$("#sim5score10").keyup(function(){
					var score = document.getElementById("sim5score10").value;
					document.getElementById("sim5grade10").value =getGrade(score);
				});
				$("#sim5score11").keyup(function(){
					var score = document.getElementById("sim5score11").value;
					document.getElementById("sim5grade11").value =getGrade(score);
				});
				$("#sim5score12").keyup(function(){
					var score = document.getElementById("sim5score12").value;
					document.getElementById("sim5grade12").value =getGrade(score);
				});
				$("#sim5score13").keyup(function(){
					var score = document.getElementById("sim5score13").value;
					document.getElementById("sim5grade13").value =getGrade(score);
				});
				$("#sim5score14").keyup(function(){
					var score = document.getElementById("sim5score14").value;
					document.getElementById("sim5grade14").value =getGrade(score);
				});
				$("#sim5score15").keyup(function(){
					var score = document.getElementById("sim5score15").value;
					document.getElementById("sim5grade15").value =getGrade(score);
				});
				$("#calcSim5GpBtn").on("tap",function(){
					//http://softwork.herokuapp.com/api/updatesim4Result/1234/hello
					var sim5result = new Object();
					for(i=1; i<=15; i++){
						sim5result["sim5ctt"+i]=document.getElementById("sim5ctt"+i).value;
						sim5result["sim5cc"+i]=document.getElementById("sim5cc"+i).value;
						sim5result["sim5cu"+i]=document.getElementById("sim5cu"+i).value;
						sim5result["sim5score"+i]=document.getElementById("sim5score"+i).value;
						sim5result["sim5grade"+i]=document.getElementById("sim5grade"+i).value;
					}
					sim5result=JSON.stringify(sim5result);
					//console.log(sim4result);
					//console.log(sim4result);
					$.ajax({
						url: "http://softwork.herokuapp.com/api/updateSim5Result/"+matricNumber+"/"+sim5result
					});
						var totalcu=0;
						var totalpoint=0;
						for(i=1; i<=15; i++){
							var cu = parseFloat(document.getElementById("sim5cu"+i).value);
							totalcu=totalcu+cu;
							var grade=document.getElementById("sim5grade"+i).value;
							point=parseFloat(getPoint(grade));
							point*=cu;
							totalpoint+=point;
						}
						var sim5GPA=totalpoint/totalcu;
						document.getElementById("sim5GPA").innerHTML=sim5GPA;
						document.getElementById("sim5GPAComment").innerHTML=getComment(sim5GPA);
						//console.log(sim5GPA);
						
						//var valu= $('#grade1').find(":selected").text()
						//console.log(valu);
				});
			}); 
			$(document).one("pagecreate","#sim6resultpage",function(){
				$("#sim6score1").keyup(function(){
					var score = document.getElementById("sim6score1").value;
					document.getElementById("sim6grade1").value =getGrade(score);
				});
				$("#sim6score2").keyup(function(){
					var score = document.getElementById("sim6score2").value;
					document.getElementById("sim6grade2").value =getGrade(score);
				});
				$("#sim6score3").keyup(function(){
					var score = document.getElementById("sim6score3").value;
					document.getElementById("sim6grade3").value =getGrade(score);
				});
				$("#sim6score4").keyup(function(){
					var score = document.getElementById("sim6score4").value;
					document.getElementById("sim6grade4").value =getGrade(score);
				});
				$("#sim6score5").keyup(function(){
					var score = document.getElementById("sim6score5").value;
					document.getElementById("sim6grade5").value =getGrade(score);
				});
				$("#sim6score6").keyup(function(){
					var score = document.getElementById("sim6score6").value;
					document.getElementById("sim6grade6").value =getGrade(score);
				});
				$("#sim6score7").keyup(function(){
					var score = document.getElementById("sim6score7").value;
					document.getElementById("sim6grade7").value =getGrade(score);
				});
				$("#sim6score8").keyup(function(){
					var score = document.getElementById("sim6score8").value;
					document.getElementById("sim6grade8").value =getGrade(score);
				});
				$("#sim6score9").keyup(function(){
					var score = document.getElementById("sim6score9").value;
					document.getElementById("sim6grade9").value =getGrade(score);
				});
				$("#sim6score10").keyup(function(){
					var score = document.getElementById("sim6score10").value;
					document.getElementById("sim6grade10").value =getGrade(score);
				});
				$("#sim6score11").keyup(function(){
					var score = document.getElementById("sim6score11").value;
					document.getElementById("sim6grade11").value =getGrade(score);
				});
				$("#sim6score12").keyup(function(){
					var score = document.getElementById("sim6score12").value;
					document.getElementById("sim6grade12").value =getGrade(score);
				});
				$("#sim6score13").keyup(function(){
					var score = document.getElementById("sim6score13").value;
					document.getElementById("sim6grade13").value =getGrade(score);
				});
				$("#sim6score14").keyup(function(){
					var score = document.getElementById("sim6score14").value;
					document.getElementById("sim6grade14").value =getGrade(score);
				});
				$("#sim6score15").keyup(function(){
					var score = document.getElementById("sim6score15").value;
					document.getElementById("sim6grade15").value =getGrade(score);
				});
				$("#calcSim6GpBtn").on("tap",function(){
					//http://softwork.herokuapp.com/api/updatesim4Result/1234/hello
					var sim6result = new Object();
					for(i=1; i<=15; i++){
						sim6result["sim6ctt"+i]=document.getElementById("sim6ctt"+i).value;
						sim6result["sim6cc"+i]=document.getElementById("sim6cc"+i).value;
						sim6result["sim6cu"+i]=document.getElementById("sim6cu"+i).value;
						sim6result["sim6score"+i]=document.getElementById("sim6score"+i).value;
						sim6result["sim6grade"+i]=document.getElementById("sim6grade"+i).value;
					}
					sim6result=JSON.stringify(sim6result);
					//console.log(sim4result);
					//console.log(sim4result);
					$.ajax({
						url: "http://softwork.herokuapp.com/api/updateSim6Result/"+matricNumber+"/"+sim6result
					});
						var totalcu=0;
						var totalpoint=0;
						for(i=1; i<=15; i++){
							var cu = parseFloat(document.getElementById("sim6cu"+i).value);
							totalcu=totalcu+cu;
							var grade=document.getElementById("sim6grade"+i).value;
							point=parseFloat(getPoint(grade));
							point*=cu;
							totalpoint+=point;
						}
						var sim6GPA=totalpoint/totalcu;
						document.getElementById("sim6GPA").innerHTML=sim6GPA;
						document.getElementById("sim6GPAComment").innerHTML=getComment(sim6GPA);
						//console.log(sim5GPA);
						
						//var valu= $('#grade1').find(":selected").text()
						//console.log(valu);
				}); 
			}); 
				
				
				///////////////////CGPA CALC//////////////////////
				$("#checkCGPA").on("tap",function(){
						var totalsim1cu=0;
						var totalsim1point=0;
						for(i=1; i<=15; i++){
							var cu = parseFloat(document.getElementById("sim1cu"+i).value);
							totalsim1cu=totalsim1cu+cu;
							var grade=document.getElementById("sim1grade"+i).value;
							point=parseFloat(getPoint(grade));
							point*=cu;
							totalsim1point+=point;
						}
						var totalsim2cu=0;
						var totalsim2point=0;
						for(i=1; i<=15; i++){
							var cu = parseFloat(document.getElementById("sim2cu"+i).value);
							totalsim2cu=totalsim2cu+cu;
							var grade=document.getElementById("sim2grade"+i).value;
							point=parseFloat(getPoint(grade));
							point*=cu;
							totalsim2point+=point;
						}
						var totalsim3cu=0;
						var totalsim3point=0;
						for(i=1; i<=15; i++){
							var cu = parseFloat(document.getElementById("sim3cu"+i).value);
							totalsim3cu=totalsim3cu+cu;
							var grade=document.getElementById("sim3grade"+i).value;
							point=parseFloat(getPoint(grade));
							point*=cu;
							totalsim3point+=point;
						}
						var totalsim4cu=0;
						var totalsim4point=0;
						for(i=1; i<=15; i++){
							var cu = parseFloat(document.getElementById("sim4cu"+i).value);
							totalsim4cu=totalsim4cu+cu;
							var grade=document.getElementById("sim4grade"+i).value;
							point=parseFloat(getPoint(grade));
							point*=cu;
							totalsim4point+=point;
						}
						var totalsim5cu=0;
						var totalsim5point=0;
						for(i=1; i<=15; i++){
							var cu = parseFloat(document.getElementById("sim5cu"+i).value);
							totalsim5cu=totalsim5cu+cu;
							var grade=document.getElementById("sim5grade"+i).value;
							point=parseFloat(getPoint(grade));
							point*=cu;
							totalsim5point+=point;
						}
						var totalsim6cu=0;
						var totalsim6point=0;
						for(i=1; i<=15; i++){
							var cu = parseFloat(document.getElementById("sim6cu"+i).value);
							totalsim6cu=totalsim6cu+cu;
							var grade=document.getElementById("sim6grade"+i).value;
							point=parseFloat(getPoint(grade));
							point*=cu;
							totalsim6point+=point;
						}
						var totalcu= totalsim1cu + totalsim2cu + totalsim3cu + totalsim4cu + totalsim5cu + totalsim6cu;
						var totalpoint = totalsim1point + totalsim2point + totalsim3point + totalsim4point + totalsim5point + totalsim6point;
						var cgpa =totalpoint/totalcu;
						console.log(totalpoint);
						console.log(totalcu);
						document.getElementById("CGPA").innerHTML=cgpa
						document.getElementById("CGPAComment").innerHTML=getComment(cgpa);
				});
			