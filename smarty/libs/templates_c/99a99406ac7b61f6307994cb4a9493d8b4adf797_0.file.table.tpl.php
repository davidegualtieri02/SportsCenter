<?php
/* Smarty version 4.3.2, created on 2024-04-29 11:29:28
  from '/Users/cicerone/public_html/smarty-esercitazione/View/smarty/templates/table.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_662f6878154fa6_96391954',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '99a99406ac7b61f6307994cb4a9493d8b4adf797' => 
    array (
      0 => '/Users/cicerone/public_html/smarty-esercitazione/View/smarty/templates/table.tpl',
      1 => 1621413718,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_662f6878154fa6_96391954 (Smarty_Internal_Template $_smarty_tpl) {
?><html> 
<body> 
<h2> Codice dei comuni  </h2>

<br>

<b>Risultati in forma di Table:</b> <br>

<table cellpadding=1 cellspacing=0 border=0 width=60<?php echo '%>'; ?>

<?php
$__section_nr_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['results']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_nr_0_total = $__section_nr_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_nr'] = new Smarty_Variable(array());
if ($__section_nr_0_total !== 0) {
for ($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['iteration'] = 1, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] = 0; $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['iteration'] <= $__section_nr_0_total; $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['iteration']++, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']++){
?> 
    <tr <?php if ((1 & (isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['iteration'] : null))) {?> bgcolor="#ccc" <?php }?>>
        <td> 
             <?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['iteration'] : null);?>

	</td>
	<td>
             <?php echo $_smarty_tpl->tpl_vars['results']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getCodice();?>

	</td>
        <td> 
             <?php echo $_smarty_tpl->tpl_vars['results']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getComune();?>

	</td>
        <td> 
             <?php echo $_smarty_tpl->tpl_vars['results']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]->getProvincia();?>

	</td> 
    </tr> 
 
<?php }} else {
 ?> 
   <tr>
        <td align="center">
	    <b> nessun risultato </b>
	<td>
   </tr>
<?php
}
?> 
     
</table>
 
</body> 
</html> <?php }
}
