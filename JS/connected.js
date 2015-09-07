var url='http://127.0.0.1/exos_php/exos/agenda/acc.php';

$(document).ready(function(){
    initData(); //donnee clients
    getMin();   //donnee taches min
    });

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

function getMin(){
    $.ajax({ 
        type: 'GET', 
        url: url, 
        data: { 'get_param' : 'minTaches' }, 
        dataType: 'json',
        success: function(data) { 
            console.log(data);
            buildMin(data);
        }
    });
}


function buildMin(d){
    for(var i=0;i<d.length;i++)
    {
        var theDiv      = document.getElementById("minTaches");
        var tache       = document.createElement("div");
        tache.className = "mini";
        tache.value     =d[i]['id'];

        tache.appendChild(document.createTextNode(d[i]['dateE']));
        tache.appendChild(document.createElement("br"));
        tache.appendChild(document.createTextNode(d[i]['titre']));
        
        tache.onclick = function(){
            console.log(this.value);
            getBig(this.value);
        };
        theDiv.appendChild(tache);

    }
}

function getBig(id){
    $.ajax({ 
        type: 'GET', 
        url: url, 
        data: { 'get_param' : 'bigTaches' , 'idTask' : id}, 
        dataType: 'json',
        success: function(data) { 
            console.log(data);
            buildBig(data);
        }
    });
}

function buildBig(d){
    document.getElementById("bigTaches").value    = d['id'];
    document.getElementById("BTdade").innerHTML   = d['dateE'];
    document.getElementById("BTEdate").innerHTML  = d['dateEntree'];
    document.getElementById("BTtitre").innerHTML  = d['titre'];
    document.getElementById("txtTache").innerHTML = d['texte'];



    }


