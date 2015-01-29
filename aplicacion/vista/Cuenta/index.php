<div class="container separar">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Cuenta
            </h1>
        </div>
    </div>
    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >


            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title" style="text-transform: uppercase;">
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center">
                            
                        </div>
                        <div class="col-xs-9 col-md-9 col-lg-9 table-responsive"> 
                            <form method="post" action="https://stg.gateway.payulatam.com/ppp-web-gateway/">
                                <input name="merchantId"    type="hidden"  value="500238"   >
                                <input name="accountId"     type="hidden"  value="500538" >
                                <input name="description"   type="hidden"  value="Test PAYU"  >
                                <input name="referenceCode" type="hidden"  value="TestPayU" >
                                <input name="amount"        type="hidden"  value="3"   >
                                <input name="tax"           type="hidden"  value="0"  >
                                <input name="taxReturnBase" type="hidden"  value="0" >
                                <input name="currency"      type="hidden"  value="USD" >
                                <input name="signature"     type="hidden"  value="be2f083cb3391c84fdf5fd6176801278"  >
                                <input name="test"          type="hidden"  value="1" >
                                <input name="buyerEmail"    type="hidden"  value="test@test.com" >
                                <input name="responseUrl"    type="hidden"  value="http://www.test.com/response" >
                                <input name="confirmationUrl"    type="hidden"  value="http://www.test.com/confirmation" >
                                <input name="Submit"        type="submit"  value="Generar recibo" >
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                </div>

            </div>
        </div>
    </div>
</div>