<?php /* Smarty version Smarty-3.1.15, created on 2014-10-17 11:38:22
         compiled from "./view/top-bar.html" */ ?>
<?php /*%%SmartyHeaderCode:147539309754408f2ef3b756-42743105%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3a7b77be3abc500708e9516091e39404950fce8c' => 
    array (
      0 => './view/top-bar.html',
      1 => 1407729496,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '147539309754408f2ef3b756-42743105',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'basedomain' => 0,
    'admin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_54408f2f03d7f6_62314728',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54408f2f03d7f6_62314728')) {function content_54408f2f03d7f6_62314728($_smarty_tpl) {?><nav id="top-bar" class="collapse top-bar-collapse">

	<ul class="nav navbar-nav pull-left">
		<li class="">
			<a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home">
				<i class="fa fa-home"></i> 
				Home
			</a>
		</li>
		
	</ul>

	<ul class="nav navbar-nav pull-right">
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
				<i class="fa fa-user"></i>
				<?php echo $_smarty_tpl->tpl_vars['admin']->value['admin']['name'];?>

				<span class="caret"></span>
			</a>

			<ul class="dropdown-menu" role="menu">
				<li>
					<a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
profile">
						<i class="fa fa-cogs"></i> 
						&nbsp;&nbsp;Settings
					</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
logout.php">
						<i class="fa fa-sign-out"></i> 
						&nbsp;&nbsp;Logout
					</a>
				</li>
			</ul>
		</li>
	</ul>

</nav> <!-- /#top-bar --><?php }} ?>