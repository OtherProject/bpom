<?php /* Smarty version Smarty-3.1.15, created on 2014-10-21 21:16:14
         compiled from "view/uploadFrame.html" */ ?>
<?php /*%%SmartyHeaderCode:210083318354465c9eb4d6b2-07035662%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88b3f61c6e41073bf513a67d8ff79d888971e944' => 
    array (
      0 => 'view/uploadFrame.html',
      1 => 1408783499,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '210083318354465c9eb4d6b2-07035662',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'basedomain' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_54465c9ebb8243_27531745',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54465c9ebb8243_27531745')) {function content_54465c9ebb8243_27531745($_smarty_tpl) {?><div id="content-header">
	<h1><i class="fa fa-facebook-square"></i> &nbsp;Facebook</h1>
</div> <!-- #content-header -->	

<div id="content-container">

	<div class="row">

		<div class="col-md-12">

			<div class="portlet">

				<div class="portlet-header">

					<h3>
						<i class="fa fa-cloud-upload"></i>
						Upload Frame and Cover
					</h3>

				</div> <!-- /.portlet-header -->

				<div class="portlet-content">

					<form method="POST" action="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
article/uplFrame" enctype="multipart/form-data">
						<center>

	                        <div class="col-sm-6">
	                            
	                        	<div class="fileupload fileupload-new" data-provides="fileupload">
								  <div class="fileupload-preview thumbnail" style="width: 400px; height: 250px;"></div>
								  <div>
								    <span class="btn btn-default btn-file"><span class="fileupload-new">Select Frame</span><span class="fileupload-exists">Change</span><input type="file" name="file_frame"/></span>
								    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
								  </div>
								</div>

	                        </div>

	                        <div class="col-sm-6">
	                            
	                        	<div class="fileupload fileupload-new" data-provides="fileupload">
								  <div class="fileupload-preview thumbnail" style="width: 400px; height: 250px;"></div>
								  <div>
								    <span class="btn btn-default btn-file"><span class="fileupload-new">Select Cover</span><span class="fileupload-exists">Change</span><input type="file" name="file_cover"/></span>
								    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
								  </div>
								</div>

	                        </div>
							<input type="hidden" name="typealbum" value="4" />
	                        <input type="text" name="title" size="40" placeholder="Title Here..." required/><br><br>
	                        <button type="submit" class="btn btn-primary">Upload</button>
	                    </center>
          			</form>	

				</div> <!-- /.portlet-content -->

			</div> <!-- /.portlet -->

		

		</div> <!-- /.col -->

	</div> <!-- /.row -->

</div><?php }} ?>