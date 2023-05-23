<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-lg-2"></div>
		<div class="col-lg-8">
            <div class="panel panel-info">
                <div class="panel-body">
                    <?php
                    $retornoExito = $this->session->flashdata('retornoExito');
                    if ($retornoExito) {
                    ?>
                        <div class="col-lg-12">
                            <div class="row" align="center">
                                <div style="width:70%;" align="center">
                                    <div class="alert alert-success"> <span class="glyphicon glyphicon-ok">&nbsp;</span>
                                        <?php echo $retornoExito; ?>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    <?php
                    } $retornoError = $this->session->flashdata('retornoError');
                    if ($retornoError) {
                    ?>
                        <div class="col-lg-12">
                            <div class="row" align="center">
                                <div style="width:70%;" align="center">
                                    <div class="alert alert-danger"> <span class="glyphicon glyphicon-remove">&nbsp;</span>
                                        <?php echo $retornoError; ?>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>