<style>
    table td,table th{
        padding: 3px !important;
    }
</style>
<?php 
$date_start = isset($_GET['date_start']) ? $_GET['date_start'] :  date("Y-m-d",strtotime(date("Y-m-d")." -7 days")) ;
$date_end = isset($_GET['date_end']) ? $_GET['date_end'] :  date("Y-m-d") ;
?>
<div class="card card-primary card-outline">
    <div class="card-header">
        <h5 class="card-title">Reportes de reparaciones</h5>
    </div>
    <div class="card-body">
        <form id="filter-form">
            <div class="row align-items-end">
                <div class="form-group col-md-3">
                    <label for="date_start">Fecha inicio</label>
                    <input type="date" class="form-control form-control-sm" name="date_start" value="<?php echo date("Y-m-d",strtotime($date_start)) ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="date_start">Fecha final</label>
                    <input type="date" class="form-control form-control-sm" name="date_end" value="<?php echo date("Y-m-d",strtotime($date_end)) ?>">
                </div>
                <div class="form-group col-md-1">
                    <button class="btn btn-flat btn-block btn-primary btn-sm"><i class="fa fa-filter"></i> Filtro</button>
                </div>
                <div class="form-group col-md-1">
                    <button class="btn btn-flat btn-block btn-success btn-sm" type="button" id="printBTN"><i class="fa fa-print"></i> Imprimir</button>
                </div>
            </div>
        </form>
        <hr>
        <div id="printable">
            <div>
                <h4 class="text-center m-0"><?php echo $_settings->info('name') ?></h4>
                <h3 class="text-center m-0"><b>Reporte de reparaciones</b></h3>
                <hr>
            </div>
            <table class="table table-bordered">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                </colgroup>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Vehiculo</th>
                        <th>Patente</th>
                        <th>Asignado por</th>
                        <th>Servicio</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                        $mechanic = $conn->query("SELECT * FROM mechanics_list");
                        $result = $mechanic->fetch_all(MYSQLI_ASSOC);
                        $mech_arr = array_column($result,'name','id');
                        $where = "where date(date_created) between '{$date_start}' and '{$date_end}'";
                        $qry = $conn->query("SELECT * from service_requests {$where} order by unix_timestamp(date_created) desc");
                        while($row = $qry->fetch_assoc()):
                        $meta = $conn->query("SELECT * FROM request_meta where request_id = '{$row['id']}'");
                        while($mrow = $meta->fetch_assoc()){
                            $row[$mrow['meta_field']] =$mrow['meta_value'];
                        }
                        $services  = $conn->query("SELECT * FROM service_list where id in ({$row['service_id']}) ");

                        while($srow = $services->fetch_assoc()):
                            
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i++ ?></td>
                        <td><?php echo $row['date_created'] ?></td>
                        <td><?php echo $row['owner_name'] ?></td>
                        <td><?php echo $row['vehicle_name'] ?></td>
                        <td><?php echo $row['vehicle_registration_number'] ?></td>
                        <td><?php echo !empty($row['mechanic_id']) && isset($mech_arr[$row['mechanic_id']]) ? $mech_arr[$row['mechanic_id']] : "N/A" ?></td>
                        <td><?php echo $srow['service'] ?></td>
                        <td class='text-center'>
                            <?php if($row['status'] == 1): ?>
                                <span class="badge badge-primary">Confirmado</span>
                            <?php elseif($row['status'] == 2): ?>
                                <span class="badge badge-warning">En progreso</span>
                            <?php elseif($row['status'] == 3): ?>
                                <span class="badge badge-success">Realizado</span>
                            <?php elseif($row['status'] == 4): ?>
                                <span class="badge badge-danger">Cancelado</span>
                            <?php else: ?>
                                <span class="badge badge-secondary">Pendiente</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php endwhile; ?>
                    <?php if($qry->num_rows <= 0): ?>
                    <tr>
                        <td class="text-center" colspan="6">Sin datos...</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<noscript>
    <style>
        .m-0{
            margin:0;
        }
        .text-center{
            text-align:center;
        }
        .text-right{
            text-align:right;
        }
        .table{
            border-collapse:collapse;
            width: 100%
        }
        .table tr,.table td,.table th{
            border:1px solid gray;
        }
    </style>
</noscript>
<script>
    $(function(){
        $('#filter-form').submit(function(e){
            e.preventDefault()
            location.href = "./?page=report&date_start="+$('[name="date_start"]').val()+"&date_end="+$('[name="date_end"]').val()
        })

        $('#printBTN').click(function(){
            var rep = $('#printable').clone();
            var ns = $('noscript').clone().html();
            start_loader()
            rep.prepend(ns)
            var nw = window.document.open('','_blank','width=900,height=600')
                nw.document.write(rep.html())
                nw.document.close()
                nw.print()
                setTimeout(function(){
                    nw.close()
                    end_loader()
                },500)
        })
    })
</script>