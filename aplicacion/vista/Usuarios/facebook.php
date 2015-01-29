
<div class="container">
    
    <form class="form-horizontal" role="form" action="<?php echo URL; ?>">
        <h2 class="form-signin-heading">Tus datos</h2>
        <img src="<?php echo $userDetails->imageUrl; ?>" alt="..." class="img-thumbnail">

        <div class="form-group">
            <label class="col-sm-2 control-label">ID</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php echo $userDetails->uid; ?></p>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php echo $userDetails->name; ?></p>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label">Primer nombre</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php echo $userDetails->firstName; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Apellidos</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php echo $userDetails->lastName; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Lugar</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php echo $userDetails->location; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Descripción</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php echo $userDetails->description; ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-8 control-label"><?php echo $error.'<br/>'; ?></label>
        </div>
        
        
        <button class="btn btn-success btn-primary btn-block" type="submit">Entrar</button>
    </form>

</div>
?>