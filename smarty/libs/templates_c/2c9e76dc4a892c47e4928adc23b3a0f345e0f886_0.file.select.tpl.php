<?php
/* Smarty version 4.3.2, created on 2024-04-29 11:40:23
  from '/Users/cicerone/public_html/smarty-esercitazione/View/smarty/templates/select.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_662f6b070104b5_78481813',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2c9e76dc4a892c47e4928adc23b3a0f345e0f886' => 
    array (
      0 => '/Users/cicerone/public_html/smarty-esercitazione/View/smarty/templates/select.tpl',
      1 => 1589124076,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_662f6b070104b5_78481813 (Smarty_Internal_Template $_smarty_tpl) {
?><html> 
<body> 
<h2> Codice dei comuni della provincia dell'Aquila </h2>

<br> 
 
<b>Risultati in forma di Select: </b> <br>

<select name="mys">
    <?php
$__section_nr_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['results']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_nr_0_total = $__section_nr_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_nr'] = new Smarty_Variable(array());
if ($__section_nr_0_total !== 0) {
for ($__section_nr_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] = 0; $__section_nr_0_iteration <= $__section_nr_0_total; $__section_nr_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']++){
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['results']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getCodice();?>
">
                   <?php echo $_smarty_tpl->tpl_vars['results']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getComune();?>
 | <?php echo $_smarty_tpl->tpl_vars['results']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getProvincia();?>

        </option>
    <?php
}
}
?>
</select>
 
</body> 
</html> <?php }
}
