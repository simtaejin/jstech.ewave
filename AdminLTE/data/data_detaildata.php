
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form id="frm" name="frm" action=""  method="post">
        <div class="row">
            <div class="col-md-3">

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">검색 조건</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <?php
                            $sql = "select distinct (gid) from geteway";
                            $result = mysqli_query($conn, $sql);
                            ?>
                            <label for="exampleInputEmail1">geteway</label>
                            <select class="custom-select rounded-0" id="geteway" name="geteway">
                                <option value="">선택하세요.</option>
                                <?php
                                while($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <option value="<?php echo $row['gid']; ?>"><?php echo $row['gid']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">node</label>
                            <select class="custom-select rounded-0" id="node" name="node">
                                <option value="">선택하세요.</option>
                            </select>

                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">센서</label>
                            <select class="custom-select rounded-0" id="sensor" name="sensor">
                                <option value="">선택하세요.</option>
                            </select>
                        </div>

                        <hr>

                        <button type="button" class="btn btn-block bg-gradient-primary" id="search">검색</button>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <div class="row">
                            <!-- Date and time range -->
                            <div class="form-group col-md-5">
                                <label>시작일시과 종료일 </label>

                                <div class="input-group">
                                    <input type="text" class="form-control float-right" id="reservationtime" name="sdateAtedate">
                                </div>
                                <!-- /.input group -->
                            </div>


                            <!-- radio -->
                            <div class="form-group col-md-7 " style="text-align: center">
                                <label>시간간격 </label>
                                <div class="input-group" style="display: inline-block;text-align: center;">
                                    <div class="icheck-primary d-inline col-sm-1">
                                        <input type="radio" id="radioPrimary1" name="bun" value="1m" checked>
                                        <label for="radioPrimary1">
                                            1m
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline col-sm-1">
                                        <input type="radio" id="radioPrimary2" name="bun" value="5m">
                                        <label for="radioPrimary2">
                                            5m
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline col-sm-1">
                                        <input type="radio" id="radioPrimary3" name="bun" value="10m">
                                        <label for="radioPrimary3">
                                            10m
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline col-sm-1">
                                        <input type="radio" id="radioPrimary4" name="bun" value="60m">
                                        <label for="radioPrimary4">
                                            60m
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline col-sm-1">
                                        <input type="radio" id="radioPrimary5" name="bun" value="1h">
                                        <label for="radioPrimary5">
                                            1h
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline col-sm-1">
                                        <input type="radio" id="radioPrimary6" name="bun" value="6h">
                                        <label for="radioPrimary6">
                                            6h
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline col-sm-1">
                                        <input type="radio" id="radioPrimary7" name="bun" value="1day">
                                        <label for="radioPrimary7">
                                            1day
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <canvas id="myChart" style="height: 900px;"></canvas>
                        <button type="button" class="btn btn-block bg-gradient-primary" id="chart_image_download">Chart Download</button>
                        <button type="button" class="btn btn-block bg-gradient-primary" id="excel_image_download">Excel Download</button>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        </form>
        <!-- /.row -->

<!--        <div class="card">-->
<!--            <div class="card-header">-->
<!--                <h3 class="card-title">DataTable with default features</h3>-->
<!--            </div>-->
<!--            <div class="card-body">-->
<!--                <table id="example" class="table table-bordered table-striped"></table>-->
<!--            </div>-->
<!--        </div>-->

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->



<!-- /.modal -->
<script src="plugins/jquery/jquery.min.js"></script>
<script>

    $(function () {
        $("#geteway").change(function () {
            if ($(this).val()) {
                $.ajax({
                    url:'../conf/dashboardAction.php',
                    type:'post',
                    data: {mode:'select_1', select_value:$(this).val()},
                    dataType: "json",
                    success:function(obj){
                        if (obj.pay_load.success == "success") {
                            if (obj.pay_load.result.nid[0]) {
                                $("#node option:gt(0)").remove();
                                $("#sensor option:gt(0)").remove();
                                obj.pay_load.result.nid.forEach(function (el, index) {
                                    $('#node').append($('<option>', {
                                        value: obj.pay_load.result.nid[index],
                                        text : el+' | node_'+obj.pay_load.result.nid_type[index]
                                    }));
                                })
                            }
                        }
                    }
                })
            }
        })

        $("#node").change(function () {
            if ($(this).val()) {
                $.ajax({
                    url:'../conf/dashboardAction.php',
                    type:'post',
                    // data: {mode:'select_2', select_value1:$("#geteway").val(), select_value2:$(this).val(), sdateAtedate:$("[name='sdateAtedate']").val(), bun:$("[name='bun']:checked").val()},
                    data: {mode:'select_2', select_value1:$("#geteway").val(), select_value2:$(this).val()},
                    dataType: "json",
                    success:function(obj){
                        if (obj.pay_load.success == "success") {
                            console.log(obj.pay_load.result)
                            if (obj.pay_load.result[0]) {
                                $("#sensor option:gt(0)").remove();
                                obj.pay_load.result.forEach(function (el, index) {
                                    $('#sensor').append($('<option>', {
                                        value: el,
                                        text : el
                                    }));
                                })

                                // const labels = obj.pay_load.chart_labels
                                //
                                // const data = {
                                //     labels: labels,
                                //     datasets: obj.pay_load.datasets
                                // };
                                //
                                // const config = {
                                //     type: 'line',
                                //     data: data,
                                //     options: {
                                //
                                //     }
                                // };
                                //
                                // const myChart = new Chart(
                                //     document.getElementById('myChart'),
                                //     config
                                // );


                            }
                        }
                    }
                })
            }
        })

        $("#search").click(function () {
            let select_value1 = $("#geteway").val()
            let select_value2 = $("#node").val()
            let select_value3 = $("#sensor").val()
            let sdateAtedate = $("[name='sdateAtedate']").val()
            let bun = $("[name='bun']:checked").val()

            $.ajax({
                url:'../conf/dashboardAction.php',
                type:'post',
                data: {mode:'search', select_value1:select_value1, select_value2:select_value2, select_value3:select_value3, sdateAtedate:sdateAtedate, bun:bun},
                dataType: "json",
                success:function(obj){
                    if (obj.length < 1) {
                        alert("error");
                        return false;
                    }
                    if (obj.pay_load.success == "success") {
                        console.log(obj.pay_load.result)
                        if (obj.pay_load.result[0]) {


                            const labels = obj.pay_load.chart_labels

                            const data = {
                                labels: labels,
                                datasets: obj.pay_load.datasets
                            };

                            const config = {
                                type: 'line',
                                data: data,
                                options: {
                                    scaleOverlay: false,
                                }
                            };

                            const myChart = new Chart(
                                document.getElementById('myChart'),
                                config
                            );


                        }
                    }
                },
                error:function (e) {
                    alert(e);
                }
            })


        })

        $("#chart_image_download").click(function () {
            const imageLink = document.createElement('a')
            const canvas = document.getElementById('myChart')
            imageLink.download = 'chart.png'
            imageLink.href = canvas.toDataURL('image/png', 1)
            imageLink.click()
        })

        $("#excel_image_download").click(function () {
            $("#frm").attr("action", "../../conf/excelDownAction.php").submit()
        })
    });
</script>