<?php /* Smarty version Smarty-3.1.15, created on 2014-10-17 11:39:41
         compiled from "./view/header.html" */ ?>
<?php /*%%SmartyHeaderCode:179732252854408f2ee3f369-99301870%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4130e282db22da60b62aa7e97f809b0f19b4bef' => 
    array (
      0 => './view/header.html',
      1 => 1413517177,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '179732252854408f2ee3f369-99301870',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_54408f2ee48d31_27220174',
  'variables' => 
  array (
    'app_domain' => 0,
    'basedomain' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54408f2ee48d31_27220174')) {function content_54408f2ee48d31_27220174($_smarty_tpl) {?><header id="header">

		<h1 id="site-logo">
			<a href="<?php echo $_smarty_tpl->tpl_vars['app_domain']->value;?>
">
				<img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
images/logos/logo.png" alt="Admin" width="200px"/>
			</a>
		</h1>	

		<a href="javascript:;" data-toggle="collapse" data-target=".top-bar-collapse" id="top-bar-toggle" class="navbar-toggle collapsed">
			<i class="fa fa-cog"></i>
		</a>

		<a href="javascript:;" data-toggle="collapse" data-target=".sidebar-collapse" id="sidebar-toggle" class="navbar-toggle collapsed">
			<i class="fa fa-reorder"></i>
		</a>

</header> <!-- header --><?php }} ?>
