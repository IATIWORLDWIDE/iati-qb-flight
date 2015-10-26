<div class="row">
    <div class="col-md-4 col-md-offset-4">
    	
    	<?php if(isset($verifyError)): ?>
    	<div class="alert alert-danger" style="margin-top: 35% !important; ">
            <?=$verifyError?>
        </div>
    	<?php endif; ?>
    	
    	<?php if(!empty($error)): ?>
    	<div class="alert alert-danger" style="margin-top: 35% !important; ">
    		<pre>
            <?=json_encode($error, JSON_PRETTY_PRINT)?>
        	</pre>
        </div>
    	<?php endif; ?>
    	
        <div class="login-panel panel panel-default" style="margin-top: 5% !important; ">
            <div class="panel-heading">
                <h3 class="panel-title">Please Log In</h3>
            </div>
            
            <div class="panel-body">
                <form role="form" action="<?=__SITE_PATH?>/login/do_login" method="POST">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Auth Code" name="auth_code" type="text" autofocus>
                        </div>
                       
                        <!-- Change this to a button or input when using this as a form -->
                        <input type="submit" value="Login" class="btn btn-lg btn-success btn-block"/>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>