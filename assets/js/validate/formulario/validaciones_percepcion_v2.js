function valid_field_autoriza() 
{
    if(document.getElementById('autoriza1').checked || document.getElementById('autoriza2').checked ){
        document.getElementById('hdd_autoriza').value = 1;
    }else{
        document.getElementById('hdd_autoriza').value = "";
    }
}

function valid_calificacion_1() 
{
    if(document.getElementById('calificacion_1_1').checked || document.getElementById('calificacion_1_2').checked || document.getElementById('calificacion_1_3').checked || document.getElementById('calificacion_1_4').checked || document.getElementById('calificacion_1_5').checked ){
        document.getElementById('hdd_calificacion_1').value = 1;
    }else{
        document.getElementById('hdd_calificacion_1').value = "";
    }

    if(document.getElementById('calificacion_1_1').checked){
        $("#div_grado_satisfaccion").css("display", "none");
        document.getElementById('hdd_calificacion_1').value = 99;
    }else{
        $("#div_grado_satisfaccion").css("display", "inline");
    }
}

function valid_calificacion_2() 
{
    if(document.getElementById('calificacion_2_1').checked || document.getElementById('calificacion_2_2').checked || document.getElementById('calificacion_2_3').checked || document.getElementById('calificacion_2_4').checked || document.getElementById('calificacion_2_5').checked ){
        document.getElementById('hdd_calificacion_2').value = 1;
    }else{
        document.getElementById('hdd_calificacion_2').value = "";
    }
}

function valid_calificacion_3() 
{
    if(document.getElementById('calificacion_3_1').checked || document.getElementById('calificacion_3_2').checked || document.getElementById('calificacion_3_3').checked || document.getElementById('calificacion_3_4').checked || document.getElementById('calificacion_3_5').checked ){
        document.getElementById('hdd_calificacion_3').value = 1;
    }else{
        document.getElementById('hdd_calificacion_3').value = "";
    }
}

function valid_calificacion_4() 
{
    if(document.getElementById('calificacion_4_1').checked || document.getElementById('calificacion_4_2').checked || document.getElementById('calificacion_4_3').checked || document.getElementById('calificacion_4_4').checked || document.getElementById('calificacion_4_5').checked ){
        document.getElementById('hdd_calificacion_4').value = 1;
    }else{
        document.getElementById('hdd_calificacion_4').value = "";
    }
}

function valid_calificacion_5() 
{
    if(document.getElementById('calificacion_5_1').checked || document.getElementById('calificacion_5_2').checked || document.getElementById('calificacion_5_3').checked || document.getElementById('calificacion_5_4').checked ){
        document.getElementById('hdd_calificacion_5').value = 1;
    }else{
        document.getElementById('hdd_calificacion_5').value = "";
    }
}

function valid_calificacion_6() 
{
    if(document.getElementById('calificacion_6_1').checked || document.getElementById('calificacion_6_2').checked || document.getElementById('calificacion_6_3').checked || document.getElementById('calificacion_6_4').checked ){
        document.getElementById('hdd_calificacion_6').value = 1;
    }else{
        document.getElementById('hdd_calificacion_6').value = "";
    }
}

function valid_calificacion_7() 
{
    if(document.getElementById('calificacion_7_1').checked || document.getElementById('calificacion_7_2').checked || document.getElementById('calificacion_7_3').checked || document.getElementById('calificacion_7_4').checked ){
        document.getElementById('hdd_calificacion_7').value = 1;
    }else{
        document.getElementById('hdd_calificacion_7').value = "";
    }
}

function valid_calificacion_8() 
{
    if(document.getElementById('calificacion_8_1').checked || document.getElementById('calificacion_8_2').checked || document.getElementById('calificacion_8_3').checked || document.getElementById('calificacion_8_4').checked ){
        document.getElementById('hdd_calificacion_8').value = 1;
    }else{
        document.getElementById('hdd_calificacion_8').value = "";
    }
}

function valid_calificacion_9() 
{
    if(document.getElementById('calificacion_9_1').checked || document.getElementById('calificacion_9_2').checked || document.getElementById('calificacion_9_3').checked || document.getElementById('calificacion_9_4').checked || document.getElementById('calificacion_9_5').checked ){
        document.getElementById('hdd_calificacion_9').value = 1;
    }else{
        document.getElementById('hdd_calificacion_9').value = "";
    }
}

function valid_calificacion_10() 
{
    if(document.getElementById('calificacion_10_1').checked || document.getElementById('calificacion_10_2').checked || document.getElementById('calificacion_10_3').checked || document.getElementById('calificacion_10_4').checked || document.getElementById('calificacion_10_5').checked ){
        document.getElementById('hdd_calificacion_10').value = 1;
    }else{
        document.getElementById('hdd_calificacion_10').value = "";
    }
}

function valid_calificacion_11() 
{
    if(document.getElementById('calificacion_11_1').checked || document.getElementById('calificacion_11_2').checked || document.getElementById('calificacion_11_3').checked || document.getElementById('calificacion_11_4').checked || document.getElementById('calificacion_11_5').checked ){
        document.getElementById('hdd_calificacion_11').value = 1;
    }else{
        document.getElementById('hdd_calificacion_11').value = "";
    }
}

function valid_calificacion_12() 
{
    if(document.getElementById('calificacion_12_1').checked || document.getElementById('calificacion_12_2').checked || document.getElementById('calificacion_12_3').checked || document.getElementById('calificacion_12_4').checked || document.getElementById('calificacion_12_5').checked ){
        document.getElementById('hdd_calificacion_12').value = 1;
    }else{
        document.getElementById('hdd_calificacion_12').value = "";
    }
}

function valid_calificacion_13() 
{
    if(document.getElementById('calificacion_13_1').checked || document.getElementById('calificacion_13_2').checked || document.getElementById('calificacion_13_3').checked || document.getElementById('calificacion_13_4').checked || document.getElementById('calificacion_13_5').checked ){
        document.getElementById('hdd_calificacion_13').value = 1;
    }else{
        document.getElementById('hdd_calificacion_13').value = "";
    }
}