<?php

header("Content-Type: text/plain; charset=UTF-8", true);

require_once("../classes/Acao.class.php");
require_once("../classes/Formulario.class.php");
require_once("../classes/Ping.class.php");
require_once("../classes/Reclamacao.class.php");
require_once("../classes/Resolvido.class.php");
require_once("../classes/banco.class.php");
require_once("../classes/base.class.php");

extract($_POST);
if ($_POST['acao'] == 'consulta') {

    $sql = "select  f.perfil as 'perfil', f.operador as 'operador', f.login as 'login', f.ip as 'ip', f.datahora as 'datahora', f.terminal as 'terminal', r.tipo as 'relcamacao', f.evento_reparo as 'evento_reparo', f.alinhado_cci as alinhado_cci, f.parametro_cci as 'parametro_cci', f.csc_funcionando as 'csc_funcionando', f.listado_csc as 'listado_csc', f.alinhado_csc as 'alinhado_csc', f.modelo_diferente as 'modelo_diferente', f.dispositivos_conectados as 'dispositivos_conectados', f.id_ping as 'ping', f.acao as 'acao', f.id_resolvido as 'resolvido', f.obs as obs 
from formulario f, reclamacao r 
where SUBSTR(f.datahora,1,10) BETWEEN '" . $_POST['de'] . "' AND '" . $_POST['ate'] . "'
and f.id_ping is null 
and f.acao is null 
and f.id_resolvido is null 
and f.id_reclamacao = r.id
union 
select  f.perfil as 'perfil', f.operador as 'operador', f.login as 'login', f.ip as 'ip', f.datahora as 'datahora', f.terminal as 'terminal', r.tipo as 'relcamacao', f.evento_reparo as 'evento_reparo', f.alinhado_cci as 'alinhado_cci', f.parametro_cci as 'parametro_cci', f.csc_funcionando as 'csc_funcionando', f.listado_csc as 'listado_csc', f.alinhado_csc as 'alinhado_csc', f.modelo_diferente as 'modelo_diferente', f.dispositivos_conectados as 'dispositivos_conectados', f.id_ping as 'ping', f.acao as 'acao', re.texto as 'texto', f.obs as 'obs' 
from formulario f, reclamacao r, resolvido re 
where SUBSTR(f.datahora,1,10) BETWEEN '" . $_POST['de'] . "' AND '" . $_POST['ate'] . "'
and f.id_ping is null 
and f.id_reclamacao = r.id
and f.id_resolvido = re.id 
union 
select f.perfil as 'perfil', f.operador as 'operador', f.login as 'login', f.ip as 'ip', f.datahora as 'datahora',  f.terminal as 'terminal', r.tipo as 'relcamacao', f.evento_reparo as 'evento_reparo', f.alinhado_cci as 'alinhado_cci', f.parametro_cci as 'parametro_cci', f.csc_funcionando as 'csc_funcionando', f.listado_csc as 'listado_csc', f.alinhado_csc as 'alinhado_csc', f.modelo_diferente as 'modelo_diferente', f.dispositivos_conectados as 'dispositivos_conectados', p.texto as 'ping', f.acao as 'acao', re.texto as 'texto', f.obs as 'obs' 
from formulario f, ping p, reclamacao r, resolvido re
where f.id_ping is not null 
and f.id_reclamacao = r.id
and f.id_ping = p.id
and f.id_resolvido = re.id 
and SUBSTR(f.datahora,1,10) BETWEEN '" . $_POST['de'] . "' AND '" . $_POST['ate'] . "'
order by datahora";
    $form = new Formulario();
    $form->executaSQL($sql);

    $file = fopen("../relatorio/relatorio.csv", "w+");
    header('Content-Encoding: UTF-8');
    header('Content-type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="relatorio.csv"');
    fputs($file, "Perfil;Operador;ip;Data Hora;Terminal;Reclamação;Evento Reparo;Alinhado cci;Parametro cci;csc Funcionando;Listado csc;Alinhado csc;Modelo Diferente;Dispositivos Conectados;Ping;Ação;Resolvido;Obsevação\n");

    while ($f = $form->retornaDados()) {
        fputs($file, "$f->perfil;$f->operador;$f->ip;$f->datahora;$f->terminal;$f->relcamacao;$f->evento_reparo;$f->alinhado_cci;$f->parametro_cci;$f->csc_funcionando;$f->listado_csc;$f->alinhado_csc;$f->modelo_diferente;$f->dispositivos_conectados;$f->ping;$f->acao;$f->resolvido;$f->obs\n");
    }
    fclose($file);
} 