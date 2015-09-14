var url='http://127.0.0.1/exos_php/exos/agenda/acc.php';
var mois = ['Janvier','Février','Mars','Avril','Mai','Juin',
    'Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
$(document).ready(function(){
    initData(); //donnee clients
    getMin();   //donnee taches min
    });

var dataTab;
var dataTabMin;
var dataDates=[];
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
            dataTabMin=data;
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

        tache.appendChild(document.createTextNode(dateSwap(d[i]['dateE'])));
        tache.appendChild(document.createElement("br"));
        tache.appendChild(document.createTextNode(d[i]['titre']));

        dataDates.push(d[i]['dateE']);//recup de la date et de son indice pour plus tard
        
        tache.onclick = function(){
            getBig(this.value);
        };
        theDiv.appendChild(tache);

    }
}

function destroyMin(){
    var myNode = document.getElementById("minTaches");
    while (myNode.firstChild) {
    myNode.removeChild(myNode.firstChild);
}
}
function buildMinFT(dF,dT){
    var f=0;
    var t=0;
    var iF=0;
    var iT=dataDates.length;
    var d=dataTabMin;

    dF=FRtoUS(dF);//on compare en utilisant le format US des dates
    dT=FRtoUS(dT);

    if (!(dF)){dF=0};//si on a entré aucune date, on prend 0 <==> false
    if (!(dT)){dT=0};

    if (dF<dT && !(dT==0))
        {f=dF;t=dT;}//2dates entrée ou juste la date de début
    else      
        {f=dT;f=dF;}

    if ( f ) //si on à donné une date
    {
        for(var i=0;i<dataDates.length;i++)
        {
            if(dataDates[i]>=f){iF=i;i=dataDates.length+1;}
        }
    }

    if ( t ) //si on à donné une date
    {
        for(var i=dataDates.length-1;i>(-1);i--)
        {
            if(dataDates[i]<= t){iT=i;i=(-2);}
        }
    }

    console.log('from '+iF);
    console.log('to '+iT);

    for(var i=iF;i<iT+1;i++)
    {
        if (!(d[i])){break;}
        var theDiv      = document.getElementById("minTaches");
        var tache       = document.createElement("div");
        tache.className = "mini";
        tache.value     =d[i]['id'];

        tache.appendChild(document.createTextNode(dateSwap(d[i]['dateE'])));
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
    document.getElementById("BTdade").innerHTML   = dateSwap(d['dateE']);
    document.getElementById("BTEdate").innerHTML  = d['dateEntree'];
    document.getElementById("BTtitre").innerHTML  = d['titre'];
    document.getElementById("txtTache").innerHTML = d['texte'];
    }


function dateSwap(d){
    var y=d.substring(0,4);
    var m=parseInt(d.substring(5,7));
    var d=d.substring(8,10);

    var comp= d+' '+mois[m-1]+' '+y;
    return comp;
}

function FRtoUS(d){
    var j=d.substring(0,2);
    var m=d.substring(3,5);
    var a=d.substring(6,10);

    var comp= a+'-'+m+'-'+j;
    return comp;
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

        return;
    });


$("#delTask").click(function() 
    {
        var mess= "vous etes sur le point de supprimer la tache :\n";
        mess += $("#BTtitre").text();
        var answer = confirm (mess);
        if (answer)
        {
            //alert ("suppression en cours.");
            $.ajax({ 
                type: 'POST', 
                url: url, 
                data: { 'delTask' :'ok', 'id' : document.getElementById("bigTaches").value}, 
                dataType: 'text',
                success: function(data) { 
                    console.log(data);
                    window.location.replace(url);//actualise la page
                }
            });
            
        }
        else
        alert ("opération annuler")
    });

$('#editTask').click(function() 
    {
        $.ajax({ 
            type: 'POST', 
            url: url, 
            data: { 'editerTache' :'ok', 'id' : document.getElementById("bigTaches").value}, 
            dataType: 'text',
            success: function(data) { 
                console.log(data);
                window.location.replace(url+"?ed");
            }
        });
    });

$('#gobutton').click(function() 
    {
        destroyMin();
        buildMinFT($('#dtPick1').val(),$('#dtPick2').val());

    });