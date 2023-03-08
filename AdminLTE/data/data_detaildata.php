
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form id="frm" name="frm" action=""  method="post">
        <div class="row">
            <div class="col-md-2">

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">검색 조건</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">

                            <label for="exampleInputEmail1">md_id</label>
                            <select class="custom-select rounded-0" id="md_id" name="md_id">
                                <option value="">선택하세요.</option>
                                <option value="7000">두람농장</option>
                            </select>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">센서</label>
                            <select class="custom-select rounded-0" id="sensor" name="sensor">
                                <option value="">선택하세요.</option>
                                <option value="TDSIN">TDS IN</option>
                                <option value="TDSOUT">TDS OUT</option>
                                <option value="PRESSUREIN">압력 IN</option>
                                <option value="PRESSUREOUT">압력 OUT</option>
                                <option value="WATERIN">유량 IN</option>
                                <option value="WATEROUT">유량 OUT</option>
                                <option value="THROUGHPUT">수처리량</option>
                                <option value="POWER">전력사용량</option>
                            </select>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">날짜</label>
                            <div class="input-group">
                                <input type="text" class="form-control float-right" id="reservationtime" name="sdateAtedate">
                            </div>
                        </div>

                        <hr>

                        <button type="button" class="btn btn-block bg-gradient-primary" id="search">검색</button>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-10 ">
                <div class="card">
                    <div class="card-body">
                        <div id="_chart" style="height: 900px;"></div>
<!--                        <canvas id="myChart" style="height: 900px;"></canvas>-->
<!--                        <button type="button" class="btn btn-block bg-gradient-primary" id="chart_image_download">Chart Download</button>-->
<!--                        <button type="button" class="btn btn-block bg-gradient-primary" id="excel_image_download">Excel Download</button>-->
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
        /*
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

         */


        $("#search").click(function () {

            if ($("#md_id").val() == "") {
                alert("md_id를 입력하세요.");
                return false;
            }

            if ($("#sensor").val() == "") {
                alert("센서를 선택하세요.");
                return false;
            }

            if ($("#reservationtime").val() == "") {
                alert("날짜를 선택하세요.");
                return false;
            }

            $.ajaxSetup({ cache: false });
            $.ajax({
                url: "../conf/AjaxAll.data.php",
                type:'post',
                data: {md_id:$("[name='md_id']").val(), sensor:$("[name='sensor']").val(), sdateAtedate:$("[name='sdateAtedate']").val()},
                dataType: 'json',
                success: function (data) {
                    if (data.pay_load.datatype == "power") {
                        // alert("1"+data.pay_load.datatype);
                        update_type_2(data,data.pay_load.datatype)
                    } else {
                        // alert("2"+data.pay_load.datatype);
                        update_type_1(data,data.pay_load.datatype)
                    }

                },
                error: function () {
                    // setTimeout(GetData, updateInterval);
                }
            });
        })

        function update_type_1(_data,type) {
            const dataset = _data.pay_load.dataset

            $.plot('#_chart', [dataset[type]], {
                grid  : {
                    hoverable  : true,
                    borderColor: '#f3f3f3',
                    borderWidth: 1,
                    tickColor  : '#f3f3f3',
                },
                series: {
                    shadowSize: 0,
                    lines     : {
                        show: true
                    },
                    points    : {
                        show: true
                    }
                },
                lines : {
                    fill : false,
                    color: ['#3c8dbc', '#f56954']
                },
                yaxis : {
                    show: true
                },

                xaxis : {
                    ticks: _data.pay_load.create_at,
                    show: true
                }
            })
        }

        function update_type_2(_data,type) {
            const dataset = _data.pay_load.dataset

            $.plot('#_chart', [dataset[type]], {
                grid  : {
                    borderWidth: 1,
                    borderColor: '#f3f3f3',
                    tickColor  : '#f3f3f3'
                },
                series: {
                    bars: {
                        show: true, barWidth: 0.5, align: 'center',
                    },
                },
                colors: ['#3c8dbc'],
                xaxis : {
                    ticks: _data.pay_load.create_at,
                    show: true
                }
            })
        }
    });
</script>