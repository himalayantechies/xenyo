<!-- BEGIN LOGIN FORM -->
<?php echo $this->Form->create('User', array('class' => 'login-form', 'novalidate' => 'novalidate')); ?>
    <h3 class="form-title">Login to your account</h3>
    <div class="alert alert-danger display-hide">
        <button data-close="alert" class="close"></button>
        <span> Enter any username and password. </span>
    </div>
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Username</label>
        <div class="input-icon">
            <i class="fa fa-user"></i>
            <?php echo $this->Form->input('username', array('label' => false, 'div' => false, 
                                                                  'placeholder' => 'User Name', 
                                                                  'class' => 'form-control placeholder-no-fix')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <div class="input-icon">
            <i class="fa fa-lock"></i>
            <?php echo $this->Form->input('password', array('label' => false, 'div' => false, 'type' => 'password', 
                                                                  'placeholder' => 'Password', 
                                                                  'class' => 'form-control placeholder-no-fix',
                                                                  'autocomplete' => 'off')); ?>
        </div>
    </div>
    <div class="form-actions margin-bottom-10">
        <button class="btn green pull-right" type="submit">
            Login <i class="m-icon-swapright m-icon-white"></i>
        </button>
    </div>
<?php echo $this->Form->end(); ?>
<!-- END LOGIN FORM -->