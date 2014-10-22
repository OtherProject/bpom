<?php /* Smarty version Smarty-3.1.15, created on 2014-10-22 14:30:35
         compiled from "./view/sidebar.html" */ ?>
<?php /*%%SmartyHeaderCode:40655109454408f2f042449-09304852%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd064259dbd57878c55967c97fc189d9b7462e5cb' => 
    array (
      0 => './view/sidebar.html',
      1 => 1413959175,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '40655109454408f2f042449-09304852',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_54408f2f0793a9_76142244',
  'variables' => 
  array (
    'basedomain' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54408f2f0793a9_76142244')) {function content_54408f2f0793a9_76142244($_smarty_tpl) {?>
<div id="sidebar-wrapper" class="collapse sidebar-collapse">
	
	<div id="search">
		<form>
			<input class="form-control input-sm" type="text" name="search" placeholder="Search..." />

			<button type="submit" id="search-btn" class="btn"><i class="fa fa-search"></i></button>
		</form>		
	</div> <!-- #search -->

	<nav id="sidebar">		
		
		<ul id="main-nav" class="open-active">			
			
			
			<li class="dropdown active">
				<a href="javascript:;">
					<i class="fa fa-file-text"></i>
					Article 
					<span class="caret"></span>
				</a>				
				<ul class="sub-nav">
					<li>
						<a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
article/addarticle">
							<i class="fa fa-plus"></i> 
							Add New Article
						</a>
					</li>
					<li>
						<a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home">
							<i class="fa fa-list-alt"></i> 
							Article List
						</a>
					</li>
					<li>
						<a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
article/profil">
							<i class="fa fa-list-alt"></i> 
							Profile
						</a>
					</li>
					<li>
						<a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
article/kontak">
							<i class="fa fa-list-alt"></i> 
							Kontak
						</a>
					</li>
				</ul>
			</li>
			
			<li class="dropdown">
				<a href="javascript:;">
					<i class="fa fa-user"></i>
					User Management
					<span class="caret"></span>
				</a>				
				<ul class="sub-nav">
					<li>
						<a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
user/add">
							<i class="fa fa-plus"></i> 
							Tambah User
						</a>
					</li>
					<li>
						<a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
user">
							<i class="fa fa-list"></i> 
							List User
						</a>
					<li>
						
				</ul>
			</li>	
			

			<li class="">
				<a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
evaluasi">
					<i class="fa fa-check"></i>
					Evaluasi
					
				</a>				
				
			</li>	
			<li class="">
				<a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
import">
					<i class="fa fa-folder"></i>
					Import Data XLS
					
				</a>				
				
			</li>	

			
		</ul>
				
	</nav> <!-- #sidebar -->

</div> <!-- /#sidebar-wrapper --><?php }} ?>
