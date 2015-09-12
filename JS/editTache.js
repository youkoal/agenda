var url='http://127.0.0.1/exos_php/exos/agenda/acc.php';

$(document).ready(function(){
    initData(); //donnee clients
    });

var dataTab;
var id;
function initData(){
    $.ajax({ 
        type: 'GET', 
        url: url, 
        data: { 'get_param' : 'tache'}, 
        dataType: 'json',
        success: function(data) { 
            dataTab=data;
            initTache(data);
        }
    });
}


function initTache(d){
    document.getElementById("tId").value=d['id'];
    document.getElementById("date").value =d["dateE"];
    document.getElementById("titre").value=d["titre"];
    document.getElementById("texte").value =d["texte"];
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
    $( "#date" ).datepicker();
});


