<?php
require_once("../../web/classes/Validacao.class.php");
$s = new Validacao();
$s->verifica(12000);
echo "<input type='hidden' id='SESSION_UsuarioID' value='" . $_SESSION['UsuarioID'] . "'>";
echo "<input type='hidden' id='SESSION_UsuarioLogin' value='" . $_SESSION['UsuarioLogin'] . "'>";
echo "<input type='hidden' id='SESSION_UsuarioNome' value='" . $_SESSION['UsuarioNome'] . "'>";
echo "<input type='hidden' id='SESSION_UsuarioPerfil' value='" . $_SESSION['UsuarioPerfil'] . "'>";
echo "<input type='hidden' id='SESSION_UsuarioIP' value='" . $_SESSION['IP'] . "'>";

//echo $_SESSION['UsuarioNome'];
?>

<script src="../app/contax_relatorio/js/contax.js"></script>
<div id="container_contax" class="text-center">
    <div class='row'>
        <div class='col-xs-3'></div>
        <div class='col-xs-6'>
            <div class='input-group'>
                <!--<span class='input-group-addon'>Data</span><input type='text' class='form-control input-lg' id='datepicker'>-->
                <span class='input-group-addon'>De</span>
                <input type='text' class='form-control input-lg' id="from" name="from">
                <span class='input-group-addon'>Até</span>
                <input type='text' class='form-control input-lg' id="to" name="to">
            </div>   
        </div>
        <div class='col-xs-3'></div>
    </div>
    <div class='row' style="padding-top: 30px">
        <div class='col-xs-12'><input type="button" class="btn btn-default" style="width: 35px; height: 35px; background-image: url(../web/img/CSV32x32.png);"id='gerar'></div>
    </div>
</div>

