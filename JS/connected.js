var url='http://127.0.0.1/exos_php/exos/agenda/acc.php';

$(document).ready(function(){initData();});
var dataTab;
function initData(){
	$.ajax({ 
        type: 'GET', 
        url: url, 
        data: { 'get_param' : 'users' }, 
        dataType: 'json',
        success: function(data) { 
        	console.log(data);
        	console.log(data[0]);
        	console.log(data[1]);
        	dataTab=data;
            initPerso(data[0]);
            initOther(data[1]);
        }
    });
}


function initPerso(d){
	document.getElementById("nomPerso").innerHTML =d["nomPerso"];
	document.getElementById("mailPerso").innerHTML=d["mailPerso"];
	document.getElementById("telPerso").innerHTML =d["telPerso"];
	document.getElementById("tel2Perso").innerHTML=d["tel2Perso"];
}

function initOther(d){
	for(var i=0;i<d.length;i++)
	{
		var theDiv = document.getElementById("members");
		var content = document.createTextNode(d[i]);
		theDiv.appendChild(content);
		theDiv.appendChild(document.createElement("br"));
	}

}	

