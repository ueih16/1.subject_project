<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style type="text/css">
	.highcharts-figure,
	.highcharts-data-table table {
		min-width: 360px;
		max-width: 800px;
		margin: 1em auto;
	}

	.highcharts-data-table table {
		font-family: Verdana, sans-serif;
		border-collapse: collapse;
		border: 1px solid #ebebeb;
		margin: 10px auto;
		text-align: center;
		width: 100%;
		max-width: 500px;
	}

	.highcharts-data-table caption {
		padding: 1em 0;
		font-size: 1.2em;
		color: #555;
	}

	.highcharts-data-table th {
		font-weight: 600;
		padding: 0.5em;
	}

	.highcharts-data-table td,
	.highcharts-data-table th,
	.highcharts-data-table caption {
		padding: 0.5em;
	}

	.highcharts-data-table thead tr,
	.highcharts-data-table tr:nth-child(even) {
		background: #f8f8f8;
	}

	.highcharts-data-table tr:hover {
		background: #f1f7ff;
	}
</style>
</head>
<body>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/series-label.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>
	<figure class="highcharts-figure">
		<div id="container"></div>
	</figure>
	<?php
	require_once '../connect.php';
	$sql = "select sum(total) as revenue, DATE_FORMAT(created_at, '%e-%m') as date from orders group by DATE_FORMAT(		created_at, '%e-%m')
			";
	$result = mysqli_query($connect,$sql);
	$revenue_days = 30;
	$today = date('d');
	$today_extended = date('d-m');
	$this_month = date("m");

	if ($today < $revenue_days) {
		$number_of_last_month = $revenue_days - $today;
		$last_month = date("m",strtotime("-1 month"));
		$last_day_of_last_month = date("t", strtotime(date("Y-m-d",strtotime("-1 month"))));
		$start_day_last_month = $last_day_of_last_month - $number_of_last_month + 1;
		for ($i = $start_day_last_month; $i <= $last_day_of_last_month; $i++) { 
			$key = $i. '-'. $last_month;
			$arr[$key] = 0;
		}
	}
	for ($i = 1; $i <= $today; $i++) { 
			$key = $i. '-'. $this_month;
			$arr[$key] = 0;
		}
		foreach ($result as $each) {
			$arr[$each['date']] = (float)$each['revenue'];
		}
	?>
	<script type="text/javascript">
		Highcharts.chart('container', {

			title: {
				text: 'Thống kê doanh thu 30 ngày gần nhất',
				align: 'center'
			},

			yAxis: {
				title: {
					text: 'Doanh thu'
				}
			},

			xAxis: {
				categories: <?php echo json_encode(array_keys($arr)) ?>
			},

			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'middle'
			},

			plotOptions: {
				series: {
					label: {
						connectorAllowed: false
					}
				}
			},

			series: [{
				data: <?php echo json_encode(array_values($arr)) ?>
			}],

			responsive: {
				rules: [{
					condition: {
						maxWidth: 500
					},
					chartOptions: {
						legend: {
							layout: 'horizontal',
							align: 'center',
							verticalAlign: 'bottom'
						}
					}
				}]
			}

		});
	</script>
</body>
</html>