<?php
include_once('form_empresas_despesa_mob_session.php');
@session_start() ;
class form_empresas_despesa_mob_help
{
    function __construct()
    {
        global $language, $nm_cod_campo;
        ini_set('default_charset', $_SESSION['scriptcase']['charset']);
        include($language . ".lang.php");
        if (!function_exists("NM_is_utf8"))
        {
             include_once("../_lib/lib/php/nm_utf8.php");
        }
        if (isset($_GET['help_css'])) {
            $cssHelp = $_GET['help_css'];
            $cssHelpDir = str_replace(".css", $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css", $_GET['help_css']);
        } else {
            $cssHelp = $_SESSION['scriptcase']['css_form_help'];
            $cssHelpDir = $_SESSION['scriptcase']['css_form_help_dir'];
        }
        foreach ($this->Nm_lang as $ind => $dados)
        {
           if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($ind))
           {
               $ind = sc_convert_encoding($ind, $_SESSION['scriptcase']['charset'], "UTF-8");
               $this->Nm_lang[$ind] = $dados;
           }
           if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
           {
               $this->Nm_lang[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
           }
           $this->Nm_lang[$ind] = str_replace('"', '&quot;',  $this->Nm_lang[$ind]);
        }
        if ($nm_cod_campo ==  "despesa_custo_id")
        {
?>
<!DOCTYPE html>

<html>
<head>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

    if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
    {
?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
    }

?>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <link rel="stylesheet" href="<?php echo $cssHelp ?>" type="text/css" media="screen" />
 <link rel="stylesheet" href="<?php echo $cssHelpDir ?>" type="text/css" media="screen" />
</head>
<body class="scFormHelpPage">
<?php echo "<b>Despesa Custo </b><br>" . nl2br("Despesa que será utilizada para gerar o valor do percentual que será incluso no custo.
"); ?>
</body>
</html>
<?php
        }
        if ($nm_cod_campo ==  "percentual_custo")
        {
?>
<!DOCTYPE html>

<html>
<head>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

    if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
    {
?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
    }

?>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <link rel="stylesheet" href="<?php echo $cssHelp ?>" type="text/css" media="screen" />
 <link rel="stylesheet" href="<?php echo $cssHelpDir ?>" type="text/css" media="screen" />
</head>
<body class="scFormHelpPage">
<?php echo "<b>% Custo</b><br>" . nl2br("Percentual que será somado aos custos do item."); ?>
</body>
</html>
<?php
        }
        if ($nm_cod_campo ==  "impostos")
        {
?>
<!DOCTYPE html>

<html>
<head>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

    if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
    {
?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
    }

?>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <link rel="stylesheet" href="<?php echo $cssHelp ?>" type="text/css" media="screen" />
 <link rel="stylesheet" href="<?php echo $cssHelpDir ?>" type="text/css" media="screen" />
</head>
<body class="scFormHelpPage">
<?php echo "<b>Impostos</b><br>" . nl2br("Informe os Impostos que utilizam a despesa/Imposto corrente para calculo."); ?>
</body>
</html>
<?php
        }
    }
}
if (!empty($_GET))
{
    foreach ($_GET as $nmgp_var => $nmgp_val)
    {
        $$nmgp_var = $nmgp_val;
    }
}
$exec_help = new form_empresas_despesa_mob_help();
?>
