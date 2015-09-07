var url='http://127.0.0.1/exos_php/exos/agenda/acc.php';

$(document).ready(function(){initData();});
var dataTab;
function initData(){
	$.ajax({ 
        type: 'GET', 
        url: url, 
        data: { 'get_param' : 'editPerso' }, 
        dataType: 'json',
        success: function(data) { 
        	console.log(data);
            initPerso(data);
        }
    });
}


function initPerso(d){
	$("#nomPerso").val ( d["nomPerso"]  );
	$("#mailPerso").val( d["mailPerso"] );
	$("#telPerso").val ( d["telPerso"]  );
	$("#tel2Perso").val( d["tel2Perso"] );
}

	

