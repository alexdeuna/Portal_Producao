$(document).ready(function() {
    $login = $("#SESSION_UsuarioLogin").val();
    $operador = $("#SESSION_UsuarioNome").val();
    $perfil = $("#SESSION_UsuarioPerfil").val();
    $ip = $("#SESSION_UsuarioIP").val();
    $('form').bind("keypress", function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    });
//    $("#datepicker").datepicker();
//    $("#datepicker").datepicker("option", "dateFormat", "yy-mm-dd");
//    $("#datepicker").on('change', function() {
//        $.ajax({
//            type: "POST",
//            url: "../app/contax_relatorio/controle/controle.php",
//            data: {acao: "consulta", data: $("#datepicker").val()},
//            beforeSend: function() {
//            },
//            error: function(data) {
//                alert("Erro ao carregar consulta");
//            },
//            success: function(data, textStatus, jqXHR) {
//                $("#container_contax").append(data);
//            }
//        });
//    });
    $("#gerar").hide();
    $("#from").datepicker({
        dateFormat: 'yy-mm-dd',
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        onClose: function(selectedDate) {
            $("#to").datepicker("option", "minDate", selectedDate);
            if (($("#from").val()) && ($("#to").val())) {
                $("#gerar").show();
            } else {
                $("#gerar").hide();
            }
        }
    });
    $("#to").datepicker({
        dateFormat: 'yy-mm-dd',
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        onClose: function(selectedDate) {
            $("#from").datepicker("option", "maxDate", selectedDate);
            if (($("#from").val()) && ($("#to").val())) {
                $("#gerar").show();
            } else {
                $("#gerar").hide();
            }
        }
    });

    $("#gerar").on('click', function() {
        $.ajax({
            type: "POST",
            url: "../app/contax_relatorio/controle/controle.php",
            data: {acao: "consulta", de: $("#from").val(), ate: $("#to").val()},
            beforeSend: function() {
            },
            error: function(data) {
//              alert("Erro ao carregar consulta".data );
                $("#container_contax").append("ERRO");
            },
            success: function(data, textStatus, jqXHR) {
//                $("#container_contax").append(data);
                window.location.href = "../app/contax_relatorio/relatorio/relatorio.csv";
            }
        });
    });
});