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


//option datepicker

$.datepicker.regional['fr'] = {clearText: 'Effacer', clearStatus: '',
    closeText: 'Fermer', closeStatus: 'Fermer sans modifier',
    prevText: '<Préc', prevStatus: 'Voir le mois précédent',
    nextText: 'Suiv>', nextStatus: 'Voir le mois suivant',
    currentText: 'Courant', currentStatus: 'Voir le mois courant',
    monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
    'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
    monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
    'Jul','Aoû','Sep','Oct','Nov','Déc'],
    monthStatus: 'Voir un autre mois', yearStatus: 'Voir une autre année',
    weekHeader: 'Sem', weekStatus: '',
    dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
    dayNamesMin: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
    
    dayStatus: 'Utiliser DD comme premier jour de la semaine', dateStatus: 'Choisir le DD, MM d',
    dateFormat: 'dd/mm/yy', firstDay: 0, 
    initStatus: 'Choisir la date', isRTL: false};
 $.datepicker.setDefaults($.datepicker.regional['fr']);

$(function() {
    $( "#dtPick1" ).datepicker();
    $( "#dtPick2" ).datepicker();
});



$("#newTask").click(function() 
    {


    }


